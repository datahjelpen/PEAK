class PostsController < ApplicationController
  def index

    if PostType.find(params[:post_type_id])
      @posts = PostType.find(params[:post_type_id]).posts
    end
  end

  def show
    if PostType.find(params[:post_type_id])
      @post = Post.find(params[:id])
    end
  end
end
