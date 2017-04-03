class ApplicationController < ActionController::Base
  # Prevent CSRF attacks by raising an exception.
  # For APIs, you may want to use :null_session instead.
  protect_from_forgery with: :exception

  # Make sure we check for auth before we let the user continue
  check_authorization :unless => :devise_controller?

  before_action :get_settings
  after_action :store_action
  after_action :setup_theme

  rescue_from CanCan::AccessDenied do |exception|
    if current_user.nil?
      session[:next] = request.fullpath
      puts session[:next]
      redirect_to :new_user_session, :alert => t("devise.failure.unauthenticated")
    else
      flash[:error] = exception.message

      #render :file => "#{Rails.root}/public/403.html", :status => 403
      if request.env["HTTP_REFERER"].present?
        redirect_to :back, :alert => exception.message
      else
        redirect_to root_url, :alert => exception.message
      end
    end
  end

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

      return @site_settings
    end

    def setup_theme()
      file_theme_colors_path = "#{Rails.root}/lib/assets/theme-config/colors.scss"
      content_to_write = ""

      get_settings()[:brand][:colors].each do |color|
        content_to_write += "$#{color.first}: #{color.last};" + $/
      end

      # Check if the file content is the same as DB content
      is_content_same = true
      File.open(file_theme_colors_path, 'r') {
        |f|
        if f.read() == content_to_write
          is_content_same = false
        end
      }

      if is_content_same
        File.open(file_theme_colors_path, 'w') {
            |f|
          begin
            f.write(content_to_write)
          rescue IOError => e
            p '--- ERROR WRITING TO FILE ---'
            p e
            p '-----------------------------'
          ensure
            f.close unless f.nil?
          end
        }
      end
    end
end
