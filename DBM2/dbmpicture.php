<?php require_once('../Connections/dbmrov.php'); ?>
<?php
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

												<?php 
													
													$perid = $_POST['perId'];
													$filetmp = mysql_real_escape_string(file_get_contents($_FILES["file_img"]["tmp_name"]));//$_FILES["file_img"] ["tmp_name"];
													$filename = mysql_real_escape_string($_FILES["file_img"] ["name"]);
													$filetype = mysql_real_escape_string($_FILES["file_img"] ["type"]);
													//$filepath = "profile/".$filename;
													//move_uploaded_file($filetmp,$filepath);
													$query1 = "select * from personnel, profile_pics
													where profile_pics.perId=personnel.perId and profile_pics.perId='$perid'";
													 $res1= mysql_query($query1);
													 while ($row1 = mysql_fetch_assoc($res1)) 
													{
													$pId=$row1['picId'];
													$per=$row1['perId'];
													if(substr($filetype,0,5)=="image")
													{
														$newNamePrefix = time() . '_';
														$update=("UPDATE profile_pics SET picname='".$newNamePrefix . $filename."' , image='".$filetmp."' ,  picType='".$filetype."' WHERE picId=".$pId);
												    if(mysql_query($update)){?>
														<script type="text/javascript">
														window.location.href="dbmPIMpersonnelVIEW.php?perId=<?php echo $per;?>";
													    </script>
													<?php
													} else {
														?> <script type="text/javascript">
														alert("OOOPSS, Something went wrong!! Try uploading a smaller size of image...");
														window.location.href="dbmPIMpersonnelVIEW.php?perId=<?php echo $per;?>";
														 </script>
													<?php 	}
													}else
													{
															?> <script type="text/javascript">
														alert("Sorry, The image Format is not Recognize or not Allowed!!");
														window.location.href="dbmPIMpersonnelVIEW.php?perId=<?php echo $per;?>";
														 </script>
													<?php 	}
													}
													
													
														?>
		
</body>
</html> 