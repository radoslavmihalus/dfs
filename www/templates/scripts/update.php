<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../inc/config_ajax.php';


function getTable($form_name) {
    $context = getContext();
    $forms = $context->query("SELECT * FROM forms WHERE form_name=?", $form_name);

    $return = "";

    foreach ($forms as $form) {
        $return = $form->table_name;
    }

    return $return;
}

function getField($form_name, $element_name) {
    $context = getContext();
    $fields = $context->query("SELECT * FROM form_fields WHERE form_name=? AND element_name=?", $form_name, $element_name);

    $return = "";

    foreach ($fields as $field) {
        $return = $field->field_name;
    }

    return $return;
}

function doInsert($table_name, $data, $id) {
    $context = getContext();

    $query = $context->query("UPDATE $table_name SET ? WHERE ID=?", $data, $id);

    //var_dump($query);

    return 'completed';
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

