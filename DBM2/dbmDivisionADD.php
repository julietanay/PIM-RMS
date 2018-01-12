<?php require_once('../Connections/dbmrov.php'); ?>
<?php
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
    </head>

<body>
										
  <?php
  $divadd = $_POST['divisionadd'];
  $date = $_POST['datediv'];
  $desc = $_POST['divDesc'];
 // echo $divadd.'----'.$date.'-----'.$desc.'';
  $insert= mysql_query("Insert INTO division VALUES ('','$divadd','$desc', '$date')");		
	 if(mysql_query($insert))
													{?>
														<script type="text/javascript">
														alert("yes");
														
													    </script>
													<?php
													} else {
														?> <script type="text/javascript">
														alert("OOOPSS");
														 </script>
													<?php 	}
													
														?>
   	<script type="text/javascript">
	//window.location.href="dbmManage.php";
	</script>
 
</form>					
</body>
</html> 