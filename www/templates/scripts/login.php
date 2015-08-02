<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../inc/config_ajax.php';

$context = getContext();

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

