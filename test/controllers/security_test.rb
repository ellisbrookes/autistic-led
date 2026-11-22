require "test_helper"

class SecurityTest < ActionDispatch::IntegrationTest
  setup do
    @admin = users(:one)
    @member = users(:two)
    @approved_blog = blogs(:three)
    @pending_blog = blogs(:two)
  end

  test "signup and profile cannot set role" do
    post registration_url, params: { role: "admin", user: signup_params.merge(role: "admin", admin: true) }
    user = User.find_by!(email_address: "new@example.com")
    assert_predicate user, :member?

    patch profile_url, params: { user: { name: "Changed", role: "admin" } }
    assert_predicate user.reload, :member?
  end

  test "member edit of title returns blog to review" do
    sign_in @member
    patch blog_url(@approved_blog), params: { blog: { title: "Changed" } }

    assert_not @approved_blog.reload.approved?
    assert_nil @approved_blog.approved_at
  end

  test "member edit of only content returns blog to review" do
    sign_in @member
    patch blog_url(@approved_blog), params: { blog: { content: "Changed" } }

    assert_not @approved_blog.reload.approved?
  end

  test "member json edit returns blog to review" do
    sign_in @member
    patch blog_url(@approved_blog, format: :json), params: { blog: { title: "Changed" } }

    assert_not @approved_blog.reload.approved?
  end

  test "admin edit of own blog stays approved" do
    sign_in @admin
    patch blog_url(blogs(:one)), params: { blog: { title: "Changed" } }

    assert_predicate blogs(:one).reload, :approved?
  end

  test "cannot approve blog content changed after review" do
    version = @pending_blog.updated_at.to_fs(:usec)
    travel 1.minute
    @pending_blog.update!(content: "Swapped")
    sign_in @admin
    patch approve_blog_url(@pending_blog, version: version)

    assert_not @pending_blog.reload.approved?
  end

  test "cannot approve listing changed after review" do
    listing = new_listing
    listing.save!
    version = listing.updated_at.to_fs(:usec)
    travel 1.minute
    listing.update!(description: "Swapped")
    sign_in @admin
    patch approve_directory_listing_url(listing, version: version)

    assert_not listing.reload.approved?
  end

  test "approve buttons carry the reviewed version" do
    listing = new_listing
    listing.save!
    sign_in @admin

    [ blogs_path, blog_path(@pending_blog), directory_listings_path, directory_listing_path(listing) ].each do |path|
      get path
      assert_select "form[action*='/approve?version=']"
    end
  end

  test "comments do not reveal or accept posts on hidden blogs" do
    assert_no_difference "Comment.count" do
      post blog_comments_url(@pending_blog), params: { comment: { author_name: "", body: "" } }
      assert_redirected_to blogs_url
      post blog_comments_url(@pending_blog), params: { comment: { author_name: "A", body: "B" } }
      assert_redirected_to blogs_url
    end
  end

  test "hidden blog json is not readable" do
    get blog_url(@pending_blog, format: :json)
    assert_redirected_to blogs_url
  end

  test "website must really be http" do
    [ "javascript:alert(1)//http://x.com", "javascript:alert(1)\nhttp://x.com", "data:text/html,http://x.com", "http://" ].each do |url|
      assert_not new_listing(website_url: url).valid?, url
    end
    assert new_listing(website_url: "https://example.com/path?q=1").valid?
  end

  test "unsafe website already in the database is not linked" do
    listing = new_listing(approved: true)
    listing.save!
    listing.update_column(:website_url, "javascript:alert(1)//http://x.com")

    get directory_listings_url
    assert_select "a[href^='javascript:']", count: 0
  end

  test "older listings with a bad url can still be moderated" do
    listing = new_listing
    listing.save!
    listing.update_column(:website_url, "not a url")

    assert listing.reload.update(approved: true)
  end

  test "contact email must be an email" do
    assert_not new_listing(contact_email: "not an email").valid?
  end

  test "listing rejects html and svg uploads" do
    [ [ "<html></html>", "x.html", "text/html" ], [ "<svg xmlns='http://www.w3.org/2000/svg'/>", "x.svg", "image/svg+xml" ] ].each do |body, name, type|
      assert_not new_listing(cover_image: { io: StringIO.new(body), filename: name, content_type: type }).valid?
      assert_not new_listing(images: [ { io: StringIO.new(body), filename: name, content_type: type } ]).valid?
    end
  end

  test "listing accepts a png" do
    assert new_listing(cover_image: png, images: [ png ]).valid?
  end

  test "listing rejects oversized and too many images" do
    large = png(Rails.root.join("public/favicon-32x32.png").binread + ("0" * 10.megabytes))
    assert_not new_listing(cover_image: large).valid?
    assert_not new_listing(images: Array.new(11) { png }).valid?
  end

  test "rejected upload renders the form on create and update" do
    sign_in @member
    file = Rack::Test::UploadedFile.new(StringIO.new("<html></html>"), "text/html", original_filename: "x.html")
    fields = { name: "L", listing_type: "T", description: "D", cover_image: file }
    post directory_listings_url, params: { directory_listing: fields }
    assert_response :unprocessable_entity

    listing = new_listing
    listing.save!
    file.rewind
    patch directory_listing_url(listing), params: { directory_listing: { images: [ file ] } }
    assert_response :unprocessable_entity
  end

  test "direct upload requires login" do
    direct_upload 100
    assert_response :unauthorized
  end

  test "direct upload enforces size" do
    sign_in @member
    direct_upload 100
    assert_response :success

    [ 11.megabytes, -1, nil, "abc" ].each do |size|
      direct_upload size
      assert_response :content_too_large
    end
  end

  test "signup rejects short passwords" do
    assert_no_difference "User.count" do
      post registration_url, params: { user: signup_params.merge(password: "short", password_confirmation: "short") }
    end
  end

  test "password change ends other sessions and keeps the current one" do
    other = open_session
    other.post session_url, params: { email_address: @member.email_address, password: "password123" }
    sign_in @member
    patch profile_url, params: { user: { current_password: "password123", password: "password456", password_confirmation: "password456" } }

    get profile_url
    assert_response :success
    other.get profile_url
    other.assert_redirected_to login_url
  end

  test "login handles unknown and missing credentials" do
    [ { email_address: "none@example.com", password: "password123" }, {} ].each do |credentials|
      post session_url, params: credentials
      assert_response :unprocessable_entity
    end
  end

  test "login still normalises email" do
    post session_url, params: { email_address: " #{@member.email_address.upcase} ", password: "password123" }
    assert_redirected_to blogs_url
  end

  private

    def sign_in(user)
      post session_url, params: { email_address: user.email_address, password: "password123" }
    end

    def signup_params
      { name: "New", email_address: "new@example.com", password: "password123", password_confirmation: "password123" }
    end

    def new_listing(**attrs)
      DirectoryListing.new(user: @member, name: "L", listing_type: "T", description: "D", **attrs)
    end

    def png(bytes = Rails.root.join("public/favicon-32x32.png").binread)
      { io: StringIO.new(bytes), filename: "x.png", content_type: "image/png" }
    end

    def direct_upload(size)
      post rails_direct_uploads_url, as: :json, params: {
        blob: { filename: "x.png", content_type: "image/png", byte_size: size, checksum: "1B2M2Y8AsgTpgAmY7PhCfg==" }
      }
    end
end
