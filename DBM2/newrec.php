<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>RMS - Add New File</title>
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

if(isset($_POST['addnew'])){
	if($_POST['rectype'] != 0){
	$series = $_POST['series'];
	$title = $_POST['title'];
	$file_date = $_POST['file_date'];
	$purpose = $_POST['purpose'];
	$amount = $_POST['amount'];
	$rectype = $_POST['rectype'];
	$agency = $_POST['agency'];

	if(isset($_GET['typeid'])){
	$typeid = mysql_escape_string($_GET['typeid']);
	$sql = "INSERT INTO file(file_id, type_id, subtype_id, series_no, title, file_date, purpose, amount, agency) VALUES('', '$typeid', '$rectype', '$series', '$title', '$file_date', '$purpose', '$amount', '$agency')";
	if (mysql_query($sql)){
				
$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
//$max_file_size = 1024*100; //100 kb
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
	        	$imagedb=mysql_query("INSERT INTO file_image(fimage_id, file_id, f_image, fimage_date) VALUES('', (SELECT MAX(file_id) FROM file), '$name', CURDATE())");
	        	//	if($imagedb){
	        	//}
	        }

	    }
	}
				echo "<script>swal('File Added!', 'New File has been successfully Added.', 'success');</script>";
            	header("Refresh:1; url=file_cat.php?type=$typeid");

	}
	else{ 
		
		echo mysql_error();
		echo $rectype;
	}
	}
}
	else{
	$series = $_POST['series'];
	$title = $_POST['title'];
	$file_date = $_POST['file_date'];
	$purpose = $_POST['purpose'];
	$amount = $_POST['amount'];
	$agency = $_POST['agency'];

	if(isset($_GET['typeid'])){
	$typeid = mysql_escape_string($_GET['typeid']);
	$sql = "INSERT INTO file(file_id, type_id, series_no, title, file_date, purpose, amount, agency) VALUES('', '$typeid', '$series', '$title', '$file_date', '$purpose', '$amount', '$agency')";
	if (mysql_query($sql)){
		
$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
//$max_file_size = 1024*100; //100 kb
$path = "scanned/"; // Upload directory
$count = 0;

	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        //if ($_FILES['files']['size'][$f] > $max_file_size) {
	        //    $message[] = "$name is too large!.";
	        //    continue; // Skip large files
	       // }
			if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        $imagedb=mysql_query("INSERT INTO file_image(fimage_id, file_id, f_image, fimage_date) VALUES('', (SELECT MAX(file_id) FROM file), '$name', CURDATE())");
	        //if($imagedb){
	        
	       // }
	    }
	    }
	}
	echo "<script>swal('File Added!', 'New File has been successfully Added.', 'success');</script>";
    header("Refresh:1; url=file_cat.php?type=$typeid");
	
	}
	}
	}
            
}

?>

</body>
</html>
