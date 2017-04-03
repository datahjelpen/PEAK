class CreateRoles < ActiveRecord::Migration[5.0]
  def change
    create_table :roles do |t|
      t.string :name

      t.timestamps
    end

    create_table :roles_users do |t|
      t.belongs_to :role, :null => false
      t.belongs_to :user, :null => false

      t.timestamps
    end
    add_index :roles_users, [:role_id, :user_id], unique: true
  end
end
