<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

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

function doGet($table_name, $data, $ret_field = "", $where = '(1=1)') {
    //error_reporting(E_ALL);
    $connection = getConnection();

    $context = new Nette\Database\Context($connection);

    $query = "SELECT $data FROM $table_name WHERE $where";

    //echo $query;

    $rows = $context->query($query);

    $return = "";

    foreach ($rows as $row) {
        $return = $row[$ret_field];
    }
    
    return $return;
}

if (isset($_REQUEST['login'])) {
    echo doGet('tbl_user', "CONCAT(`name`,' ',`surname`) AS username", 'id=' . $_SESSION['userid']);
} else {
    $table = $_REQUEST['tableName'];
    $field = $_REQUEST['fieldName'];
    echo doGet($table, $field, "username");
}

