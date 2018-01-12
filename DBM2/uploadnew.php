<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>RMS - Upload</title>
	<script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
</head>
<style type="text/css">
	body{
width: 10%;
height: 100%;
background-image: url("images/bghome.png");
background-size: cover;
background-repeat: no-repeat;
display: table;
top: 0;
}
</style>
<body>


<?php

if(isset($_POST['newim'])){
	$file_id=$_GET['file_id'];
	$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
	$path = "scanned/"; // Upload directory
	$count = 0;

	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	       // if ($_FILES['files']['size'][$f] > $max_file_size) {
	       //     $message[] = "$name is too large!.";
	       //     continue; // Skip large files
	       // }
			if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        	$imagedb=mysql_query("INSERT INTO file_image(fimage_id, file_id, f_image, fimage_date) VALUES('', '$file_id', '$name', CURDATE())");
	        	if($imagedb){
	        	echo "<script>swal('Upload Successfull!', 'Scanned file was successfully uploaded.', 'success');</script>";
          		header("Refresh:1.5; url=file_img.php?fileid=$file_id");
				
	        	}
	        	else{
	        		echo mysql_error();
	        	}
	       }


	}
	
	}
}
?>
</body>
</html>