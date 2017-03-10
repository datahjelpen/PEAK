class Admin::PostTagsController < Admin::ApplicationController
  def index
    @post_tags = PostTag.all
  end

  def show
    @post_tag = PostTag.find(params[:id])
  end

  def new
    @post_tag = PostTag.new
  end

  def edit
    @post_tag = PostTag.find(params[:id])
  end

  def create
    @post_tag = PostTag.new(post_tag_params)

    if @post_tag.save
      redirect_to edit_admin_post_tag_path(@post_tag)
    else
      render 'new'
    end
  end

  def update
    @post_tag = PostTag.find(params[:id])

    if @post_tag.update(post_tag_params)
      redirect_to edit_admin_post_tag_path(@post_tag)
    else
      render 'edit'
    end
  end

  def destroy
    @post_tag = PostTag.find(params[:id])
    @post_tag.destroy

    redirect_to :back
  end

  private
    def post_tag_params
      params.require(:post_tag).permit(
        :name,
        :slug
      )
    end
end