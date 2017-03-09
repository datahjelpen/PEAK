Rails.application.routes.draw do
  devise_for :users, :controllers => {
    registrations: 'registrations',
    omniauth_callbacks: 'users/omniauth_callbacks'
  }

  devise_scope :user do
    get '/users/edit' => 'account'
    get '/account' => 'devise/registrations#edit'
    get '/profile' => 'devise/registrations#edit'
  end


  root 'landing#index'
  get '/welcome', to: 'landing#welcome'
  get '/goodbye', to: 'landing#goodbye'

  resources :posts, only: [:index, :show]
  resources :posts, except: [:index, :show], :controller => "admin/posts"
  resources :post_categories, only: [:index, :show]
  resources :post_categories, except: [:index, :show], :controller => "admin/categories"

  get '/admin', to: 'admin/#index'
  namespace :admin do
    resources :posts
    resources :post_categories
    # resources :post_types
    # resources :post_tags
  end
end
