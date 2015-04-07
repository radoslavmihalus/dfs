<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (@!include __DIR__ . '/../../nette/Nette/loader.php') {
    die('Install packages using `composer update --dev`');
}

use Nette\Forms\Form,
    Nette\Forms\Controls,
    Nette\Database\Connection,
    Nette\Database\Context,
    Tracy\Debugger,
    Tracy\Dumper;

$variables = $_REQUEST['formvars'];

$variables = explode("|", $variables);


$update = FALSE;

foreach ($variables as $variable) {
    $vararrs = explode("=", $variable);
    if($vararrs[0] == 'id')
    {
        $update = TRUE;
        break;
    }
}

if ($update)
{
    
}