class AddFieldsToUsers < ActiveRecord::Migration[5.0]
  def change
    add_column :users, :name_display, :string
    add_column :users, :avatar, :string
  end
end
