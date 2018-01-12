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
							$password = mysql_real_escape_string($_GET['accPassword']);
							$username =mysql_real_escape_string($_GET['accUsername']);
							$perperId = mysql_real_escape_string($_GET['perId']);
							$priv = mysql_real_escape_string($_GET['accPrivilege']);
							$query1="select * from account where account.perId='$perperId'";
							$result1= mysql_query($query1);	
							$counter1=0;
							while($row1 = mysql_fetch_assoc($result1)) {
							$accId=$row1['accId'];
							$update=("UPDATE account SET accPassword='$password', accUsername='$username', accPrivilege='$priv' where account.accId='$accId'");
							if(mysql_query($update)){
								echo ("<SCRIPT LANGUAGE='JavaScript'>
										window.alert('Your Account is Ready!!')
										window.location.href='dbmPimUserLogin.php'
										</SCRIPT>");
											} else {
												echo ("<SCRIPT LANGUAGE='JavaScript'>
										window.alert('Something went wrong...Please Try Again..')
										window.location.href='dbmSignUp.php'
										</SCRIPT>");
											}
							}

						 ?>

<SCRIPT LANGUAGE="JavaScript">
	window.location.href="dbmPIMNotification.php?perId=<?php echo $perId; ?>"
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>