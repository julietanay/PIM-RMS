<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
?>
<body>
 <?php $appLeaveId=mysql_real_escape_string($_GET['appLeaveId']);
			$Approve="No";
			$update=("UPDATE apply_leave SET Approve1='$Approve' where apply_leave.appLeaveId='$appLeaveId'");
			if(mysql_query($update))
						{
							echo '';
								 
						} 
						else echo "no";		
		
		
		
// $sql= "insert into profile_pics (picname, image, picType, perId) values ('','','','$per')";
 ?>

<SCRIPT LANGUAGE="JavaScript">
	window.location.href="dbmPIMLeaveRequest.php"
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>