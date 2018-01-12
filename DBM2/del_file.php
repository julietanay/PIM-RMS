<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html>
<html>
<head>
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
	if (isset($_GET['fileid'])){
		$fileid=$_GET['fileid'];
		$t=mysql_query("SELECT type_id FROM file WHERE file_id='$fileid'");
		$r=mysql_fetch_assoc($t);
		$type_id=$r['type_id'];
		$delimg=mysql_query("DELETE FROM file_image WHERE file_id='$fileid'");
		if($delimg){
		$qry=mysql_query("DELETE FROM file WHERE file_id='$fileid'");
		if($qry){
			echo "<script>swal('Deleted!', 'File has been permanently deleted!', 'success');</script>";
            header("Refresh:1; url=file_cat.php?type=$type_id");
		}
		else
		{
			mysql_error();
		}
		}
	}
?>
</body>
</html>