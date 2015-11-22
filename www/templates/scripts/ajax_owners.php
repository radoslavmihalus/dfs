<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../inc/config_ajax.php';

$context = getContext();

$rows = $context->query("SELECT user_id FROM tbl_userowner GROUP BY user_id")->fetchAll();

$i = 0;
$ids = "";

foreach ($rows as $row) {
    if ($i == 0)
        $ids = $row->user_id;
    else
        $ids .= "," . $row->user_id;

    $i++;
}

$fields = $context->query("SELECT concat(name, ' ', surname) as owner_name FROM tbl_user WHERE id IN ($ids) AND concat(name, ' ', surname) LIKE '%" . $_GET['q'] . "%' ORDER BY concat(name, ' ', surname)")->fetchAll();

$return = array();

$str = '{"items":';

foreach ($fields as $field) {
    $return[]['name'] = $field->owner_name;
}

$str .= json_encode($return);

$str .= "}";

echo $str;
