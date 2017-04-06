class RolesUser < ApplicationRecord
  belongs_to :role, dependent: :destroy
  belongs_to :user, dependent: :destroy

  validates :role, uniqueness: { scope: :user }

  def to_param
    user_id
  end

  def self.find(input)
    find_by_user_id(input)
  end
end
