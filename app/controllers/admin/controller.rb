class Admin::Controller < Admin::ApplicationController
  def index
    @posts = Post.all
    @post_categories = PostCategory.all
  end
end
