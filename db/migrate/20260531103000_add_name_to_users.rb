class AddNameToUsers < ActiveRecord::Migration[8.1]
  def up
    add_column :users, :name, :string

    execute <<~SQL
      UPDATE users
      SET name = 'Member'
      WHERE name IS NULL OR name = ''
    SQL

    change_column_null :users, :name, false
  end

  def down
    remove_column :users, :name
  end
end
