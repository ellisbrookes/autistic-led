require "test_helper"

class RegistrationsControllerTest < ActionDispatch::IntegrationTest
  setup do
    @user = users(:one)
  end

  test "should get new" do
    get signup_url

    assert_response :success
  end

  test "should create user and log in" do
    assert_difference("User.count") do
      post registration_url, params: {
        user: {
          email_address: "newuser@example.com",
          password: "password123",
          password_confirmation: "password123"
        }
      }
    end

    assert_redirected_to blogs_url
  end

  test "should reject invalid sign up" do
    assert_no_difference("User.count") do
      post registration_url, params: {
        user: {
          email_address: "",
          password: "password123",
          password_confirmation: "password123"
        }
      }
    end

    assert_response :unprocessable_entity
  end

  test "should redirect new when already logged in" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }

    get signup_url

    assert_redirected_to blogs_url
  end

  test "should redirect create when already logged in" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }

    assert_no_difference("User.count") do
      post registration_url, params: {
        user: {
          email_address: "another@example.com",
          password: "password123",
          password_confirmation: "password123"
        }
      }
    end

    assert_redirected_to blogs_url
  end
end
