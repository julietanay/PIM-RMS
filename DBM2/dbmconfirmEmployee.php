<?php require_once('../Connections/dbmrov.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE account SET accUsername=%s, accPassword=%s, accPrivilege=%s WHERE accId=%s",
                       GetSQLValueString($_POST['accUsername'], "text"),
                       GetSQLValueString($_POST['accPassword'], "text"),
                       GetSQLValueString($_POST['accPrivilege'], "int"),
                       GetSQLValueString($_POST['accId'], "text"));

  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($updateSQL, $dbmrov) or die(mysql_error());
  
 $updateGoTo = "dbmPimUserLogin";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['perId'])) {
  $colname_Recordset1 = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = sprintf("SELECT * FROM account WHERE perId = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<link type="text/css" href="css/styleLink.css" rel='stylesheet'>
<style>
.img-circular{
 width: 200px;
 height: 200px;
 background-size:cover;
 display: block;
 border-radius: 100px;
 -webkit-border-radius: 100px;
 -moz-border-radius: 100px;
 border:thick;
 position:center;
 margin-left: 13%;
 border-color:#F90;
}
 .img-circulars{
 width: 160px;
 height: 150px;
 background-size:cover;
 display: block;
 border-radius: 100px;
 -webkit-border-radius: 100px;
 -moz-border-radius: 100px;
 border:thick;
 border-color:#F90;
 }
#mywarning{
display:none;
position: fixed;
left: 0;
top: 0;
width: 100%;
height: 100%;
text-align: center;
z-index: 1000;
background-color: rgba(0,0,0, .3); 
}

#mywarning div{   
width: 500px;
margin: 200px auto;
background: #fff;    
padding: 0px;
text-align: left;
overflow: hidden;
}
#myalert{
display:none;
position: fixed;
overflow: auto;
left: 0;
top: 0;
width: 100%;
height: 100%;
text-align: center;
z-index: 90;
background-color: rgba(0,0,0, .4); 
 
}

#myalert div{   
width: 800px;
margin: 30px auto;
background: #fff;    
padding: 3px;
text-align: left;
overflow: hidden;
-webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}
#header {
    padding: 2px 16px;
    background: #333;
    color: black;
	border-top-left-radius: 20px;
	border-top-right-radius: 20px;
	border-bottom-left-radius: 15px;
	border-bottom-right-radius: 15px;
}

@-webkit-keyframes animatetop {
    from {top: -300px; opacity: 0} 
    to {top: 0; opacity: 0}
}

@keyframes animatetop {
    from {top: -300px; opacity: 0}
    to {top: 0; opacity: 0}
	
}
</style>

</head>
<?php
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
?>
<body>
 <?php
		
		if (isset($_GET['perId'])){
		$perId=mysql_real_escape_string($_GET['perId']);
		$perAgenEmpNoTXT=mysql_real_escape_string($_GET['perAgenEmpNo']);
		$query02 = "SELECT * FROM personnel, profile_pics where personnel.perId='$perId' and profile_pics.perId=personnel.perId";
					$result2= mysql_query($query02);	
					while($row = mysql_fetch_assoc($result2)) {
						$perperId=$row['perId'];	
					$perAgenEmpNo=$row['perAgenEmpNo'];		
						$firstname=$row['perFname'];
						$lastname=$row['perLname'];
						$middlename=$row['perMname'];
						$extensionname=$row['perExtName'];
						$image=$row['image']; 
						$type=$row['picType'];
							if ($perAgenEmpNoTXT==$perAgenEmpNo){  ?>
								 <?php $display="block"; ?>
										<div id="myalert"  style="display:<?php echo $display ?>;">
										  <div id="header">
											<form action="dbmSignUp.php" method="post">
											  <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
											</form>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											<center>
										 <?php if($image==null){ ?>
										<img class="img-circulars"  src="images/user - Copy.png">
										<p> <?php echo '<strong class="text-info"> Hello, '.$firstname.' '.$middlename.' '.$lastname.' '.$extensionname.'</strong>' ?></p>
										<?php } else{ ?>
										<img class="img-circulars" src="<?php echo 'data:image/'.$type.';base64,'.base64_encode($image); ?>" width="200" height="200"/>
										<p> <?php echo '<strong class="text-info"> Hello, '.$firstname.' '.$middlename.' '.$lastname.' '.$extensionname.'</strong>' ?></p>
										<?php	}?>
											  <label for="perAgenEmpNo"><h4 class="modal-title">&nbsp;We have Confirmed your Agency Employee No.</h4></label>
											</center>
											<hr>
											<center>
											<table width="60%" bordercolor="#FFCC00" border="1">
											<tr>
											<td bgcolor="#FFCC00" align="center"><p></p>
											<h4 id="StyleLink2">Sign up</h4>
											</td>
											</tr>
											<tr>
											<td>
											<p></p>
											
											<form action="dbmCreateUser.php" method="Get" name="form2" id="form2">
												  <table align="center" class="table">
													<tr valign="baseline">
													  <td nowrap="nowrap"><strong align="right">Username</strong></td>
													  <td><input type="text" name="accUsername" placeholder="Username..."  class="span4" size="32" required/>
													  <input type="hidden" name="perId" placeholder="Username..."  class="span4" value="<?php echo $perperId; ?>" size="32" /></td>
													</tr>
													<tr valign="baseline">
													  <td nowrap="nowrap"><strong align="right">Password</strong></td>
													  <td><input type="password" name="accPassword" placeholder="Password..."  size="32"  class="span4" required/>
													  <input type="hidden" name="accPrivilege" value="2" size="32"  /></td>
													</tr>
													<!--<tr valign="baseline">
													  <td nowrap="nowrap"><strong align="right">Confirm Password</strong></td>
													  <td><input type="password" name="accPasswordCon" placeholder="Password..."  size="32"  class="span4" required/>
													  <input type="hidden" name="accPrivilege" value="2" size="32"  /></td>
													</tr>-->
													<tr valign="baseline">
													  <td nowrap="nowrap" align="right">&nbsp;</td>
													  <td ><p align="right"><input name="create" id="create" type="submit" class="btn btn-primary" value="create" /></p></td>
													</tr>
												  </table>
												</form>
						
											</td>
											</tr>
											</table>
											
											</center>
											<p>&nbsp;</p>
												<p>&nbsp;</p>
											  </div>
												</div>
								<?php 		} else { 
								echo ("<SCRIPT LANGUAGE='JavaScript'>
										window.alert('Wrong agency employee no!')
										window.location.href='dbmSignUp.php'
										</SCRIPT>");
											}
		}
		}
													?>

<p>&nbsp;</p>
<SCRIPT LANGUAGE="JavaScript">
	//window.location.href="dbmPIMDelPerUpdate.php?perId=<?php echo $perId3; ?>";
 //window.location.href="dbmPIMNotification.php";
</SCRIPT>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
