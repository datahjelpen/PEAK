class Admin::PostCategoriesController < Admin::ApplicationController
  def index
    @post_type = PostType.find(params[:post_type_id])
  end

  def show
    redirect_to post_type_post_category_path(params[:post_type_id], params[:id])
  end

  def new
    @post_category = PostCategory.new
    @post_category.post_type = PostType.find(params[:post_type_id])
  end

  def edit
    @post_category = PostCategory.find(params[:id])
    @post_type = PostType.find(params[:post_type_id])
  end

  def create
    prepare_params(params)
    @post_category = PostCategory.new(post_category_params)

    if @post_category.save
      redirect_to edit_admin_post_type_post_category_path(@post_category.post_type, @post_category)
    else
      render 'new'
    end
  end

  def update
    @post_category = PostCategory.find(params[:id])

    if @post_category.update(post_category_params)
      redirect_to edit_admin_post_category_path(@post_category)
    else
      render 'edit'
    end
  end

  def destroy
    @post_category = PostCategory.find(params[:id])
    @post_category.destroy

    redirect_to :back
  end

  private
  def post_category_params
    params.require(:post_category).permit(
      :name,
      :slug,
      :image,
      :parent,
      :post_type_id,
      :template,
      :locale,
      :rights
    )
  end

  def prepare_params(params)
    # Slug
    if params[:post_category][:slug].present?
      params[:post_category][:slug] = params[:post_category][:slug].parameterize
    else
      params[:post_category][:slug] = params[:post_category][:name].parameterize
    end
  end
end