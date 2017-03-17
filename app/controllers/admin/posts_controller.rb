class Admin::PostsController < Admin::ApplicationController
  def index
    @posts = Post.all
  end

  def show
    redirect_to post_path(params[:id])
  end

  def new
    @post = Post.new
    # @post_category = PostCategory.all
    # @post_type = PostType.all
  end

  def edit
    @post = Post.find(params[:id])
    # @post_category = PostCategory.all
    # @post_type = PostType.all
  end

  def create
    prepare_params(params)
    # @post = Post.new(post_params.except(:post_category_ids, :post_type))
    @post = Post.new(post_params.except(:post_type))

    if @post.save
      # Admin::PostCategoryLinksController.new(@post.id, params[:post][:post_category_ids])
      # @post_type = PostTypeLink.new(post: @post.id, post_type: params[:post][:post_type])

      # if @post_type.save
      #   redirect_to edit_admin_post_path(@post)
      # else
      #   render 'new'
      # end

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
      :post_type,
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
