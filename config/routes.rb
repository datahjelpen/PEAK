Rails.application.routes.draw do
  devise_for :users
  root 'landing#index'

  get '/goodbye', to: 'landing#goodbye'

  resources :categories, only: [:index, :show] do
    resources :posts, only: [:new, :create, :show]
  end

  get 'admin', to: 'admin#index'

  namespace :admin do
    resources :posts
    resources :post_categories
    resources :post_types
    resources :post_tags
  end
end
