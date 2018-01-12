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
		//$perId3=mysql_real_escape_string($_GET['perId2']);
		//echo $perId3;
		//echo $perId.' '.$perId2;
		if (isset($_GET['perId2'])){
	    $perId3=$_GET['perId2'];
		
		$query02 = "SELECT * FROM personnel_update where personnel_update.perId2='$perId3'";
													$result2= mysql_query($query02);	
													while($row2 = mysql_fetch_assoc($result2)) {
													$perIds=$row2['perId2'];
													$perMname=$row2['perMname2'];
													$perLname=$row2['perLname2'];
													$perEmail=$row2['perEmail2'];
													$perMobileNo =$row2['perMobileNo2'];
													$perTelnos=$row2['perTelno2'];
													$perHeight =$row2['perHeight2'];
													$perWeight =$row2['perWeight2'];
													$perStatus  =$row2['perStatus2'];
													$perDateModified=date('Y-m-d');
													$perId2 =$row2['perId22'];
		$update1=("UPDATE personnel_update SET status2='Allowed' where personnel_update.perId2='$perId3'");	
			/*echo $perIds.'<p></p>' ;
			echo $perMname.'<p></p>';
			echo $perLname.' <p></p>';
			echo $perEmail.' <p></p>';
		echo $perMobileNo.'<p></p> ';	
		echo $perTelnos.' <p>df</p>';
		echo $perHeight.'<p></p> ';
		echo $perWeight.'<p></p> ';
		echo $perStatus.' <p></p>';
		echo $perDateModified.' <p></p>';
		echo $perId2.' <p></p>';*/
							
			$update2=("UPDATE personnel SET perMname='".$perMname."' WHERE personnel.perId='".$perId2."'");	
			$update3=("UPDATE personnel SET perLname='".$perLname."' WHERE personnel.perId='".$perId2."'");
			$update4=("UPDATE personnel SET perEmail='".$perEmail."' WHERE personnel.perId='".$perId2."'");
			$update5=("UPDATE personnel SET perMobileNo='".$perMobileNo."' WHERE personnel.perId='".$perId2."'");
			$update6=("UPDATE personnel SET perTelno='".$perTelnos."' WHERE personnel.perId='".$perId2."'");
			$update7=("UPDATE personnel SET perHeight='".$perHeight."' WHERE personnel.perId='".$perId2."'");
			$update8=("UPDATE personnel SET perWeight='".$perWeight."' WHERE personnel.perId='".$perId2."'");
			$update9=("UPDATE personnel SET perStatus='".$perStatus."' WHERE personnel.perId='".$perId2."'");
			$update10=("UPDATE personnel SET perDateModified='".$perDateModified."' WHERE personnel.perId='".$perId2."'");
			
			
			if(mysql_query($update1))
						{
							echo '';					 
						} 
						else echo "no";	
		if(mysql_query($update2))
						{
							echo '';					 
						} 
						else echo "no";	
		
		if(mysql_query($update3))
						{
							echo '';					 
						} 
						else echo "no";	
		
		if(mysql_query($update4))
						{
							echo '';					 
						} 
						else echo "no";	
		
		if(mysql_query($update5))
						{
							echo '';					 
						} 
						else echo "no";	
		
		if(mysql_query($update6))
						{
							echo '';					 
						} 
						else echo "no";	
		
		if(mysql_query($update7))
						{
							echo '';					 
						} 
						else echo "no";	
		
		if(mysql_query($update8))
						{
							echo '';					 
						} 
						else echo "no";	
		if(mysql_query($update9))
						{
							echo '';					 
						} 
						else echo "no";	
		if(mysql_query($update10))
						{
							echo '';					 
						} 
						else echo "no";	
		
		}

		}
													?>
<SCRIPT LANGUAGE="JavaScript">
	//window.location.href="dbmPIMDelPerUpdate.php?perId=<?php echo $perId3; ?>";
 window.location.href="dbmPIMNotification.php";
</SCRIPT>
</body>
</html>