require "test_helper"

class BlogsControllerTest < ActionDispatch::IntegrationTest
  setup do
    @blog = blogs(:one)
    @user = users(:one)
  end

  test "should get index" do
    get blogs_url
    assert_response :success
  end

  test "should get new" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    get new_blog_url
    assert_response :success
  end

  test "should create blog" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }

    assert_difference("Blog.count") do
      post blogs_url, params: { blog: { content: @blog.content, title: @blog.title } }
    end

    assert_redirected_to blog_url(Blog.last)
  end

  test "should show blog" do
    get blog_url(@blog)
    assert_response :success
  end

  test "should get edit" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    get edit_blog_url(@blog)
    assert_response :success
  end

  test "should update blog" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }
    patch blog_url(@blog), params: { blog: { content: @blog.content, title: @blog.title } }
    assert_redirected_to blog_url(@blog)
  end

  test "should destroy blog" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }

    assert_difference("Blog.count", -1) do
      delete blog_url(@blog)
    end

    assert_redirected_to blogs_url
  end

  test "should redirect new when not logged in" do
    get new_blog_url

    assert_redirected_to login_url
  end
end
