class SessionsController < ApplicationController
  def new
    redirect_to blogs_path, notice: "You're already logged in." if authenticated?
  end

  def create
    credentials = params.permit(:email_address, :password)
    email_address = credentials[:email_address].to_s.strip.downcase
    user = User.find_by(email_address: email_address)

    if user&.authenticate(credentials[:password])
      session[:user_id] = user.id
      redirect_to blogs_path, notice: "Logged in successfully."
    else
      flash.now[:alert] = "Invalid email or password."
      render :new, status: :unprocessable_entity
    end
  end

  def destroy
    session.delete(:user_id)
    redirect_to root_path, notice: "Logged out successfully."
  end
end
