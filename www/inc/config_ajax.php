<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

if (@!include __DIR__ . '/../../libs/Nette/loader.php') {
    die('Install packages using `composer update --dev`');
}

use Nette\Forms\Form,
    Nette\Forms\Controls,
    Nette\Database\Connection,
    Nette\Database\Context,
    Tracy\Debugger,
    Tracy\Dumper;

function DBHost() {
    return "localhost";
}

function DBName() {
    return "u147232041_dfs";
}

function DBUser() {
    return "u147232041_dfs";
}

function DBPassword() {
    return "dfs123";
}

if (!function_exists("dbConnect")) {

    function dbConnect() {
        global $databaseGlobal;
        $dbHostname = DBHost();
        $dbDatabase = DBName();
        $dbUsername = DBUser();
        $dbPassword = DBPassword();
        $Connect = mysql_connect($dbHostname, $dbUsername, $dbPassword) or die('<storng>Database connect error: </strong>' . mysql_error());
        mysql_query("SET NAMES 'utf8'", $Connect);
        return array($dbDatabase, $Connect);
    }

}

// QUERY PROCESS / spracovanie poziadavky
if (!function_exists("getQuery")) {

    function getQuery($myQuery, $typeQuery = "GET") {
        list($dbDatabase, $Connect) = dbConnect();
        mysql_select_db($dbDatabase, $Connect);
        if ($typeQuery != "GET") {
            mysql_real_escape_string($myQuery);
        }
        $processQuery = mysql_query($myQuery, $Connect) or die($myQuery . '<br/><strong>Query process error: </strong>' . mysql_error());
        return $processQuery;
    }

}

function getConnection() {
    $connection = new Nette\Database\Connection('mysql:host=' . DBHost() . ';dbname=' . DBName(), DBUser(), DBPassword());
    return $connection;
}

function getContext() {
    $connection = getConnection();
    $context = new Nette\Database\Context($connection);

    return $context;
}

function getImportConnection() {
    $connection = new Nette\Database\Connection('mysql:host=' . DBHost() . ';dbname=nh2093800db', DBUser(), DBPassword());
    return $connection;
}

function getImportContext() {
    $connection = getConnection();
    $context = new Nette\Database\Context($connection);

    return $context;
}
