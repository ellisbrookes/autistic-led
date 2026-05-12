# frozen_string_literal: true

class Website::BannerComponent < ViewComponent::Base
  def initialize(message:, link_text:, link_path: nil, icon: nil)
    @message = message
    @link_text = link_text
    @link_path = link_path
  end
end
