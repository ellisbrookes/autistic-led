class ReplaceAdminWithRoleOnUsers < ActiveRecord::Migration[8.1]
  def up
    add_column :users, :role, :integer, default: 0, null: false

    if column_exists?(:users, :admin)
      execute <<~SQL
        UPDATE users
        SET role = CASE WHEN admin THEN 1 ELSE 0 END
      SQL

      remove_column :users, :admin
    end
  end

  def down
    add_column :users, :admin, :boolean, default: false, null: false unless column_exists?(:users, :admin)

    execute <<~SQL
      UPDATE users
      SET admin = CASE WHEN role = 1 THEN TRUE ELSE FALSE END
    SQL

    remove_column :users, :role
  end
end
