class AddReplyToToComments < ActiveRecord::Migration[8.1]
  def change
    add_reference :comments, :reply_to, foreign_key: { to_table: :comments }
  end
end
