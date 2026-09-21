# frozen_string_literal: true

class Website::NavLinkComponent < ViewComponent::Base
  BASE_CLASSES = "inline-flex items-center rounded-[10px] px-3.5 py-3 text-[length:calc(16px*var(--a11y-scale))] " \
    "[transition-duration:var(--a11y-motion-duration)] transition-colors"

  def initialize(text:, path:)
    @text = text
    @path = path
  end

  def classes
    if current_page?(@path)
      "#{BASE_CLASSES} font-bold text-[var(--a11y-accent)] underline decoration-2 underline-offset-[4px] " \
        "[text-decoration-color:var(--a11y-accent)]"
    else
      "#{BASE_CLASSES} font-semibold text-[var(--a11y-text)] [text-decoration:var(--a11y-underline)] " \
        "hover:bg-[var(--a11y-surface-alt)]"
    end
  end
end
