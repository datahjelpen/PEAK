# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the rails db:seed command (or created alongside the database with db:setup).

PostCategory.create([{ name: 'Uncategorized', slug: 'uncategorized', post_type_id: 1 }])

SiteSettings.create([
  { setting_name: 'site_type',                     setting_group: 'general',    setting_type: 'text_field',  setting_value: 'xyz' },
  { setting_name: 'site_name',                     setting_group: 'general',    setting_type: 'text_field',  setting_value: 'PEAK CMS' },
  { setting_name: 'site_title',                    setting_group: 'general',    setting_type: 'text_field',  setting_value: 'P E A K' },
  { setting_name: 'site_description',              setting_group: 'general',    setting_type: 'text_field',  setting_value: 'xyz' },
  { setting_name: 'site_locale_default',           setting_group: 'general',    setting_type: 'text_field',  setting_value: 'xyz' },
  { setting_name: 'site_locale_default_admin',     setting_group: 'general',    setting_type: 'text_field',  setting_value: 'xyz' },
  { setting_name: 'brand_type',                    setting_group: 'brand',      setting_type: 'text_field',  setting_value: 'xyz' },
  { setting_name: 'brand_name',                    setting_group: 'brand',      setting_type: 'text_field',  setting_value: 'xyz' },
  { setting_name: 'brand_logo',                    setting_group: 'brand',      setting_type: 'file_field',  setting_value: 'xyz' }, # full logo
  { setting_name: 'brand_icon',                    setting_group: 'brand',      setting_type: 'file_field',  setting_value: 'xyz' }, # logo without text
  { setting_name: 'brand_favicon',                 setting_group: 'brand',      setting_type: 'file_field',  setting_value: 'xyz' },
  { setting_name: 'brand_color_primary',           setting_group: 'brand',      setting_type: 'color_field', setting_value: '#fff' },
  { setting_name: 'brand_color_accent',            setting_group: 'brand',      setting_type: 'color_field', setting_value: '#fff' },
  { setting_name: 'brand_color_1',                 setting_group: 'brand',      setting_type: 'color_field', setting_value: '#fff' },
  { setting_name: 'brand_color_2',                 setting_group: 'brand',      setting_type: 'color_field', setting_value: '#fff' },
  { setting_name: 'brand_color_3',                 setting_group: 'brand',      setting_type: 'color_field', setting_value: '#fff' },
  { setting_name: 'brand_color_dark',              setting_group: 'brand',      setting_type: 'color_field', setting_value: '#000' },
  { setting_name: 'brand_color_light',             setting_group: 'brand',      setting_type: 'color_field', setting_value: '#fff' },
  { setting_name: 'peak_theme',                    setting_group: 'appearance', setting_type: 'text_field',  setting_value: 'nordic-peak' },
  { setting_name: 'meta_theme_color',              setting_group: 'appearance', setting_type: 'color_field', setting_value: '#fff' },
  { setting_name: 'meta_mask_icon_color',          setting_group: 'appearance', setting_type: 'color_field', setting_value: '#fff' },
  { setting_name: 'meta_msapplication_tile_color', setting_group: 'appearance', setting_type: 'color_field', setting_value: '#fff' }
])
