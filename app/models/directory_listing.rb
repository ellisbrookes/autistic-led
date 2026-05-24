class DirectoryListing < ApplicationRecord
  belongs_to :user
  has_many_attached :images

  validates :name, :listing_type, :location, :description, presence: true

  def support_tags
    supports.to_s.split(/[\n,]/).map(&:strip).reject(&:blank?)
  end
end
