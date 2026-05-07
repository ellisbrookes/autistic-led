# frozen_string_literal: true

require "test_helper"

class Website::LinkComponentTest < ViewComponent::TestCase
  def test_renders_link_with_text
    render_inline(Website::LinkComponent.new(text: "Read more", path: "/blogs"))

    assert_selector "a[href='/blogs']", text: "Read more"
  end
end
