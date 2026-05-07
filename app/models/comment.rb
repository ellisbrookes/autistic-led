class Comment < ApplicationRecord
  belongs_to :blog
  belongs_to :parent, class_name: "Comment", optional: true, inverse_of: :replies
  belongs_to :reply_to, class_name: "Comment", optional: true
  has_many :replies, class_name: "Comment", foreign_key: :parent_id, dependent: :destroy, inverse_of: :parent

  validates :author_name, presence: true, length: { maximum: 80 }
  validates :body, presence: true, length: { maximum: 1000 }
  validates :commenter_token, presence: true
  validate :reply_to_in_same_blog

  scope :top_level, -> { where(parent_id: nil) }

  private

    def reply_to_in_same_blog
      return if reply_to.blank? || reply_to.blog_id == blog_id

      errors.add(:reply_to, "must belong to the same blog")
    end
end
