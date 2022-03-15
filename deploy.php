<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/npm.php';
require 'recipe/fpm.php';

// Project name
set('application', 'mymarket');

// Project repository
set('repository', 'reex11@bitbucket.org:reex11/alamermarket.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);




// Hosts

 host('alamer')
    ->hostname('46.101.229.184')
	->user('deployer')
    ->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '/var/www/alamer')
	->multiplexing(false);

# -------------------------
 host('sultansweets')
    ->hostname('46.101.229.184')
	->user('deployer')
    ->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '/var/www/sultansweets')
	->multiplexing(false);




// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

// before('deploy:symlink', 'artisan:migrate');

