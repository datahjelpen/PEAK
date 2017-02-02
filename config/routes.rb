Rails.application.routes.draw do
  devise_for :users
  get 'admin', to: 'admin#index'

  namespace :admin do
    resources :posts
    resources :post_categories
    resources :post_types
    resources :post_tags
  end
end
