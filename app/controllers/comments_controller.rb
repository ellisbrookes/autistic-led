class CommentsController < ApplicationController
  before_action :set_blog

  def create
    @comment = @blog.comments.new(comment_params)

    if @comment.save
      redirect_to blog_path(@blog), notice: "Comment posted successfully."
    else
      @comments = @blog.comments.order(created_at: :desc)
      render "blogs/show", status: :unprocessable_entity
    end
  end

  private

    def set_blog
      @blog = Blog.find(params.expect(:blog_id))
    end

    def comment_params
      params.expect(comment: [ :author_name, :body ])
    end
end
