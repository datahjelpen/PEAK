class Post < ApplicationRecord
  # has_many :post_tags
  # has_many :post_categories
  # has_one :post_types

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
