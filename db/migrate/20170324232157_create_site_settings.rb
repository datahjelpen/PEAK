class CreateSiteSettings < ActiveRecord::Migration[5.0]
  def change
    create_table :site_settings do |t|
      t.string :setting_name
      t.string :setting_value
      t.string :setting_group

      t.timestamps
    end
  end
end
