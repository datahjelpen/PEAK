class Admin::PostCategoriesController < Admin::ApplicationController
  def index
    @post_categories = PostCategory.all
  end

  def show
    @post_category = PostCategory.find(params[:id])
  end

  def new
    @post_category = PostCategory.new
  end

  def edit
    @post_category = PostCategory.find(params[:id])
  end

  def create
    @post_category = PostCategory.new(post_category_params)

    if @post_category.save
      redirect_to admin_post_category_path(@post_category)
    else
      render 'new'
    end
  end

  def update
    @post_category = PostCategory.find(params[:id])

    if @post_category.update(post_category_params)
      redirect_to admin_post_categories_path
    else
      render 'edit'
    end
  end

  def destroy
    @post_category = PostCategory.find(params[:id])
    @post_category.destroy

    redirect_to admin_post_categories_path
  end

  private
    def post_category_params
      params.require(:post_category).permit(
        :name,
        :slug,
        :image,
        :parent,
        :template,
        :locale,
        :rights
      )
    end
end