Rails.application.routes.draw do
  # Authentication
  resource :session, only: %i[new create destroy]
  resource :registration, only: %i[new create]
  resource :profile, only: %i[show update]

  get "team", to: "team#index"
  get "login",  to: "sessions#new"
  get "signup", to: "registrations#new"
  delete "logout", to: "sessions#destroy"
  get "home", to: "home#index"

  # Blogs
  resources :blogs do
    member do
      patch :approve
    end

    resources :comments, only: %i[create update destroy] do
      post :replies, to: "comments#create", on: :member
    end
  end

  # Directory
  resources :directory_listings, path: "directory", controller: "directory" do
    member do
      patch :approve
    end
  end

  # Health Check
  get "up", to: "rails/health#show", as: :rails_health_check

  # Root
  root "home#index"
end
