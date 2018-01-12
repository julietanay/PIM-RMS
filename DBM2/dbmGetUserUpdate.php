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
 <?php  $perId=mysql_real_escape_string($_GET['perId2']);
		$perMname =mysql_real_escape_string($_GET['perMname']);
		$perLname =mysql_real_escape_string($_GET['perLname']);
		$perEmail =mysql_real_escape_string($_GET['perEmail']);
		$perMobileNo =mysql_real_escape_string($_GET['perMobileNo']);
		$perTelno =mysql_real_escape_string($_GET['perTelno']);
		$perHeight =mysql_real_escape_string($_GET['perHeight']);
		$perWeight =mysql_real_escape_string($_GET['perWeight']);
		$perStatus  =mysql_real_escape_string($_GET['perStatus']);
		$perDateModified=mysql_real_escape_string($_GET['perDateModified']);
		$status="Pending";
		$seen="No";
		
		/*echo $perId.'<p></p>';
		echo $perMname.'<p></p>';
		echo $perLname.'<p></p>';
	
		echo $perEmail.'<p></p>';
		
		echo $perMobileNo.'<p></p>';
		echo $perTelno.'<p></p>';
		echo $perHeight.'<p></p>';
		echo $perWeight.'<p></p>';
		echo $perStatus.'<p></p>';
		echo $perDateModified.'<p></p>';*/
		
		
		$sqlInsert="INSERT INTO personnel_update( perMname2, perLname2, perEmail2, perMobileNo2, perTelno2, perHeight2, perWeight2, perStatus2, perDateModified2, status2, perId22, seen) VALUES ( '$perMname', '$perLname', '$perEmail', '$perMobileNo', '$perTelno', '$perHeight', '$perWeight', '$perStatus', '$perDateModified', '$status', '$perId', '$seen')";
if(mysql_query($sqlInsert))
				{
							echo '';
								 
						} 
						else echo 'no';
	
		
		
		
// $sql= "insert into profile_pics (picname, image, picType, perId) values ('','','','$per')";
 ?>

<SCRIPT LANGUAGE="JavaScript">
 window.location.href="dbmPIMUserIndex.php?perId=<?php echo $perId; ?>"
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>