class DirectoryListing < ApplicationRecord
  belongs_to :user
  has_many_attached :images

  validates :name, :listing_type, :location, :description, presence: true
  validates :website_url,
    format: {
      with: URI::DEFAULT_PARSER.make_regexp(["http", "https"]),
      message: "must be a valid HTTP(S) URL"
    },
    allow_blank: true

  def support_tags
    supports.to_s.split(/[\n,]/).map(&:strip).reject(&:blank?)
  end
end
