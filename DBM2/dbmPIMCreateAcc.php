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
  $per=mysql_real_escape_string($_GET['perId']);
			$query = "select * from personnel where personnel.perId=$per";
			$result= mysql_query($query);	
			while($row = mysql_fetch_assoc($result)) {
			$fname=$row['perFname'];
			}
	$upper="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$lower="abcdefghijklmnopqrstuvwxyz";
	$num="0123456789";
	$shuffledUpper=substr(str_shuffle($upper),0,3);
	$shuffledLower=substr(str_shuffle($lower),0,3);
	$shuffledNum=substr(str_shuffle($num),0,3);
	$password="$shuffledUpper$shuffledLower$shuffledNum";
	//echo $password;
	$update=("UPDATE account SET accUsername='".$fname."' , accPassword='".$password."' ,  accPrivilege='2' WHERE perId=".$per);
	//$sql= "insert into account (accUsername, accPassword, accPrivilege, perId) values ('$fname','$password','2','$per')";
				if(mysql_query($update))
						{
							echo 'yes';
								 
						} 
						else echo "no";						
 ?>
  

<SCRIPT LANGUAGE="JavaScript">
 //window.location.href="dbmPIMAccount.php?perId=<?php echo $per; ?>"
 window.location.href="dbmPIMAcct.php";
</SCRIPT>
</body>
</html>