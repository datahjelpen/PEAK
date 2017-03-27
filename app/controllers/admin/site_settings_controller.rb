class Admin::SiteSettingsController < Admin::ApplicationController
  def index
  end

  def show
  end

  def edit
    @settings_group = params[:setting_group]
    @settings = SiteSettings.where(setting_group: @settings_group)
  end

  def update
    SiteSettings.update(params[:site_settings].keys, params[:site_settings].values)

    redirect_back(fallback_location: "/admin/settings/")
  end

  private
  def setting_params
    params.require(:site_settings).permit(
      :setting_value
    )
  end
end