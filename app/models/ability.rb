class Ability
  include CanCan::Ability

  def initialize(user)
    user ||= User.new # guest user

    if user.role? :superadmin
      can :manage, :all
    elsif user.role? :admin
      can :manage, :all
      cannot :manage, Roles
    elsif user.role? :author
      # can :manage, [Posts, Post_categories, Post_tags]
      # cannot :manage, [Users, Post_types]
    elsif user.role? :normal
      can :read, [:welcome, Posts]
    end
  end
end