# Active Storage's upload endpoint is public unless the app protects it.
module DirectUploadProtection
  extend ActiveSupport::Concern
  include Authentication

  MAX_SIZE = 10.megabytes

  included do
    before_action :require_upload_login, :require_upload_size
    rate_limit to: 60, within: 1.hour, only: :create
  end

  private

    def require_upload_login
      head :unauthorized unless authenticated?
    end

    def require_upload_size
      size = Integer(params.dig(:blob, :byte_size).to_s, exception: false)
      head :content_too_large unless size&.between?(1, MAX_SIZE)
    end
end
