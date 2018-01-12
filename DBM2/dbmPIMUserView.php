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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE personnel SET perPosition=%s, perAppStat=%s, perFname=%s, perMname=%s, perLname=%s, perExtName=%s, perGender=%s, perAge=%s, perEmail=%s, perBday=%s, perBPlace=%s, perMobileNo=%s, perTelno=%s, perHeight=%s, perWeight=%s, perBloodType=%s, perBIRno=%s, perAgenEmpNo=%s, perGSISno=%s, perPagIbigNo=%s, perPhilHno=%s, perSSSno=%s, perStatus=%s, perTransferee=%s, perTINno=%s, perDateModified=%s, divId=%s WHERE perId=%s",
                       GetSQLValueString($_POST['perPosition'], "text"),
                       GetSQLValueString($_POST['perAppStat'], "text"),
                       GetSQLValueString($_POST['perFname'], "text"),
                       GetSQLValueString($_POST['perMname'], "text"),
                       GetSQLValueString($_POST['perLname'], "text"),
                       GetSQLValueString($_POST['perExtName'], "text"),
                       GetSQLValueString($_POST['perGender'], "text"),
                       GetSQLValueString($_POST['perAge'], "int"),
                       GetSQLValueString($_POST['perEmail'], "text"),
                       GetSQLValueString($_POST['perBday'], "date"),
                       GetSQLValueString($_POST['perBPlace'], "text"),
                       GetSQLValueString($_POST['perMobileNo'], "text"),
                       GetSQLValueString($_POST['perTelno'], "text"),
                       GetSQLValueString($_POST['perHeight'], "double"),
                       GetSQLValueString($_POST['perWeight'], "double"),
                       GetSQLValueString($_POST['perBloodType'], "text"),
                       GetSQLValueString($_POST['perBIRno'], "text"),
                       GetSQLValueString($_POST['perAgenEmpNo'], "text"),
                       GetSQLValueString($_POST['perGSISno'], "text"),
                       GetSQLValueString($_POST['perPagIbigNo'], "text"),
                       GetSQLValueString($_POST['perPhilHno'], "text"),
                       GetSQLValueString($_POST['perSSSno'], "text"),
                       GetSQLValueString($_POST['perStatus'], "text"),
                       GetSQLValueString($_POST['perTransferee'], "text"),
                       GetSQLValueString($_POST['perTINno'], "int"),
                       GetSQLValueString($_POST['perDateModified'], "date"),
                       GetSQLValueString($_POST['divId'], "int"),
                       GetSQLValueString($_POST['perId'], "int"));

  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($updateSQL, $dbmrov) or die(mysql_error());

  $updateGoTo = "dbmPIMUserView.php?perId=" . $row_Recordset1['perId'] . "";
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
$query_Recordset1 = sprintf("SELECT * FROM personnel WHERE perId = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
 @session_start(); 
if($_SESSION['username']==''){
header('location:dbmPIMUserLogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
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
background-color: rgba(0,0,0, .8); 
 
}

#myalert div{   
width: 700px;
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

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
		<link type="text/css" href="css/styleLink.css" rel='stylesheet'>
	<script src="sweetalert-master/dist/sweetalert.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">

</head>
<body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                 <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="dbmIndexPIM.php"><img src="images/logo.png" class="nav-avatar" /> DBM-ROV</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                         <!--<ul class="nav nav-icons">
                            <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                            <li><a href="#"><i class="icon-eye-open"></i></a></li>
                            <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                        </ul>
                       <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form> -->
                       <?php $pertid1=$_SESSION['pidU'];
									$query1 = "SELECT *	FROM personnel WHERE personnel.perId = '$pertid1' ";
											$result1= mysql_query($query1);	
											while($row1= mysql_fetch_assoc($result1)){
												$perId1=$row1['perId'];?>
                        <ul class="nav pull-right">
											<li class="active"><a href="dbmPIMUserIndex.php?perId=<?php echo $perId1; ?>">Home &nbsp; <?php } ?></a></li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Item No. 1</a></li>
                                    <li><a href="#">Don't Click</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Example Header</li>
                                    <li><a href="#">A Separated link</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Notification : &nbsp;<b class="label pull-right" style="background-color: red;">
                                    11</b></a></li>
							
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user - Copy.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                   <!-- <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li> -->
									<li class="nav-header">User :</li>
									<li ><?php 
									$f=$_SESSION['fname'];
									$l=$_SESSION['lname'];
									echo '<div align="center"> '.$f.' '.$l.' </div>' ?></li>
									 <li><a href="#" ><div class="menu-icon icon-cog">&nbsp; Account Setting</div></a></li>
									 
                                    <li class="divider"></li>
                                     <li><a href="#" ><div class="menu-icon icon-signout">&nbsp; Logout</div></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
	<div class="wrapper">
		<div class="container">
			<div class="row">
             <div class="span12">
			 <div class="content">
			 <table align="center" border="0" width="100%">
				 <tr bgcolor="#666666">
				 <td>
				 <p></p>
				 </td>
				 </tr>
				 <tr bgcolor="#333">
				 <td></td>
				 </tr>
				 </table>
                        <div class="module">

           <div class="module-body">
               
				 <table align="center" border="0" width="90%">
				 <tr>
				 <td>
				  <ul class="profile-tab nav nav-tabs">
                                    <li class="active"><a href="dbmPIMUserView.php" data-toggle="tab">Feed</a></li>
                                    <li><a href="#friends" data-toggle="tab">Friends</a></li>
                                </ul>
				 <div class="profile-tab-content tab-content">
                                    <div class="tab-pane fade active in" id="activity">
                                       <div class="module-body">
									 
                                       <form class="form-horizontal row-fluid" method="post" name="form1" action="<?php echo $editFormAction; ?>">
                                         <table align="center">
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerPosition:</td>
                                             <td><input id="basicinput" placeholder="Type something here..." class="span12" type="text" name="perPosition" value="<?php echo htmlentities($row_Recordset1['perPosition'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerAppStat:</td>
                                             <td><input type="text" name="perAppStat" value="<?php echo htmlentities($row_Recordset1['perAppStat'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerFname:</td>
                                             <td><input type="text" name="perFname" value="<?php echo htmlentities($row_Recordset1['perFname'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerMname:</td>
                                             <td><input type="text" name="perMname" value="<?php echo htmlentities($row_Recordset1['perMname'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerLname:</td>
                                             <td><input type="text" name="perLname" value="<?php echo htmlentities($row_Recordset1['perLname'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerExtName:</td>
                                             <td><input type="text" name="perExtName" value="<?php echo htmlentities($row_Recordset1['perExtName'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerGender:</td>
                                             <td><input type="text" name="perGender" value="<?php echo htmlentities($row_Recordset1['perGender'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerAge:</td>
                                             <td><input type="text" name="perAge" value="<?php echo htmlentities($row_Recordset1['perAge'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerEmail:</td>
                                             <td><input type="text" name="perEmail" value="<?php echo htmlentities($row_Recordset1['perEmail'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerBday:</td>
                                             <td><input type="text" name="perBday" value="<?php echo htmlentities($row_Recordset1['perBday'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerBPlace:</td>
                                             <td><input type="text" name="perBPlace" value="<?php echo htmlentities($row_Recordset1['perBPlace'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerMobileNo:</td>
                                             <td><input type="text" name="perMobileNo" value="<?php echo htmlentities($row_Recordset1['perMobileNo'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerTelno:</td>
                                             <td><input type="text" name="perTelno" value="<?php echo htmlentities($row_Recordset1['perTelno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerHeight:</td>
                                             <td><input type="text" name="perHeight" value="<?php echo htmlentities($row_Recordset1['perHeight'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerWeight:</td>
                                             <td><input type="text" name="perWeight" value="<?php echo htmlentities($row_Recordset1['perWeight'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerBloodType:</td>
                                             <td><input type="text" name="perBloodType" value="<?php echo htmlentities($row_Recordset1['perBloodType'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerBIRno:</td>
                                             <td><input type="text" name="perBIRno" value="<?php echo htmlentities($row_Recordset1['perBIRno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerAgenEmpNo:</td>
                                             <td><input type="text" name="perAgenEmpNo" value="<?php echo htmlentities($row_Recordset1['perAgenEmpNo'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerGSISno:</td>
                                             <td><input type="text" name="perGSISno" value="<?php echo htmlentities($row_Recordset1['perGSISno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerPagIbigNo:</td>
                                             <td><input type="text" name="perPagIbigNo" value="<?php echo htmlentities($row_Recordset1['perPagIbigNo'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerPhilHno:</td>
                                             <td><input type="text" name="perPhilHno" value="<?php echo htmlentities($row_Recordset1['perPhilHno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerSSSno:</td>
                                             <td><input type="text" name="perSSSno" value="<?php echo htmlentities($row_Recordset1['perSSSno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerStatus:</td>
                                             <td><input type="text" name="perStatus" value="<?php echo htmlentities($row_Recordset1['perStatus'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerTransferee:</td>
                                             <td><input type="text" name="perTransferee" value="<?php echo htmlentities($row_Recordset1['perTransferee'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerTINno:</td>
                                             <td><input type="text" name="perTINno" value="<?php echo htmlentities($row_Recordset1['perTINno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">PerDateModified:</td>
                                             <td><input type="text" name="perDateModified" value="<?php echo htmlentities($row_Recordset1['perDateModified'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">DivId:</td>
                                             <td><input type="text" name="divId" value="<?php echo htmlentities($row_Recordset1['divId'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                           </tr>
                                           <tr valign="baseline">
                                             <td nowrap align="right">&nbsp;</td>
                                             <td><input type="submit" value="Update record"></td>
                                           </tr>
                                         </table>
                                         <input type="hidden" name="MM_update" value="form1">
                                         <input type="hidden" name="perId" value="<?php echo $row_Recordset1['perId']; ?>">
                                       </form>
                                       <p>&nbsp;</p>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="friends">
                                        <div class="module-option clearfix">
                                            <form>
                                            <div class="input-append pull-left">
                                                <input type="text" class="span3" placeholder="Filter by name...">
                                                <button type="submit" class="btn">
                                                    <i class="icon-search"></i>
                                                </button>
                                            </div>
                                            </form>
                                            <div class="btn-group pull-right" data-toggle="buttons-radio">
                                                <button type="button" class="btn">
                                                    All</button>
                                                <button type="button" class="btn">
                                                    Male</button>
                                                <button type="button" class="btn">
                                                    Female</button>
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                John Donga
                                                            </h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                Donga John</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                John Donga</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                Donga John</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                John Donga</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                Donga John</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                John Donga</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                Donga John</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />
                                            <div class="pagination pagination-centered">
                                                <ul>
                                                    <li><a href="#"><i class="icon-double-angle-left"></i></a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#"><i class="icon-double-angle-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
				 </td>
				 </tr>
				
				 </table> </li>
                     </div>
					   </div>
					     </div>
            </div><!--/.widget-nav-->
				<!--/.span3-->

				<div>&nbsp;</div>
				
	</div><!--/.wrapper-->
	</div>
      </div>
        <div class="footer" style="background-color:white;">
           <div class="container" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="copyright">&copy; 2017 Department of Budget and Management Regional Office V</b> - All rights reserved.
		</div>
		</div>
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="scripts/common.js" type="text/javascript"></script>
      
    </body>


<?php
mysql_free_result($Recordset1);
?>
