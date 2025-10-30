# frozen_string_literal: true

class Website::NavLinkComponent < ViewComponent::Base
  def initialize(text:, path:)
    @text = text
    @path = path
  end

  def classes
    classes = "block rounded-md px-3 py-2 font-medium hover:bg-primary-300 dark:hover:bg-primary-700"

    if current_page?(@path)
      "#{classes} bg-primary-400 dark:bg-primary-500 text-white"
    else
      classes
    end
  end
end
