class Website::LinkComponent < ViewComponent::Base
  VARIANTS = {
    default: "underline underline-offset-4 decoration-2 text-white hover:dark:text-white hover:underline-offset-6",
    small: "text-sm decoration-2 text-gray-900 dark:text-white hover:dark:text-white hover:underline hover:underline-offset-6",
    button: "text-white bg-primary-500 hover:bg-primary-600 border-primary-500 hover:border-primary-600 border-2 rounded-md px-4 py-2 text-sm",
    button_outline: "bg-transparent hover:bg-primary-600 border-primary-500 hover:border-primary-600 border-2 rounded-md px-4 py-2 text-sm text-primary-500 hover:text-white",
    button_large: "text-white bg-primary-500 hover:bg-primary-600 border-primary-500 hover:border-primary-600 border-2 rounded-md px-6 py-3",
    button_large_outline: "bg-transparent hover:bg-primary-600 border-primary-500 hover:border-primary-600 border-2 rounded-md px-6 py-3 text-primary-500 hover:text-white"
  }

  def initialize(text:, path:, variant: :default)
    @text = text
    @path = path
    @variant = variant
  end

  def classes
    classes = "cursor-pointer transition-all duration-250 ease-in-out text-white"
    "#{classes} #{VARIANTS[@variant]}"
  end
end
