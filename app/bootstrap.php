<?php

// Load Nette Framework
if (@!include __DIR__ . '/../libs/Nette/loader.php') {
    die('Install Nette using `composer update`');
}

use Nette\Application\Routers\Route,
    Nette\Application\Routers\SimpleRouter;

// Configure application
$configurator = new Nette\Configurator;

// Enable Nette Debugger for error visualisation & logging
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
        ->addDirectory(__DIR__)
        ->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config.neon');
$container = $configurator->createContainer();



// Setup router using mod_rewrite detection
$router = $container->getService('router');

// routy
$router[] = new Route('index.php', 'LandingPage:default');
$router[] = new Route('forgot-password', 'LandingPage:forgot_password');
$router[] = new Route('reset-password', 'LandingPage:reset_password');
// User routes
$router[] = new Route('switch-profile', 'user:user_create_profile_switcher');
$router[] = new Route('edit-account', 'user:user_edit_account');
$router[] = new Route('list-of-friends-requests', 'user:user_friend_requests_list');
$router[] = new Route('notification-list', 'user:user_notification_list');
$router[] = new Route('message-list', 'user:user_message_list');
$router[] = new Route('message-compose', 'user:user_message_compose');
// Kennel routes
$router[] = new Route('kennel-create-profile', 'kennel:kennel_create_profile');
$router[] = new Route('kennel-edit-profile', 'kennel:kennel_edit_profile');
$router[] = new Route('list-of-kennels', 'kennel:kennel_list');
$router[] = new Route('kennel-profile', 'kennel:kennel_profile_home');
$router[] = new Route('kennel-awards-list', 'kennel:kennel_awards_list');
$router[] = new Route('kennel-awards-add', 'kennel:kennel_awards_add');
$router[] = new Route('kennel-awards-edit', 'kennel:kennel_awards_edit');
$router[] = new Route('kennel-dog-list', 'kennel:kennel_dog_list');
$router[] = new Route('kennel-friends-list', 'kennel:kennel_friends_list');
$router[] = new Route('kennel-followers-list', 'kennel:kennel_followers_list');
// Handler routes
$router[] = new Route('handler-create-profile', 'handler:handler_create_profile');
$router[] = new Route('handler-edit-profile', 'handler:handler_edit_profile');
$router[] = new Route('list-of-handlers', 'handler:handler_list');
$router[] = new Route('handler-profile', 'handler:handler_profile_home');
$router[] = new Route('handler-awards-list', 'handler:handler_awards_list');
$router[] = new Route('handler-awards-add', 'handler:handler_awards_add');
$router[] = new Route('handler-awards-edit', 'handler:handler_awards_edit');
$router[] = new Route('handler-certificates-list', 'handler:handler_certificates_list');
$router[] = new Route('handler-certificates-add', 'handler:handler_certificates_add');
$router[] = new Route('handler-certificates-edit', 'handler:handler_certificates_edit');
$router[] = new Route('handler-friends-list', 'handler:handler_friends_list');
$router[] = new Route('handler-followers-list', 'handler:handler_followers_list');
// Owner routes
$router[] = new Route('owner-create-profile', 'owner:owner_create_profile');
$router[] = new Route('owner-edit-profile', 'owner:owner_edit_profile');
$router[] = new Route('list-of-owners', 'owner:owner_list');
$router[] = new Route('owner-profile', 'owner:owner_profile_home');
$router[] = new Route('owner-dog-list', 'owner:owner_dog_list');
$router[] = new Route('owner-friends-list', 'owner:owner_friends_list');
$router[] = new Route('owner-followers-list', 'owner:owner_followers_list');
// Dog routes
$router[] = new Route('list-of-dogs', 'dog:dog_list');
$router[] = new Route('add-dog', 'dog:dog_create_profile');
$router[] = new Route('dog-profile', 'dog:dog_title_list');
$router[] = new Route('dog-title-add', 'dog:dog_title_add');
$router[] = new Route('dog-title-edit', 'dog:dog_title_edit');
$router[] = new Route('dog-workexam-list', 'dog:dog_workexam_list');
$router[] = new Route('dog-workexam-add', 'dog:dog_workexam_add');
$router[] = new Route('dog-workexam-edit', 'dog:dog_workexam_edit');
$router[] = new Route('dog-health-list', 'dog:dog_health_list');
$router[] = new Route('dog-health-add', 'dog:dog_health_add');
$router[] = new Route('dog-health-edit', 'dog:dog_health_edit');
$router[] = new Route('dog-mating-list', 'dog:dog_mating_list');
$router[] = new Route('dog-mating-add', 'dog:dog_mating_add');
$router[] = new Route('dog-mating-edit', 'dog:dog_mating_edit');
$router[] = new Route('dog-coowner-list', 'dog:dog_coowner_list');
$router[] = new Route('dog-coowner-add', 'dog:dog_coowner_add');
$router[] = new Route('dog-coowner-edit', 'dog:dog_coowner_edit');


// routy

$router[] = new Route('<presenter>/<action>[/<id>]', 'LandingPage:default');

$cache = Nette\Environment::getCache();
$cache->clean(array(\Nette\Caching\Cache::ALL => true));

return $container;
