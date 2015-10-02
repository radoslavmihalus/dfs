<?php

//error_reporting(0);
session_start();

header('Access-Control-Allow-Origin: dogforshow.com');
header('Access-Control-Allow-Origin: new.dogforshow.com');

//echo 'kokot';

require_once('ImgSelect.php');
require_once('../../inc/config_ajax.php');

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function processImageFile($image) {
    $target_path = "../../../uploads/";
    
    $ext = '';

    $ext = explode('.', $image);

    $length = count($ext);

    $ext = $ext[$length - 1];

    switch ($ext) {
        case 'jpeg':
            $ext = 'jpg';
            break;
        case 'jpg':
            $ext = 'jpg';
            break;
        case 'png':
            $ext = 'png';
            break;
    }
    
    $filename = generateRandomString() . ".$ext";
    rename($image, "$target_path/$filename");
    
    return $filename;
}

function processImageFileUploaded($image) {
    $target_path = "../../../uploads/";
    
    $ext = '';

    $ext = explode('.', $image);

    $length = count($ext);

    $ext = $ext[$length - 1];

    switch ($ext) {
        case 'jpeg':
            $ext = 'jpg';
            break;
        case 'jpg':
            $ext = 'jpg';
            break;
        case 'png':
            $ext = 'png';
            break;
    }
    
    $filename = generateRandomString() . ".$ext";
    copy($image, "$target_path/$filename");
    
    return $filename;
}

$options = array(
    // Upload directory
    'upload_dir' => '../files/',
    // Accepted file types
    'accept_file_types' => 'png|jpg|jpeg',
    // Directory mode
    'mkdir_mode' => 0777,
    // File max/min size in bytes
    'max_file_size' => null,
    'min_file_size' => 1,
    // Image size validation
    'max_width' => null,
    'max_height' => null,
    'min_width' => 1,
    'min_height' => 1,
    // If the image size < crop size then force the resize
    'force_crop' => true,
    // Crop max width
    'crop_max_width' => null,
    // Crop max height
    'crop_max_height' => null,
    /**
     * 	Before upload callback
     *
     *  @param 	stdClass  		$image 		Properties: name, type size
     * 	@param  ImgSelect 		$instance 	ImgSelect instance
     *
     *  Use $_POST['data'] to get the custom data
     */
    'before_upload' => function($image, $instance) {
        // Set image name. By default the image will have the original name but 
        // with a number at the end if already exits
        // You can set the name to the userID or something like that 
        //$image->name = "my_image.".$image->type;
    },
    /**
     * 	Upload complete callback
     *
     *  @param 	stdClass  		$image 		Properties: name, type, size, path, url, width, height
     * 	@param  ImgSelect 		$instance 	ImgSelect instance
     *
     *  Use $_POST['data'] to get the custom data
     */
    'upload_complete' => function($image, $instance) {
        // Here you can save the image to database
        // using $image->name to get the image name 
        $image->name = processImageFileUploaded($image->path);
    },
    /**
     * 	Before crop callback
     *
     *  @param 	stdClass  		$crop 		Properties: file_name, file_type, src_path, dst_path, src_h, src_w, src_y, src_x, dst_w, dst_h
     * 	@param  ImgSelect 		$instance 	ImgSelect instance
     *
     *  Use $_POST['data'] to get the custom data
     */
    'before_crop' => function($crop, $instance) {
        // You can set the crop destionaton path so the original file will be keept
        //$filename = "my_image_cropped.".$crop->file_type;
        //$crop->dst_path = $instance->getUploadPath($filename);
    },
    /**
     * 	Crop complete callback
     *
     *  @param 	stdClass  		$image 		Properties: name, type, path, url, width, height
     * 	@param  ImgSelect 		$instance 	ImgSelect instance
     *
     *  Use $_POST['data'] to get the custom data
     */
    'crop_complete' => function($image, $instance) {
        // Here you can save the image to database
        // using $image->name to get the image name 
        
        $image->name = processImageFile($image->path);
    }
);

new ImgSelect($options);

// $error_messages - array of error messages to be used instead of the default ones
// See ImgSelect.php
// new ImgSelect($options, $error_messages);
?>