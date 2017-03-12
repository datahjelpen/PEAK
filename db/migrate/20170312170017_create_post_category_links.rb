class CreatePostCategoryLinks < ActiveRecord::Migration[5.0]
  def change
    create_table :post_category_links do |t|
      t.integer :post
      t.integer :category

      t.timestamps
    end
  end
end
