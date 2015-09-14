<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../inc/config_ajax.php';

$context = getContext();
$fields = $context->query("SELECT concat(tbl_user.name,' ',tbl_user.surname) as name FROM tbl_user inner join tbl_userhandler ON tbl_userhandler.user_id=tbl_user.id WHERE tbl_user.name LIKE '%" . $_GET['q'] . "%' OR tbl_user.surname LIKE '%" . $_GET['q'] . "%' ORDER BY tbl_user.surname,tbl_user.name")->fetchAll();

$return = array();

//$fp = fopen("request.txt", "a+");
//foreach ($_REQUEST as $req => $value) {
//    fwrite($fp, $req . ' => ' . $value . '|');
//}
//fclose($fp);

$str = '{"items":';

foreach ($fields as $field) {
    $return[]['name'] = $field->name;
}

$str .= json_encode($return);

$str .= "}";

//$fp = fopen("request.txt", "a+");
//foreach ($_REQUEST as $req => $value) {
//    fwrite($fp, $str . "\r\n");
//}
//fclose($fp);

echo $str;
