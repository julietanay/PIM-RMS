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
						$houseNo=mysql_real_escape_string($_GET['houseNo']);
						$street=mysql_real_escape_string($_GET['street']);
						$subd=mysql_real_escape_string($_GET['subdivision']);
						$brgy=mysql_real_escape_string($_GET['barangay']);
						$city=mysql_real_escape_string($_GET['city']);
						$prov=mysql_real_escape_string($_GET['province']);
						$zip=mysql_real_escape_string($_GET['zipcode']);
						$addresstype=mysql_real_escape_string($_GET['addressType']);
						$perId=mysql_real_escape_string($_GET['perId']);
						$date= date('Y-m-d');
		$insertAddress="INSERT INTO address (houseNo, street, subdivision, barangay, city, province, addressType, addDateModified, zipcode, perId) VALUES ('$houseNo', '$street', '$subd', '$brgy', '$city', '$prov', '$addresstype', '$date', '$zip', '$perId' )";
		 if(mysql_query($insertAddress))
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