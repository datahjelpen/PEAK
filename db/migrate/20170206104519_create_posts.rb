class CreatePosts < ActiveRecord::Migration[5.0]
  def change
    create_table :posts do |t|
      t.string :title
      t.text :text
      t.text :excrept
      t.text :extra_css
      t.text :extra_js
      t.integer :type
      t.integer :author
      t.integer :template
      t.integer :microdata
      t.integer :custom_meta
      t.integer :rights
      t.boolean :comments
      t.integer :status
      t.integer :locale

      t.timestamps
    end
  end
end
