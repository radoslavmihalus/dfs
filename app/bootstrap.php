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
$router[] = new Route('list-of-followers', 'user:user_followers_list');
$router[] = new Route('list-of-friends', 'user:user_friends_list');
$router[] = new Route('list-of-friends-requests', 'user:user_friend_requests_list');
$router[] = new Route('notification-list', 'user:user_notification_list');
$router[] = new Route('message-list', 'user:user_message_list');
$router[] = new Route('message-compose', 'user:user_message_compose');
// Kennel routes
$router[] = new Route('kennel-profile', 'kennel:kennel_profile');
$router[] = new Route('kennel-create-profile', 'kennel:kennel_create_profile');
$router[] = new Route('kennel-edit-profile', 'kennel:kennel_edit_profile');
$router[] = new Route('list-of-kennels', 'kennel:kennel_list');
// Handler routes
$router[] = new Route('handler-profile', 'handler:handler_profile');
$router[] = new Route('handler-create-profile', 'handler:handler_create_profile');
$router[] = new Route('handler-edit-profile', 'handler:handler_edit_profile');
$router[] = new Route('list-of-handlers', 'handler:handler_list');
// Owner routes
$router[] = new Route('owner-profile', 'owner:owner_profile');
$router[] = new Route('owner-create-profile', 'owner:owner_create_profile');
$router[] = new Route('owner-edit-profile', 'owner:owner_edit_profile');
$router[] = new Route('list-of-owners', 'owner:owner_list');
// Dog routes
$router[] = new Route('dog-profile', 'dog:dog_profile');
$router[] = new Route('list-of-dogs', 'dog:dog_list');


// routy

$router[] = new Route('<presenter>/<action>[/<id>]', 'LandingPage:default');

$cache = Nette\Environment::getCache();
$cache->clean(array(\Nette\Caching\Cache::ALL => true));

return $container;
