<?php
$uploaddir = 'images/'; 
$file = $uploaddir . basename($_FILES['uploaded']['name']);  
if (move_uploaded_file($_FILES['uploaded']['tmp_name'], $file)) { 
  echo "success";  
} else {
	echo "error";
}
?>