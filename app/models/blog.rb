class Blog < ApplicationRecord
  belongs_to :user
  has_rich_text :content
  has_many :comments, dependent: :destroy

  scope :approved, -> { where(approved: true) }
end
