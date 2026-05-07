require "test_helper"

class SessionsControllerTest < ActionDispatch::IntegrationTest
  setup do
    @user = users(:one)
  end

  test "should get new" do
    get new_session_url

    assert_response :success
  end

  test "should create session with valid credentials" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }

    assert_redirected_to blogs_url
  end

  test "should reject invalid credentials" do
    post session_url, params: { email_address: @user.email_address, password: "wrong" }

    assert_response :unprocessable_entity
  end

  test "should destroy session" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    delete session_url

    assert_redirected_to root_url
  end
end
