class Admin::PostsController < Admin::ApplicationController
  def index
    @post_type = PostType.find(params[:post_type_id])
  end

  def show
    redirect_to post_type_post_path(params[:post_type_id], params[:id])
  end

  def new
    @post = Post.new
    @post.post_type = PostType.find(params[:post_type_id])
  end

  def edit
    @post = Post.find(params[:id])
    @post_type = PostType.find(params[:post_type_id])
  end

  def create
    prepare_params(params)
    @post = Post.new(post_params)

    if @post.save
      redirect_to edit_admin_post_type_post_path(@post.post_type, @post)
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
      :locale,
      :post_type_id,
      post_category_ids: []
    )
  end

  def prepare_params(params)
    # Slug
    if params[:post][:slug].present?
      params[:post][:slug] = params[:post][:slug].parameterize
    else
      params[:post][:slug] = params[:post][:title].parameterize
    end

    # Categories
    if !params[:post][:post_category_ids].present?
      params[:post][:post_category_ids] = [1]
    end
  end
end
