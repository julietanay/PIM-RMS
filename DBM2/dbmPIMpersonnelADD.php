<?php require_once('../Connections/dbmrov.php'); ?>
<?php @session_start(); 
if($_SESSION['username']==''){
header('location:dbmLoginPIM.php');
}
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO personnel (perPosition, perFname, perMname, perLname, perExtName, perGender, perAge, perEmail, perBday, perMobileNo, perTelno, perHeight, perWeight, perBloodType, perBIRno, perAgenEmpNo, perGSISno, perPagIbigNo, perPhilHno, perSSSno, perStatus, perTransferee, perTINno, perDateModified, divId) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['position'], "text"),
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['mname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['extname'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['Age'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['birthday'], "date"),
                       GetSQLValueString($_POST['mobile'], "text"),
                       GetSQLValueString($_POST['telephone'], "text"),
                       GetSQLValueString($_POST['height'], "double"),
                       GetSQLValueString($_POST['weight'], "double"),
                       GetSQLValueString($_POST['bloodtype'], "text"),
                       GetSQLValueString($_POST['bir'], "text"),
                       GetSQLValueString($_POST['empno'], "text"),
                       GetSQLValueString($_POST['gsisno'], "text"),
                       GetSQLValueString($_POST['pagibigno'], "text"),
                       GetSQLValueString($_POST['philno'], "text"),
                       GetSQLValueString($_POST['sssno'], "text"),
                       GetSQLValueString($_POST['civilstat'], "text"),
                       GetSQLValueString($_POST['transfer'], "text"),
                       GetSQLValueString($_POST['tinno'], "int"),
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['division'], "int"));
					    
  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($insertSQL, $dbmrov) or die(mysql_error());

  $insertGoTo = "dbmPIMprofilePic.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= "?perId=" . mysql_insert_id();
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = "SELECT * FROM personnel";
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
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
		<link type="text/css" href="css/styleLink.css" rel="stylesheet" rel='stylesheet'>
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
                        <ul class="nav pull-right">
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
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                   <!-- <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li> -->
									<li class="nav-header">HR Admin :</li>
									<li ><?php 
									$f=$_SESSION['fname'];
									$l=$_SESSION['lname'];
									echo '<div align="center"> '.$f.' '.$l.' </div>' ?></li>
									 <li><a href="#" ><div class="menu-icon icon-cog">&nbsp; Account Setting</div></a></li>
									 <li><a href="#" ><div class="menu-icon icon-cog">&nbsp; Review User Acct</div></a></li>
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
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled" style="background-color:#333" >
								
							<?php 										
									$accountid=$_SESSION['aid'];
									$pertid=$_SESSION['pid'];
									$query0 = "SELECT *	FROM account, personnel, profile_pics 
												WHERE account.accId = '$accountid'
												AND account.perId = '$pertid' 
												AND account.perId=personnel.perId 
												AND profile_pics.perId=personnel.perId";
											$result0= mysql_query($query0);	
											while($row0 = mysql_fetch_assoc($result0)) {
											$p0=$row0['perId'];
											$f0=$row0['perFname'];
											$img0=$row0['image']; 
											$type0=$row0['picType'];?>
									<?php if($img0==null){ ?>
                                       <li align="center" ><p></p><img class ="img-circular" src="images/user.png" /> <p></p></li>
									
									<?php } else{ ?>
                                      <li align="center" style="background-color:#333" ><p></p> <img class ="img-circular" src="<?php echo 'data:image/'.$type0.';base64,'.base64_encode($img0); ?>" /><p></p> </li>
												
								<?php	} ?>
                                    
								 <li class="active"><a href="dbmPIMpersonnelVIEW.php?perId=<?php echo $p0; ?>" title="View Personnel detail"><i class="menu-icon icon-eye-open"></i>User Profile (<?php echo $f0; ?>)
                                </a></li><?php	}  ?>
							</ul>
							<ul class="widget widget-menu unstyled">
                                <li class="active"><a href="dbmIndexPIM.php"><i class="menu-icon icon-dashboard"></i>Home
                                </a></li>
                               
                                <li><a href="dbmPIMpersonnelLIST.php"><i class="menu-icon icon-user"></i>Personnel <b class="menu-icon pull-right">
                                    <?php
									$query = "select * from personnel";
											$result= mysql_query($query);	
											$counter=0;
											while($row = mysql_fetch_assoc($result)) {
												$counter=$counter+1;
											} echo '('.$counter.')';
									?></b></a></li>
                                <li><a href="message.html"><i class="menu-icon icon-exchange"></i>Pending<b class="label green pull-right">
                                    11</b> </a></li>
                                <li><a href="task.html"><i class="menu-icon icon-tasks"></i>Reminders<b class="label orange pull-right">
                                    19</b> </a></li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a href="ui-button-icon.html"><i class="menu-icon icon-bold"></i> Leave Application </a></li>
                                <li><a href="ui-typography.html"><i class="menu-icon icon-book"></i>201 File </a></li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Requirements (201 file)</a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href="other-login.html"><i class="icon-inbox"></i>Appointment </a></li>
                                        <li><a href="other-user-profile.html"><i class="icon-inbox"></i>Assumption to Duty </a></li>
                                        <li><a href="other-user-listing.html"><i class="icon-inbox"></i>Leave Balances</a></li>
										<li><a href="other-login.html"><i class="icon-inbox"></i>Clearance</a></li>
                                        <li><a href="other-user-profile.html"><i class="icon-inbox"></i>Contract Services </a></li>
                                        <li><a href="other-user-listing.html"><i class="icon-inbox"></i>Eligibilities </a></li>
										<li><a href="other-login.html"><i class="icon-inbox"></i>Diplomas, Commendations & Awards</a></li>
                                        <li><a href="other-user-profile.html"><i class="icon-inbox"></i>Disciplinary Actions</a></li>
                                        <li><a href="other-user-listing.html"><i class="icon-inbox"></i>Marriage Contract</a></li>
										<li><a href="other-login.html"><i class="icon-inbox"></i>Designations</a></li>
                                        <li><a href="other-user-profile.html"><i class="icon-inbox"></i>Medical Certificates</a></li>
                                        <li><a href="other-user-listing.html"><i class="icon-inbox"></i>NBI Clearance</a></li>
										<li><a href="other-user-listing.html"><i class="icon-inbox"></i>Notices </a></li>
										<li><a href="other-user-listing.html"><i class="icon-inbox"></i>Oaths </a></li>
										<li><a href="other-user-listing.html"><i class="icon-inbox"></i>PDF </a></li>
										<li><a href="other-user-listing.html"><i class="icon-inbox"></i>PDS </a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="module">
							<table bgcolor="#333" width="100%"><tr>
								<td bgcolor="#333" width="13%"><h3>
								<img src="images/pimlogoo.png" height="80px" width="80px;" style="margin-top: 10px; margin-bottom: 10px; margin-left: 30px;  "> 
								</h3></td>
								<td bgcolor="#333" width="71%" align="left"><div><strong><font color="white">Personnel Information Management System</font></strong></div>
                                <div>For the Department of Budget and Management</div>
								<div>(Regional Ofiice V)</div>
								<div>Rawis, Legazpi City</div></td>
								</tr>
								<tr>
								<td colspan="3"><h3>
								</td>
								</tr>
								</table>
							<div class="module-head">
								<table width="100%"><tr>
								<td><h3>
								ADD new Personnel :
								</h3></td>
								<td align="right"><h3>
                                <a href="dbmPIMpersonnelLIST.php" class="btn btn-large btn-inverse pull-right" ><strong> < </strong>Back To Personnel List</a>
								</h3></td>
								</tr></table>
						      
							</div>
							<div class="module-body">
                            <form name="form2" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal row-fluid">
							<div class="control-group">
											<p>&nbsp;</p>
											<p>
											  <label class="control-label" for="position">Position Name</label>
									  </p>
											<div class="controls">
											  <input type="text" name="position" id="position" placeholder="Type here..." class="span8" required>
										   </div>
							  </div>
									  <div class="control-group">
											<label class="control-label" for="division">Division</label> 
											<div class="controls">
											  <select tabindex="1" class="span5" name="division" id="division" required>
											    <option value="">Select Division...</option>
											    <?php 
													  $result = $conn->query("select * from division"); 
													  while ($row = $result->fetch_assoc()) 
													  {

														  unset($id, $name);
														  $id = $row['divId'];
														  $name=$row['divName'];
														 
														  echo '<option value="'.$id.'"> '.$name.'  </option>';
														 
													 }
													  
													?>
										    </select>
											
												
											</div>
											
							  </div>
									 <div class="control-group">
									  <label class="control-label">Transferee ?</label>
											<div class="controls">
												<label class="radio">
													<input type="radio" name="transfer" id="transfer" value="yes" checked="">
													Yes
												</label> 
												<label class="radio">
													<input type="radio" name="transfer" id="transfer" value="no">
													No
												</label> 
											</div>
											<div class="control-group">
											<label class="control-label" for="fname">Firstname</label>
											<div class="controls">
												<input type="text" name="fname" id="fname" placeholder="Type here..." class="span8" required>
											</div>
									  </div>
										<div class="control-group">
											<label class="control-label" for="mname">Middlename</label>
											<div class="controls">
												<input type="text" name="mname" id="mname" placeholder="Type here..." class="span8" required> 
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="lname">Lastname</label>
											<div class="controls">
												<input type="text" id="lname" name="lname" placeholder="Type here..." class="span8" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="extname">Extension Name</label>
											<div class="controls">
												<input type="text" name="extname" id="extname" placeholder="Type here..." class="span8">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Gender</label>
											<div class="controls">
												<label class="radio">
													<input type="radio" name="gender" id="gender" value="female" checked="">
													Female
												</label> 
												<label class="radio">
													<input type="radio" name="gender" id="gender" value="male">
													Male
												</label> 
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="birthday">Birthday</label>
											<div class="controls">
												<input type="Date" name="birthday" id="birthday" placeholder="Type something here..." class="span8" required>
											</div>
										</div>	
										
										<div class="control-group">
											<label class="control-label" for="birthplace">Birthplace</label>
											<div class="controls">
												<textarea class="span8" rows="3" name="birthplace" id="birthplace" required></textarea>
											</div>
										</div>		
										<div class="control-group">
											<label class="control-label" for="Age">Age</label>
											<div class="controls">
											<input class="span3" type="number" placeholder="Age in Number..." name="Age" id="Age" required>       
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="civilstat">Civil Status</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span5" name="civilstat" id="civilstat" required>
													<option value="">Select here..</option>
													<option value="Single">Single</option>
													<option value="Married">Married</option>
													<option value="Widowed">Widowed</option>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="bloodtype">Blood Type</label>
											<div class="controls">
											<input class="span3" type="text" placeholder="type here..." name="bloodtype" id="bloodtype" required>       
										  </div>
										</div>
										<div class="control-group">
                                        <table width="600" border="0" align="left">
										  <tr>
											<td align="center">
											<label class="control-label" for="height">Height</label>
											<div class="controls">
											<input class="span12" type="number" placeholder="(meter)" id="height" name="height" required>       
											</div>
											</td>
											<td>
											<label class="control-label" for="weight">Weight</label>
											<div class="controls">
											<input class="span12" type="number" placeholder="(kg)" name="weight" id="weight" required>       
											</div>
											</td>
										  </tr>
										</table>
										</div>
										
										
										<div class="control-group">
											<label class="control-label" for="email">Email Address (optional)</label>
											<div class="controls">
											<input class="span8" type="text" placeholder="sample@yahoo.com" name="email" id="email">       
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="mobile">Mobile No.</label>
											<div class="controls">
											<input class="span8" type="number" id="mobile" name="mobile">       
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="telephone">Tel No.</label>
											<div class="controls">
											<input class="span8" type="number" name="telephone" id="telephone">       
											</div>
										</div>
										<div class="control-group">
                                        <table width="700" border="0" align="left">
										  <tr>
											<td align="center">
											<label class="control-label" for="empno">AGENCY EMPLOYEE NO.</label>
											<div class="controls">
											<input class="span12" type="text" name="empno" id="empno" required>       
											</div>    
											</td>
											<td>
											<label class="control-label" for="gsisno">GSIS ID NO.</label>
											<div class="controls">
											<input class="span12" type="text" name="gsisno" id="gsisno" >       
											</div>
											</td>
										  </tr>
										  
										</table>
										</div>
										<div class="control-group">
                                        <table width="700" border="0" align="left">
										  <tr>
											<td align="center">
											<label class="control-label" for="pagibigno">PAG-IBIG ID NO.</label>
											<div class="controls">
											<input class="span12" type="text" name="pagibigno" id="pagibigno">       
											</div>
											</td>
											<td>
											<label class="control-label" for="philno">PHILHEALTH NO.</label>
											<div class="controls">
											<input class="span12" type="text" name="philno" id="philno">       
											</div>
											</td>
										  </tr>
										</table>
										</div>
										<div class="control-group">
                                        <table width="700" border="0" align="left">
										  <tr>
											<td align="center">
											<label class="control-label" for="sssno">SSS NO.</label>
											<div class="controls">
											<input class="span12" type="text" name="sssno" id="sssno" >       
											</div>
											</td>
											<td>
											<label class="control-label" for="tinno">TIN NO.</label>
											<div class="controls">
											<input class="span12" type="text" name="tinno" id="tinno">       
											</div>
											</td>
										  </tr>
										</table>
										</div>
										<div class="control-group">
                                        <table width="700" border="0" align="left">
										  <tr>
											<td width="32%" align="center">
											<label class="control-label" for="bir">BIR No</label>
											<div class="controls">
											<input class="span12" type="text" name="bir" id="bir">       
											</div>
											</td>
											<td width="32%">
											
											</td>
										  </tr>
										</table>
										</div>
											  <input class="span8" type="hidden" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">       
									  </p>
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submitbtn" id="submitbtn" class="btn btn-large btn-inverse pull-right">Submit Form</button>
											</div>
										</div>
										<input type="hidden" name="MM_insert" value="form2">
                            </form>
							</div>
						</div>
						
                            <!--/.module-->
                        </div>
						<table align="center" width="100%" >
							<tr>
							<td bgcolor="#333">&nbsp;<div align="center"></td>
							</tr>
							<tr>
							<td bgcolor="#333">&nbsp;<div align="center"></td>
							</tr>
						</table>
						<p>&nbsp;</p>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
      <div class="footer" style="background-color:white;">
           <div class="container" >
			<b class="copyright">&copy; 2017 Department of Budget and Management Regional Office V</b> - All rights reserved.
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
