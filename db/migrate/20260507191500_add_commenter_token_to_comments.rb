class AddCommenterTokenToComments < ActiveRecord::Migration[8.1]
  def change
    add_column :comments, :commenter_token, :string
    add_index :comments, :commenter_token
  end
end
