Rails.application.routes.draw do
  # For details on the DSL available within this file, see http://guides.rubyonrails.org/routing.html
  get 'admin', to: 'admin#index'

  namespace :admin do
    resources :posts
    resources :post_categories
    resources :post_types
    resources :post_tags
  end
end
