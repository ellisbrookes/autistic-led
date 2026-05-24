class AddApprovalToBlogs < ActiveRecord::Migration[8.1]
  def up
    add_column :blogs, :approved, :boolean, default: false, null: false
    add_column :blogs, :approved_at, :datetime

    execute <<~SQL
      UPDATE blogs
      SET approved = TRUE,
          approved_at = COALESCE(updated_at, created_at)
      WHERE approved = FALSE
    SQL
  end

  def down
    remove_column :blogs, :approved_at
    remove_column :blogs, :approved
  end
end
