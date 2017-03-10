class PostTagsController < ApplicationController
  def index
    @post_tags = PostTag.all
  end

  def show
    @post_tag = PostTag.find(params[:id])
  end
end