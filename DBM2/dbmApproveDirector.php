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
		$perId=mysql_real_escape_string($_GET['perId']);
			$Approve="Yes";
			$update=("UPDATE apply_leave SET Approve2='$Approve' where apply_leave.appLeaveId='$appLeaveId'");
			if(mysql_query($update))
						{
							echo '';
								 
						} 
						else echo "no";		
		
		$query7 = "SELECT * FROM apply_leave WHERE apply_leave.appLeaveId=$appLeaveId";
				$result7= mysql_query($query7);	
				while($row7= mysql_fetch_assoc($result7)){
				$perId7=$row7['perId'];
				$appLeave7=$row7['appLeaveId'];
				$appliedFor7=$row7['appliedFor'];
				$type7=$row7['leaveType'];
				if($type7=='Sick'){	
			   $update2=("UPDATE per_leave SET sickLeave=(sickLeave-$appliedFor7) where per_leave.perId='$perId7' ");
			   	if(mysql_query($update2))
						{
							echo '';
								 
						} 
						else echo "no2";		
				}else if($type7=='Vacation'){
		      $update3=("UPDATE per_leave SET vacationLeave=(vacationLeave-$appliedFor7) where per_leave.perId='$perId7' ");
			  	if(mysql_query($update3))
						{
							echo '';
								 
						} 
						else echo "no3";	
				} else if ($type7=='Maternity'){
		      $update4=("UPDATE per_leave SET maternityLeave=(maternityLeave-$appliedFor7) where per_leave.perId='$perId7' ");
		  	if(mysql_query($update4))
						{
							echo '';
								 
						} 
						else echo "no4";	
				}	
				}
// $sql= "insert into profile_pics (picname, image, picType, perId) values ('','','','$per')";
 ?>

<SCRIPT LANGUAGE="JavaScript">
	window.location.href="dbmPIMDirector.php?perId=<?php echo $perId; ?>";
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>