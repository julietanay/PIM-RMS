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
  $sql= "insert into profile_pics (picname, image, picType, perId) values ('','','','$per')";
					$query = "SELECT *	FROM personnel where perId='$per'";
					$result= mysql_query($query);	
					$row = mysql_fetch_assoc($result); 
					$perfname = $row['perFname'];
					$perlname = $row['perLname'];
					$perdatestart = $row['perDateStarted'];
					$pa3=$perfname.$perlname;
					$nes=str_replace(' ','',$pa3 );
  $sql2= "insert into account (accUsername, accPassword, accPrivilege, perId) values ('$nes', 'dbmrovpass','2','$per')";
				   $date=date('Y-m-d');
				   $d = date_parse_from_format("Y-m-d", $perdatestart);
				   $month=$d["month"];   
				   $day=$d["day"]; 
				   $Year=$d["year"]; 
				   $currentd=date('d');
				   $currentm=date('m');
				   $currenty=date('Y');
				 if ($Year==$currenty)
				 {
						if ($month==$currentm){
							$sl=1.25;
							$vl=1.25;
						} else{
							$count = 0;
							$count = $currentm-$month;
								$sl=$count*1.25;
								$vl=$count*1.25;
						}
				} 
				else 
				{
						$sl=$currentm*1.25;
						$vl=$currentm*1.25;
				}
				$ml=0;
				$count2=0;
				if ($Year<$currenty)
				{
						if ($currentm<$month){
							$count2=$currenty-$Year;
							$count2=$count2-1;
						} else {
							$count2=$currenty-$Year;
						}
							if($count2>=2)
							{
								$ml = 60;
							} 
							else
							{
								$ml = 0;
							}
				}
  $sql3= "insert into per_leave (sickLeave, vacationLeave, maternityLeave, divModified, perId) values ('$sl', '$vl' , '$ml','$date', '$per')";
  	if(mysql_query($sql) && mysql_query($sql2) && mysql_query($sql3))
						{
								echo '<script type="text/javascript">
							    alert("Added Successfully!!");
								window.location.href="dbmPerAdd.php";
							     </script>';
						} 
						else {
							echo '<script type="text/javascript">
							    alert("Failed!! Something went wrong...");
								window.location.href="dbmPerAdd.php";
							     </script>';
						}
							
/*if(mysql_query($sql2))
						{
							echo "yes";
								 
						} 
						else echo mysql_error();		
if(mysql_query($sql3))
						{
							echo 'yes';
								 
						} 
						else echo mysql_error();	*/							
   ?>

<SCRIPT LANGUAGE="JavaScript">
 //window.location.href="dbmPIMAccount.php?perId=<?php echo $per; ?>"
 //window.location.href="dbmPerAdd.php";
</SCRIPT>
</body>
</html>