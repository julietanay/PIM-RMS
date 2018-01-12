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



mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset2 = "SELECT * FROM account ";
$Recordset2 = mysql_query($query_Recordset2, $dbmrov) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);


$recodAcc=$row_Recordset2['accPrivilege'];
$accountid1=$_SESSION['aid'];
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = "SELECT * FROM personnel, account where personnel.perId=account.perId and account.accPrivilege!=3 and account.accPrivilege!=1";
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
background-color: rgba(0,0,0, .3); 
 
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
		<link type="text/css" href="css/styleLink.css" rel='stylesheet'>

			
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
                            <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
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
								<a href="dbmPIMNotification.php?perId=<?php echo $per01; ?>"><i class="icon-exclamation-sign"></i> Notification  &nbsp;	<?php } ?>
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
                                       <li align="center" ><p></p><img class="img-circular" src="images/user - Copy.png" /> <p></p></li>
									
									<?php } else{ ?>
                                      <li align="center" style="background-color:#333" ><p></p> <img class="img-circular" src="<?php echo 'data:image/'.$type0.';base64,'.base64_encode($img0); ?>" /> <p></p></li>
												
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
								
                                   <table  width="100%" align="center" >
														<tr>
														<td bgcolor="#6699CC">
														 <h2 class="stream-author">
                                                           <font color="white" >&nbsp;&nbsp;&nbsp;Manage User Accounts: </font>
                                                        </h2>
														</td>
														</tr>
														</table>
																			
                                </div>
								
                                <div class="module-body table">
                                   <table cellpadding="0" cellspacing="0" border="0" align="center" class="datatable-1 table table-bordered display" width="90%">
                                        <thead>
                                    <tr>
                                      <th>User Accounts</th>
                                    </tr>
                                     </thead>
									
                                    <?php
									$counter=1;
									do { ?>
                                      <tr class="odd gradeX">
										<td>
										<table width="50%" align=center border=1 class="table table-striped table-bordered table-condensed">
										<tr>
										<td width="73%" rowspan=3>
										
										<?php 
												$perId3=$row_Recordset1['perId'];
												$query3= "select * from profile_pics where profile_pics.perId=$perId3";
												$result3= mysql_query($query3);	
												while($row3 = mysql_fetch_assoc($result3)) {
												$img=$row3['image']; 
												$type=$row3['picType'];?>
												<div class="media user">
                                                <a class="media-avatar pull-left" href="#">
                                                <?php if($img==null){ ?>
												<img class="img-circulars pull-left"  src="images/user - Copy.png">
												<?php } else{ ?>
												<img class="img-circulars pull-left" src="<?php echo 'data:image/'.$type.';base64,'.base64_encode($img); ?>" width="200" height="200"/>
												<?php }	} ?>
												  </a>
                                                        <div class="media-body">
														 <h3 class="media-title">			
										<p>
										<?php 
										$perId6=$row_Recordset1['perId'];
										$query6 = "select * from account where account.perId=$perId6";
										$result6= mysql_query($query6);	
										while($row6 = mysql_fetch_assoc($result6)) {
										$priv6=$row6['accPrivilege'];
										$pass6=$row6['accPassword'];
										$usern6=$row6['accUsername'];
										if ($priv6==0){
											echo "<strong>No Account</strong> <b class='label' style='background-color: red;'>
                                    !!</b>";
										}else if($priv6==1){
											echo "<strong> Admin Privilege</strong>";
										}else if($priv6==2){?>
											<div><strong>User :</strong></div>
											<!--<div><small> Username: <?php //echo $usern6; ?></small></div>
											<div><small> Password: <?php // echo $pass6; ?></small></div>-->
										<?php 				}
										
										}?>
										</p>														 
										  <?php 
										$first=$row_Recordset1['perFname'];
										$middle=$row_Recordset1['perMname'];
										$last=$row_Recordset1['perLname'];
										$ext=$row_Recordset1['perExtName'];
										echo $first.' '.$middle.' '.$last .' '.$ext.' '
										?>
                                                            </h3>
															
														 <p> <?php 
												 $position5=$row_Recordset1['perPosition'];

												 $queryPos="select * from positions where positions.posId='$position5'";
												 $resultPos= mysql_query($queryPos);	
												 while($rowpos = mysql_fetch_assoc($resultPos)) { 	
												 $posname=$rowpos['posName'];
												 echo 'Position Title: '.$posname;
												 } 
														  ?></p> 
									
										</div>
												</div>
										</td>
										</tr>
										<tr>
										<td width="27%" align="center">       
											<div class="media user">	
											<?php   $perId3=$row_Recordset1['perId']; 
													$query7 = "select * from account where account.perId=$perId3";
													$result7= mysql_query($query7);	
													while($row7 = mysql_fetch_assoc($result7)) {
													$perId7=$row7['perId'];
													$user7=$row7['accUsername'];
													$priv7=$row7['accPrivilege'];
														if (($priv7!=0)){?>
										   <div class="media-option btn-group shaded-icon">
											<div> 
										   <div><a href="dbmResetAcct.php?perId=<?php echo $perId7; ?> " class="btn btn-mini btn-danger" onClick="return confirm('Do you want to reset this Account?!')"><i class="icon-retweet" ></i> Reset Acct
										   </a></div>
											</div>
													</div> <?php } else echo "no action Available"; } ?>
											</div>

										</td>
										</tr>
										<tr>
										<td align="center">                                       
												<div class="media user">
									<div class="media-option btn-group shaded-icon">
                                           <div> <button class="btn btn-mini btn-primary"> <a id="StyleLink2" href="dbmPIMpersonnelVIEW.php?perId=<?php echo $row_Recordset1['perId']; ?>">View Profile</a>
                                              <i class="icon-eye-open"></i>
                                            </button></div>
                                    </div>
									</div>
										</td>
										</tr>
										
										</table>
										 </td>
                                       
                                      </tr>
                                      <?php  $counter++; 
									  } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
									 ?>
                                  </table>
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
        <div class="footer">
           <div class="container">
			 <p><b class="copyright">&copy; 2017 Department of Budget and Management Regional Office V</b> - All rights reserved.</p>
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
mysql_free_result($Recordset2);

mysql_free_result($Recordset1);
?>
