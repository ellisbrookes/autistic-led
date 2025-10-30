# frozen_string_literal: true

class Website::SectionComponent < ViewComponent::Base
  VARIANTS = {
    default: "py-12",
    large: "py-24",
    fill: "flex-1 py-12"
    }.freeze

  def initialize(variant: :default)
    @variant = variant.to_sym
  end

  def classes
    classes = "dark:bg-primary-900 px-4 flex flex-col gap-8 border-b border-primary-300 dark:border-primary-700"
    "#{classes} #{VARIANTS[@variant]}"
  end
end
