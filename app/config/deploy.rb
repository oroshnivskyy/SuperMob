set :application, "supermobfreebi"
set :domain,      "ssh1.eu1.frbit.com"
set :user, "u-supermobfreebi"
set :deploy_to,   "/var/www/web/supermobfreebi/htdocs/#{application}"
set :app_path,    "app"
set :shared_files,      ["app/config/parameters.yml"]
set :web_path, "www"
set :shared_children,     [app_path + "/logs", web_path + "/uploads", "vendor"]
set :use_composer, true
set :dump_assetic_assets, true
set :deploy_via, :remote_cache
set :ssh_options, { :forward_agent => true }
set :branch, "master"
set :copy_exclude, [".git", "spec"]

set :repository,  "https://github.com/oroshnivskyy/SuperMob"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  5
set  :use_sudo, false
# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL

#before 'symfony:composer:install', 'symfony:copy_vendors'
#before 'symfony:composer:update', 'symfony:copy_vendors'
set :copy_vendors, true

namespace :symfony do
  desc "Copy vendors from previous release"
  task :copy_vendors, :except => { :no_release => true } do
    if Capistrano::CLI.ui.agree("Do you want to copy last release vendor dir then do composer install ?: (y/N)")
      capifony_pretty_print "--> Copying vendors from previous release"

      run "cp -a #{previous_release}/vendor #{latest_release}/"
      capifony_puts_ok
    end
  end
end