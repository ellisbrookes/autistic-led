# frozen_string_literal: true

require "test_helper"

class Website::NavLinkComponentTest < ViewComponent::TestCase
  def test_renders_nav_link_with_text
    render_inline(Website::NavLinkComponent.new(text: "Home", path: "/"))

    assert_selector "a[href='/']", text: "Home"
  end
end
