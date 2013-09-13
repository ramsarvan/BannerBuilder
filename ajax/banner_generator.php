<?php
header("Cache-Control: no-cache, must-revalidate");
header("Content-type: image/png");
$banner_img = "../images/".$_GET['banner_img'];

if($_GET['font'] != '') {
$font = "../fonts/".$_GET['font'];
} else {
$font = "../fonts/arial_black.ttf";	
}

if($_GET['font_size'] != '') {
$font_size = $_GET['font_size'];
} else {
$font_size = 20;	
}

if($_GET['text1'] != '') {
$text1 = $_GET['text1'];
} else {
$text1 = "YOUR TEXT";	
}

if($_GET['text2'] != '') {
$text2 = $_GET['text2'];
} else {
$text2 = "YOUR TEXT";	
}


$fileInfo = explode(".",$_GET['banner_img']);
if($fileInfo['1'] == "png") {
$im = imagecreatefrompng($banner_img);
} else if(($fileInfo['1'] == "jpg") || ($fileInfo['1'] == "jpeg")) {
$im = imagecreatefromjpeg($banner_img);	
}

$line1_color = $_GET['line1_color'];
$line1_color_value = explode(",",$line1_color);
if($line1_color_value[0] != '') {
$text_color_1 = imagecolorallocate($im, $line1_color_value[0], $line1_color_value[1], $line1_color_value[2]);
} else {
$text_color_1 = imagecolorallocate($im, 133, 130, 130);	
}

$line2_color = $_GET['line2_color'];
$line2_color_value = explode(",",$line2_color);
if($line2_color_value[0] != '') {
$text_color_2 = imagecolorallocate($im, $line2_color_value[0], $line2_color_value[1], $line2_color_value[2]);
} else {
$text_color_2 = imagecolorallocate($im, 255, 255, 255);	
}

if($_GET['line1_x'] != '') { $x1 = $_GET['line1_x']; } else { $x1 = 60; }
if($_GET['line1_y'] != '') { $y1 = $_GET['line1_y']; } else { $y1 = 70; }
if($_GET['line2_x'] != '') { $x2 = $_GET['line2_x']; } else { $x2 = 60; }
if($_GET['line2_y'] != '') { $y2 = $_GET['line2_y']; } else { $y2 = 120; }

$x11 = $x1 - 2;
$y11 = $y1 - 2;
$x22 = $x2 - 2;
$y22 = $y2 - 2;

$angle_line1 = $_GET['angle_line1'];
$angle_line2 = $_GET['angle_line2'];

$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);

if($_GET['text_effect'] == 'shadow') {
imagettftext($im, $font_size, $angle_line1, $x11, $y11, $black, $font, $text1);	
}
imagettftext($im, $font_size, $angle_line1, $x1, $y1, $text_color_1, $font, $text1);

if($_GET['text_effect'] == 'shadow') {
imagettftext($im, $font_size, $angle_line2, $x22, $y22, $black, $font, $text2);
}
imagettftext($im, $font_size, $angle_line2, $x2, $y2, $text_color_2, $font, $text2);

if($fileInfo['1'] == "png") {
imagepng($im);
} else if(($fileInfo['1'] == "jpg") || ($fileInfo['1'] == "jpeg")) {
imagejpeg($im);
}
?>