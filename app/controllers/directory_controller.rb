# frozen_string_literal: true

class DirectoryController < ApplicationController
  before_action :require_authentication, only: %i[new create edit update]
  before_action :set_directory_listing, only: %i[show edit update approve destroy]
  before_action :require_directory_listing_visibility, only: %i[show]
  before_action :require_directory_listing_owner_or_admin, only: %i[edit update]
  before_action :require_admin, only: %i[approve destroy]

  Business = Struct.new(
    :id, :name, :category, :location, :supports, :notes,
    :website_url, :contact_email, :approved, :editable, :cover_image,
    keyword_init: true
  )

  LOCATION_RADIUS_OPTIONS = [5, 10, 25, 50].freeze

  def index
    @businesses = filtered_businesses
    @radius_options = LOCATION_RADIUS_OPTIONS

    @category_query = params[:category].to_s.strip
    @location_query = params[:location].to_s.strip
    @radius_miles = radius_miles_param

    @category_options = @businesses
      .map(&:category)
      .compact_blank
      .reject { |c| c.to_s.strip.casecmp?("test") }
      .uniq
      .sort
  end

  def new
    @directory_listing = DirectoryListing.new
  end

  def show; end
  def edit; end

  def create
    @directory_listing = DirectoryListing.new(directory_listing_params)
    @directory_listing.user = current_user

    if @directory_listing.save
      redirect_to directory_path(@directory_listing),
      notice: "Directory listing submitted for admin approval."
    else
      render :new, status: :unprocessable_entity
    end
  end

  def update
    attrs = cleaned_directory_listing_params

    attrs = if admin?
      attrs
    else
      attrs.merge(approved: false, approved_at: nil)
    end

    if @directory_listing.update(attrs)
      notice = admin? ? "Directory listing updated." : "Directory listing changes submitted for admin approval." 
      redirect_to directory_path(@directory_listing), notice: notice
    else
      render :edit, status: :unprocessable_entity
    end
  end

  def approve
    if @directory_listing.approved?
      redirect_to directory_path(@directory_listing), notice: "Listing is already approved."
      return
    end

    @directory_listing.update!(approved: true, approved_at: Time.current)
    redirect_to directory_path(@directory_listing),
    notice: "Directory listing approved and now live."
  end

  def destroy
    @directory_listing.destroy!
    redirect_to directory_index_path, notice: "Directory listing was removed."
  end

  private

  def filtered_businesses
    scope = DirectoryListing.order(created_at: :desc)

    scope =
      if admin?
        scope
      elsif authenticated?
        scope.where(approved: true).or(scope.where(user_id: current_user.id))
      else
        scope.where(approved: true)
      end

    listings = scope.to_a

    listings.map do |listing|
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
        cover_image: listing.cover_image.attached? ? listing.cover_image : listing.images.first
      )
    end
  end

  def radius_miles_param
    value = params[:radius].to_i
    return 25 if value.zero?

    LOCATION_RADIUS_OPTIONS.include?(value) ? value : 25
  end

  def cleaned_directory_listing_params
    attrs = directory_listing_params.to_h

    attrs.delete("images") if attrs["images"].blank?
    attrs.delete("cover_image") if attrs["cover_image"].blank?

    attrs
  end

  def directory_listing_params
    params.expect(
      directory_listing: [
        :name,
        :listing_type,
        :location,
        :description,
        :supports,
        :website_url,
        :contact_email,
        :cover_image,
        { images: [] }
      ]
    )
  end

  def set_directory_listing
    @directory_listing = DirectoryListing.find(params.expect(:id))
  end

  def require_directory_listing_owner_or_admin
    return if admin? || @directory_listing.user_id == current_user&.id

    redirect_to directory_index_path, alert: "You can only edit your own listing."
  end

  def require_directory_listing_visibility
    return if @directory_listing.approved? || admin? || @directory_listing.user_id == current_user&.id
    redirect_to directory_index_path, alert: "This listing is awaiting admin approval."
  end
end