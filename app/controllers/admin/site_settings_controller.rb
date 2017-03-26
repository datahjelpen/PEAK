class Admin::SiteSettingsController < Admin::ApplicationController
  def index
  end

  def general
    @settings = SiteSettings.where(setting_group: 'general')
  end

  def brand
    @settings = SiteSettings.where(setting_group: 'brand')
  end

  def appearance
    @settings = SiteSettings.where(setting_group: 'appearance')
  end

  def update
    # @post = Setting.find(params[:id])

    # if @post.update(post_params)
    #   redirect_to edit_admin_post_path(@post)
    # else
    #   render 'edit'
    # end
  end

  private
  # def post_params
  #   params.require(:setting).permit(
  #     :title,
  #     :slug,
  #     :text,
  #     :excrept,
  #     :extra_css
  #   )
  # end
end
