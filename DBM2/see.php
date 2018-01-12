
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
//$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
//or die ('Cannot connect to db');
//$nm=$_GET["nm"];
//	$query = "select division.divId, division.divName from division where divName like('$nm')";
//						$result= mysql_query($query);	
//						 while($row = mysql_fetch_assoc($result)) {
//							 $divisionId=$row['divId'];
//							 $name=$row['divName'];
//							 echo  $name;
//						 }
@session_start(); 
$logU=mysql_real_escape_string($_POST['username']);
$logP=mysql_real_escape_string($_POST['password']);
							
echo $_SESSION['username'];
echo $_SESSION['pass'];
echo $_SESSION['pid'];
echo $logU;
echo $logP;
echo $hh;
 ?>
</body>
</html>