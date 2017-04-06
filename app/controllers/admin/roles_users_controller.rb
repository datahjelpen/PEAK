class Admin::RolesUsersController < Admin::ApplicationController
  def index
    authorize! :read, RolesUser
    @roles_users = RolesUser.all
  end

  def show
    authorize! :read, RolesUser
    @roles_user = RolesUser.find(params[:id])
  end

  def edit
    authorize! :edit, RolesUser
    @roles = Role.all
    @roles_user = RolesUser.find(params[:id])
  end

  def update
    authorize! :edit, RolesUser

    @roles_user = RolesUser.find(params[:id])
    @role = Role.find(role_user_params["role_id"])
    old_user_role_id = @roles_user.role_id


    if old_user_role_id > role_user_params["role_id"].to_i
      flash[:notice] = "You can't give yourself a higher role than you currently have. Please contact the system administror"
      redirect_to edit_admin_user_roles_user_path(@roles_user)
    elsif @roles_user.update(role_user_params)
      if current_user.can? :update, RolesUser
        flash[:notice] = "Success"
      else
        flash[:notice] = "You can't give yourself a role too low to edit user roles."
        if !@roles_user.update({"role_id" => old_user_role_id})
          render 'edit'
        end
      end

      redirect_to edit_admin_user_roles_user_path(@roles_user)
    else
      render 'edit'
    end
  end

  private
  def role_user_params
    params.require(:roles_user).permit(
      :user_id,
      :role_id
    )
  end
end