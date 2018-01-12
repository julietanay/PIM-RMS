<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php require_once('../Connections/dbmrov.php'); ?>
<?php
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db'); 

											$que = "SELECT * FROM profile_pics ";
											$res= mysql_query($que);	
											while($ro= mysql_fetch_assoc($res)) {
											$img0=$ro['image']; ?>
											<img src="<?php echo 'data:image/'.$type0.';base64,'.base64_encode($img0); ?>"/>
									<?php		}?>



</body>
</html>