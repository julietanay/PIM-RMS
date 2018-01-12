<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
@session_start(); 
if($_SESSION['username']==''){
header('location:dbmLoginPIM.php');
}
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');

?>
<body>
<?php
							
							$current = mysqli_real_escape_string($conn, $_POST['current']);
							$new = mysqli_real_escape_string($conn, $_POST['new']);
							$confirm= mysqli_real_escape_string($conn, $_POST['confirm']);
							$username = mysqli_real_escape_string($conn, $_SESSION['username']);
							$query1="select * from account where account.accUsername='$username'";
							$result1= mysql_query($query1);	
							$counter1=0;
							while($row1 = mysql_fetch_assoc($result1)) {
								$accPassword=$row1['accPassword'];
								$accId=$row1['accId'];
								if($accPassword!=$current){
									echo "wrong Password";
								}else {
									if($confirm!=$new){
										echo "wrong confirmation of  Password";
									}else{
										$update=("UPDATE account SET accPassword='$confirm' where account.accId='$accId'");
										if(mysql_query($update))
											{?>
												<SCRIPT LANGUAGE="JavaScript">
													window.location.href="dbmPIMEditAcc.php"
												 //window.location.href="dbmPerAdd.php";
												</SCRIPT>
													 
										<?php	} 
											else echo "no";	
									}
								}
							}
				?>


 <?php 
			
			/*$update=("UPDATE personnel_update SET seen='$seen' where personnel_update.seen='No'");
			if(mysql_query($update))
						{
							echo '';
								 
						} 
						else echo "no";		*/
		
		
		
// $sql= "insert into profile_pics (picname, image, picType, perId) values ('','','','$per')";
 ?>

<SCRIPT LANGUAGE="JavaScript">
//	window.location.href="dbmPIMNotification.php?perId=<?php echo $perId; ?>"
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>