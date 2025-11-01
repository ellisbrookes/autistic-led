# frozen_string_literal: true

class Website::NavLinkComponent < ViewComponent::Base
  def initialize(text:, path:)
    @text = text
    @path = path
  end

  def classes
    classes = "block rounded-md px-3 py-2 font-medium hover:bg-gray-300 dark:hover:bg-gray-700"

    if current_page?(@path)
      "#{classes} bg-gray-400 dark:bg-gray-500"
    else
      classes
    end
  end
end
