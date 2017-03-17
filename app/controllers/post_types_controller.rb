class PostTypesController < ApplicationController
  def self.get_post_type(post_id)
    @post_type = PostType.find(PostTypeLink.find_by(post: post_id).post_type)
  end
end
