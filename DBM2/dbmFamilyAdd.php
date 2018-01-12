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
						$perId=mysql_real_escape_string($_GET['perId']);
						$date=date('Y-m-d');
						echo $badd.'<p></p>';
						echo $employ.'<p></p>';
						echo $occu.'<p></p>';
						
		$insertFamily="INSERT INTO family(famLname, famMname, famFname, famRelationship, famExtName, famOccupation, famEmployer, famBussAddress, famTelNo, famMaidenName, famBday, famDateModified, perId) VALUES ('$lname','$mname','$fname','$relation','$ext','$occu','$employ','$badd','$telno','$Maidenname','$bday','$date','$perId')";
		 if(mysql_query($insertFamily))
						{ ?>
								<script type="text/javascript">
							    alert("Added Successfully!!");
								window.location.href="dbmPIMpersonnelView.php?perId=<?php echo $perId; ?>";
							     </script>';
						<?php } else {?> 
							<script type="text/javascript">
							    alert("Something went wrong...Please Try Again...");
								window.location.href="dbmPIMpersonnelView.php?perId=<?php echo $perId; ?>";
							     </script>
							<?php 	 }
			  ?>		
<script type="text/javascript"> 
// window.location.href="dbmAddPosition.php";
 </script>
</body>
</html>