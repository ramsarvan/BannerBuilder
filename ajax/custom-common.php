<?php
$con = mysql_connect("localhost","corvusse_jo151","RlJE58sHFC2t");
if (!$con){ die('Could not connect: ' . mysql_error()); }
mysql_select_db('corvusse_jo151');


$banner_category = $_POST['banner_category'];
$custom_category_name = $_POST['custom_category_name'];
$banner_img = $_POST['banner_img'];
$cus_banner_type = $_POST['cus_banner_type'];
$banner_name = "Cbanner-".rand(0,1000);

$check_qry = mysql_query("SELECT banner_image FROM banner_size order by banner_size_id desc limit 1");
$check_result = mysql_fetch_array($check_qry);
$check_img = $check_result['banner_image'];

if($banner_img != $check_img) {
//echo $banner_category.'<br/>'.$custom_category_name.'<br/>'.$banner_img.'<br/>'.$banner_name;
 if($banner_category == 'other') {
mysql_query("Insert into banner_category (banner_category_name, banner_category_status) values ('".$custom_category_name."','y')");
$banner_id = mysql_insert_id();
} else {
$banner_id = $banner_category;
}

mysql_query("Insert into banner_banner (banner_name, banner_type, banner_category, banner_status) values('".$banner_name."','".$cus_banner_type."','".$banner_id."','1')");
$banner_banner_id = mysql_insert_id();

mysql_query("Insert into banner_size (banner_id, banner_size, banner_image) values ('".$banner_banner_id."','','".$banner_img."')");

/* ----- End of insertion -----*/
$banner_qry = mysql_query("SELECT a.banner_name, b.banner_image FROM banner_banner AS a, banner_size AS b WHERE banner_type = '".$cus_banner_type."' AND a.banner_id = b.banner_id AND a.banner_category = '".$banner_id."' AND b.banner_size = ''");
$num = mysql_num_rows($banner_qry);
if($num != 0) {
echo '<table width="" align="left" cellspacing="6">
<tr><td colspan="4" align="center">Choose a banner</td></tr>
<tr>';	
$i = 0;
while($img_result = mysql_fetch_array($banner_qry)) {
	
		$banner_name = $img_result['banner_name'];							   
		$banner_img = $img_result['banner_image'];
		if($i <= 3) {
		echo '<td align="left" style="width:184px; height:184px; padding:0px 0px 0px 0px; color:#fff; background-image:url(images/'.$banner_img.'); background-repeat:no-repeat; border:solid 1px #000;" valign="top" onmouseover="Tip('."'<img src=\'images/".$banner_img."\'>'".')" onmouseout="UnTip()"><div class="fade"><input type="radio" name="selected_img" value="'.$banner_img.'" onclick="make_banner();">'.$banner_name.'<div></td>';
		} else {
			echo '<td align="center" style="width:184px; height:184px; padding:0px 0px 0px 0px; color:#fff; background-image:url(images/'.$banner_img.'); background-repeat:no-repeat; border:solid 1px #000;"  valign="top"><div class="fade"><input type="radio" name="selected_img" value="'.$banner_img.'" onclick="make_banner();">'.$banner_name.'</div></td></tr><tr><td colspan="5" height="10"></td></tr><tr>';
		}
}
echo '</tr></table>';
} else { echo 'No banner for this selection'; }

} else {
	echo 'This banner have been added to our database already. Please add new banner';	
}
 ?>
