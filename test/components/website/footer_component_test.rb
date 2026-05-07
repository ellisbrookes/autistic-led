# frozen_string_literal: true

require "test_helper"

class Website::FooterComponentTest < ViewComponent::TestCase
  def test_renders_footer
    render_inline(Website::FooterComponent.new)

    assert_selector "footer"
    assert_text "Autistic Led"
  end
end
