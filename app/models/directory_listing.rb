class DirectoryListing < ApplicationRecord
  IMAGE_TYPES = %w[image/jpeg image/png image/gif image/webp].freeze
  MAX_IMAGE_SIZE = 10.megabytes
  MAX_IMAGES = 10

  belongs_to :user
  has_one_attached :cover_image
  has_many_attached :images

  validates :name, :listing_type, :description, presence: true
  # Only check new values, so older records can still be approved or edited.
  validates :contact_email, format: { with: URI::MailTo::EMAIL_REGEXP }, allow_blank: true, if: :contact_email_changed?
  validate :website_url_is_http, if: :website_url_changed?
  validate :new_uploads_are_safe_images

  def support_tags
    supports.to_s.split(/[\n,]/).map(&:strip).reject(&:blank?)
  end

  private

    def website_url_is_http
      return if website_url.blank? || ApplicationController.helpers.safe_http_url(website_url)

      errors.add(:website_url, "must be a valid HTTP(S) URL")
    end

    def new_uploads_are_safe_images
      cover = attachment_changes["cover_image"]
      validate_images(:cover_image, [ cover.blob ]) if cover.respond_to?(:blob)

      gallery = attachment_changes["images"]
      return unless gallery.respond_to?(:blobs)

      validate_images(:images, gallery.blobs)
      errors.add(:images, "can't be more than #{MAX_IMAGES} files") if gallery.blobs.size > MAX_IMAGES
    end

    def validate_images(field, blobs)
      errors.add(field, "must be JPEG, PNG, GIF or WebP") unless blobs.all? { IMAGE_TYPES.include?(it.content_type) }
      errors.add(field, "must be under 10 MB each") if blobs.any? { it.byte_size > MAX_IMAGE_SIZE }
    end
end
