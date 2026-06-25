class MakeDirectoryListingsLocationNullable < ActiveRecord::Migration[8.1]
  def change
    change_column_null :directory_listings, :location, true
  end
end
