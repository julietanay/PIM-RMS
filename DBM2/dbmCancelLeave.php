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
		<?php
			$appLeaveId=mysql_real_escape_string($_GET['appLeaveId']);
			$delete=("DELETE FROM apply_leave WHERE apply_leave.appLeaveId='$appLeaveId'");
			if(mysql_query($delete))
						{
							echo '';
								 
						} 
						else echo "no";		
		
		
		
// $sql= "insert into profile_pics (picname, image, picType, perId) values ('','','','$per')";
 ?>

<SCRIPT LANGUAGE="JavaScript">
	window.location.href="dbmUserLeaveApp.php?perId=<?php 
								$appLeaveId=mysql_real_escape_string($_GET['appLeaveId']);
								$query3 = "select * from apply_leave where apply_leave.appLeaveId='$appLeaveId'";
								$result3= mysql_query($query3);	
								while($row3 = mysql_fetch_assoc($result3)){
								$perId1=$row3['perId']; 
								echo $perId1;
								} 
								?>"
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>