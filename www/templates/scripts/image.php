<?php

$filename = "../../../" . $_GET['image'];

$percent = 1.0; // if you want to scale down first
// Content type
header('Content-type: image/jpeg');

// Get new dimensions
list($width, $height) = getimagesize($filename);
$new_width = $width * $percent;
$new_height = $height * $percent;

if($imagethumbsize>$new_width)
{
    $imagethumbsize = $new_width;
}

if($imagethumbsize>$new_height)
{
    $imagethumbsize = $new_height;
}

// Resample
$image_p = imagecreatetruecolor($width , $height);  // true color for best quality
$image = imagecreatefromjpeg($filename);

// basically take this line and put in your versin the -($new_width/2) + ($imagethumbsize/2) & -($new_height/2) + ($imagethumbsize/2) for
// the 2/3 position in the 3 and 4 place for imagecopyresampled
// -($new_width/2) + ($imagethumbsize/2)
// AND
// -($new_height/2) + ($imagethumbsize/2)
// are the trick
//imagecopyresampled($image_p, $image, -($new_width/2) + ($imagethumbsize/2), -($new_height/2) + ($imagethumbsize/2), 0, 0, $new_width , $new_width , $width, $height);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width , $height , $width, $height);

// Output

imagejpeg($image_p, null, 10);

imagedestroy($image);
?>