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
 <?php //$perId=$per=mysql_real_escape_string($_GET['perId']);
		$perId2=mysql_real_escape_string($_GET['perId']);
		 //echo $perId2;
			$delete=("DELETE FROM personnel_update WHERE personnel_update.perId2='$perId2'");
			if(mysql_query($delete))
						{
							echo ' ';					 
						} 
						else echo "no";	
													
													?>
<SCRIPT LANGUAGE="JavaScript">
	window.location.href="dbmPIMNotification.php?";
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>