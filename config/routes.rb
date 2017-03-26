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
    get 'settings', to: 'site_settings#index'
    namespace 'site_settings', path: 'settings' do
      get 'general'
      get 'brand'
      get 'appearance'
    end

    resources :post_types do
      resources :post_tags
      resources :post_categories
      resources :posts
    end
  end

  ## CUSTOM PAGES ##
  root 'landing#index'
  get '/welcome', to: 'landing#welcome'
  get '/goodbye', to: 'landing#goodbye'

  ## POSTS ##
  resources :post_types,      except: [:index, :show], :controller => 'admin/post_types'
  resources :post_tags,       except: [:index, :show], :controller => 'admin/post_tags'
  resources :post_categories, except: [:index, :show], :controller => 'admin/post_categories'
  resources :posts,           except: [:index, :show], :controller => 'admin/posts'

  resources :post_types, only: [:index, :show], path: '/' do
    resources :post_tags,       only: [:index, :show], path: 'tags'
    resources :post_categories, only: [:index, :show], path: 'categories'
    resources :posts,           only: [:index, :show], path: '/'
  end
end
