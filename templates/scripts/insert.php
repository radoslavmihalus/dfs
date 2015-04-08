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

function getConnection() {
    $connection = new Nette\Database\Connection('mysql:host=localhost;dbname=dfs', 'root', 'L884fv57');
    return $connection;
}

function getTable($form_name) {
    $connection = getConnection();
    $context = new Nette\Database\Context($connection);
    $forms = $context->query("SELECT * FROM forms WHERE form_name=?", $form_name);

    $return = "";

    foreach ($forms as $form) {
        $return = $form->table_name;
    }

    return $return;
}

function getField($form_name, $element_name) {
    $connection = getConnection();
    $context = new Nette\Database\Context($connection);
    $fields = $context->query("SELECT * FROM form_fields WHERE form_name=? AND element_name=?", $form_name, $element_name);

    $return = "";

    foreach ($fields as $field) {
        $return = $field->field_name;
    }

    return $return;
}

function doInsert($table_name, $data) {
    $connection = getConnection();

    $context = new Nette\Database\Context($connection);

    $query = $context->query("INSERT INTO $table_name", $data);

    //var_dump($data);

    return 'Registration suceeded';
}

$array = array();

$formName = $_REQUEST['formName'];
$table = getTable($formName);


foreach ($_REQUEST as $request => $value) {
    if ($request != 'formName') {
        $array[getField($formName, $request)] = $value;
    }
}


echo doInsert($table, $array);

