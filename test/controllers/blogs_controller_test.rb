require "test_helper"

class BlogsControllerTest < ActionDispatch::IntegrationTest
  setup do
    @blog = blogs(:one)
    @pending_blog = blogs(:two)
    @user = users(:one)
    @other_user = users(:two)
  end

  test "should get index" do
    get blogs_url
    assert_response :success
    assert_match @blog.title, response.body
    assert_no_match @pending_blog.title, response.body
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

    assert_not Blog.last.approved?
    assert_redirected_to blog_url(Blog.last)
  end

  test "should show blog" do
    get blog_url(@blog)
    assert_response :success
  end

  test "should not show unapproved blog when not owner" do
    get blog_url(@pending_blog)

    assert_redirected_to blogs_url
  end

  test "owner should show own unapproved blog" do
    post session_url, params: { email_address: @other_user.email_address, password: "password123" }
    get blog_url(@pending_blog)

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

  test "admin should destroy another user's blog" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }

    assert_difference("Blog.count", -1) do
      delete blog_url(@pending_blog)
    end

    assert_redirected_to blogs_url
  end

  test "should not destroy another user's blog" do
    post session_url, params: { email_address: @other_user.email_address, password: "password123" }

    assert_no_difference("Blog.count") do
      delete blog_url(@blog)
    end

    assert_redirected_to blog_url(@blog)
  end

  test "admin should approve a blog" do
    post session_url, params: { email_address: @user.email_address, password: "password123" }

    patch approve_blog_url(@pending_blog)

    assert_redirected_to blog_url(@pending_blog)
    assert @pending_blog.reload.approved?
    assert_not_nil @pending_blog.approved_at
  end

  test "non admin should not approve a blog" do
    post session_url, params: { email_address: @other_user.email_address, password: "password123" }

    patch approve_blog_url(@pending_blog)

    assert_redirected_to blogs_url
    assert_not @pending_blog.reload.approved?
  end

  test "should redirect new when not logged in" do
    get new_blog_url

    assert_redirected_to login_url
  end
end
