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
		$posId=mysql_real_escape_string($_GET['posId']);
		$posName=mysql_real_escape_string($_GET['posName']);
		$date= date('Y-m-d');
		$query = "SELECT *	FROM positions where posId='$posId'";
					$result= mysql_query($query);	
					$row = mysql_fetch_assoc($result); 
					$posposName = $row['posName'];
		if($posposName==$posName){
			echo '<script type="text/javascript">
							    alert("No changes Detected...");
								window.location.href="dbmAddPosition.php";
							     </script>';
		} else {
			$update1=("UPDATE positions SET posName='$posName' where positions.posId='$posId'");
			$update2=("UPDATE positions SET divModified='$date' where positions.posId='$posId'");
			  if(mysql_query($update1) && mysql_query($update2))
						{
								echo '<script type="text/javascript">
							    alert("Updated Successfully!!");
								window.location.href="dbmAddPosition.php";
							     </script>';
						} else {
							echo '<script type="text/javascript">
							    alert("Something went wrong...Please Try Again...");
								window.location.href="dbmAddPosition.php";
							     </script>';}
	}	
								?>		
<script type="text/javascript"> 
// window.location.href="dbmAddPosition.php";
 </script>
</body>
</html>