# Be sure to restart your server when you modify this file.

# See https://guides.rubyonrails.org/security.html#content-security-policy-header
# The browser tests in test/system fail if this policy blocks something the site needs.
Rails.application.configure do
  config.content_security_policy do |policy|
    policy.default_src     :self
    policy.base_uri        :self
    policy.object_src      :none
    policy.frame_ancestors :self
    policy.form_action     :self
    policy.script_src      :self
    # Trix, Turbo and the comment animations set inline styles.
    policy.style_src       :self, :unsafe_inline
    policy.img_src         :self, :https, :data, :blob
    policy.font_src        :self, :data
    policy.media_src       :self
    policy.connect_src     :self
    policy.frame_src       "https://www.google.com", "https://maps.google.com"
  end

  # Random per request. The session id is blank on a first visit, so it can't be used here.
  config.content_security_policy_nonce_generator = ->(_request) { SecureRandom.base64(16) }
  config.content_security_policy_nonce_directives = %w[script-src]
end
