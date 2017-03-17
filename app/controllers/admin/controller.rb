class Admin::Controller < Admin::ApplicationController
  def index
    @posts = Post.all
    @post_categories = PostCategory.all
    @post_types = PostType.all
    @post_tags = PostTag.all
  end
end
