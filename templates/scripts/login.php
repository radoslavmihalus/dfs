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

$connection = getConnection();
$context = new Nette\Database\Context($connection);

$email = $_REQUEST['txtEmail'];
$password = $_REQUEST['txtPassword'];

$_SESSION['userid'] = 0;
$_SESSION['username'] = '';
$_SESSION['user_fname'] = '';
$_SESSION['user_lname'] = '';
$_SESSION['user_state'] = '';
$_SESSION['is_logged_in'] = FALSE;


$forms = $context->query("SELECT * FROM tbl_user WHERE email=? AND password=?", $email, $password);

foreach ($forms as $form) {
    $_SESSION['userid'] = $form->id;
    $_SESSION['username'] = $form->email;
    $_SESSION['user_name'] = $form->name;
    $_SESSION['user_surname'] = $form->surname;
    $_SESSION['user_state'] = $form->state;
    $_SESSION['is_logged_in'] = TRUE;
}


if ($_SESSION['is_logged_in'])
    echo 'ok';
else
    echo 'Wrong username or password';

