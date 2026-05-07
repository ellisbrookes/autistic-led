class Website::LinkComponent < ViewComponent::Base
  VARIANTS = {
    default: "text-slate-700 hover:text-slate-900 dark:text-slate-300 dark:hover:text-slate-100",
    small: "text-sm text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-slate-100"
  }.freeze

  def initialize(text:, path:, variant: :default)
    @text = text
    @path = path
    @variant = variant
  end

  def classes
    classes = "cursor-pointer underline decoration-2 underline-offset-4 transition-all duration-200 ease-in-out hover:underline-offset-8"
    "#{classes} #{VARIANTS.fetch(@variant, VARIANTS[:default])}"
  end
end
