<?php
$banner_img = $_POST['banner_img'];
$font = $_POST['font'];
$font_size = $_POST['font_size'];
$line1_color = $_POST['line1_color'];
$line2_color = $_POST['line2_color'];
$text1 = $_POST['text1'];
$text2 = $_POST['text2'];
$angle_line1 = $_POST['angle_line1'];
$angle_line2 = $_POST['angle_line2'];
$text_effect = $_POST['text_effect'];
$line1_x = $_POST['line1_x'];
$line1_y = $_POST['line1_y'];
$line2_x = $_POST['line2_x'];
$line2_y = $_POST['line2_y'];

echo '<img id="banner" src="http://www.banner-builder.corvusseo.com/ajax/banner_generator.php?banner_img='.$banner_img.'&font='.$font.'&font_size='.$font_size.'&line1_color='.$line1_color.'&line2_color='.$line2_color.'&text1='.$text1.'&text2='.$text2.'&angle_line1='.$angle_line1.'&angle_line2='.$angle_line2.'&text_effect='.$text_effect.'&line1_x='.$line1_x.'&line1_y='.$line1_y.'&line2_x='.$line2_x.'&line2_y='.$line2_y.'" />';
	echo '<br /><br />';
?>