class BlogsController < ApplicationController
  before_action :require_authentication, except: %i[ index show ]
  before_action :set_blog, only: %i[ show edit update destroy approve ]
  before_action :require_blog_owner, only: %i[ edit update ]
  before_action :require_blog_owner_or_admin, only: %i[ destroy ]
  before_action :require_admin, only: %i[ approve ]

  # GET /blogs or /blogs.json
  def index
    scope = Blog.with_rich_text_content_and_embeds.order(created_at: :desc)
    @blogs = if admin?
      scope
    elsif authenticated?
      scope.where(approved: true).or(scope.where(user_id: current_user.id))
    else
      scope.where(approved: true)
    end
  end

  # GET /blogs/1 or /blogs/1.json
  def show
    unless @blog.approved? || owns_blog?(@blog) || admin?
      redirect_to blogs_path, alert: "This blog is awaiting admin approval."
      return
    end

    @comments = @blog.comments.top_level.includes(replies: :reply_to).order(created_at: :desc)
    @comment = @blog.comments.new
  end

  # GET /blogs/new
  def new
    @blog = Blog.new
  end

  # GET /blogs/1/edit
  def edit
  end

  # POST /blogs or /blogs.json
  def create
    @blog = Blog.new(blog_params)
    @blog.user = current_user

    respond_to do |format|
      if @blog.save
        format.html { redirect_to @blog, notice: "Blog was submitted for admin approval." }
        format.json { render :show, status: :created, location: @blog }
      else
        format.html { render :new, status: :unprocessable_entity }
        format.json { render json: @blog.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /blogs/1 or /blogs/1.json
  def update
    respond_to do |format|
      if @blog.update(blog_params)
        format.html { redirect_to @blog, notice: "Blog was successfully updated.", status: :see_other }
        format.json { render :show, status: :ok, location: @blog }
      else
        format.html { render :edit, status: :unprocessable_entity }
        format.json { render json: @blog.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /blogs/1 or /blogs/1.json
  def destroy
    @blog.destroy!

    respond_to do |format|
      format.html { redirect_to blogs_path, notice: "Blog was successfully destroyed.", status: :see_other }
      format.json { head :no_content }
    end
  end

  def approve
    if @blog.approved?
      redirect_to blog_path(@blog), notice: "Blog is already approved."
      return
    end

    @blog.update!(approved: true, approved_at: Time.current)
    redirect_to blog_path(@blog), notice: "Blog approved and now live."
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_blog
      @blog = Blog.find(params.expect(:id))
    end

    # Only allow a list of trusted parameters through.
    def blog_params
      params.expect(blog: [ :title, :content ])
    end

    def require_blog_owner
      return if owns_blog?(@blog)

      redirect_to blog_path(@blog), alert: "You can only manage your own blogs."
    end

    def require_blog_owner_or_admin
      return if owns_blog?(@blog) || admin?

      redirect_to blog_path(@blog), alert: "You can only manage your own blogs."
    end
end
