Rails.application.routes.draw do
  devise_for :users
  root 'landing#index'

  get '/goodbye', to: 'landing#goodbye'

  get 'admin', to: 'admin#index'

  namespace :admin do
    resources :posts
    resources :post_categories
    resources :post_types
    resources :post_tags
  end
end
