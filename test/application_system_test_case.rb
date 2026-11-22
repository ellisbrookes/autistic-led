require "test_helper"

class ApplicationSystemTestCase < ActionDispatch::SystemTestCase
  driven_by :selenium, using: :headless_chrome, screen_size: [ 1400, 1400 ] do |options|
    options.add_option("goog:loggingPrefs", { browser: "ALL" })
  end

  # One browser at a time keeps these reliable on CI.
  parallelize(workers: 1)

  setup do
    Capybara.default_max_wait_time = 8
    @forgery_protection = ActionController::Base.allow_forgery_protection
    ActionController::Base.allow_forgery_protection = true
  end

  teardown do
    ActionController::Base.allow_forgery_protection = @forgery_protection
  end

  private

    def log_in_as(user)
      visit login_path
      fill_in "email_address", with: user.email_address
      fill_in "password", with: "password123"
      click_button "Login"
      assert_text "Logged in successfully."
      # Headless Chrome can drop input in the tab that did the Turbo login, so carry on in a new one.
      page.switch_to_window(page.open_new_window)
    end

    def assert_no_browser_errors
      errors = page.driver.browser.logs.get(:browser).map(&:message).grep(/Content Security Policy|Uncaught/)
      assert_empty errors
    end
end
