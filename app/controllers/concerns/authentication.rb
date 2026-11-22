module Authentication
  extend ActiveSupport::Concern

  private

    def current_user
      return @current_user if defined?(@current_user)

      user = User.find_by(id: session[:user_id]) if session[:user_id]
      @current_user = (user if user && session[:password_fingerprint] == password_fingerprint(user))
    end

    def authenticated?
      current_user.present?
    end

    def log_in(user)
      reset_session
      session[:user_id] = user.id
      session[:password_fingerprint] = password_fingerprint(user)
    end

    # Changes with the password, which logs out every session created with the old one.
    def password_fingerprint(user)
      Digest::SHA256.hexdigest(user.password_digest)
    end
end
