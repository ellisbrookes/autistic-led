class User < ApplicationRecord
  has_secure_password

  normalizes :email_address, with: ->(value) { value.strip.downcase }

  validates :email_address, presence: true, uniqueness: true
end
