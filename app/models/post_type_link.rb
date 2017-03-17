class PostTypeLink < ApplicationRecord
  belongs_to :post
  belongs_to :post_type
end
