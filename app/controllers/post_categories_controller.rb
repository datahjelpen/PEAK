class PostCategoriesController < ApplicationController
  def index
    @post_categories = PostCategory.all
  end

  def show
    @post_category = PostCategory.find(params[:id])
  end
end