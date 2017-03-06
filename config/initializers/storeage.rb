CarrierWave.configure do |config|
  config.fog_credentials = {
      provider:              'AWS',
      aws_access_key_id:     Rails.application.secrets.aws_app_id,
      aws_secret_access_key: Rails.application.secrets.aws_app_secret,
      region: Rails.application.secrets.aws_app_region
  }
  config.fog_directory  = Rails.application.secrets.aws_app_bucket
  config.fog_public     = false
  config.storage = :fog
end