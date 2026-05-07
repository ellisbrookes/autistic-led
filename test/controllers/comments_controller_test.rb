require "test_helper"

class CommentsControllerTest < ActionDispatch::IntegrationTest
  setup do
    @blog = blogs(:one)
  end

  test "should create comment" do
    assert_difference("Comment.count") do
      post blog_comments_url(@blog), params: {
        comment: {
          author_name: "Test Reader",
          body: "Great post, thanks for sharing this."
        }
      }
    end

    assert_redirected_to blog_url(@blog)
  end

  test "should not create invalid comment" do
    assert_no_difference("Comment.count") do
      post blog_comments_url(@blog), params: {
        comment: {
          author_name: "",
          body: ""
        }
      }
    end

    assert_response :unprocessable_entity
  end
end
