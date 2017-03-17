class PostsController < ApplicationController
  def index
    @posts = Post.all
  end

  def show
    @post = Post.find(params[:id])
    @post["post_categories"] = PostCategoriesController.get_post_categories(@post.id)
    @post["post_type"] = PostTypesController.get_post_type(@post.id)
  end
end
