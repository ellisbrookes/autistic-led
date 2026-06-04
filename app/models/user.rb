class User < ApplicationRecord
  has_secure_password
  enum :role, { member: 0, admin: 1 }

  normalizes :email_address, with: ->(value) { value.strip.downcase }
  normalizes :name, with: ->(value) { value.to_s.strip }

  validates :name, presence: true
  validates :role, presence: true
  validates :email_address, presence: true, uniqueness: true

  def display_name
    name.presence || "Member"
  end
end
