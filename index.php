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

include __DIR__ . '/functions/translator.php';

Debugger::enable();

$latte = new Latte\Engine;
$latte->setTempDirectory('tmp');

$translator = new DFSTranslator();

$latte->addFilter('translate', $translator === NULL ? NULL : array($translator, 'translate'));

$countries = array(
    'Buranda',
    'Qumran',
    'Saint Georges Island',
    'other',
);

$latte->render('templates/home.latte.php', $countries);
?>
