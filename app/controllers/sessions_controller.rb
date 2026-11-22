class SessionsController < ApplicationController
  rate_limit to: 10, within: 3.minutes, only: :create,
    with: -> { redirect_to login_path, alert: "Too many login attempts. Please try again in a few minutes." }

  def new
    redirect_to blogs_path, notice: "You're already logged in." if authenticated?
  end

  def create
    credentials = params.permit(:email_address, :password)
    user = User.authenticate_by(email_address: credentials[:email_address].to_s, password: credentials[:password].to_s)

    if user
      log_in(user)
      redirect_to blogs_path, notice: "Logged in successfully."
    else
      flash.now[:alert] = "Invalid email or password."
      render :new, status: :unprocessable_entity
    end
  end

  def destroy
    reset_session
    redirect_to root_path, notice: "Logged out successfully."
  end
end
