require "test_helper"

class ProfilesControllerTest < ActionDispatch::IntegrationTest
  setup do
    @user = users(:one)
  end

  test "should redirect guests to login" do
    get profile_url

    assert_redirected_to login_url
  end

  test "should get show when authenticated" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    get profile_url

    assert_response :success
    assert_match @user.name, @response.body
  end

  test "should update name when authenticated" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    patch profile_url, params: { user: { name: "Updated Name" } }

    assert_redirected_to profile_url
    assert_equal "Updated Name", @user.reload.name
  end

  test "should reject blank name update" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    patch profile_url, params: { user: { name: "" } }

    assert_response :unprocessable_entity
  end

  test "should update email when authenticated" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    patch profile_url, params: {
      user: {
        name: @user.name,
        email_address: "updated@example.com",
        current_password: "password123"
      }
    }

    assert_redirected_to profile_url
    assert_equal "updated@example.com", @user.reload.email_address
  end

  test "should update password when authenticated" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    patch profile_url, params: {
      user: {
        name: @user.name,
        email_address: @user.email_address,
        current_password: "password123",
        password: "newpassword123",
        password_confirmation: "newpassword123"
      }
    }

    assert_redirected_to profile_url
    assert @user.reload.authenticate("newpassword123")
  end

  test "should reject mismatched password confirmation" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    patch profile_url, params: {
      user: {
        name: @user.name,
        email_address: @user.email_address,
        current_password: "password123",
        password: "newpassword123",
        password_confirmation: "wrongconfirmation"
      }
    }

    assert_response :unprocessable_entity
  end

  test "should reject email update without current password" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    patch profile_url, params: {
      user: {
        name: @user.name,
        email_address: "updated@example.com"
      }
    }

    assert_response :unprocessable_entity
    assert_equal @user.email_address, @user.reload.email_address
  end

  test "should reject password update with incorrect current password" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    patch profile_url, params: {
      user: {
        name: @user.name,
        email_address: @user.email_address,
        current_password: "wrongpassword",
        password: "newpassword123",
        password_confirmation: "newpassword123"
      }
    }

    assert_response :unprocessable_entity
    assert @user.reload.authenticate("password123")
  end
end
