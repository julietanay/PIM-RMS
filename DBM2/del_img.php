<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>RMS - Delete Page</title>
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
	if(isset($_GET['fimage_id']))
			{
			$img_id=$_GET['fimage_id'];
			$getfile=mysql_query("SELECT file_id FROM file_image WHERE fimage_id='$img_id'");
			if($getfile){
				$f_id=mysql_fetch_assoc($getfile);
				$file_id=$f_id['file_id'];
 			$sql_query=mysql_query("DELETE FROM file_image WHERE fimage_id='$img_id'");
 				if($sql_query){
 				echo "<script>swal('Deleted!', 'Page has been permanently deleted.', 'success');</script>";
 				header("Refresh:1.5; url=file_img.php?fileid=$file_id");
 				}
 				}
			}

?>
</body>
</html>