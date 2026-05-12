# frozen_string_literal: true

class DirectoryController < ApplicationController
  Business = Struct.new(:name, :type, :location, :supports, :notes, keyword_init: true)

  def index
    @businesses = [
      Business.new(
        name: "Quiet Cup Cafe",
        type: "Cafe",
        location: "Spalding Town Centre",
        supports: ["Low-sensory seating", "Noise-reduced hour", "Visual menus"],
        notes: "Staff can switch music off in the back room on request."
      ),
      Business.new(
        name: "Harbor Books & Co.",
        type: "Bookshop",
        location: "Market Deeping",
        supports: ["Clear signage", "Calm checkout lane", "Text-first communication"],
        notes: "You can request help by showing a card at the till."
      ),
      Business.new(
        name: "Bloom Wellness Studio",
        type: "Health & wellbeing",
        location: "Pinchbeck",
        supports: ["Dimmable lighting", "Predictable session plans", "Flexible appointment length"],
        notes: "First-visit walkthrough available by email before booking."
      ),
      Business.new(
        name: "Northbank Cinema",
        type: "Leisure",
        location: "Peterborough",
        supports: ["Relaxed screenings", "Ear defender friendly", "Step-by-step visit guide"],
        notes: "Weekend screenings include lower volume and softer lights."
      )
    ]
  end
end
