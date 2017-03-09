class CreatePostCategories < ActiveRecord::Migration[5.0]
  def change
    create_table :post_categories do |t|
      t.string :name
      t.string :slug
      t.string :image
      t.integer :parent
      t.integer :template
      t.integer :locale
      t.integer :rights

      t.timestamps
    end
  end
end
