class UpdateReplyToForeignKeyOnComments < ActiveRecord::Migration[8.1]
  def change
    remove_foreign_key :comments, column: :reply_to_id
    add_foreign_key :comments, :comments, column: :reply_to_id, on_delete: :nullify
  end
end
