<?php require_once('../Connections/dbmrov.php'); ?>
<?php
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

												<?php 
											$query = mysql_query("select * from profile_pics");
											while($row = mysql_fetch_assoc($query)) {
												$img=$row['image'];
												$pn=$row['picname'];
												$id=$row['picId'];
												$t=$row['picType'];
												echo $id;
												//echo $img; 
												 $msg= '<img src="data:image/'.$t.';base64,'.base64_encode($img). ' " />';
												 echo $msg;
											}
											
											
											?>
											 <button data-toggle="modal" data-target="#modal" class="btn" ><i class="icon-plus shaded"></i> Change Profile Picture</button>
</body>
</html> 