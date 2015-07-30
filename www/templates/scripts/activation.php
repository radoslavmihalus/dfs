<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../inc/config_ajax.php';

$context = getContext();

if (isset($_GET['alink'])) {
    $id = base64_decode($_GET['alink']);
    $id = base64_decode($id);

    if ($id > 0)
        $context->query("UPDATE tbl_user SET `active`=1 WHERE ID=$id");

    header("location: http://dfs.fsofts.eu/index.php?activated=1");
}