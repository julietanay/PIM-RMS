<?php require_once('../Connections/dbmrov.php'); ?>
<?php @session_start(); 
//if($_SESSION['username']==''){
//header('location:dbmLoginPIM.php');
//}else{
//header('location:dbmIndexPIM.php');
//}
?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "dbmIndexPIM.php";
  $MM_redirectLoginFailed = "dbmHomepage.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_dbmrov, $dbmrov);
  
  $LoginRS__query=sprintf("SELECT accUsername, accPassword, accPrivilege FROM account WHERE accUsername=%s AND accPassword=%s AND accPrivilege=1",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $dbmrov) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Your log-in was unsuccessful!')
        window.location.href='dbmHomepage.php'
        </SCRIPT>");
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Department of budget and Management</title>
<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<link type="text/css" href="css/styleLink.css" rel='stylesheet'>
	<!--	background-image:url(images/DBM2.jpg);
 -->
<style>
body{
width: 10%;
height: 100%;
background-image: url("images/bghome.png");
background-size: cover;
background-repeat: no-repeat;
display: table;
top: 0;
}

#mywarning{
display:none;
position: fixed;
overflow: auto;
left: 0;
top: 0;
width: 100%;
height: 100%;
text-align: center;
z-index: 90;
background-color: rgba(0,0,0, .6); 
 
}

#mywarning div{   
width: 850px;
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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>
<?php
//$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
//or die ('Cannot connect to db');
?>
<body>
<p>&nbsp;</p><p></p>
	 <!--<div class="container" align="center">
            <div class="row">
                <!--/.span3
				 <div class="span12">
						<div class="module" style="background: rgba(255,255,255,0.55);">
                            <div class="module-body">
							</div>
						</div>
                        </div>
                    </div>
     </div>-->
        <div class="container">
            <div class="row">
                <!--/.span3-->
				 <div class="span12">
                    <div class="content">
					 <div class="span1">
                    <div class="content">
                        <div class="module" style="background: rgba(255,255,255,0.55);">
                            <div class="module-body">
							<img src="images/lol.PNG" width="100%" height="100%" />
							</div>
						</div>
						</div>
					</div>
				<div class="span3">
                    <div class="content">
                        <div class="module" style="border-radius: 100%; width: 100%; height: 100%; box-shadow: 1px 4px 20px 1px rgba(0,0,0,0.75);">
                            <div class="module-body">
									<table align="center">
									<tr>
									<td ><div class="media user" style="border-radius: 100%;"> <a href="dbmLoginPIM.php" style="text-decoration: none; border-radius: 100%; " title="Personnel Information and Management System Portal" ><img src="images/pimsportal copy.PNG" width="100%" height="100%" /></a></div>
									</td>
									</tr>
									</table>
                            </div>
                        </div>
                    </div>
                </div>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				 <div class="span5">
                    <div class="content">
                        <div class="module" style="background: rgba(255,255,255,0.55);">
                            <div class="module-body">
									<table align="center"  width="100%" >
									<tr>
									<td ><div class="media user" ><ul>
										<li><h4>Personnel Information Management System</h4></li>
										<ul>
											  <li>Login As HR (Human Resource) Admin</li>
											 <li>Manage Personnel Information</li>
										</ul>
									</ul></div>
									</td>
									</tr>	
									</table>
                            </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
				 </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
			<div class="container">
            <div class="row">
                <!--/.span3-->
				 <div class="span12">
                    <div class="content">
					 <div class="span1">
                    <div class="content">
                        <div class="module" style="background: rgba(255,255,255,0.55);">
                            <div class="module-body">
							<img src="images/lol.PNG" width="100%" height="100%" />
							</div>
						</div>
						</div>
					</div>
				<div class="span3">
                    <div class="content">
                       <div class="module" style="border-radius: 100%; width: 100%; height: 100%; box-shadow: 1px 4px 20px 1px rgba(0,0,0,0.75);">
                            <div class="module-body">
									<table align="center" >
									<tr>
									<td ><div class="media user" style="border-radius: 100%;"> <a href="dbmLoginRECORDS.php" style="text-decoration: none; border-radius: 100%; " title="Records Management System Portal" ><img src="images/rmsportal copy.PNG" height="95%" width="93%" ></a></div>
									</td>
									</tr>
									</table>
										 <?php
										 
					if(isset($_POST['rms'])){ ?>
							<div id="mywarning"  style="display:<?php echo $display ?>;">
							 <div id="header">
								<form action="dbmHomepage.php" method="post">
								 <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
								</form>
								<p>&nbsp;</p>
								<center><h2>Voluntary Works :</h2></center>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											  </div>
												</div>
					<?php }	?>					
                            </div>
                        </div>
                    </div>
                </div>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				 <div class="span5">
                    <div class="content">
                        <div class="module" style="background: rgba(255,255,255,0.55);">
                            <div class="module-body">
									<table align="center"  width="100%" >
									<tr>
									<td ><div class="media user" ><ul>
										<li><h4>Records Management System</h4></li>
										<ul>
											  <li>Login As Records Admin</li>
											 <li>Manage Important Documents and Files</li>
										</ul>
									</ul></div>
									</td>
									</tr>	
									</table>
                            </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
				
				
                            </div>
                        </div>
                </div>
				 </div>
		
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>	
</body>
</html>
