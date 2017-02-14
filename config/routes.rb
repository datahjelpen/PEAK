Rails.application.routes.draw do
  devise_for :users, :controllers => {
    registrations: 'registrations',
    omniauth_callbacks: 'users/omniauth_callbacks'
  }

  devise_scope :user do
    get '/users/edit' => 'account'
    get '/account' => 'devise/registrations#edit'
    get '/profile' => 'devise/registrations#edit'
    # get '/profile' => 'registrations#profile_edit'
    # post '/profile' => 'registrations#profile_update'
  end


  root 'landing#index'
  get '/welcome', to: 'landing#welcome'
  get '/goodbye', to: 'landing#goodbye'
  # get '/profile', to: 'registrations#edit'

  resources :posts, only: [:index, :show]
  #   resources :posts, only: [:show]
  # end

  get '/admin', to: 'admin#index'
  namespace :admin do
    resources :posts
    # resources :post_categories
    # resources :post_types
    # resources :post_tags
  end
end
