class AvatarUploader < CarrierWave::Uploader::Base
  # encoding: utf-8

  include CarrierWave::MiniMagick
  # include CarrierWave::RMagick
  # Choose what kind of storage to use for this uploader:

  storage :fog

  # Override the directory where uploaded files will be stored.
  # This is a sensible default for uploaders that are meant to be mounted:
  def store_dir
    "uploads/#{model.class.to_s.underscore}/#{mounted_as}/#{model.id}"
  end

  # Create different versions of your uploaded files:
  ################################################
  #  CANNOT GET THIS TO WORK ON WINDOWS          #
  #  I THINK INSTALLING 'rmagick' WOULD FIX THIS #
  #  DON'T HAVE ANY GOATS TO SACRIFICE, SO IDK   #
  ################################################
  version :thumb do
    # process :resize_to_fill => [256, 256]
  end

  version :small do
    # process :resize_to_fill => [512, 512]
  end

  version :medium do
    # process :resize_to_fill => [1024, 1024]
  end

  # Add a white list of extensions which are allowed to be uploaded.
  # For images you might use something like this:
  def extension_white_list
    %w(jpg jpeg gif png)
  end

  def default_url(*args)
    ActionController::Base.helpers.asset_path("assets/fallback/" + [version_name, "avatar.png"].compact.join('_'))
  end
end
