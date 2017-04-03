class RolesUser < ApplicationRecord
  belongs_to :role, dependent: :destroy
  belongs_to :user, dependent: :destroy
end
