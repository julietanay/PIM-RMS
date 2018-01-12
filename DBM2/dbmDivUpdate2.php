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
		$perId=mysql_real_escape_string($_GET['perId']);
		$divName=mysql_real_escape_string($_GET['divName']);
		$divId=mysql_real_escape_string($_GET['divId']);
		$date= date('Y-m-d');
		$query = "SELECT *	FROM division where divId='$divId'";
					$result= mysql_query($query);	
					$row = mysql_fetch_assoc($result); 
					$divdivName = $row['divName'];
					$perperId= $row['perId'];
					if ($perId==" "){
					$perId = null;
			}
		if($divName==$divdivName && $perperId==$perId){
			echo '<script type="text/javascript">
							    alert("No changes Detected...");
								window.location.href="dbmAddDivision.php";
							     </script>';
		} else {
			
			$update1=("UPDATE division SET divName='$divName' where division.divId='$divId'");
			$update3=("UPDATE division SET perId='$perId' where division.divId='$divId'");
			$update2=("UPDATE division SET divModified='$date' where division.divId='$divId'");
		if(mysql_query($update1) && mysql_query($update2) || mysql_query($update3))
						{
								echo '<script type="text/javascript">
							    alert("Updated Successfully!!");
							window.location.href="dbmAddDivision.php";
							     </script>';
						} else {
							echo '<script type="text/javascript">
							    alert("Something went wrong...Please Try Again...");
								window.location.href="dbmAddDivision.php";
							   </script>';}
	}	
								?>		

</body>
</html>