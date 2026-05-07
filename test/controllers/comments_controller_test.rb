require "test_helper"

class CommentsControllerTest < ActionDispatch::IntegrationTest
  setup do
    @blog = blogs(:one)
    @comment = comments(:one)
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

    assert_redirected_to blog_url(@blog, anchor: ActionView::RecordIdentifier.dom_id(Comment.last))
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

  test "should create reply" do
    assert_difference("Comment.count") do
      post replies_blog_comment_url(@blog, @comment), params: {
        comment: {
          author_name: "Reply User",
          body: "Thanks for this perspective."
        }
      }
    end

    assert_equal @comment.id, Comment.last.parent_id
    assert_redirected_to blog_url(@blog, anchor: ActionView::RecordIdentifier.dom_id(Comment.last))
  end

  test "should create reply to a reply" do
    reply = comments(:reply_one)

    assert_difference("Comment.count") do
      post replies_blog_comment_url(@blog, reply), params: {
        comment: {
          author_name: "Thread User",
          body: "Replying directly to your message."
        }
      }
    end

    created_comment = Comment.last
    assert_equal @comment.id, created_comment.parent_id
    assert_equal reply.id, created_comment.reply_to_id
    assert_redirected_to blog_url(@blog, anchor: ActionView::RecordIdentifier.dom_id(created_comment))
  end

  test "should ignore honeypot spam submission" do
    assert_no_difference("Comment.count") do
      post blog_comments_url(@blog), params: {
        comment: {
          author_name: "Spam User",
          body: "Spam message",
          website: "https://spam.example"
        }
      }
    end

    assert_redirected_to blog_url(@blog)
  end

  test "should update own comment" do
    post blog_comments_url(@blog), params: {
      comment: {
        author_name: "Original Name",
        body: "Original body"
      }
    }

    created_comment = Comment.last

    patch blog_comment_url(@blog, created_comment), params: {
      comment: {
        author_name: "Updated Name",
        body: "Updated body"
      }
    }

    assert_redirected_to blog_url(@blog, anchor: ActionView::RecordIdentifier.dom_id(created_comment))
    assert_equal "Updated body", created_comment.reload.body
  end

  test "should destroy own comment" do
    post blog_comments_url(@blog), params: {
      comment: {
        author_name: "Original Name",
        body: "Original body"
      }
    }

    created_comment = Comment.last

    assert_difference("Comment.count", -1) do
      delete blog_comment_url(@blog, created_comment)
    end

    assert_redirected_to blog_url(@blog)
  end

  test "should not update someone elses comment" do
    patch blog_comment_url(@blog, @comment), params: {
      comment: {
        author_name: "Not Allowed",
        body: "Not allowed"
      }
    }

    assert_redirected_to blog_url(@blog)
    assert_not_equal "Not allowed", @comment.reload.body
  end
end
