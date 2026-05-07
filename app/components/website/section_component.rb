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
    classes = "flex flex-col gap-8 border-b border-slate-200 bg-white px-4 dark:border-slate-700 dark:bg-slate-900"
    "#{classes} #{VARIANTS[@variant]}"
  end
end
