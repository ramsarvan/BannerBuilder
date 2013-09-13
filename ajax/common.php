<?php
$con = mysql_connect("localhost","corvusse_jo151","RlJE58sHFC2t");
if (!$con){ die('Could not connect: ' . mysql_error()); }
mysql_select_db('corvusse_jo151');

$banner_category = $_POST['banner_category'];
$banner_type = $_POST['banner_type'];
$banner_size = $_POST['banner_size'];


$banner_qry = mysql_query("SELECT a.banner_name, b.banner_image FROM banner_banner AS a, banner_size AS b WHERE banner_type = '".$banner_type."' AND a.banner_id = b.banner_id AND a.banner_category = '".$banner_category."' AND b.banner_size = '".$banner_size."'");
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


 ?>
