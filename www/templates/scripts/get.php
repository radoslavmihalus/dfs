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

function doGet($table_name, $data, $ret_field = "", $where = '(1=1)') {
    $context = getContext();

    $query = "SELECT $data FROM $table_name WHERE $where";

    //echo $query;

    //echo $query;

    $rows = $context->query($query);

    $return = "";

    foreach ($rows as $row) {
        $return = $row->username;
    }

    return $return;
}

if (isset($_REQUEST['login'])) {
    echo doGet('tbl_user', "CONCAT(`name`,' ',`surname`) AS username", "username", "id=" . $_SESSION['userid']);
} else {
    $table = $_REQUEST['tableName'];
    $field = $_REQUEST['fieldName'];
    echo doGet($table, $field);
}

