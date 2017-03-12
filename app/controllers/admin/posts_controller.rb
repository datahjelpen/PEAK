class Admin::PostsController < Admin::ApplicationController
  def index
    @posts = Post.all
  end

  def show
    @post = Post.find(params[:id])
  end

  def new
    @post = Post.new
    @post_category = PostCategory.all
  end

  def edit
    @post = Post.find(params[:id])
    @post_category = PostCategory.all
  end

  def create
    @post = Post.new(post_params)

    if @post.save
      @post_category_link = Admin::PostCategoryLinksController.new(@post.id, params[:post_categories])

      redirect_to edit_admin_post_path(@post)
    else
      render 'new'
    end
  end

  def update
    @post = Post.find(params[:id])

    if @post.update(post_params)
      redirect_to edit_admin_post_path(@post)
    else
      render 'edit'
    end
  end

  def destroy
    @post = Post.find(params[:id])
    @post.destroy

    redirect_to :back
  end

  private
  def post_params
    params.require(:post).permit(
      :title,
      :slug,
      :post_categories,
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
