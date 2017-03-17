class PostCategoriesController < ApplicationController
  def index
    @post_categories = PostCategory.all
  end

  def show
    @post_category = PostCategory.find(params[:id])
  end

  def self.get_post_categories(post_id)
    categories = [];
    PostCategoryLink.where(post: post_id).each do |link|
      categories.push(link.category);
    end

    @post_category = PostCategory.find(categories);
  end
end