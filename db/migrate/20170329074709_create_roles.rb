class CreateRoles < ActiveRecord::Migration[5.0]
  def change
    create_table :roles do |t|
      t.string :name

      t.timestamps
    end

    create_table :roles_users, :id => false do |t|
      t.belongs_to :role, :null => false
      t.belongs_to :user, :null => false
      t.primary_key :user_id

      t.timestamps
    end
  end
end
