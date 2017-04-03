class User < ApplicationRecord
  # Include default devise modules. Others available are:
  # :confirmable, :lockable, :timeoutable and :omniauthable
  devise :database_authenticatable, :registerable,
         :recoverable, :rememberable, :trackable, :validatable,
         :confirmable, :lockable, :timeoutable, :omniauthable,
         :omniauth_providers => [:facebook, :google_oauth2, :twitter]

  has_and_belongs_to_many :roles

  def role?(role)
    return !!self.roles.find_by_name(role.to_s)
  end

  def self.from_omniauth(auth)
    where(provider: auth.provider, uid: auth.uid).first_or_create do |user|
      user.email = auth.info.email
      user.remote_avatar_url = auth.info.image.gsub('http://','https://')
      user.name_display = auth.info.name
      user.password = Devise.friendly_token[0,20]
      user.skip_confirmation!
    end
  end

  def self.new_with_session(params, session)
    super.tap do |user|
      if data = session["devise.facebook_data"] && session["devise.facebook_data"]["extra"]["raw_info"]
        user.email = data["email"] if user.email.blank?
      end
    end
  end

  mount_uploader :avatar, AvatarUploader
  # User Avatar Validation
  def avatar_size_validation
    validates_integrity_of  :avatar
    validates_processing_of :avatar
  end

  private
    def avatar_size_validation
      errors[:avatar] << "should be less than 3MB" if avatar.size > 3.megabytes
    end
end
