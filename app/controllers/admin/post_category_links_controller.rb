class Admin::PostCategoryLinksController < Admin::ApplicationController
  def index
    @post_category_links = PostCategoryLink.all
  end

  def show
    @post_category_link = PostCategoryLink.find(params[:id])
  end

  def new(a, b)
    @post_category_link = PostCategoryLink.new
  end

  def edit
    @post_category_link = PostCategoryLink.find(params[:id])
  end

  def self.new(post_id, categories)
    categories.each do |category|
      @post_category_link = PostCategoryLink.new(post: post_id, category: category.to_i)

      if !@post_category_link.save
        abort("Could not save the post category link")
      end
    end
  end

  def create
    @post_category_link = PostCategoryLink.new(post_category_link_params)

    if @post_category_link.save
      redirect_to edit_admin_post_category_link_path(@post_category_link)
    else
      render 'new'
    end
  end

  def update
    @post_category_link = PostCategoryLink.find(params[:id])

    if @post_category_link.update(post_category_link_params)
      redirect_to edit_admin_post_category_link_path(@post_category_link)
    else
      render 'edit'
    end
  end

  def destroy
    @post_category_link = PostCategoryLink.find(params[:id])
    @post_category_link.destroy

    redirect_to :back
  end

  private
    def post_category_link_params
      params.require(:post_category_link).permit(
        :post,
        :category
      )
    end
end
