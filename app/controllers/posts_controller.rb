class PostsController < ApplicationController
  def index
    @post_type = PostType.find(params[:post_type_id])
  end

  def show
    if post_type = PostType.find(params[:post_type_id])

      # (params[:id] = ~ /\A\d+\z/ params[:id] : params[:id].to_f)

      @post = Post.where(slug: params[:id], post_type_id: post_type.id)
    else
      render 'error/404'
    end
  end
end
