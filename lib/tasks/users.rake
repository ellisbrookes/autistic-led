namespace :users do
  desc "Promote an existing user to admin (usage: bin/rails 'users:make_admin[email@example.com]')"
  task :make_admin, [ :email ] => :environment do |_task, args|
    email = args[:email].to_s.strip.downcase

    if email.blank?
      abort "Provide an email: bin/rails 'users:make_admin[email@example.com]'"
    end

    user = User.find_by(email_address: email)

    if user.nil?
      abort "No user found for #{email}. Create the account first, then rerun this task."
    end

    user.update!(role: :admin)
    puts "#{user.email_address} is now an admin."
  end
end
