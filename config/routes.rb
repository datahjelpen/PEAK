Rails.application.routes.draw do
  ## LOGIN & REGISTRATION ##
  devise_for :users, :controllers => {
    registrations: 'registrations',
    omniauth_callbacks: 'users/omniauth_callbacks'
  }

  devise_scope :user do
    get '/users/edit' => 'account'
    get '/account' => 'devise/registrations#edit'
    get '/profile' => 'devise/registrations#edit'
  end

  # admin
  get '/admin', to: 'admin/#index'
  namespace :admin do
    resources :posts
    resources :post_tags
    resources :post_types
    resources :post_categories
  end

  ## CUSTOM PAGES ##
  root 'landing#index'
  get '/goodbye', to: 'landing#goodbye'

  ## POSTS ##
  resources :posts,           except: [:index, :show], :controller => "admin/posts"
  resources :post_tags,       except: [:index, :show], :controller => "admin/post_tags"
  resources :post_types,      except: [:index, :show], :controller => "admin/post_types"
  resources :post_categories, except: [:index, :show], :controller => "admin/post_categories"

  resources :post_types, only: [:index, :show], :path => "/" do
    resources :posts,           only: [:index, :show], :path => "/"
    resources :post_tags,       only: [:index, :show]
    resources :post_categories, only: [:index, :show]
  end
  get '/welcome', to: 'landing#welcome'
end
