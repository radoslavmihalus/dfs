<?php

require_once '../../inc/config_ajax.php';

$context = getContext();

$profile_type = $_REQUEST['profile_type'];
$profile_id = $_REQUEST['profile_id'];

$image_type = $_REQUEST['image_type'];
$image_name = "uploads/" . $_REQUEST['image_name'];

$table_name = "";
$field_name = "";

var_dump($_REQUEST);

switch ($profile_type) {
    case 1:
        $table_name = "tbl_userkennel";
        $field_name = "kennel_";
        break;
    case 2:
        $table_name = "tbl_userowner";
        $field_name = "owner_";
        break;
    case 3:
        $table_name = "tbl_userhandler";
        $field_name = "handler_";
        break;
}

switch ($image_type) {
    case 'cover':
        $field_name .= "background_image";
        break;
    case 'profile':
        $field_name .= "profile_picture";
        break;
}

$data[$field_name] = $image_name;

//var_dump($data);

//$sql = "UPDATE $table_name SET $field_name = '$image_name' WHERE id=$profile_id";
//echo $sql;
//
//getQuery($sql);

$context->table($table_name)->where("id = ?", $profile_id)->update($data);

echo "ok";
