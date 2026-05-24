module ApplicationHelper
  def safe_http_url(value)
    return if value.blank?

    uri = URI.parse(value)
    return unless uri.is_a?(URI::HTTP) && uri.host.present?

    uri.to_s
  rescue URI::InvalidURIError
    nil
  end
end
