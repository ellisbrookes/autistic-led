class ApplicationController < ActionController::Base
  # Only allow modern browsers supporting webp images, web push, badges, import maps, CSS nesting, and CSS :has.
  allow_browser versions: :modern

  # Changes to the importmap will invalidate the etag for HTML responses
  stale_when_importmap_changes

  helper_method :current_user, :authenticated?, :owns_comment?, :owns_blog?, :admin?

  private

    def current_user
      return @current_user if defined?(@current_user)

      @current_user = User.find_by(id: session[:user_id])
    end

    def authenticated?
      current_user.present?
    end

    def require_authentication
      return if authenticated?

      redirect_to login_path, alert: "Please log in to continue."
    end

    def admin?
      current_user&.email_address == "admin@autisticled.com"
    end

    def require_admin
      return if admin?

      redirect_to blogs_path, alert: "Only admins can perform that action."
    end

    def commenter_token
      token = cookies.signed[:commenter_token]
      return token if token.present?

      token = SecureRandom.hex(16)
      cookies.signed.permanent[:commenter_token] = {
        value: token,
        httponly: true,
        same_site: :lax
      }
      token
    end

    def owns_comment?(comment)
      return false if comment.commenter_token.blank?

      ActiveSupport::SecurityUtils.secure_compare(comment.commenter_token, commenter_token)
    end

    def owns_blog?(blog)
      return false if current_user.blank? || blog.user_id.blank?

      blog.user_id == current_user.id
    end
end
