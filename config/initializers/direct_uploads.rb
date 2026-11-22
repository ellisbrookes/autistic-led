Rails.application.config.to_prepare do
  ActiveStorage::DirectUploadsController.include DirectUploadProtection
end
