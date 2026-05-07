# frozen_string_literal: true

require "test_helper"

class NavigationComponentTest < ViewComponent::TestCase
  def test_renders_navigation
    render_inline(Website::NavigationComponent.new)

    assert_selector "nav"
  end
end
