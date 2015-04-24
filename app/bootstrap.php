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
$router[] = new Route('list-of-kennels', 'kennel:list');
$router[] = new Route('kennel-profile', 'kennel:profile');
$router[] = new Route('kennel-create-profile', 'kennel:create_profile');
// routy

$router[] = new Route('<presenter>/<action>[/<id>]', 'LandingPage:default');

$cache = Nette\Environment::getCache();
$cache->clean(array(\Nette\Caching\Cache::ALL => true));

return $container;
