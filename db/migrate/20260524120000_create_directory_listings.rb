class CreateDirectoryListings < ActiveRecord::Migration[8.1]
  def change
    create_table :directory_listings do |t|
      t.string :name, null: false
      t.string :listing_type, null: false
      t.string :location, null: false
      t.text :description, null: false
      t.text :supports
      t.string :website_url
      t.string :contact_email
      t.references :user, null: false, foreign_key: true

      t.timestamps
    end
  end
end
