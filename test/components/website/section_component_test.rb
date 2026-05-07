# frozen_string_literal: true

require "test_helper"

class Website::SectionComponentTest < ViewComponent::TestCase
  def test_renders_content_inside_section
    render_inline(Website::SectionComponent.new) { "Section content" }

    assert_selector "section", text: "Section content"
  end
end
