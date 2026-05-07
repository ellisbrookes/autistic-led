class RegistrationsController < ApplicationController
  before_action :redirect_if_authenticated

  def new
    @user = User.new
  end

  def create
    @user = User.new(user_params)

    if @user.save
      session[:user_id] = @user.id
      redirect_to blogs_path, notice: "Account created successfully."
    else
      render :new, status: :unprocessable_entity
    end
  end

  private

    def redirect_if_authenticated
      return unless authenticated?

      redirect_to blogs_path, notice: "You're already logged in."
    end

    def user_params
      params.expect(user: [ :email_address, :password, :password_confirmation ])
    end
end
