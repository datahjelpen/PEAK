class ApplicationController < ActionController::Base
  # Prevent CSRF attacks by raising an exception.
  # For APIs, you may want to use :null_session instead.
  protect_from_forgery with: :exception
  
  before_action :get_settings
  after_action :store_action

  # Store the action
  def store_action
    return unless request.get?
    if (request.path != "/goodbye" &&
        request.path != "/users/sign_in" &&
        request.path != "/users/sign_up" &&
        request.path != "/users/password/new" &&
        request.path != "/users/password/edit" &&
        request.path != "/users/confirmation" &&
        request.path != "/users/sign_out" &&
        !request.xhr?) # don't store ajax calls
      store_location_for(:user, request.fullpath)
    end
  end

  # Login redirect
  def after_sign_in_path_for(resource_or_scope)
    stored_location_for(resource_or_scope) || signed_in_root_path(resource_or_scope)
  end

  # Logout redirect
  def after_sign_out_path_for(resource_or_scope)
    '/goodbye'
  end

  private
    def get_settings
      @site_settings = {}
      general = {}
      brand_info = {}
      brand_colors = {}
      appearance = {}

      SiteSettings.all.each do |s|
        if s.setting_group == "general"
            general[s.setting_name.to_sym] = s.setting_value
        elsif s.setting_group == "brand"
          if s.setting_type == "color_field"
            brand_colors[s.setting_name.to_sym] = s.setting_value
          else
            brand_info[s.setting_name.to_sym] = s.setting_value
          end
        elsif s.setting_group == "appearance"
            appearance[s.setting_name.to_sym] = s.setting_value
        end
      end

      @site_settings[:general] = general
      @site_settings[:brand] = { :info => brand_info, :colors => brand_colors }
      @site_settings[:appearance] = appearance
    end
end
