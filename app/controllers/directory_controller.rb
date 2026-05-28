# frozen_string_literal: true

class DirectoryController < ApplicationController
  before_action :require_authentication, only: %i[new create edit update]
  before_action :set_directory_listing, only: %i[show edit update approve destroy]
  before_action :require_directory_listing_visibility, only: %i[show]
  before_action :require_directory_listing_owner_or_admin, only: %i[edit update]
  before_action :require_admin, only: %i[approve destroy]

  Business = Struct.new(:id, :name, :category, :location, :supports, :notes, :website_url, :contact_email, :approved, :editable, :cover_image, keyword_init: true)

  def index
    @businesses = submitted_businesses
  end

  def new
    @directory_listing = DirectoryListing.new
  end

  def show
  end

  def create
    @directory_listing = DirectoryListing.new(directory_listing_params)
    @directory_listing.user = current_user

    if @directory_listing.save
      redirect_to directory_listing_path(@directory_listing), notice: "Directory listing submitted for admin approval."
    else
      render :new, status: :unprocessable_entity
    end
  end

  def edit
  end

  def update
    attrs = directory_listing_params
    attrs = attrs.except(:images) if attrs[:images].blank?
    attrs = attrs.except(:cover_image) if attrs[:cover_image].blank?

    attrs = if admin?
      attrs
    else
      attrs.merge(approved: false, approved_at: nil)
    end

    if @directory_listing.update(attrs)
      notice = if admin?
        "Directory listing updated."
      else
        "Directory listing changes submitted for admin approval."
      end
      redirect_to directory_listing_path(@directory_listing), notice: notice
    else
      render :edit, status: :unprocessable_entity
    end
  end

  def approve
    if @directory_listing.approved?
      redirect_to directory_listing_path(@directory_listing), notice: "Listing is already approved."
      return
    end

    @directory_listing.update!(approved: true, approved_at: Time.current)
    redirect_to directory_listing_path(@directory_listing), notice: "Directory listing approved and now live."
  end

  def destroy
    @directory_listing.destroy!
    redirect_to directory_path, notice: "Directory listing was removed."
  end

  private

    def submitted_businesses
      listings_scope = DirectoryListing.order(created_at: :desc)
      listings_scope = if admin?
        listings_scope
      elsif authenticated?
        listings_scope.where(approved: true).or(listings_scope.where(user_id: current_user.id))
      else
        listings_scope.where(approved: true)
      end

      listings_scope.map do |listing|
        Business.new(
          id: listing.id,
          name: listing.name,
          category: listing.listing_type,
          location: listing.location,
          supports: listing.support_tags,
          notes: listing.description,
          website_url: listing.website_url,
          contact_email: listing.contact_email,
          approved: listing.approved?,
          editable: admin? || (authenticated? && listing.user_id == current_user.id),
          cover_image: (listing.cover_image.attached? ? listing.cover_image : listing.images.first)
        )
      end
    end

    def directory_listing_params
      params.expect(directory_listing: [ :name, :listing_type, :location, :description, :supports, :website_url, :contact_email, :cover_image, { images: [] } ])
    end

    def set_directory_listing
      @directory_listing = DirectoryListing.find(params.expect(:id))
    end

    def require_directory_listing_owner_or_admin
      return if admin? || @directory_listing.user_id == current_user&.id

      redirect_to directory_path, alert: "You can only edit your own listing."
    end

    def require_directory_listing_visibility
      return if @directory_listing.approved? || admin? || @directory_listing.user_id == current_user&.id

      redirect_to directory_path, alert: "This listing is awaiting admin approval."
    end
end
