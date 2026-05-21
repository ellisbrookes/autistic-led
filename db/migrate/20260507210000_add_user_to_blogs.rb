class AddUserToBlogs < ActiveRecord::Migration[8.1]
  class MigrationBlog < ApplicationRecord
    self.table_name = "blogs"
  end

  class MigrationUser < ApplicationRecord
    self.table_name = "users"
  end

  def up
    add_reference :blogs, :user, foreign_key: true

    first_user_id = MigrationUser.order(:id).pick(:id)
    return if first_user_id.blank?

    MigrationBlog.where(user_id: nil).update_all(user_id: first_user_id)
  end

  def down
    remove_reference :blogs, :user, foreign_key: true
  end
end
