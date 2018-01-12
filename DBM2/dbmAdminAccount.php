<?php require_once('../Connections/dbmrov.php'); ?>
<?php 
@session_start(); 
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

$accountid1=$_SESSION['aid'];
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = "SELECT * FROM personnel where personnel.perId!=$accountid1 order by perId desc";
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset2 = "SELECT * FROM account ";
$Recordset2 = mysql_query($query_Recordset2, $dbmrov) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

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
 .container2{
 margin:0px auto;
 width:500px;
 height:250px;
 text-align:center;
 background-color:white;
 background-size:cover;
 border:6px solid #BFBFBF;
 box-shadow:0px 0px 3px #BFBFBF;
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
                                                           <font color="white">&nbsp;&nbsp;&nbsp;Manage Your Account: </font>
                                                        </h2>
														</td>
														</tr>
														</table>
														   <?php 										
											$accountid4=$_SESSION['aid'];
											$pertid4=$_SESSION['pid'];
											$query4 = "SELECT *	FROM account, personnel, profile_pics 
												WHERE account.accId = '$accountid4'
												AND account.perId = '$pertid' 
												AND account.perId=personnel.perId 
												AND profile_pics.perId=personnel.perId";
											$result4= mysql_query($query4);	
											while($row4 = mysql_fetch_assoc($result4)) {
											$p4=$row4['perId'];
											$first4=$row4['perFname'];
											$middle4=$row4['perMname'];
											$last4=$row4['perLname'];
											$ext4=$row4['perExtName'];
											$img4=$row4['image']; 
											$type4=$row4['picType'];
											$position4=$row4['perPosition'];?>
											
									<table align="center" width="100%">
									<tr>
									<td bgcolor="white">
									<div class="module-body">                                                    
									<div class="media">
                                    <a class="media-avatar pull-left" href="#">
                                     <?php if($img4==null){ ?>
									  <img class="img-circulars pull-left"  src="images/user - Copy.png">
								     <?php } else{ ?>
									  <img class="img-circulars pull-left" src="<?php echo 'data:image/'.$type4.';base64,'.base64_encode($img4); ?>" width="200" height="200"/>
												<?php	} ?>
                                      </a>
                                         <div class="media-body">
										   <div class="media-title">
                                         <?php	
													$query3 = "select * from personnel, account where personnel.perId='$p4' and account.perId=personnel.perId";
													$result3= mysql_query($query3);	
													while($row3 = mysql_fetch_assoc($result3)) {
													$priv3=$row3['accPrivilege'];
													$pass3=$row3['accPassword'];
													$usern3=$row3['accUsername'];
													} 
													if($priv3==1){?>
															<div><h3 class="media-title">Administrator <small class="text-success"></small></h3></div>
													<?php	}
										  ?>
                                         
										
                                          <?php echo '<div><strong>'.$first4.' '.$middle4.' '.$last4.' '.$ext4.'</strong></div>'; ?>
                                          </div>
                                           <div>
										   <?php 
												 $queryPos="select * from positions where positions.posId='$position4'";
												 $resultPos= mysql_query($queryPos);	
												 while($rowpos = mysql_fetch_assoc($resultPos)) { 	
												 $posname=$rowpos['posName'];
												 echo 'Position Title: '.$posname;
												 } 
														  ?>
										   </div>
										   <div>
										   <?php 
												 $querydiv="select * from division where division.perId='$p4'";
												 $resultdiv= mysql_query($querydiv);	
												 while($rowdiv = mysql_fetch_assoc($resultdiv)) { 	
												 $divname=$rowdiv['divName'];
												 echo 'Division: '.$divname;
												 } 
														  ?>
										   </div>
                                            </div>
                                                    </div>
												</div>
												
												</td>
											    </tr>
												
												</table>	
																							
											<?php } ?>	
						<table align="center" width="100%" >
							<tr>
							<td> 
							<p></p>
					<div class="span4">
                    <div class="content">
                        <div class="module">
                            <div class="module-body">
									<table align="center" class="table table-striped table-bordered table-condensed">
									<?php
									$perPerId=$_SESSION['pid'];
									$query5 = "select * from account where perId=$perPerId";
									$result5= mysql_query($query5);	
									while($row5 = mysql_fetch_assoc($result5)) {
									$username=$row5['accUsername'];?>
									<tr>
									<td bgcolor="#DBDBDB" colspan=2><font color="black">Username <i class="icon-edit"></i></font></td>
									</tr>
									<tr>
									<form name="UserUpdate" method="post" action="dbmAdminAccount.php">
									<td><input type="text" name="userUsername" id="userUsername" placeholder="Change Username" value="<?php echo $username; ?>"  required /></td>
									<td><button type="submit" name="btnUser" id="btnUser" class="btn btn-mini btn-info">Change</button></td>
									</form>
									</tr>
									<?php if(isset($_POST['btnUser'])){
									$usernamename=$_POST['userUsername'];
									$query6 = "select * from account where accId!='$perPerId'";
									$result6= mysql_query($query6);	
									while($row6 = mysql_fetch_assoc($result6)) {
										$username6 = $row6['accUsername'];
										if($username6==$usernamename){
											echo '<script type="text/javascript">
												  alert("Username already Exist!");
												  window.location.href="dbmAdminAccount.php";
												 </script>';
										}else if($username==$usernamename){
											echo '<script type="text/javascript">
												  alert("You Have not made any changes!!");
												  window.location.href="dbmAdminAccount.php";
												 </script>';
									}else if (ctype_alnum($usernamename) && strlen($usernamename)>5){
										$update1=("UPDATE account SET accUsername='$usernamename' where account.perId='$perPerId'");
										if(mysql_query($update1))
										{
												echo '<script type="text/javascript">
												alert("Username was Updated Successfully!!");
												window.location.href="dbmAdminAccount.php";
												 </script>';
										} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												window.location.href="dbmAdminAccount.php";
												 </script>';
										}
										
									} else {
										echo '<script type="text/javascript">
												alert("Invalid Username!! \nPLEASE TAKE NOTE: \n *Special Characters and Space Are not Allowed. \n *Username must be atleast 6 Characters long!!");
												window.location.href="dbmAdminAccount.php";
												 </script>';
									}
									}
									} ?>
									<?php } ?>
									</table>
                            </div>
                        </div>
						<div class="module">
                            <div class="module-body">
									<table align="center" class="table">
									<tr>
									<td bgcolor="#DBDBDB"><font color="black">Set To Default Account <i class="icon-retweet"></i></font></td>
									</tr>
									<tr>
									<td> 
									<div><strong class="text-error">Default Username :</strong> FirstnameLastname</div>
									<div><strong class="text-error">Default Password :</strong> dbmrovpass</div><p></p>
									<div><form method="post" action="dbmAdminAccount.php"><button type="submit" name="defaultBtn" id="defaultBtn"  class="btn btn-mini btn-info" onClick="return confirm('Do you want to reset Your Account?!')">Set To Default</button></form></div>
									</td>
									<?php if(isset($_POST['defaultBtn'])){
										$perPerId=$_SESSION['pid'];
										$query = "SELECT *	FROM personnel where perId='$perPerId'";
										$result= mysql_query($query);	
										$row = mysql_fetch_assoc($result); 
										$perfname = $row['perFname'];
										$perlname = $row['perLname'];
										$pa3=$perfname.$perlname;
										$nes=str_replace(' ','',$pa3 );
								    	$update2=("UPDATE account SET accUsername='$nes', accPassword='dbmrovpass' where account.perId='$perPerId'");
										if(mysql_query($update2))
												{
														echo '<script type="text/javascript">
														alert("Account was Reset Successfully!!");
														window.location.href="dbmAdminAccount.php";
														 </script>';
												} 
												else {
													echo '<script type="text/javascript">
														alert("Failed!! Something went wrong...");
														window.location.href="dbmAdminAccount.php";
														 </script>';
												}
									}?>
									</tr>
									</table>
                            </div>
                        </div>
                    </div>
                    </div>
				 <div class="span4">
                    <div class="content">
                        <div class="module">
                            <div class="module-body">
									<table align="center" class="table table-striped table-bordered table-condensed">
									<tr>
									<td bgcolor="#DBDBDB"><font color="black">Password <i class="icon-edit"></i></font></td>
									</tr>
									<form method="post" action="dbmAdminAccount.php">
									<tr>
									<td><label for="current">Current Password</label>
									<div align="center"><input name="current" id="current" type="password" placeholder="Required..." required/></div></td>
									</tr>
									<tr>
									<td><label for="new">New Password</label>
									<div align="center"><input name="new" id="new" type="password" placeholder="Required..." required/></div></td>
									</tr>
									<tr>
									<td><label for="confirm" class="text-error">* Re Enter Your New Password</label>
									<div align="center"><input name="confirm" id="confirm" type="password" placeholder="Required..." required/></div></td>
									</tr>
									<tr>
									<td><div align="center"><input name="submit" id="submit" type="submit" class="btn btn-mini btn-info span3" /></div></td>
									</tr>
									</form>
									<?php if(isset($_POST['submit'])){
										$perPerId=$_SESSION['pid'];
										$current = $_POST['current'];
										$new = $_POST['new'];
										$confirm= $_POST['confirm'];
										$query6="select * from account where account.perId='$perPerId'";
										$result6= mysql_query($query6);	
										$row6 = mysql_fetch_assoc($result6);
											$accPassword=$row6['accPassword'];
											$accId=$row6['accId'];
											if($current==$accPassword){
												if (ctype_alnum($new) && strlen($new) > 7) {
													if($new==$confirm){
														$update3=("UPDATE account SET accPassword='$confirm' where account.accId='$accId'");
														if(mysql_query($update3))
														{
															echo '<script type="text/javascript">
														alert("Password was Updated Successfully!!");
														window.location.href="dbmAdminAccount.php";
														 </script>';
														 } 
														else {
															echo '<script type="text/javascript">
														alert("Failed...Something Went Wrong!!");
														window.location.href="dbmAdminAccount.php";
														 </script>';
														}
													}else { 
														echo '<script type="text/javascript">
															alert("Confirmation of Password is incorrect...");
														    history.back();
														 </script>';
													}
												}else{
													echo '<script type="text/javascript">
															alert("Invalid Password!! \nPLEASE TAKE NOTE: \n *Special Characters and Space Are not Allowed. \n *Username must be atleast 8 Characters long!!");
														    history.back();
														 </script>';
													}
											} else{
													echo '<script type="text/javascript">
														  alert("Current Password did not Matched...");
														  history.back();
														 </script>';
											}
									}
										?>
									</table>
                            </div>
                        </div>
                    </div>
                    </div>

</td>
							</tr>
							
						</table>	
                                </div>
							<table align="center" width="100%" >
							<tr>
							<td bgcolor="#333">&nbsp;</td>
							</tr>
							<tr>
							<td bgcolor="#333">&nbsp;</td>
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
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
