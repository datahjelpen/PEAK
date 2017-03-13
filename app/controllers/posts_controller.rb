class PostsController < ApplicationController
  def index
    @posts = Post.all
  end

  def show
    @post = Post.find(params[:id])

    categories = [];
    PostCategoryLink.where(post: @post.id).each do |link|
      categories.push(link.category);
    end

    @post_category = PostCategory.find(categories);
  end
end
