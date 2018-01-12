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
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = "SELECT * FROM personnel";
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
 @session_start(); 
if($_SESSION['username']==''){
header('location:dbmLoginPIM.php');
}
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
        <title>Edmin</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
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
								 <li class="active"><a href="dbmIndexPIM.php"><i class="menu-icon icon-dashboard"></i>Home
                                </a></li>
                                <li><a href="dbmPIMpersonnelLIST.php"><i class="menu-icon icon-user"></i>Personnel<b class="menu-icon pull-right">
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
								<img src="images/logo.png" height="70px" width="70px;" style="margin-top: 10px; margin-bottom: 10px; margin-left: 30px;  "> 
								</h3></td>
								<td bgcolor="#333" width="71%" align="left"><div><strong><font color="white">Department of Budget and Management</font></strong></div>
                                <div>Regional Office V</div>
								<div>Legazpi City</div></td>
								<td bgcolor="#333"><img src="images/pimlogo.png" height="70px" width="70px;" style="margin-top: 10px; margin-bottom: 10px; margin-left: 30px; "> 
								</td>
								</tr>
								<tr>
								<td colspan="3"><h3>
								</td>
								</tr>
							  </table>
							<div class="module-head">
                              
                                <ul class="profile-tab nav nav-tabs">
                                    <li ><a href="dbmManage.php">Division</a></li>
									 <li> <a href="dbmPerAdd.php">Personnel</a></li>
                                    <!--<li><a href="dbmReqAdd.php">Requirements</a></li>-->
									<li  class="active"><a href="dbmPIMAcct.php" >User Accounts</a></li>
                                </ul>
                                <div class="profile-tab-content tab-content">
                                    <div class="tab-pane fade active in" id="Division">
                                        <div class="stream-list">
                                            <div class="media stream">
                                                <p class="pull-left">
                                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </p>
                                                <div class="media-body">
                                                    <div class="stream-headline">
														<table  width="100%" align="center" >
														<tr>
														<td bgcolor="white">
														 <h2 class="stream-author">
                                                           &nbsp;&nbsp;&nbsp; Add & Manage User Accounts: 
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
										   <h3 class="media-title">
                                          Your Account: <?php	
													$query3 = "select * from personnel, account where personnel.perId='$p4' and account.perId=personnel.perId";
													$result3= mysql_query($query3);	
													while($row3 = mysql_fetch_assoc($result3)) {
													$priv3=$row3['accPrivilege'];
													} 
													if($priv3==1){
															echo "<strong> Admin Privilege</strong>";
														}else if($priv3==2){
															echo "<strong> Regular User </strong>";
														}

										  ?>
                                          </h3>
										  <h3 class="media-title">
                                          <?php echo '<div><strong>'.$first4.' '.$middle4.' '.$last4.' '.$ext4.'</strong></div>'; ?>
                                          </h3>
                                           <p><?php echo 'Position Title: '.$position4; ?></p>
										    <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">Edit Account
                                                                    <i class="icon-edit"></i>
                                                                </button>
                                            </div>
                                                        </div>
                                                    </div>
												</div>
												</td>
											    </tr>
												
												</table>		
											<?php } ?>					
                                                <div class="stream-text">
												<p>&nbsp;</p>
												</div>
                                                    
                                                    <!--/.stream-headline-->
						
									   
                                            <div class="stream-options">
                                            <div class="module-body table">
											
											 <?php
											$query2 = "select * from account";
											$result2= mysql_query($query2);	
											$counter2=0;
											while($row2 = mysql_fetch_assoc($result2)) {
												$counter2=$counter2+1;	
												$persid=$row2['perId'];
												$acc=$row2['accId'];
												$priv2=$row2['accPrivilege'];
												?><?php	} ?>
											<table align="center" width="90%">
											<tr>
											<td bgcolor="#333"> </td>
											<tr>
												<td><p>&nbsp;</p>
												</td>
												</tr>
											</tr>
											<?php 
													$accountid5=$_SESSION['aid'];
													$query5 = "select * from personnel, profile_pics where profile_pics.perId=personnel.perId and personnel.perId!=$accountid5";
													$result5= mysql_query($query5);	
													while($row5 = mysql_fetch_assoc($result5)) {
													$perId5=$row5['perId'];	
												$first=$row5['perFname'];
												$middle=$row5['perMname'];
												$last=$row5['perLname'];
												$ext=$row5['perExtName'];
												$position5=$row5['perPosition'];
												$tel=$row5['perTelno'];
												$mob=$row5['perMobileNo'];
												$em=$row5['perEmail'];
												$img=$row5['image'];
												$type=$row5['picType'];
												
													 ?>
													<tr>
												<td bgcolor="white">
												<div class="module-body">                                                   
												<div class="media user">
                                                <a class="media-avatar pull-left" href="#">
                                                <?php if($img==null){ ?>
												<img class="img-circulars pull-left"  src="images/user - Copy.png">
												<?php } else{ ?>
												<img class="img-circulars pull-left" src="<?php echo 'data:image/'.$type.';base64,'.base64_encode($img); ?>" width="200" height="200"/>
												<?php	} ?>
                                                        </a>
                                                        <div class="media-body">
														 <h3 class="media-title">
                                                                <?php echo '<div>'.$first.' '.$middle.' '.$last.' '.$ext.'</div>'; ?>
                                                            </h3>
														 <p> <?php echo 'Position Title: '.$position5; ?></p>
												<?php if($persid==$perId5) {?>
													 <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">Edit Account
                                                                    <i class="icon-edit"></i>
                                                                </button>
                                                            </div>
												<?php } else { ?>
												 <div class="media-option btn-group shaded-icon">
                                                    <button class="btn btn-small">Create Account
                                                    <i class="icon-plus "></i>
                                                    </button>
                                                 </div>
												<?php }
												?>
                                                    </div>
													</div>
                                                  </div>
												</td>
											    </tr>
												<tr>
												<td><p>&nbsp;</p>
												</td>
												</tr>
											<?php		
													}
													
													
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
</div>
        </div>
        <!--/.container-->
    </div>
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
?>
