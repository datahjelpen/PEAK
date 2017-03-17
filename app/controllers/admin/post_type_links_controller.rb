class Admin::PostTypeLinksController < Admin::ApplicationController
  def index
    @post_type_links = PostTypeLink.all
  end

  def new
    @post_type_link = PostTypeLink.new
  end

  def edit
    @post_type_link = PostTypeLink.find(params[:id])
  end

  def create
    @post_type_link = PostTypeLink.new(post_type_link_params)

    if @post_type_link.save
      redirect_to edit_admin_post_type_link_path(@post_type_link)
    else
      render 'new'
    end
  end

  def update
    @post_type_link = PostTypeLink.find(params[:id])

    if @post_type_link.update(post_type_link_params)
      redirect_to edit_admin_post_type_link_path(@post_type_link)
    else
      render 'edit'
    end
  end

  def destroy
    @post_type_link = PostTypeLink.find(params[:id])
    @post_type_link.destroy

    redirect_to :back
  end

  private
  def post_type_link_params
    params.require(:post_type_link).permit(
      :post,
      :post_type
    )
  end
end
