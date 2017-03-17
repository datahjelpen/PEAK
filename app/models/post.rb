class Post < ApplicationRecord
  has_many :post_tags, :through => :post_tag_links
  has_many :post_tag_links, dependent: :destroy

  has_many :post_categories, :through => :post_category_links
  has_many :post_category_links, dependent: :destroy

  has_many :post_types, :through => :post_type_links
  has_many :post_type_links, dependent: :destroy

  # has_many :post_tags, through: :post_tag_links
  # has_one :post_type, through: :post_type_links

  # Use slug instead of ID for pretty urls
  validates_uniqueness_of :slug
  validates_format_of :slug, :without => /\A\d/

  def to_param
    slug
  end

  def self.find(input)
    if input.is_a?(String)
      find_by_slug(input)
    else
      super
    end
  end
end
