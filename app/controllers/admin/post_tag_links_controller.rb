class Admin::PostTagLinksController < Admin::ApplicationController
  def index
    @post_tag_links = PostTagLink.all
  end

  def new
    @post_tag_link = PostTagLink.new
  end

  def edit
    @post_tag_link = PostTagLink.find(params[:id])
  end

  def create
    @post_tag_link = PostTagLink.new(post_tag_link_params)

    if @post_tag_link.save
      redirect_to edit_admin_post_tag_link_path(@post_tag_link)
    else
      render 'new'
    end
  end

  def update
    @post_tag_link = PostTagLink.find(params[:id])

    if @post_tag_link.update(post_tag_link_params)
      redirect_to edit_admin_post_tag_link_path(@post_tag_link)
    else
      render 'edit'
    end
  end

  def destroy
    @post_tag_link = PostTagLink.find(params[:id])
    @post_tag_link.destroy

    redirect_to :back
  end

  private
  def post_tag_link_params
    params.require(:post_tag_link).permit(
      :post,
      :post_tag
    )
  end
end
