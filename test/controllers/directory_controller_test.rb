require "test_helper"

class DirectoryControllerTest < ActionDispatch::IntegrationTest
  setup do
    @admin = users(:one)
    @member = users(:two)
    @approved_listing = directory_listings(:one)
    @pending_listing = directory_listings(:two)
    @member_approved_listing = directory_listings(:three)
  end

  test "should get index" do
    get directory_url
    assert_response :success
    assert_match "Calm Coding Collective", response.body
    assert_no_match "Quiet Makers", response.body
    assert_no_match "Quiet Cup Cafe", response.body
  end

  test "should redirect new when not logged in" do
    get new_directory_listing_url

    assert_redirected_to login_url
  end

  test "should get new when logged in" do
    post session_url, params: { email_address: @admin.email_address, password: "password123" }

    get new_directory_listing_url
    assert_response :success
  end

  test "should create directory listing when logged in" do
    post session_url, params: { email_address: @admin.email_address, password: "password123" }

    assert_difference("DirectoryListing.count") do
      post directory_url, params: {
        directory_listing: {
          name: "Neuro Art Studio",
          listing_type: "Creative services",
          location: "Boston",
          description: "Inclusive workshops and sensory-aware art sessions.",
          supports: "Visual schedules, low-noise sessions",
          website_url: "https://example.org",
          contact_email: "studio@example.org"
        }
      }
    end

    assert_redirected_to directory_listing_url(DirectoryListing.last)
  end

  test "should show approved listing" do
    get directory_listing_url(@approved_listing)

    assert_response :success
  end

  test "should not show pending listing when not owner" do
    get directory_listing_url(@pending_listing)

    assert_redirected_to directory_url
  end

  test "owner should show own pending listing" do
    post session_url, params: { email_address: @member.email_address, password: "password123" }

    get directory_listing_url(@pending_listing)

    assert_response :success
  end

  test "owner should get edit for own listing" do
    post session_url, params: { email_address: @member.email_address, password: "password123" }

    get edit_directory_listing_url(@member_approved_listing)

    assert_response :success
  end

  test "non owner should not get edit for another users listing" do
    post session_url, params: { email_address: @member.email_address, password: "password123" }

    get edit_directory_listing_url(@approved_listing)

    assert_redirected_to directory_url
  end

  test "owner update should require re-approval" do
    post session_url, params: { email_address: @member.email_address, password: "password123" }

    patch update_directory_listing_url(@member_approved_listing), params: {
      directory_listing: {
        name: "Spectrum Studio Updated",
        listing_type: @member_approved_listing.listing_type,
        location: @member_approved_listing.location,
        description: @member_approved_listing.description,
        supports: @member_approved_listing.supports,
        website_url: @member_approved_listing.website_url,
        contact_email: @member_approved_listing.contact_email
      }
    }

    assert_redirected_to directory_listing_url(@member_approved_listing)
    assert_not @member_approved_listing.reload.approved?
    assert_nil @member_approved_listing.approved_at
  end

  test "admin update should stay approved" do
    post session_url, params: { email_address: @admin.email_address, password: "password123" }

    patch update_directory_listing_url(@approved_listing), params: {
      directory_listing: {
        name: "Calm Coding Collective Updated",
        listing_type: @approved_listing.listing_type,
        location: @approved_listing.location,
        description: @approved_listing.description,
        supports: @approved_listing.supports,
        website_url: @approved_listing.website_url,
        contact_email: @approved_listing.contact_email
      }
    }

    assert_redirected_to directory_listing_url(@approved_listing)
    assert @approved_listing.reload.approved?
  end

  test "admin should approve a directory listing" do
    post session_url, params: { email_address: @admin.email_address, password: "password123" }

    patch approve_directory_listing_url(@pending_listing)

    assert_redirected_to directory_listing_url(@pending_listing)
    assert @pending_listing.reload.approved?
    assert_not_nil @pending_listing.approved_at
  end

  test "non admin should not approve a directory listing" do
    post session_url, params: { email_address: @member.email_address, password: "password123" }

    patch approve_directory_listing_url(@pending_listing)

    assert_redirected_to blogs_url
    assert_not @pending_listing.reload.approved?
  end

  test "admin should destroy a directory listing" do
    post session_url, params: { email_address: @admin.email_address, password: "password123" }

    assert_difference("DirectoryListing.count", -1) do
      delete destroy_directory_listing_url(@approved_listing)
    end

    assert_redirected_to directory_url
  end

  test "non admin should not destroy a directory listing" do
    post session_url, params: { email_address: @member.email_address, password: "password123" }

    assert_no_difference("DirectoryListing.count") do
      delete destroy_directory_listing_url(@approved_listing)
    end

    assert_redirected_to blogs_url
  end
end
