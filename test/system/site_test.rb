require "application_system_test_case"

class SiteTest < ApplicationSystemTestCase
  test "public pages load without browser errors" do
    [ root_path, team_path, blogs_path, blog_path(blogs(:one)), directory_listings_path,
      directory_listing_path(directory_listings(:three)), login_path, signup_path ].each do |path|
      visit path
      assert_selector "main"
      assert page.evaluate_async_script("const done = arguments[0]; import('@hotwired/turbo-rails').then(() => done(true), () => done(false))"), path
      assert_no_browser_errors
    end
  end

  test "turbo navigates without a full reload" do
    visit blogs_path
    assert page.evaluate_async_script("const done = arguments[0]; import('@hotwired/turbo-rails').then(() => done(true))")
    page.execute_script("window.notReloaded = true")
    click_link "Read more →", match: :first
    assert_selector "article.blog-article-shell"
    assert page.evaluate_script("window.notReloaded === true")
    assert_no_browser_errors
  end

  test "password visibility toggle works" do
    visit login_path
    assert_selector "input[name=password][type=password]"
    find("button[aria-label='Show or hide password']").click
    assert_selector "input[name=password][type=text]"
    assert_no_browser_errors
  end

  test "member can write a blog with an image" do
    log_in_as users(:two)
    visit new_blog_path
    fill_in "blog_title", with: "A post with a picture"
    find("trix-editor").click.send_keys("Hello from the browser")
    attach_image_to_editor
    assert_selector "trix-editor figure img"
    assert_selector "trix-editor progress", count: 0
    click_button "Create blog"

    assert_text "Blog was submitted for admin approval."
    assert_text "Hello from the browser"
    assert_selector ".blog-article-body img"
    assert_no_browser_errors
  end

  test "member edit goes back for review and admin can approve it" do
    blog = blogs(:three)
    log_in_as users(:two)
    visit edit_blog_path(blog)
    fill_in "blog_title", with: "Edited title"
    click_button "Update blog"
    assert_text "Blog changes submitted for admin approval."
    assert_not blog.reload.approved?

    Capybara.reset_sessions!
    log_in_as users(:one)
    visit blog_path(blog)
    click_button "Approve this blog"
    assert_text "Blog approved and now live."
    assert_predicate blog.reload, :approved?
    assert_no_browser_errors
  end

  test "admin can approve a directory listing" do
    listing = directory_listings(:three)
    listing.update!(approved: false)
    log_in_as users(:one)
    visit directory_listing_path(listing)
    click_button "Approve listing"
    assert_text "Directory listing approved and now live."
    assert_predicate listing.reload, :approved?
    assert_no_browser_errors
  end

  test "editing a listing keeps its photos" do
    listing = directory_listings(:three)
    listing.images.attach(io: file_fixture_image, filename: "photo.png", content_type: "image/png")
    log_in_as users(:two)
    visit edit_directory_listing_path(listing)
    fill_in "directory_listing_name", with: "Renamed listing"
    click_button "Update listing"

    assert_text "Directory listing changes submitted for admin approval."
    assert_equal 1, DirectoryListing.find(listing.id).images.count
    assert_no_browser_errors
  end

  test "visitor can comment" do
    visit blog_path(blogs(:one))
    within ".comment-reply-composer" do
      find("[name='comment[author_name]']").set("Visitor")
      find("[name='comment[body]']").set("A comment from the browser")
      find("[type=submit]").click
    end
    assert_text "Comment posted successfully."
    assert_no_browser_errors
  end

  test "results per page selector reloads the directory" do
    visit directory_listings_path
    select "20", from: "per_page"
    assert_current_path(/per_page=20/, url: true)
    assert_select "per_page", selected: "20"
    assert_no_browser_errors
  end

  test "injected scripts are blocked" do
    visit root_path
    page.execute_script(<<~JS)
      const script = document.createElement("script")
      script.textContent = "window.injected = true"
      document.body.appendChild(script)
    JS
    assert_not page.evaluate_script("window.injected === true")
    page.driver.browser.logs.get(:browser) # Clear the expected violation so the next test doesn't see it
  end

  private

    def file_fixture_image
      StringIO.new(Rails.root.join("public/favicon-32x32.png").binread)
    end

    def attach_image_to_editor
      page.execute_script(<<~JS, Base64.strict_encode64(file_fixture_image.read))
        const bytes = Uint8Array.from(atob(arguments[0]), (char) => char.charCodeAt(0))
        document.querySelector("trix-editor").editor.insertFile(new File([bytes], "photo.png", { type: "image/png" }))
      JS
    end
end
