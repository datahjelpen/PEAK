class CreatePostTags < ActiveRecord::Migration[5.0]
  def change
    create_table :post_tags do |t|
      t.string :name
      t.string :slug, :null => false
      t.index :slug, unique: true

      t.timestamps
    end
  end
end
