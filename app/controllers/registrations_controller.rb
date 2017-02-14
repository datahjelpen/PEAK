class RegistrationsController < Devise::RegistrationsController
  def sign_up_params
    params.require(:user).permit(:name_display, :email, :password, :password_confirmation)
  end

  def account_update_params
    params.require(:user).permit(:name_display, :email, :password, :password_confirmation, :current_password)
  end

  protected
    def update_resource(resource, params)
      # Only allow user to update info without current password if email is the same, and password fields are blank
      if params[:password].blank? && params[:password_confirmation].blank? && params[:email] == current_user.email
          params.delete(:password)
          params.delete(:password_confirmation)
          params.delete(:current_password)

          resource.update_without_password(params)
      else
        resource.update_with_password(params)
      end
    end

  private
    def profile_params
      params.require(:user).permit(:name_display)
    end
end