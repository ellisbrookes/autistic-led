class ProfilesController < ApplicationController
  before_action :require_authentication

  def show
    @user = current_user
  end

  def update
    @user = current_user
    attributes = filtered_profile_params

    if attributes && @user.update(attributes)
      redirect_to profile_path, notice: "Profile updated."
    else
      render :show, status: :unprocessable_entity
    end
  end

  private

    def profile_params
      params.require(:user).permit(:name, :email_address, :password, :password_confirmation, :current_password)
    end

    def filtered_profile_params
      attrs = profile_params.to_h
      current_password = attrs.delete("current_password")
      email_changed = attrs.key?("email_address") &&
        attrs["email_address"].to_s.strip.downcase != @user.email_address.to_s.strip.downcase
      password_change_requested = attrs["password"].present? || attrs["password_confirmation"].present?

      if attrs["password"].blank? && attrs["password_confirmation"].blank?
        attrs.except!("password", "password_confirmation")
      end

      return attrs unless email_changed || password_change_requested

      if @user.authenticate(current_password.to_s)
        attrs
      else
        @user.assign_attributes(attrs.except("password", "password_confirmation"))
        @user.errors.add(:current_password, "is incorrect")
        nil
      end
    end
end
