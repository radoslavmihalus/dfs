<?php

// let bootstrap create Dependency Injection container
$container = require __DIR__ . '/app/bootstrap.php';

// run application
session_start();
$container->getService('application')->run();
