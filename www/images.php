<?php

/* ----------------------------------------------------------------
  DYNAMIC IMAGE RESIZING SCRIPT - V2
  The following script will take an existing JPG image, and resize it
  using set options defined in your .htaccess file (while also providing
  a nice clean URL to use when referencing the images)
  Images will be cached, to reduce overhead, and will be updated only if
  the image is newer than it's cached version.

  The original script is from Timothy Crowe's 'veryraw' website, with
  caching additions added by Trent Davies:
  http://veryraw.com/history/2005/03/image-resizing-with-php/

  Further modifications to include antialiasing, sharpening, gif & png
  support, plus folder structues for image paths, added by Mike Harding
  http://sneak.co.nz

  For instructions on use, head to http://sneak.co.nz
  ---------------------------------------------------------------- */

// max_width and image variables are sent by htaccess

$max_height = 1000;

$image = '../' . $_GET["imgfile"];

$max_width = $_GET["max_width"];
if (strrchr($image, '/')) {
    $filename = substr(strrchr($image, '/'), 1); // remove folder references
} else {
    $filename = $image;
}

$size = getimagesize($image);
$width = $size[0];
$height = $size[1];

// get the ratio needed
$x_ratio = $max_width / $width;
$y_ratio = $max_height / $height;

// Ratio cropping
$offsetX = 0;
$offsetY = 0;

if (isset($_GET['cropratio'])) {
    $cropRatio = explode(':', (string) $_GET['cropratio']);
    if (count($cropRatio) == 2) {
        $ratioComputed = $width / $height;
        $cropRatioComputed = (float) $cropRatio[0] / (float) $cropRatio[1];

        if ($ratioComputed < $cropRatioComputed) { // Image is too tall so we will crop the top and bottom
            $origHeight = $height;
            $height = $width / $cropRatioComputed;
            $offsetY = ($origHeight - $height) / 2;
        } else if ($ratioComputed > $cropRatioComputed) { // Image is too wide so we will crop off the left and right sides
            $origWidth = $width;
            $width = $height * $cropRatioComputed;
            $offsetX = ($origWidth - $width) / 2;
        }
    }
}


// if image already meets criteria, load current values in
// if not, use ratios to load new size info
if (($width <= $max_width) && ($height <= $max_height)) {
    $tn_width = $width;
    $tn_height = $height;
} else if (($x_ratio * $height) < $max_height) {
    $tn_height = ceil($x_ratio * $height);
    $tn_width = $max_width;
} else {
    $tn_width = ceil($y_ratio * $width);
    $tn_height = $max_height;
}




/* Caching additions by Trent Davies */
// first check cache
// cache must be world-readable
$resized = '../temp/images/' . $tn_width . 'x' . $tn_height . '-' . $filename;
$imageModified = @filemtime($image);
$thumbModified = @filemtime($resized);

header("Content-type: image/jpeg");

// if thumbnail is newer than image then output cached thumbnail and exit
if ($imageModified < $thumbModified) {
    header("Last-Modified: " . gmdate("D, d M Y H:i:s", $thumbModified) . " GMT");
    readfile($resized);
    exit;
}

// read image
$ext = substr(strrchr($image, '.'), 1); // get the file extension
switch ($ext) {
    case 'jpg':     // jpg
        $src = imagecreatefromjpeg($image) or notfound();
        break;
    case 'jpeg':     // jpeg
        $src = imagecreatefromjpeg($image) or notfound();
        break;
    case 'png':     // png
        $src = imagecreatefrompng($image) or notfound();
        break;
    case 'gif':     // gif
        $src = imagecreatefromgif($image) or notfound();
        break;
    default:
        notfound();
}

// set up canvas
$dst = imagecreatetruecolor($tn_width, $tn_height);

//imageantialias ($dst, true);
// copy resized image to new canvas
imagecopyresampled($dst, $src, 0, 0, $offsetX, $offsetY, $tn_width, $tn_height, $width, $height);

/* Sharpening adddition by Mike Harding */
// sharpen the image (only available in PHP5.1)
if (function_exists("imageconvolution")) {
    $matrix = array(array(-1, -1, -1),
        array(-1, 32, -1),
        array(-1, -1, -1));
    $divisor = 24;
    $offset = 0;

    imageconvolution($dst, $matrix, $divisor, $offset);
}

// send the header and new image
imagejpeg($dst, null, -1);
imagejpeg($dst, $resized, -1); // write the thumbnail to cache as well...
// clear out the resources
imagedestroy($src);
imagedestroy($dst);
?>