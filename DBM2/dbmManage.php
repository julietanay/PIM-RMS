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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO division (divName, divDesc, divModified) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['divisionadd'], "text"),
                       GetSQLValueString($_POST['divDesc'], "text"),
                       GetSQLValueString($_POST['datediv'], "date"));
 if(mysql_query($insertSQL))
						{echo '<script type="text/javascript"> 
								 window.alert("Successfully Added!!");
								window.location.href="dbmManage.php";
							     </script>';
						 } else
						{
							echo '<script type="text/javascript">
							    alert("Fail! Something went wrong...Are you trying to insert the same value? Please check and Try again :) Thank you");
								 history.back();
							     </script>';
						}
						mysql_close();
  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($insertSQL, $dbmrov) or die(mysql_error());

  $insertGoTo = "dbmManage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE division SET divName=%s, divDesc=%s, divModified=%s, perId=%s WHERE divId=%s",
                       GetSQLValueString($_POST['divName'], "text"),
                       GetSQLValueString($_POST['divDesc'], "text"),
                       GetSQLValueString($_POST['divModified'], "date"),
					   GetSQLValueString($_POST['perId'], "int"),
                       GetSQLValueString($_POST['divId'], "int"));

  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($updateSQL, $dbmrov) or die(mysql_error());

  $updateGoTo = "dbmManage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = "SELECT * FROM personnel";
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['divId'])) {
  $colname_Recordset2 = $_GET['divId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset2 = sprintf("SELECT * FROM division WHERE divId = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $dbmrov) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
background-color: rgba(0,0,0, .2); 
 
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
        <title>Department of budget and Management</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
		<link type="text/css" href="bootstrap/css/styleLink.css" rel="stylesheet" rel='stylesheet'>
		
		
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
                              <!--<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Item No. 1</a></li>
                                    <li><a href="#">Don't Click</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Example Header</li>
                                    <li><a href="#">A Separated link</a></li>
                                </ul>
                            </li>-->
							<li><a href="dbmIndexPIM.php"><i class="icon-home"></i> Home </a> </li>
							<li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                   <!-- <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li> -->
									<li class="nav-header">Quick Links :</li>
									 <li><a href="dbmPerAdd.php" ><div class="menu-icon icon-plus">&nbsp; Add personnel</div></a></li>
									 <li><a href="dbmReports.php" ><div class="menu-icon icon-book">&nbsp; Reports</div></a></li>
                                     <li><a href="dbmLeaveAppList.php" ><div class="menu-icon icon-briefcase">&nbsp; Leave Application</div></a></li>
									  <li><a href="dbmPIMAcct.php" ><div class="menu-icon icon-cog">&nbsp; Manage User Accounts</div></a></li>
                                </ul>
                            </li>
                             <li><?php
								$perId01=$_SESSION['pid'];
								$query01 = "SELECT * FROM personnel where personnel.PerId='$perId01'";
								$result01= mysql_query($query01);	
								while($row01 = mysql_fetch_assoc($result01)) { 
								$per01=$row01['perId'];
								?>
								<a href="dbmSeenNotif.php?perId=<?php echo $per01; ?>"><i class="icon-exclamation-sign"></i>   Notification  &nbsp;	<?php } ?>
								<?php	$query0 = "SELECT *	FROM personnel_update where personnel_update.seen='No'";
								$result0= mysql_query($query0);	
								$count=0;
								while($row0 = mysql_fetch_assoc($result0)) { 
								$count=$count+1;
								}  
								if($count!=0){
									echo '<b class="label pull-right" style="background-color: red;">'.$count.'</b>';
								}
								 ?></a></li> 
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user - Copy.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                   <!-- <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li> -->
									<li class="nav-header">HR Admin :</li>
									<li ><?php 
									$f=$_SESSION['fname'];
									$l=$_SESSION['lname'];
									echo '<div align="center"> '.$f.' '.$l.' </div>' ?></li>
									 <li><a href="dbmAdminAccount.php" ><div class="menu-icon icon-cog">&nbsp; Your Account</div></a></li>
                                    <li class="divider"></li>
                                     <li><a href="logoutPimAdmin.php" ><div class="menu-icon icon-signout">&nbsp; Logout</div></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled" style="background-color:#333">
								
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
                                       <li align="center" ><p></p><img class="img-circular" src="images/user - Copy.png" /><p></p> </li>
									
									<?php } else{ ?>
                                      <li align="center" style="background-color:#333" > <p></p><img class="img-circular" src="<?php echo 'data:image/'.$type0.';base64,'.base64_encode($img0); ?>" /><p></p> </li>
												
								<?php	} ?>
                                    
								
								 <li class="active"><a href="dbmPIMpersonnelVIEW.php?perId=<?php echo $p0; ?>" title="View Personnel detail"><i class="menu-icon icon-eye-open"></i>User Profile (<?php echo $f0; ?>)
                                </a></li><?php	}  ?>
							</ul>
							<ul class="widget widget-menu unstyled">
								
                                <li><a href="dbmPIMpersonnelLIST.php"><i class="menu-icon icon-user"></i>Personnel<b class="menu-icon pull-right">
                                    <?php
									$query = "select * from personnel";
											$result= mysql_query($query);	
											$counter=0;
											while($row = mysql_fetch_assoc($result)) {
												$counter=$counter+1;
											} echo '('.$counter.')';
									?></b></a></li>
                                <li><a href="dbmPIMNotification.php"><i class="menu-icon icon-exchange"></i>Pending<b class="label green pull-right">
                                     <?php
									$query1 = "select * from personnel_update where personnel_update.status2='Pending'";
											$result1= mysql_query($query1);	
											$counter1=0;
											while($row1 = mysql_fetch_assoc($result1)) {
												$counter1=$counter1+1;
											} echo $counter1; ?></b> </a></li>
                               
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a href="dbmLeaveAppList.php"><i class="menu-icon icon-briefcase"></i> Leave Application </a></li>
                                <li><a href="#"><i class="menu-icon icon-book"></i>201 File </a></li>
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
								<img src="images/logo.png" height="70px" width="70px;" style="margin-top: 10px; margin-bottom: 10px; margin-left: 30px;  "> 
								</h3></td>
								<td bgcolor="#333" width="71%" align="left"><div><strong><font color="white">Department of Budget and Management</font></strong></div>
                                <div>Regional Office V</div>
								<div>Legazpi City</div></td>
								<td bgcolor="#333">
								</td>
								</tr>
								<tr>
								<td colspan="3"><h3>
								</td>
								</tr>
							  </table>
							<div class="module-head">
                              
                                <ul class="profile-tab nav nav-tabs">
                                    <li class="active"><a href="dbmManage.php">Division</a></li>
									 <li><a href="dbmPerAdd.php">Personnel</a></li>
                                    <!--<li><a href="dbmReqAdd.php">Requirements</a></li>-->
									<li><a href="dbmPIMAcct.php" >User Accounts</a></li>
                                </ul>
                                <div class="profile-tab-content tab-content">
                                    <div class="tab-pane fade active in" id="Division">
                                        <div class="stream-list">
                                            <div class="media stream">
                                              
                                                <div class="media-body">
                                                  
                                                       <table  width="100%">
														<tr>
														<td bgcolor="white" align="left">
														 <h2 class="stream-author">
                                                           &nbsp; &nbsp; &nbsp; &nbsp;List of Division :
                                                        </h2>
														</td>
														<td bgcolor="white" align="center" width="15%">
														 <h2 class="stream-author">
                                                            <form method="post" action="" name="formAddDiv"><button name="addDivisionBtn" id="addDivisionBtn" class="btn btn-primary">Add Division<i class="menu-icon">+</i></button></form>
                                                        </h2>
														</td>
														</tr>
														</table>
                                                    </div>
											
									<?php	
										$display="block";
										if(isset($_POST['addDivisionBtn'])){ ?>
										<div id="myalert"  style="display:<?php echo $display ?>;">
										  <div id="header">
											<form action="dbmManage.php?" method="post">
											  <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
											</form>
											<p>&nbsp;</p>
											<center>
											  <h2 class="modal-title"><b> &nbsp;Add Divisions :</b></h2>
											</center>
											<hr>
											<center>
											<form action="<?php echo $editFormAction; ?>" id="form1" name="form1"  method="POST" enctype="multipart/form-data">
											<table width="100%" border="1">
													<tr bgcolor="#333333">
													  <td>&nbsp;</td>
													</tr>
												</table>
												<p></p>
												<table align="center" border="0">
												<tr>
												<td align="center">Division Name : </td>
														<td> <input type="text" name="divisionadd" id="divisionadd" placeholder="Type here..." class="span4" required></td>
												</tr>
												<tr>
														<td>Description (optional) :</td>
														<td> <p><textarea class="span4" type="text" name="divDesc" id="divDesc"></textarea> </p><input class="span4" type="hidden" name="datediv" id="datediv" value="<?php echo date('Y-m-d'); ?>">
														</td>
												</tr>
												<tr>
												<td colspan=2><p align="right"><input type="submit" name="btn_div" id="btn_div" value="&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;" class="btn btn-large btn-inverse"></p></td>
												</tr>
												</table>
												 <table width="100%" border="1">
													<tr bgcolor="#333333">
													  <td>&nbsp;</td>
													</tr>
												</table>
												<input type="hidden" name="MM_insert" value="form1">
                                                </form>
											<p>&nbsp;</p>
											</center>
											  </div>
												</div>
											<?php } ?>
													
											
                                                    <!--/.stream-headline-->
								<?php 
								$que= "select * from division";
								$res= mysql_query($que);	
								$cnts=0;
								 while($row = mysql_fetch_assoc($res)) {
								 $cnts=$cnts+1; }
									  ?>
									   <div class="module-head" style="background-color:grey" align="center">
									  <div class="module-option clearfix">
									    <div class="btn-group pull-left" >
                                         <a href="dbmManage.php" id="StyleLink2">
											<h4><font color="white"><?php
												echo '('.$cnts.')';
											?> Division (s)</font></h4></a>
											</div>
                                            <form name="searcform" method="post" action="dbmManage.php">
                                            <div class="input-append pull-right">
                                           	<select tabindex="1" class="span4" name="search" id="search">
											    <option value="">Select Division...</option>
											    <?php 
													  $result = $conn->query("select * from division"); 
													  while ($row = $result->fetch_assoc()) 
													  {

														  unset($id, $name);
														  $id = $row['perId'];
														  $name=$row['divName'];
														  echo '<option value="'.$name.'"> '.$name.'  </option>';
														 
													 }
													  
													?>
										    </select>
                                                <button type="submit" class="btn" name="submit" id="submit">GO
                                                    <i class="icon-search"></i> </button>
                                            </div>
                                            </form>
                                           </div>
                                        </div>
											
                                            <div class="stream-options">
                                            <div class="module-body table">
			<table width="60%" align="center" class="datatable-1 table " >
                 <?php
					if(isset($_POST['submit'])){
					$ss = $_POST['search'];
					$query = "select * from division where divName='$ss' order by divModified Desc";
						$result= mysql_query($query);	
						$cnt=0;
						 while($row = mysql_fetch_assoc($result)) {
							 $divisionId=$row['divId'];
							 $name=$row['divName'];
							 $des=$row['divDesc'];
							 $perId=$row['perId'];
							 $cnt=$cnt+1;
							 ?>
							 <tr bgcolor="#333" >
				  <td> <div></div>
				    <div align="left">
				      <h4><font color="white" style="margin-top: 500px; margin-left: 10px;"><?php
						if (($des==null)||($des==' ')){
							echo $cnt.'.) '.$name.' - <small> (Description Not Available) </small>';
						} else{
							echo $cnt.'.) '.$name.' - <small>'.$des.'</small>';
						}  ?></font></h4>
				    </div>
					<div id="StyLink2"><?php
					$query11="select * from personnel where personnel.perId='$perId'";
					$result11= mysql_query($query11);	
						 while($row11 = mysql_fetch_assoc($result11)) { 
								$id11 = $row11['perId'];
								 $name1=$row11['perFname'];
								 $name11=$row11['perMname'];
								 $name21=$row11['perLname'];
								 $name31=$row11['perExtName'];
						 }if($perId==null){
									echo "No Officer In Charge!!";
								} else{
									 echo 'Officer In Charge : '. $name1.' '.$name11.' '.$name21.' '.$name31.' ';
								}
						?></div>
					</td>
                       <td width="11%" >
                         <h4>
						  
						<?php 	$query2s = "select * from personnel
											where personnel.divId='$divisionId'";
											$result2s= mysql_query($query2s);	
											$counters=0;
											while($row2 = mysql_fetch_assoc($result2s)) {
											$counters=$counters+1;}	
								if($counters==0){?>
					  <form name="form2" method="POST" action="dbmManage.php?divId=<?php echo $divisionId; ?>" class="form-horizontal row-fluid">
                      <button id="dbt" name="dbt" class="btn btn-mini btn-inverse" title="Edit or Update"><i class="icon-edit"></i> Edit</button>
                           </form>
                          <p></p>
								<?php }else{ ?>
					  <form name="form2" method="POST" action="dbmManage.php?divId=<?php echo $divisionId; ?>" class="form-horizontal row-fluid">
                      <button id="dbt" name="dbt" class="btn btn-mini btn-inverse" title="Edit or Update"><i class="icon-edit"></i> Edit</button>
                           </form>
                          <p></p>
						    <form name="form2" method="POST" action="dbmDivisionForm.php?divId=<?php echo $divisionId; ?>" class="form-horizontal row-fluid">
                      <button id="viewform" name="viewform" class="btn btn-mini btn-primary" title="Edit or Update"><div> View</div> in form </button>
                           </form>
								<?php }	?>
							
						     </h4>
                        <?php 
						$display="block";
							if(isset($_POST['dbt'])){
								$dvd=mysql_real_escape_string($_GET['divId']);
								?>
								<div id="myalert" style="display:<?php echo $display ?>;">
								  <div id="header">
										<form action="dbmManage.php" method="post">
										<button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
										</form><p>&nbsp;</p>
                                 <center><h2 class="modal-title"><b> &nbsp;Update Division "<?php echo $row_Recordset2['divName']; ?>"</b></h2></center>
								 <hr>
                                 <table width="100%" border="1">
									    <tr bgcolor="#333333">
									      <td>&nbsp;</td>
								        </tr>
									    </table>
									  <p>&nbsp;</p>
                                 <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
                                   <table align="center">
                                     
                                     <tr valign="baseline">
                                       <td nowrap align="right">Division Name:</td>
                                       <td><input class="span4" type="text" name="divName" value="<?php echo htmlentities($row_Recordset2['divName'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                     </tr>
									  <tr valign="baseline">
                                       <td nowrap align="right">Officer In Charge (OIC) :</td>
                                       <td> Showing Personnel from selected Division:
									   <select name="perId" id="perId" class="span4" required >
									   <option value=" ">Select from Personnel...</option>
							 <?php
							 $perId=$row_Recordset2['perId'];
							 echo $perId;
							 $result = $conn->query("select * from personnel where personnel.divId='$dvd'");
									while ($row = $result->fetch_assoc()) {
												   unset($id, $name, $name1, $name2, $name3);
												  $id = $row['perId'];
												  $name=$row['perFname'];
												  $name1=$row['perMname'];
												  $name2=$row['perLname'];
												  $name3=$row['perExtName'];
									if($perId == $id )
										{
											$selected = 'selected="selected"';
										}
										else
										{
										$selected = '';
										}
										 echo '<option value="'.$id.'" '.$selected.'"> '.$name.' '.$name1.' '.$name2.' '.$name3.' </option>';
								}
							?>  
						   </select></td>
                                     </tr>
									 <tr valign="baseline">
                                       <td nowrap align="right">Division Description :</td>
                                       <td> <textarea class="span4" name="divDesc" id="divDesc" cols="45" rows="3"><?php echo $row_Recordset2['divDesc']; ?></textarea></td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right"></td>
                                       <td><input type="hidden" name="divModified" value="<?php echo date('Y-m-d'); ?>" size="32"></td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right">&nbsp;</td>
                                       <td><input type="submit" value="Update record" class="btn btn-inverse pull-right"></td>
                                     </tr>
                                   </table>
                                   <input type="hidden" name="MM_update" value="form3">
                                   <input type="hidden" name="divId" value="<?php echo $row_Recordset2['divId']; ?>">
                                 </form>
                                 <table width="100%" border="1">
									    <tr bgcolor="#333333">
									      <td>&nbsp;</td>
								        </tr>
									    </table>
									
                                 <p>&nbsp;</p>
                                  </div>
									
						</div>
							
						<?php 	} ?>

                       </td> 
						
						
				 
						
                  </tr> 
				  <tr>
				  <td colspan=2>
				  <table  width="90%" class="table table-striped table-bordered table-condensed">
							
				 
								<?php
											$query2 = "select * from personnel
											where personnel.divId='$divisionId'";
											$result2= mysql_query($query2);	
											$counter=0;
											while($row2 = mysql_fetch_assoc($result2)) {
											$personnelID=$row2['perId'];
											$first=$row2['perFname'];
											$middle=$row2['perMname'];
											$last=$row2['perLname'];
											$ext=$row2['perExtName'];
											$counter=$counter+1;	
										?>
							  <tr>
							  	<td><?php echo $counter ?></td>
								<td align="center"><?php echo $first.' '.$middle.' '.$last .' '.$ext.' ' ?></td>
							  </tr>
							    <?php } ?>
								
								<?php if($counter<1){?>
								<tr>
							  	<td colspan=2> 
					<form name="formdel" method="POST" action="">
                     <strong class="text-info">This Department or Division is empty at the moment!! <button id="delete" name="delete" class="btn btn-mini btn-primary pull-right" title="DELETE"><i class="icon"></i>Delete</button></strong>
                           </form>
						   <?php
						   $display="block";
						   if(isset($_POST['delete'])){ ?>
							   <div id="mywarning"  style="display:<?php echo $display ?>;">
								<div id="header"><p>
								<form action="dbmManage.php" method="get">
										<button title="close" type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
										</form>&nbsp;</p>
								<h3 align="center" >Are you Sure you Want to Delete <?php echo '"'.$name.'"'; ?>?</h3>	
								<hr>
								<table align="right" width="40%">
								<tr>
								 <td width="10%" bgcolor="#fff"><form name="formdelete" method="POST" action="dbmDeleteDiv.php?divId=<?php echo $divisionId; ?>">
								<button id="delete" name="delete" class="btn btn-large btn-danger" title="DELETE"><i class="icon"></i>Delete it...</button></form></td>
								  <td width="10%"><form name="formcancel" method="POST" action="dbmManage.php">
								<button  id="cancel" name="cancel" class="btn btn-large btn-primary" title="Cancel"><i class="icon"></i>Cancel...</button></form></td>
								</tr>
								</table> 
								
								
								</div>
								
								</div>
						 <?php  } ?>
							</td>
							  </tr>
								<?php } ?>
					  </table>
					   <div align="center">****Nothing follows****</div>
					  
					  <p>&nbsp;</p></td> 
				  </tr>
				 
				  <?php } if ($cnt<1){ ?>
				   <div class="module-body table">
					   <?php echo '<h3 align="center">'.$ss.' Please Select a Division to search...Thank You!!</h3>'; ?>
                                </div>
				   <?php } ?>
							
				 </table>
							 
							

					<?php }else{?>
						<table width="60%" align="center" class="datatable-1 table " >
				  <?php	
						$queryc = "select * from division order by divModified Asc";
						$resultc = mysql_query($queryc);	
						$cntc=0;
						 while($rowc = mysql_fetch_assoc($resultc)) {
							 $divisionIdc=$rowc['divId'];
							 $namec=$rowc['divName'];
							 $descc=$rowc['divDesc'];
							 $perIdc =$rowc['perId'];
							 $cntc=$cntc+1;
							 ?>
				  <tr bgcolor="#333" >
				  <td> <div></div>
				    <div align="left">
				      <h4><font color="white" style="margin-top: 500px; margin-left: 10px;"><?php
						if (($descc==null)||($descc==' ')){
							echo $cntc.'.) '.$namec.' - <small> (Description Not Available) </small>';
						} else{
							echo $cntc.'.) '.$namec.' - <small>'.$descc.'</small>';
						}  ?></font></h4>
				    </div>
					<div id="StyLink2"><?php
					$query11="select * from personnel where personnel.perId='$perIdc'";
					$result11= mysql_query($query11);	
						 while($row11 = mysql_fetch_assoc($result11)) { 
								$id11 = $row11['perId'];
								 $name1=$row11['perFname'];
								 $name11=$row11['perMname'];
								 $name21=$row11['perLname'];
								 $name31=$row11['perExtName'];
						 }if($perIdc==null){
									echo "No Officer In Charge!!";
								} else{
									 echo 'Officer In Charge : '. $name1.' '.$name11.' '.$name21.' '.$name31.' ';
								}
						?></div>
					</td>
                       <td width="11%" >
                         <h4>
						  
						<?php 	$query2s = "select * from personnel
											where personnel.divId='$divisionIdc'";
											$result2s= mysql_query($query2s);	
											$counters=0;
											while($row2s = mysql_fetch_assoc($result2s)) {
											$counters=$counters+1;}	
								if($counters==0){?>
					  <form name="form2" method="POST" action="dbmManage.php?divId=<?php echo $divisionIdc; ?>" class="form-horizontal row-fluid">
                      <button id="dbt" name="dbt" class="btn btn-mini btn-inverse" title="Edit or Update"><i class="icon-edit"></i> Edit</button>
                           </form>
                          <p></p>
								<?php }else{ ?>
					  <form name="form2" method="POST" action="dbmManage.php?divId=<?php echo $divisionIdc; ?>" class="form-horizontal row-fluid">
                      <button id="dbt" name="dbt" class="btn btn-mini btn-inverse" title="Edit or Update"><i class="icon-edit"></i> Edit</button>
                           </form>
                          <p></p>
						    <form name="form2" method="POST" action="dbmDivisionForm.php?divId=<?php echo $divisionIdc; ?>" class="form-horizontal row-fluid">
                      <button id="viewform" name="viewform" class="btn btn-mini btn-primary" title="Edit or Update"><div> View</div> in form </button>
                           </form>
								<?php }	?>
							
						     </h4>
                        <?php 
						$display="block";
							if(isset($_POST['dbt'])){
								$dvd=mysql_real_escape_string($_GET['divId']);
								?>
								<div id="myalert" style="display:<?php echo $display ?>;">
								  <div id="header">
										<form action="dbmManage.php" method="get">
										<button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
										</form><p>&nbsp;</p>
                                 <center><h2 class="modal-title"><b> &nbsp;Update Division "<?php echo $row_Recordset2['divName']; ?>"</b></h2></center>
								 <hr>
                                 <table width="100%" border="1">
									    <tr bgcolor="#333333">
									      <td>&nbsp;</td>
								        </tr>
									    </table>
									  <p>&nbsp;</p>
                                 <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
                                   <table align="center">
                                     
                                     <tr valign="baseline">
                                       <td nowrap align="right">Division Name:</td>
                                       <td><input class="span4" type="text" name="divName" value="<?php echo htmlentities($row_Recordset2['divName'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                     </tr>
									 									  <tr valign="baseline">
                                       <td nowrap align="right">Officer In Charge (OIC) :</td>
                                       <td>Showing List of Personnel from selected Division: <select name="perId" id="perId" class="span4" required > 
							 <?php
							 $perId=$row_Recordset2['perId'];
							 echo $perId;
							 $result = $conn->query("select * from personnel where personnel.divId='$dvd'");
									while ($row = $result->fetch_assoc()) {
												   unset($id, $name, $name1, $name2, $name3);
												  $id = $row['perId'];
												  $name=$row['perFname'];
												  $name1=$row['perMname'];
												  $name2=$row['perLname'];
												  $name3=$row['perExtName'];
									if($perId == $id )
										{
											$selected = 'selected="selected"';
										}
										else
										{
										$selected = '';
										}
										 echo '<option value="'.$id.'" '.$selected.'"> '.$name.' '.$name1.' '.$name2.' '.$name3.' </option>';
								}
							?>  
						   </select></td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right">Division Description :</td>
                                       <td> <textarea class="span4" name="divDesc" id="divDesc" cols="45" rows="3"><?php echo $row_Recordset2['divDesc']; ?></textarea></td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right"></td>
                                       <td><input type="hidden" name="divModified" value="<?php echo date('Y-m-d'); ?>" size="32"></td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right">&nbsp;</td>
                                       <td><input type="submit" value="Update record" class="btn btn-inverse pull-right"></td>
                                     </tr>
                                   </table>
                                   <input type="hidden" name="MM_update" value="form3">
                                   <input type="hidden" name="divId" value="<?php echo $row_Recordset2['divId']; ?>">
                                 </form>
                                 <table width="100%" border="1">
									    <tr bgcolor="#333333">
									      <td>&nbsp;</td>
								        </tr>
									    </table>
									
                                 <p>&nbsp;</p>
                                  </div>
									
						</div>
							
						<?php 	}
						?>

                       </td> 
                  </tr> 
				  <tr>
				  <td colspan=2>
				  <table  width="90%" class="table table-striped table-bordered table-condensed">
							
				 
								<?php
											$query2 = "select * from personnel
											where personnel.divId='$divisionIdc'";
											$result2= mysql_query($query2);	
											$counter=0;
											while($row2 = mysql_fetch_assoc($result2)) {
											$personnelID=$row2['perId'];
											$first=$row2['perFname'];
											$middle=$row2['perMname'];
											$last=$row2['perLname'];
											$ext=$row2['perExtName'];
											$counter=$counter+1;	
										?>
							  <tr>
							  	<td><?php echo $counter ?></td>
								<td align="center"><?php echo $first.' '.$middle.' '.$last .' '.$ext.' ' ?></td>
							  </tr>
							    <?php } ?>
								
								<?php if($counter<1){?>
								<tr>
							  	<td colspan=2> 
					<form name="formdel" method="POST" action="">
                     <strong class="text-info">This Department or Division is empty at the moment!! <button id="delete" name="delete" class="btn btn-mini btn-primary pull-right" title="DELETE"><i class="icon"></i>Delete</button></strong>
                           </form>
						   <?php
						   $display="block";
						   if(isset($_POST['delete'])){ ?>
							   <div id="mywarning"  style="display:<?php echo $display ?>;">
								<div id="header"><p>
								<form action="dbmManage.php" method="get">
										<button title="close" type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
										</form>&nbsp;</p>
								<h3 align="center" >Are you Sure you Want to Delete <?php echo '"'.$name.'"'; ?>?</h3>	
								<hr>
								<table align="right" width="40%">
								<tr>
								 <td width="10%" bgcolor="#fff"><form name="formdelete" method="POST" action="dbmDeleteDiv.php?divId=<?php echo $divisionIdc; ?>">
								<button id="delete" name="delete" class="btn btn-large btn-danger" title="DELETE"><i class="icon"></i>Delete it...</button></form></td>
								  <td width="10%"><form name="formcancel" method="POST" action="dbmManage.php">
								<button  id="cancel" name="cancel" class="btn btn-large btn-primary" title="Cancel"><i class="icon"></i>Cancel...</button></form></td>
								</tr>
								</table> 
								
								
								</div>
								
								</div>
						 <?php  } ?>
							</td>
							  </tr>
								<?php } ?>
					  </table>
					   <div align="center">****Nothing follows****</div>
					  
					  <p>&nbsp;</p></td> 
				  </tr>
				 
				  <?php } ?>
							
				 </table>
						
						
					<?php }

				 ?>
                 </div>
                                                    </div>
													
                                                </div>
                                            </div>
                                           <table align="center" width="100%" >
							<tr>
							<td bgcolor="#333">&nbsp;<div align="center"></td>
							</tr>
							<tr>
							<td bgcolor="#333">&nbsp;<div align="center"></td>
							</tr>
						</table>
 
                                        </div>
                                        <!--/.stream-list-->
                                    </div>
                                   
                                </div>
                            </div>
                            <!--/.module-->
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
		    
        <!--/.container-->
 
        <div class="footer" style="background-color:white;">
           <div class="container" >
			<b class="copyright">&copy; 2017 Department of Budget and Management Regional Office V</b> - All rights reserved.
		</div>
        </div>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="scripts/common.js" type="text/javascript"></script>
		   <?php include ('script.php');?>
	
    </body>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
