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
			$query = "SELECT *	FROM personnel where perId='$perId'";
				$result= mysql_query($query);	
				$row = mysql_fetch_assoc($result); 
				$perfname = $row['perFname'];
				$perlname = $row['perLname'];
				$pa3=$perfname.$perlname;
				$nes=str_replace(' ','',$pa3 );
		    $update1=("UPDATE account SET accUsername='$nes', accPassword='dbmrovpass' where account.perId='$perId'");
				if(mysql_query($update1))
						{
								echo '<script type="text/javascript">
							    alert("Account was Reset Successfully!!");
								window.location.href="dbmPIMAcct.php";
							     </script>';
						} 
						else {
							echo '<script type="text/javascript">
							    alert("Failed!! Something went wrong...");
								window.location.href="dbmPIMAcct.php";
							     </script>';
						}
								?>	
		
		


<SCRIPT LANGUAGE="JavaScript">
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>