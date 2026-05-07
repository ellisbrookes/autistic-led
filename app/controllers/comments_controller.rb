class CommentsController < ApplicationController
  before_action :set_blog
  before_action :set_comment, only: %i[update destroy]
  before_action :require_comment_owner, only: %i[update destroy]

  def create
    @reply_target = @blog.comments.find(params[:id]) if params[:id].present?
    @parent_comment = @reply_target&.parent || @reply_target

    if spam_submission?
      redirect_to blog_path(@blog), notice: "Comment posted successfully."
      return
    end

    if rate_limited?
      redirect_to blog_path(@blog), alert: "You're commenting too quickly. Please wait a minute and try again."
      return
    end

    @comment = @blog.comments.new(comment_params)
    @comment.parent = @parent_comment if @parent_comment.present?
    @comment.reply_to = @reply_target if @reply_target.present?
    @comment.commenter_token = commenter_token

    if @comment.save
      redirect_to blog_path(@blog, anchor: ActionView::RecordIdentifier.dom_id(@comment)), notice: "Comment posted successfully."
    else
      @comments = @blog.comments.top_level.includes(replies: :reply_to).order(created_at: :desc)
      render "blogs/show", status: :unprocessable_entity
    end
  end

  def update
    if @comment.update(comment_params)
      redirect_to blog_path(@blog, anchor: ActionView::RecordIdentifier.dom_id(@comment)), notice: "Comment updated successfully."
    else
      @comments = @blog.comments.top_level.includes(replies: :reply_to).order(created_at: :desc)
      @comment_with_errors = @comment
      @comment = @blog.comments.new
      @parent_comment = @comment_with_errors.parent
      @reply_target = @comment_with_errors.reply_to || @comment_with_errors.parent
      render "blogs/show", status: :unprocessable_entity
    end
  end

  def destroy
    @comment.destroy!
    redirect_to blog_path(@blog), notice: "Comment removed successfully."
  end

  private

    def set_blog
      @blog = Blog.find(params.expect(:blog_id))
    end

    def set_comment
      @comment = @blog.comments.find(params.expect(:id))
    end

    def comment_params
      params.expect(comment: [ :author_name, :body ])
    end

    def require_comment_owner
      return if owns_comment?(@comment)

      redirect_to blog_path(@blog), alert: "You can only edit or remove your own comments."
    end

    def spam_submission?
      params.dig(:comment, :website).present?
    end

    def rate_limited?
      key = "comments:#{request.remote_ip}:#{Time.current.to_i / 60}"
      attempts = Rails.cache.fetch(key, expires_in: 1.minute) { 0 }
      return true if attempts >= 8

      Rails.cache.write(key, attempts + 1, expires_in: 1.minute)
      false
    end
end
