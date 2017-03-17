class Admin::PostTypesController < Admin::ApplicationController
  def index
    @post_types = PostType.all
  end

  def show
    redirect_to post_type_path(params[:id])
  end

  def new
    @post_type = PostType.new
  end

  def edit
    @post_type = PostType.find(params[:id])
  end

  def create
    prepare_params(params)
    @post_type = PostType.new(post_type_params)

    if @post_type.save
      redirect_to edit_admin_post_type_path(@post_type)
    else
      render 'new'
    end
  end

  def update
    @post_type = PostType.find(params[:id])

    if @post_type.update(post_type_params)
      redirect_to edit_admin_post_type_path(@post_type)
    else
      render 'edit'
    end
  end

  def destroy
    @post_type = PostType.find(params[:id])
    @post_type.destroy

    redirect_to :back
  end

  private
  def post_type_params
    params.require(:post_type).permit(
      :name,
      :slug,
      :template,
      :rights,
      :locale,
    )
  end

  def prepare_params(params)
    # Slug
    if params[:post_type][:slug].present?
      params[:post_type][:slug] = params[:post_type][:slug].parameterize
    else
      params[:post_type][:slug] = params[:post_type][:name].parameterize
    end
  end
end