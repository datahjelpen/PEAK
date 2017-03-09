class Admin::PostsController < Admin::ApplicationController
  def index
    @posts = Post.all
  end

  def show
    @post = Post.find(params[:id])
  end

  def new
    @post = Post.new
  end

  def edit
    @post = Post.find(params[:id])
  end

  def create
    @post = Post.new(post_params)

    if @post.save
      redirect_to admin_post_path(@post)
    else
      render 'new'
    end
  end

  def update
    @post = Post.find(params[:id])

    if @post.update(post_params)
      redirect_to admin_posts_path
    else
      render 'edit'
    end
  end

  def destroy
    @post = Post.find(params[:id])
    @post.destroy

    redirect_to admin_posts_path
  end

  private
  def post_params
    params.require(:post).permit(
      :title,
      :text,
      :excrept,
      :extra_css,
      :extra_js,
      :type,
      :author,
      :template,
      :microdata,
      :custom_meta,
      :rights,
      :comments,
      :status,
      :locale
    )
  end
end
