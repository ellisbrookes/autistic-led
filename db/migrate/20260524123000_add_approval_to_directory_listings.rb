class AddApprovalToDirectoryListings < ActiveRecord::Migration[8.1]
  def change
    add_column :directory_listings, :approved, :boolean, default: false, null: false
    add_column :directory_listings, :approved_at, :datetime
  end
end
