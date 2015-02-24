<?php

/**
 * Nette Forms & Bootstap 3 rendering example.
 */
if (@!include __DIR__ . '/nette/Nette/loader.php') {
die('Install packages using `composer update --dev`');
}

use Nette\Forms\Form,
 Nette\Forms\Controls,
 Tracy\Debugger,
 Tracy\Dumper;

Debugger::enable();

$latte = new Latte\Engine;
$latte->setTempDirectory('tmp');

$latte->render('templates/home.latte.php');


?>