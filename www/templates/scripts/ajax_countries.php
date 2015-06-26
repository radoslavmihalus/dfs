<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

if (@!include __DIR__ . '/../../../libs/Nette/loader.php') {
    die('Install packages using `composer update --dev`');
}

use Nette\Forms\Form,
    Nette\Forms\Controls,
    Nette\Database\Connection,
    Nette\Database\Context,
    Tracy\Debugger,
    Tracy\Dumper;

function getConnection() {
    $connection = new Nette\Database\Connection('mysql:host=localhost;dbname=u147232041_dfs', 'u147232041_dfs', 'dfs123');
    return $connection;
}

$connection = getConnection();
$context = new Nette\Database\Context($connection);
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
