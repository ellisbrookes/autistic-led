class Website::ButtonComponent < ViewComponent::Base
  BASE_CLASSES = "inline-flex cursor-pointer items-center justify-center rounded-md font-semibold transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-60 dark:focus-visible:ring-offset-slate-900".freeze

  SIZE_CLASSES = {
    sm: "px-3 py-1.5 text-sm",
    md: "px-3.5 py-2 text-sm",
    lg: "px-5 py-2.5 text-base"
  }.freeze

  VARIANT_CLASSES = {
    primary: "border border-slate-300 bg-white text-slate-900 hover:bg-slate-100",
    secondary: "bg-slate-100 text-slate-900 hover:bg-slate-200 dark:bg-slate-700 dark:text-slate-100 dark:hover:bg-slate-600",
    outline: "border border-slate-300 text-slate-700 hover:bg-slate-100 dark:border-slate-600 dark:text-slate-100 dark:hover:bg-slate-700",
    danger: "bg-red-600 text-white hover:bg-red-700"
  }.freeze

  def initialize(text:, path: nil, method: nil, variant: :primary, size: :md, type: "button", data: {}, form_class: nil, extra_classes: nil, disabled: false)
    @text = text
    @path = path
    @method = method
    @variant = variant.to_sym
    @size = size.to_sym
    @type = type
    @data = data
    @form_class = form_class
    @extra_classes = extra_classes
    @disabled = disabled
  end

  def classes
    [
      BASE_CLASSES,
      SIZE_CLASSES.fetch(@size, SIZE_CLASSES[:md]),
      VARIANT_CLASSES.fetch(@variant, VARIANT_CLASSES[:primary]),
      @extra_classes
    ].compact.join(" ")
  end

  def submit_button?
    @path.blank?
  end

  def non_get_route?
    @method.present? && @method.to_sym != :get
  end
end
