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
		$familyId=mysql_real_escape_string($_GET['familyId']);
		$fname=mysql_real_escape_string($_GET['famFname']);
		$mname=mysql_real_escape_string($_GET['famMname']);
		$lname=mysql_real_escape_string($_GET['famLname']);
		$Maidenname=mysql_real_escape_string($_GET['famMaidenName']);
		$ext=mysql_real_escape_string($_GET['famExtName']);
		$bday=mysql_real_escape_string($_GET['famBday']);
		$relation=mysql_real_escape_string($_GET['famRelationship']);
		$badd=mysql_real_escape_string($_GET['famBussAddress']);
		$employ=mysql_real_escape_string($_GET['famEmployer']);
		$occu=mysql_real_escape_string($_GET['famOccupation']);
		$telno=mysql_real_escape_string($_GET['famTelNo']);
		$date= date('Y-m-d');
		$query = "SELECT *	FROM family where familyId='$familyId'";
					$result= mysql_query($query);	
					$row = mysql_fetch_assoc($result); 
					$ffname=$row['famFname'];
					$fmname=$row['famMname'];
					$flname=$row['famLname'];
					$fMaidenname=$row['famMaidenName'];
					$fext=$row['famExtName'];
					$fbday=$row['famBday'];
					$frelation=$row['famRelationship'];
					$fbadd=$row['famBussAddress'];
					$femploy=$row['famEmployer'];
					$foccu=$row['famOccupation'];
					$ftelno=$row['famTelNo'];
					$perper=$row['perId'];
		if( $ffname==$fname &&
		    $fmname==$mname &&
			$flname==$lname &&
			$fMaidenname==$Maidenname &&
			$fext==$ext &&
			$fbday==$bday &&
			$frelation==$relation &&
			$fbadd==$badd &&
			$femploy==$employ &&
			$foccu==$occu &&
			$ftelno==$telno ){?>
			<script type="text/javascript">
							    alert("You have not made any changes!!");
								window.location.href="dbmPIMpersonnelView.php?perId=<?php echo $perper; ?>";
							     </script>';
		<?php } else {
			$update1=("UPDATE family SET famLname='$lname',famMname='$mname',famFname='$fname',famRelationship='$relation',famExtName='$ext',famOccupation='$occu',famEmployer='$employ',famBussAddress='$badd',famTelNo='$telno',famMaidenName='$Maidenname',famBday='$bday',famDateModified='$date' WHERE familyId='$familyId'");
			//$update2=("UPDATE positions SET divModified='$date' where positions.posId='$posId'");
			  if(mysql_query($update1))
						{ ?>
								<script type="text/javascript">
							    alert("Updated Successfully!!");
								window.location.href="dbmPIMpersonnelView.php?perId=<?php echo $perper; ?>";
							     </script>';
						<?php } else {?> 
							<script type="text/javascript">
							    alert("Something went wrong...Please Try Again...");
								window.location.href="dbmPIMpersonnelView.php?perId=<?php echo $perper; ?>";
							     </script>
							<?php 	 }
	}	
								?>		
<script type="text/javascript"> 
// window.location.href="dbmAddPosition.php";
 </script>
</body>
</html>