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
error_reporting(E_ERROR);

Tracy\Debugger::$productionMode = TRUE;

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
$router[] = new SimpleRouter('login:login');
//$router[] = new Route('accounting', 'accounting:accounting');
// routy
//$router[] = new Route('<presenter>/<action>[/<id>]', 'login:login');

return $container;
