# frozen_string_literal: true

class Website::NavLinkComponent < ViewComponent::Base
  def initialize(text:, path:)
    @text = text
    @path = path
  end

  def classes
    classes = "block rounded-md px-3 py-2 font-medium text-slate-700 transition-colors hover:bg-slate-200 hover:text-slate-900 dark:text-slate-200 dark:hover:bg-slate-700 dark:hover:text-white"

    if current_page?(@path)
      "#{classes} bg-slate-200 text-slate-900 dark:bg-slate-700 dark:text-white"
    else
      classes
    end
  end
end
