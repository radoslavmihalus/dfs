<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../inc/config_ajax.php';

$context = getContext();
$fields = $context->query("SELECT CountryName_en FROM lk_countries WHERE CountryName_en LIKE '%" . $_GET['q'] . "%'  ORDER BY CountryName_en")->fetchAll();

$return = array();

//$fp = fopen("request.txt", "a+");
//foreach ($_REQUEST as $req => $value) {
//    fwrite($fp, $req . ' => ' . $value . '|');
//}
//fclose($fp);

$str = '{"items":';

foreach ($fields as $field) {
    $return[]['name'] = $field->CountryName_en;
}

$str .= json_encode($return);

$str .= "}";

//$fp = fopen("request.txt", "a+");
//foreach ($_REQUEST as $req => $value) {
//    fwrite($fp, $str . "\r\n");
//}
//fclose($fp);

echo $str;
