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
								echo '<script type="text/javascript">
							    alert("Leave Request was Successfully Canceled!");
								window.location.href="dbmLeaveAppList.php";
							     </script>';
						} else {
							echo '<script type="text/javascript">
							    alert("Something went wrong...Please Try Again...");
								window.location.href="dbmLeaveAppList.php";
							     </script>';}
							
		/*$query3 = "select * from personnel";
					$result3= mysql_query($query3);	
					while($row3 = mysql_fetch_assoc($result3)) {
					$priv3=$row3['perFname'];
					$pass3=$row3['perLname'];
					$pa3=$priv3.$pass3;
					$nes=str_replace(' ','',$pa3 );
					echo $nes.'<p></p>'; 
					
			} 	*/
		?>	


<SCRIPT LANGUAGE="JavaScript">
   window.location.href="dbmLeaveAppList.php?";
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>