<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Banner generator</title>
<style>
.fade {
	padding:4px 0px 4px 4px;
	color:#FFF;
	font-weight:bold;
	background-color:#000;
	opacity:0.4;
    filter:alpha(opacity=40);
}
#line_one {
	width:12px;
	height:12px;
	background-color:#FFF;
	border:solid 1px #000;
}
#line_two {
	width:12px;
	height:12px;
	background-color:#FFF;
	border:solid 1px #000;
}
	
</style>
 <script src="js/jquery.js" type="text/javascript"></script>
 <script src="js/upload.js" type="text/javascript"></script>
  <script src="js/ifx.js" type="text/javascript"></script>
  <script src="js/idrop.js" type="text/javascript"></script>
  <script src="js/idrag.js" type="text/javascript"></script>
  <script src="js/iutil.js" type="text/javascript"></script>
  <script src="js/islider.js" type="text/javascript"></script>
  <script src="js/color_picker/color_picker.js" type="text/javascript"></script>
  <link href="js/color_picker/color_picker.css" rel="stylesheet" type="text/css">
 <script type="text/javascript">
 
  function show_option(opt) {
	document.getElementById('stored').style.display = "none";
	document.getElementById('custom').style.display = "none";
	$("div#"+opt).slideDown("slow");
  }
 
  function check_for_category() {
	if(document.getElementById('custom_banner_category').value == 'other'){
	 document.getElementById('custom_category_name').disabled = false;	
	} else {
	 document.getElementById('custom_category_name').value = "";	
	 document.getElementById('custom_category_name').disabled = true;
	}
  }
 
 
 $(function(){
		var images_name = "";
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php',
			name: 'uploaded', 
			onSubmit: function(file, ext){
				 if (! (ext && /^(png|jpeg|jpg)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPEG & PNG files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				if(response==="success"){
					
					 images_name += file +',';
					 document.getElementById('hid_banner').value=file;
					//alert(images_name);
					$('<li style="list-style:none;"></li>').appendTo('#files').html('<img src="images/'+file+'" alt="" width="100" height="100"/><br />'+file).addClass('success');
					$('<div>').appendTo('#value').html(file).addClass('success');
					
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});  		
	}); 
 
 
  function use_banner() {
	  
	  	  document.getElementById('show_custom_banner').style.display = "block";
	  var custom_banner_category = document.getElementById('custom_banner_category').value;
	  var custom_category_name = document.getElementById('custom_category_name').value;
	  var hid_banner = document.getElementById('hid_banner').value;
	  var test = '';
	  for (var i=0; i < document.generate_banner.cus_banner_type.length; i++) {
		  
      if (document.generate_banner.cus_banner_type[i].checked){
      var cus_banner_type = document.generate_banner.cus_banner_type[i].value;
     }
     }
	  
	  if(custom_banner_category == '') {
		alert("Select a category");  
	  }
	  else if((custom_banner_category == 'other') && (custom_category_name == '')) {
		alert("Enter category name");
	  }
	  else if((document.generate_banner.cus_banner_type[0].checked == false) && (document.generate_banner.cus_banner_type[1].checked == false) && (document.generate_banner.cus_banner_type[1].checked == false)) {
		  
		  alert("Please select a banner type");
	  }
	  else if(hid_banner == '') {
		  alert("Please Upload a banner");
	  }
	  else {  
	         document.getElementById('show_banner').style.display = "none";
		      t = document.getElementById('show_custom_banner');
			  t.innerHTML = "Initializing image. please wait..."; 
			  $.ajax({
			  type: "POST",
			  url: "http://banner-builder.corvusseo.com/ajax/custom-common.php",
			  data: "banner_category=" + custom_banner_category + "&custom_category_name=" + custom_category_name + "&banner_img=" + hid_banner + "&cus_banner_type=" + cus_banner_type,
			  success: function(html) {
				 $("#show_custom_banner").html(html);
			  }
		      });
	  }
  }
 
  function list_banners() {
	document.getElementById('show_banner').style.display = "block";  
	document.getElementById('show_custom_banner').style.display = "none";
	var banner_category = document.getElementById('banner_category').value;
	for (var i=0; i < document.generate_banner.banner_type.length; i++) {
    if (document.generate_banner.banner_type[i].checked){
      var banner_type = document.generate_banner.banner_type[i].value;
    }
    }
    var banner_size = document.getElementById('banner_size').value;
	z = document.getElementById('show_banner');
	z.innerHTML = "Loading...";
	//alert(banner_category + '-' + banner_type + '-' + banner_size);
	$.ajax({
	  type: "POST",
	  url: "http://banner-builder.corvusseo.com/ajax/common.php",
	  data: "banner_category=" + banner_category + "&banner_type=" + banner_type + "&banner_size=" + banner_size,
	  success: function(html) {
		 $("#show_banner").html(html);
	  }
   });
   
  }
  
  function make_banner() {
    
	document.getElementById('show_banner').style.display = "block";
    if(typeof document.generate_banner.selected_img.length === 'number') {

	 for (var i=0; i < document.generate_banner.selected_img.length; i++) {
     if (document.generate_banner.selected_img[i].checked){
      var banner_img = document.generate_banner.selected_img[i].value;
     }
     }
	 
	} else {
		
		if (document.generate_banner.selected_img.checked){
		var banner_img = document.generate_banner.selected_img.value;
		}
	}
	 var font = document.getElementById('font').value;
	 var font_size = document.getElementById('font_size').value;
	 var text1 = document.getElementById('first_line').value;
	 var text2 = document.getElementById('second_line').value;
	 
	 var r1 = document.getElementById('r1').value;
	 var g1 = document.getElementById('g1').value;
	 var b1 = document.getElementById('b1').value;
	 var line1_color = r1+","+g1+","+b1;
	 
	 var r2 = document.getElementById('r2').value;
	 var g2 = document.getElementById('g2').value;
	 var b2 = document.getElementById('b2').value;
	 var line2_color = r2+","+g2+","+b2;
	 
	 var angle_line1 = document.getElementById('angle_line1').value;
	 var angle_line2 = document.getElementById('angle_line2').value;
	 var text_effect = document.getElementById('text_effect').value;
	 
	 var line1_x = document.getElementById('line1_x').value;
	 var line1_y = document.getElementById('line1_y').value;
	 var line2_x = document.getElementById('line2_x').value;
	 var line2_y = document.getElementById('line2_y').value;
	 
	 var y = document.getElementById('result_img');
	 y.innerHTML = "Generating Preview...";
	 //alert(banner_img + '=' + text1 + '=' + text2);
	 $.ajax({
	  type: "POST",
	  url: "http://banner-builder.corvusseo.com/ajax/imtermediate.php",
	  data: "banner_img=" + banner_img + "&text1=" + text1 + "&text2=" + text2 + "&font=" + font + "&font_size=" + font_size + "&line1_color=" + line1_color + "&line2_color=" + line2_color + "&angle_line1=" + angle_line1 + "&angle_line2=" + angle_line2 + '&text_effect=' + text_effect + '&line1_x=' + line1_x + "&line1_y=" + line1_y + "&line2_x=" + line2_x + "&line2_y=" + line2_y,
	  success: function(html) {
		$("#result_img").html(html);
	  }
   });
	 
  }
  
  function text_position(sym,line,len) {
	  
	  var current_line_value = document.getElementById(line).value;
	  var evn = len;
	  if(sym == 'plus') {
		  document.getElementById(line).value = parseInt(current_line_value) + parseInt(evn);
	  } else if(sym == 'minus') {
		  document.getElementById(line).value = parseInt(current_line_value) - parseInt(evn);
	  }
  }
 </script>
</head>
<body>
<script src="js/tool.js"></script>
<?php
$con = mysql_connect("localhost","corvusse_jo151","RlJE58sHFC2t");
if (!$con){
  die('Could not connect: ' . mysql_error());
}
mysql_select_db('corvusse_jo151');
 ?>
<form action="" name="generate_banner" id="generate_banner" enctype="multipart/form-data">
<table align="center" width="100%" cellpadding="0" cellspacing="0">
<tr><td align="center" colspan="3"><h1>Banner Builder</h1></td></tr>
<tr><td colspan="3" height="16"></td></tr>
<tr>
 <td align="left" width="38%" valign="top">
  <table align="center" width="100%" cellpadding="0" cellspacing="0">
   <tr>
    <td colspan="2" align="left">
     <a href="javascript:void(0);" onclick="show_option('stored');">Select banner from our list</a>&nbsp;&nbsp;(or)&nbsp;&nbsp;<a href="javascript:void(0);" onclick="show_option('custom');">Upload new banner</a>
    </td>
   </tr>
   <tr><td colspan="2" height="18"></td></tr>
   <tr>
    <td align="center" colspan="2">
  <div id="stored" style="display:none;">
   <table align="center" width="100%" cellpadding="0" cellspacing="0">
  <tr>
   <td width="38%" align="left">Select category</td>
   <td width="62%" align="left">
   <select name="banner_category" id="banner_category">
    <option value="">-- Category --</option>
    <?php
	$cat_qry = mysql_query("Select * from banner_category where banner_category_status = 'y'");
	while($cat_result = mysql_fetch_array($cat_qry)) {
	 echo '<option value="'.$cat_result['banner_category_id'].'">'.$cat_result['banner_category_name'].'</option>';	
	}
	?>
   </select>
   </td>
  </tr>
  <tr><td colspan="3" height="10"></td></tr>
  <tr>
   <td align="left">Select banner type</td>
   <td align="left">
    <input type="radio" name="banner_type" value="vr" />Verticle&nbsp;<input type="radio" name="banner_type" value="hr" />Horizontal&nbsp;<input type="radio" name="banner_type" value="sq" />Square
   </td>
  </tr>
  <tr><td align="left" height="10"></td></tr>
  <tr>
   <td align="left">Select Banner size</td>
   <td align="left" valign="top" height="20">
    <select name="banner_size" id="banner_size" style="padding-bottom:5px;">
     <option value="">-- Banner size --</option>
     <option value="large">Large</option>
     <option value="medium">Medium</option>
     <option value="small">Small</option>
    </select>
   </td>
 </tr>
 <tr><td colspan="2" height="8"></td></tr>
 <tr>
  <td align="left"></td>
  <td align="left"><a href="javascript:viod(0);" onclick="list_banners();"><img src="images/load-images.jpg" border="0"  /></a></td>
 </tr>
   </table>
  </div>
   <div id="custom" style="display:none;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0">
     <tr>
      <td width="38%" align="left" valign="top">Select a category</td>
      <td width="62%" align="left">
       <select name="custom_banner_category" id="custom_banner_category" style="width:90px;" onchange="check_for_category();">
        <option value="">-- Category --</option>
        <?php
        $cat_qry = mysql_query("Select * from banner_category where banner_category_status = 'y'");
        while($cat_result = mysql_fetch_array($cat_qry)) {
         echo '<option value="'.$cat_result['banner_category_id'].'">'.$cat_result['banner_category_name'].'</option>';	
        }
        ?>
        <option value="other">others</option>
       </select>&nbsp;<input type="text" name="custom_category_name" id="custom_category_name" style="width:120px;" disabled="disabled" />
      </td>
     </tr>
     <tr><td colspan="2" height="10"></td></tr>
     <tr>
      <td align="left">Banner type</td>
      <td align="left">
       <input type="radio" name="cus_banner_type" value="vr" />Verticle&nbsp;<input type="radio" name="cus_banner_type" value="hr" />Horizontal&nbsp;<input type="radio" name="cus_banner_type" value="sq" />Square
      </td>
     </tr>
     <tr><td colspan="2" height="10"></td></tr>
     <tr>
      <td align="left">Upload banner template</td>
      <td align="left">
      <div id="upload" style="padding:5px; width:80px; font-size:12px; background-color:#373737; color:#FFF;" align="center"><span>Upload Banner</span></div><span id="status" ></span>		
      <ul id="files"></ul> 
      <input type="hidden" name="hid_banner" id="hid_banner" value=""/>
      </td>
     </tr>
     <tr><td colspan="2" height="10"></td></tr>
     <tr><td colspan="2" align="center"><a href="javascript:void(0);" onclick="use_banner();"><img src="images/use-this-banner.jpg" border="0" /></a></td></tr>
    </table>
   </div>
   </td>
  </tr> 
 <tr><td align="left" colspan="2" height="8"></td></tr>
 <tr><td align="left" colspan="2" height="8"></td></tr>
 <tr>
  <td width="27%" align="left" style="font-size:14px; color:#4F4F4F;">Choose a font</td>
  <td width="73%" align="left">
   <select name="font" id="font">
    <option value="">-- Font --</option>
    <option value="arial_black.ttf">Arial black</option>
    <option value="Cocktail.TTF">Cocktail</option>
    <option value="Bones Font.TTF">Bones Font</option>
    <option value="BloomS.TTF">Blooms</option>
    <option value="Arrow_Down.ttf">Arrow Down</option>
    <option value="ariblk_0.ttf">ariblk</option>
   </select>
  </td>
 </tr>
 <tr><td align="left" height="10"></td></tr>
 <tr>
  <td align="left" style="font-size:14px; color:#4F4F4F;">Select font size</td>
  <td align="left">
   <select name="font_size" id="font_size">
    <option value="">-- Font size --</option>
    <?php 
	 for($i=11;$i<=50;$i++) {
		echo '<option value="'.$i.'">'.$i.'px</option>'; 
	 }
	?>
   </select>
  </td>
 </tr>
 <tr><td align="left" colspan="2" height="10"></td></tr>
 <tr>
   <td align="left" valign="top" style="font-size:14px; color:#4F4F4F;">Text and angle</td>
   <td align="left">
    <table align="left" width="100%" cellpadding="0" cellspacing="0">
     <tr>
      <td width="77%" align="left"><input type="text" name="first_line" id="first_line" style="width:150px;" />&nbsp;
       <select name="angle_line1" id="angle_line1" style="width:75px;">
        <option value="0">Horizontal</option>
        <option value="90">Verticle</option>
        <option value="45">45 degree</option>
         <option value="270">270 degree</option>
        <option value="180">Reverse</option>
       </select>
      </td>
      <td width="23%" align="left"><div id="line_one"></div></td>
     </tr>
     <tr><td colspan="2" height="8"></td></tr>
     <tr>
      <td colspan="2">
       <span style="color:#8A8A8A">Set x position</span> <input type="text" name="" id="line1_x" style="width:30px; border: solid 1px #FFF; color:#959595;" value="60" /><a href="javascript:void(0);" onclick="text_position('minus','line1_x','10');"><img src="images/left-arrow.jpg" border="0" width="12" height="12" /></a>&nbsp;<a href="javascript:void(0);" onclick="text_position('minus','line1_x','1');"><img src="images/left-arrow.jpg" border="0" width="12" height="12" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="text_position('plus','line1_x','1');"><img src="images/right-arrow.jpg" width="11" height="11" border="0"/></a>&nbsp;<a href="javascript:void(0);" onclick="text_position('plus','line1_x','10');"><img src="images/right-arrow.jpg" width="11" height="11" border="0"/></a>
      </td>
     </tr>
     <tr><td colspan="2" height="6"></td></tr>
     <tr>
      <td colspan="2">
       <span style="color:#8A8A8A">Set y position</span> <input type="text" name="line1_y" id="line1_y" style="width:30px; border: solid 1px #FFF; color:#959595;" value="70" /><a href="javascript:void(0);" onclick="text_position('plus','line1_y','10');"><img src="images/down-arrow.jpg" border="0" width="12" height="12" /></a>&nbsp;<a href="javascript:void(0);" onclick="text_position('plus','line1_y','1');"><img src="images/down-arrow.jpg" border="0" width="12" height="12" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="text_position('minus','line1_y','1');"><img src="images/up-arrow.jpg" width="11" height="11" border="0"/></a>&nbsp;<a href="javascript:void(0);" onclick="text_position('minus','line1_y','10');"><img src="images/up-arrow.jpg" width="11" height="11" border="0"/></a>
      </td>
     </tr>
     <tr><td colspan="2" height="8"></td></tr>
     <tr>
      <td align="left"><input type="text" name="second_line" id="second_line" style="width:150px;" />&nbsp;
       <select name="angle_line2" id="angle_line2" style="width:75px;">
        <option value="0">&nbsp;Default</option>
        <option value="90">Verticle</option>
        <option value="45">45 degree</option>
        <option value="180">Reverse</option>
        <option value="270">270 degree</option>
        <option value="360">Inverse</option>
       </select>
      </td>
      <td align="left"><div id="line_two"></div> </td>
     </tr>
     <tr><td colspan="2" height="8"></td></tr>
     <tr>
      <td colspan="2">
       <span style="color:#8A8A8A">Set x position</span> <input type="text" name="line2_x" id="line2_x" style="width:30px; border: solid 1px #FFF; color:#959595;" value="60" /><a href="javascript:void(0);" onclick="text_position('minus','line2_x','10');"><img src="images/left-arrow.jpg" border="0" width="12" height="12" /></a>&nbsp;<a href="javascript:void(0);" onclick="text_position('minus','line2_x','1');"><img src="images/left-arrow.jpg" border="0" width="12" height="12" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="text_position('plus','line2_x','1');"><img src="images/right-arrow.jpg" width="11" height="11" border="0"/></a>&nbsp;<a href="javascript:void(0);" onclick="text_position('plus','line2_x','10');"><img src="images/right-arrow.jpg" width="11" height="11" border="0"/></a>
      </td>
     </tr>
     <tr><td colspan="2" height="6"></td></tr>
     <tr>
      <td colspan="2">
       <span style="color:#8A8A8A">Set y position</span> <input type="text" name="line2_y" id="line2_y" style="width:30px; border: solid 1px #FFF; color:#959595;" value="120" /><a href="javascript:void(0);" onclick="text_position('plus','line2_y','10');"><img src="images/down-arrow.jpg" border="0" width="12" height="12" /></a>&nbsp;<a href="javascript:void(0);" onclick="text_position('plus','line2_y','1');"><img src="images/down-arrow.jpg" border="0" width="12" height="12" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="text_position('minus','line2_y','1');"><img src="images/up-arrow.jpg" width="11" height="11" border="0"/></a>&nbsp;<a href="javascript:void(0);" onclick="text_position('minus','line2_y','10');"><img src="images/up-arrow.jpg" width="11" height="11" border="0"/></a>
      </td>
     </tr>
    </table> 
   </td>
 </tr>
  <tr><td align="left" height="10" colspan="2"></td></tr>
 <tr>
  <td align="left" style="font-size:14px; color:#4F4F4F;">Choose font color</td>
  <td align="left">
   <div style="float:left">
	 <a href="javascript:void(0);" rel="colorpicker&objcode=myhexcode&objshow=myshowcolor&showrgb=1&okfunc=myokfunc" style="text-decoration:none;" >
        <div id="myshowcolor" style="width:15px;height:15px;border:1px solid black;">&nbsp;</div></a>
        </div>
		<script language="Javascript">
		    function myokfunc(){
				for (var i=0; i < document.generate_banner.select_line.length; i++) {
                  if (document.generate_banner.select_line[i].checked){
                    var selected_line = document.generate_banner.select_line[i].value;
                  }
                }
				hex = document.getElementById('myhexcode').value;
				var r_color = document.getElementById('cPrgbR').value;
				var g_color = document.getElementById('cPrgbG').value;
				var b_color = document.getElementById('cPrgbB').value;
				
				if(selected_line == 'line1') {
					document.getElementById('r1').value = r_color;
					document.getElementById('g1').value = g_color;
					document.getElementById('b1').value = b_color;
					document.getElementById('line_one').style.backgroundColor = "#"+ hex;
				}
				if(selected_line == 'line2') {
					document.getElementById('r2').value = r_color;
					document.getElementById('g2').value = g_color;
					document.getElementById('b2').value = b_color;
					document.getElementById('line_two').style.backgroundColor = "#"+ hex;
				}
			}
			
			$(document).ready(
				function() {
				$.ColorPicker.init();
				}
			);
		</script><span style="color:#8A8A8A">&nbsp;<input type="radio" name="select_line" value="line1" /> line1&nbsp;<input type="radio" name="select_line" value="line2" />line2</span>
        <input type="hidden" id="myhexcode" value="">
  </td>
 </tr>
 <tr><td colspan="2" height="10"></td></tr>
 <tr>
  <td align="left" style="font-size:14px; color:#4F4F4F;">Text effect</td>
  <td align="left">
   <select name="text_effect" id="text_effect">
    <option value="">- Text effect -</option>
    <option value="shadow">Shadow</option>
   </select>
  </td>
 </tr>
 <tr><td colspan="2" height="10"></td></tr>
 <tr>
  <td align="center" colspan="2">
  <input type="hidden" name="r1" id="r1" value="" />
  <input type="hidden" name="g1" id="g1" value="" />
  <input type="hidden" name="b1" id="b1" value="" />
  
  <input type="hidden" name="r2" id="r2" value="" />
  <input type="hidden" name="g2" id="g2" value="" />
  <input type="hidden" name="b2" id="b2" value="" />
  
  <a href="javascript:void(0);" onclick="make_banner();"><img src="images/generate-banner.jpg" /></a>
  </td>
 </tr>
  </table>
 </td>
 <td align="center" width="62%" valign="top">
 <table align="center" width="100%" cellpadding="0" cellspacing="0">
  <tr><td align="center"><div id="show_banner" style="text-align:left"></div></td></tr>
  <tr><td align="center"><div id="show_custom_banner" style="text-align:left"></div></td></tr>
  <tr><td align="center" height="24"></td></tr>
  <tr><td align="left"><div id="result_img" align="left"></div></td></tr>
 </table>
 </td>
</tr>  
 </table>
 </form>
</body>
</html>