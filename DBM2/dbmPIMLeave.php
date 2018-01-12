<?php require_once('../Connections/dbmrov.php'); ?>
<?php @session_start(); 
if($_SESSION['username']==''){
header('location:dbmLoginPIM.php');
}
?>
<?php
$Per0=mysql_real_escape_string($_GET['perId']);
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
  $updateSQL = sprintf("UPDATE personnel SET perGender=%s, perAge=%s, perBday=%s, perBPlace=%s, perMobileNo=%s, perTelno=%s, perFname=%s, perMname=%s, perLname=%s, perExtName=%s, perEmail=%s, perHeight=%s, perWeight=%s, perBloodType=%s, perStatus=%s, perDateModified=%s  WHERE perId=%s",
                       GetSQLValueString($_POST['perGender'], "text"),
                       GetSQLValueString($_POST['perAge'], "int"),
                       GetSQLValueString($_POST['perBday'], "date"),
                       GetSQLValueString($_POST['perBPlace'], "text"),
                       GetSQLValueString($_POST['perMobileNo'], "text"),
                       GetSQLValueString($_POST['perTelno'], "text"),
                       GetSQLValueString($_POST['perFname'], "text"),
                       GetSQLValueString($_POST['perMname'], "text"),
                       GetSQLValueString($_POST['perLname'], "text"),
                       GetSQLValueString($_POST['perExtName'], "text"),
                       GetSQLValueString($_POST['perEmail'], "text"),
                       GetSQLValueString($_POST['perHeight'], "double"),
                       GetSQLValueString($_POST['perWeight'], "double"),
                       GetSQLValueString($_POST['perBloodType'], "text"),
                       GetSQLValueString($_POST['perStatus'], "text"),
                       GetSQLValueString($_POST['perDateModified'], "date"),
                       GetSQLValueString($_POST['perId'], "int"));

  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($updateSQL, $dbmrov) or die(mysql_error());

  $updateGoTo = "dbmPIMpersonnelView.php?perId=" . $row_Recordset1['perId'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE personnel SET perPosition=%s, perAppStat=%s, perBIRno=%s, perAgenEmpNo=%s, perGSISno=%s, perPagIbigNo=%s, perPhilHno=%s, perSSSno=%s, perTransferee=%s, perTINno=%s, perDateModified=%s, divId=%s, perDateStarted=%s, perDateEnded=%s, perMonSalary=%s WHERE perId=%s",
                       GetSQLValueString($_POST['perPosition'], "text"),
                       GetSQLValueString($_POST['perAppStat'], "text"),
                       GetSQLValueString($_POST['perBIRno'], "text"),
                       GetSQLValueString($_POST['perAgenEmpNo'], "text"),
                       GetSQLValueString($_POST['perGSISno'], "text"),
                       GetSQLValueString($_POST['perPagIbigNo'], "text"),
                       GetSQLValueString($_POST['perPhilHno'], "text"),
                       GetSQLValueString($_POST['perSSSno'], "text"),
                       GetSQLValueString($_POST['perTransferee'], "text"),
                       GetSQLValueString($_POST['perTINno'], "int"),
                       GetSQLValueString($_POST['perDateModified'], "date"),
                       GetSQLValueString($_POST['divId'], "int"),
					   GetSQLValueString($_POST['perDateStarted'], "date"),
					   GetSQLValueString($_POST['perDateEnded'], "date"),
					   GetSQLValueString($_POST['perMonSalary'], "decimal"),
                       GetSQLValueString($_POST['perId'], "int"));

  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($updateSQL, $dbmrov) or die(mysql_error());
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
                            <li><?php
								$perId01=$_SESSION['pid'];
								$query01 = "SELECT * FROM personnel where personnel.PerId='$perId01'";
								$result01= mysql_query($query01);	
								while($row01 = mysql_fetch_assoc($result01)) { 
								$per01=$row01['perId'];
								?>
								<a href="dbmSeenNotif.php?perId=<?php echo $per01; ?>">Notification  &nbsp;	<?php } ?>
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
            <li align="center" style="background-color:#333" ><p></p> <img class="img-circular" src="<?php echo 'data:image/'.$type0.';base64,'.base64_encode($img0); ?>"/> <p></p></li>
            
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
             <li><a href="dbmPIMNotification.php"><i class="menu-icon icon-exchange"></i>Pending<b class="label green pull-right">
                                     <?php
									$query1 = "select * from personnel_update";
											$result1= mysql_query($query1);	
											$counter1=0;
											while($row1 = mysql_fetch_assoc($result1)) {
												$counter1=$counter1+1;
											} echo $counter1; ?></b> </a></li>
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
            <table bgcolor="#333" width="100%">
              <tr>
                <td bgcolor="#333" width="13%"><h3> <img src="images/logo.png" height="70px" width="70px;" style="margin-top: 10px; margin-bottom: 10px; margin-left: 30px;  "></h3></td>
                <td bgcolor="#333" width="71%" align="left"><div><strong><font color="white">Department of Budget and Management</font></strong></div>
                  <div>Regional Office V</div>
                  <div>Legazpi City</div></td>
                <td bgcolor="#333"><img src="images/pimlogo.png" height="70px" width="70px;" style="margin-top: 10px; margin-bottom: 10px; margin-left: 30px; "></td>
              </tr>
              <tr>
                <td colspan="3"><h3></td>
              </tr>
            </table>
            <div class="module-body">
              <div class="profile-head media">
                <?php 
											$Per1=mysql_real_escape_string($_GET['perId']);
											$query = "select * from personnel, profile_pics where personnel.perId=$Per1 and profile_pics.perId=personnel.perId";
											$result= mysql_query($query);	
											while($row = mysql_fetch_assoc($result)) {
											$persid=$row['perId'];
											$first=$row['perFname'];
											$middle=$row['perMname'];
											$last=$row['perLname'];
											$ext=$row['perExtName'];
											$position=$row['perPosition'];
											$tel=$row['perTelno'];
											$mob=$row['perMobileNo'];
											$em=$row['perEmail'];
											$img=$row['image'];
											$type=$row['picType'];
											
									?>
                <?php if($img==null){ ?>
                <img class="img-circulars pull-left"  src="images/user - Copy.png">
                <?php } else{ ?>
                <img class="img-circulars pull-left" src="<?php echo 'data:image/'.$type.';base64,'.base64_encode($img); ?>" width="200" height="200"/>
                <?php	}?>
                <div class="media-body">
                  <h4>
                    <?php
					echo $first.' '.$middle.' '.$last.' '.$ext.''; ?>
                  </h4>
                  <div class="profile-brief"> <strong> <?php echo $position ?></strong></div>
                  <div class="profile-brief">
                    <?php if($tel!=NULL){
											  echo ' <strong>  Tel. No :</strong> '.$tel.' - ';
										  }
										  if($mob!=NULL){
											  echo ' <strong>  Mobile No :</strong> '.$mob.' - ';
										  }
										  if($em!=NULL){
											  echo ' <strong> Email No :</strong> '.$em.' ';
										  }
										  ?>
                    </strong></div>
                  <div class="profile-brief"> Department of Budget and Management </div>
                  <div class="profile-brief"> Regional Office V </div>
                  <div class="profile-brief"> Legazpi City </div>
                  <div class="profile-details muted">
                    <form name="formprofile" method="POST" action="">
                      <button class="btn" name="profile" id="profile"><i class="icon-plus shaded"></i> Change Profile Picture</button>
                    </form>
                    <?php
						$display="block";
						if(isset($_POST['profile'])){ ?>
                    <div id="myalert"  style="display:<?php echo $display ?>;">
                      <div id="header">
                        <form action="dbmPIMpersonnelVIEW.php?perId=<?php echo $persid;?>" method="post">
                          <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                        </form>
                        <p>&nbsp;</p>
                        <center>
                          <h2 class="modal-title"><b> &nbsp;Change Profile Picture</b></h2>
                        </center>
                        <hr>
                        <form id="uploadform"  action ="dbmpicture.php" method="post" enctype="multipart/form-data">
                          <table  width="100%" width="100%">
                          <tr>
                            <td align="center" colspan=3 bgcolor="black" ><font color="white">Current Profile Picture</font></td>
                          </tr>
                          <tr>
                            <td colspan=3 ><p>&nbsp;</p></td>
                          </tr>
                          <tr>
                            <td align="center" colspan=3><?php if($img==null){ ?>
                              <img class="img-circulars" align="center" src="images/user - Copy.png">
                              <?php } else{ ?>
                              <img class="img-circulars" src="<?php echo 'data:image/'.$type.';base64,'.base64_encode($img); ?>" width="200" height="200"/>
                              <?php }
													?></td>
                          </tr>
                          <tr>
                            <td colspan=3 ><p>&nbsp;</p></td>
                          </tr>
                          <tr>
                            <td bgcolor="grey" ><input type="hidden" name="perId" id="perId" value="<?php echo $persid ?>" /></td>
                            <td bgcolor="grey"><input class="btn btn-large btn-inverse" type="file" name="file_img" id="file_img" value=" " required/></td>
                            <td bgcolor="grey" ><input type="submit" name="btn_upload" id="btn_upload" value="upload" class="btn btn-large btn-inverse"></td>
                          </tr>
                          <tr>
                            <td align="center" colspan=3 bgcolor="black"><p>&nbsp;</p></td>
                          </tr>
                          </table>
                        </form>
                      </div>
                    </div>
                    <?php  } ?>
                  </div>
                </div>
              
              </div>
              <ul class="profile-tab nav nav-tabs">
                <li class="active"><a href="dbmPIMpersonnelView.php?perId=<?php echo $persid; ?>" >Personal</a></li>
				<li><a href="dbmPIMLeave.php?perId=<?php echo $persid; ?>" >Leave </a></li>
                <li><a href="dbmPIMFamily.php?perId=<?php echo $persid; ?>" >Family </a></li>
                <li><a href="#friends">Education</a></li>
                <li><a href="#friends" >Requirement <small>(201 Files)</small></a></li>
              </ul>  <?php } ?>
              <div class="profile-tab-content tab-content">
                <div class="tab-pane fade active in" id="activity">
                  <div class="stream-list">
                    <div class="media stream">
                      <div class="media-body">
                        <div class="stream-headline">
                         
                          <form method="post" name="form1" action="<?php echo $editFormAction; ?>" >
                            <table align="center" border=0 width="90%" >
							<tr valign="baseline" >
                                <td  colspan=4 align="left"><ul><li class="text-info" >Please, Fill up all the Required Fields...The entered data will be later use for the generation of necessary reports later...
								</li></ul>
								 <?php 
						  $id=$row_Recordset1['perId'];
						  $bdy=$row_Recordset1['perBday'];
						 $d = date_parse_from_format("Y-m-d", $bdy);
						 $month=$d["month"];
						 $day=$d["day"];
						 $currentMonth=date('m');
						 $currentDate=date('d');
					     if (($month==$currentMonth)&&($day==$currentDate))
					     {
							$Ageee=$row_Recordset1['perAge']+1;
						 $update=("UPDATE personnel SET perAge='".$Ageee."' WHERE perId=".$id);
					     } ?>
								
								
								</td>
                              </tr>
                              <tr valign="baseline" >
                                <td bgcolor="#333" colspan=4 align="center"><p>&nbsp;</p>
                                  <h4> <font color="white">Basic Information :<font></h4></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td colspan=4 nowrap align="right"><p>&nbsp;</p></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td nowrap align="right">First Name :</td>
                                <td><input type="text" placeholder="Required..." name="perFname" value="<?php echo htmlentities($row_Recordset1['perFname'], ENT_COMPAT, 'utf-8'); ?>" size="32" required ></td>
                                <td nowrap align="right">Middle Name :</td>
                                <td><input type="text"  placeholder="Required..." name="perMname" value="<?php echo htmlentities($row_Recordset1['perMname'], ENT_COMPAT, 'utf-8'); ?>" size="32" required ></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td nowrap align="right">Last Name :</td>
                                <td><input type="text"  placeholder="Required..." name="perLname" value="<?php echo htmlentities($row_Recordset1['perLname'], ENT_COMPAT, 'utf-8'); ?>" size="32" required></td>
                                <td nowrap align="right">Extension Name :</td>
                                <td><input type="text" maxlength="2" placeholder="If Applicable..." name="perExtName" value="<?php echo htmlentities($row_Recordset1['perExtName'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td nowrap align="right">Gender :</td>
                                <td><select  placeholder="Required..." name="perGender" id="perGender" required>
                                  <option value = "Male"<?php if($row_Recordset1['perGender'] == 'Male') { ?> selected="selected"<?php } ?>>Male</option>
                                  <option value = "Female"<?php if($row_Recordset1['perGender'] == 'Female') { ?> selected="selected"<?php } ?>>Female</option>
                                </select></td>
                                <td nowrap align="right">Age :</td>
                                <td><input type="number"  placeholder="Required..." name="perAge" value="<?php echo htmlentities($row_Recordset1['perAge'], ENT_COMPAT, 'utf-8'); ?>" size="32" required></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td nowrap align="right">Birthday :</td>
                                <td><input type="date"   name="perBday" value="<?php echo htmlentities($row_Recordset1['perBday'], ENT_COMPAT, 'utf-8'); ?>" size="32" required></td>
                                <td nowrap align="right">Birth Place :</td>
                                <td><textarea class="span2" placeholder="Required..." rows="2" name="perBPlace" id="perBPlace" required><?php echo $row_Recordset1['perBPlace'] ?></textarea></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td nowrap align="right">Blood Type :</td>
                                <td><input type="text" placeholder="Required..." name="perBloodType" value="<?php echo htmlentities($row_Recordset1['perBloodType'], ENT_COMPAT, 'utf-8'); ?>" size="32" required></td>
                                <td nowrap align="right" >Civil Status :</td>
                                <td><select name="perStatus" id="perStatus" required>
                                  <option value = "Single"<?php if($row_Recordset1['perStatus'] == 'Single') { ?> selected="selected"<?php } ?>>Single</option>
                                  <option value = "Married"<?php if($row_Recordset1['perStatus'] == 'Married') { ?> selected="selected"<?php } ?>>Married</option>
                                  <option value = "Widowed"<?php if($row_Recordset1['perStatus'] == 'Widowed') { ?> selected="selected"<?php } ?>>Widowed</option>
                                </select></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td nowrap align="right">Mobile No :</td>
                                <td><input type="number" placeholder="Optional..." name="perMobileNo" value="<?php echo htmlentities($row_Recordset1['perMobileNo'], ENT_COMPAT, 'utf-8'); ?>" size="32" ></td>
                                <td nowrap align="right">Telephone No :</td>
                                <td><input type="number" placeholder="Optional..." name="perTelno" value="<?php echo htmlentities($row_Recordset1['perTelno'], ENT_COMPAT, 'utf-8'); ?>" size="32" ></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td nowrap align="right">Email :</td>
                                <td align="left" colspan=3><input class="span6" type="text" placeholder="Optional..." name="perEmail" value="<?php echo htmlentities($row_Recordset1['perEmail'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB" >
                                <td nowrap align="right">Height :</td>
                                <td><input type="number" placeholder="Required..." name="perHeight" value="<?php echo htmlentities($row_Recordset1['perHeight'], ENT_COMPAT, 'utf-8'); ?>" size="32" required></td>
                                <td nowrap align="right">Weight :</td>
                                <td><input type="number" placeholder="Required..." name="perWeight" value="<?php echo htmlentities($row_Recordset1['perWeight'], ENT_COMPAT, 'utf-8'); ?>" size="32" required></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td nowrap align="right"></td>
                                <td><input type="hidden" name="perDateModified" value="<?php echo date('Y-m-d');?>" size="32"></td>
                                <td nowrap align="right">&nbsp;</td>
                                <td align="center"><input type="submit" value="Save Changes" class="btn btn-large btn-inverse
"></td>
                              </tr>
                              <tr valign="baseline" bgcolor="#DBDBDB">
                                <td colspan=4 align="center"><p>&nbsp;</p></td>
                              </tr>
                            </table>
                            <input type="hidden" name="MM_update" value="form1">
                            <input type="hidden" name="perId" value="<?php echo $row_Recordset1['perId']; ?>">
                          </form>
                        </div>
                      </div>
                    </div>
                    <!--/.media .stream-->
                    <div class="media stream">
                      <div class="media-body"> <div class="stream-headline">
    
                        <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
                          <table align="center" border=0 width="90%">
						  <tr valign="baseline" >
                                <td  colspan=4 align="left"><ul><li class="text-info" >Please, Fill up all the Required Fields...The entered data will be later use for the generation of necessary reports later...
								</li></ul></td>
                                  
                              </tr>
						   <tr valign="baseline" >
                                <td bgcolor="#333" colspan=4 align="center"><p>&nbsp;</p>
                                  <h4> <font color="white">Employment Information :<font></h4></td>
                              </tr>
							  <tr valign="baseline" bgcolor="#DBDBDB">
                                <td colspan=4 nowrap align="right"><p>&nbsp;</p></td>
                              </tr>
                            <tr valign="baseline" bgcolor="#DBDBDB">
                              <td nowrap align="right">Employment Position : </td>
                              <td><input type="text" placeholder="Required..." name="perPosition" value="<?php echo htmlentities($row_Recordset1['perPosition'], ENT_COMPAT, 'utf-8'); ?>" size="32" required>
							  </td>
							   <td nowrap align="right">Status of Appointment : </td>
                              <td>
							  <select name="perAppStat" id="perAppStat">
								<option value = "Permanent"<?php if($row_Recordset1['perAppStat'] == 'Permanent') { ?> selected="selected"<?php } ?>>Permanent</option>
								<option value = "Contractual"<?php if($row_Recordset1['perAppStat'] == 'Contractual') { ?> selected="selected"<?php } ?>>Contractual</option>
							 </select>
							  </td>
                            </tr>
                             <tr valign="baseline" bgcolor="#DBDBDB">
							  <td nowrap align="right">Transferee(?) : </td>
								<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="radio inline">
									<input type="radio" name="perTransferee" id="perTransferee" value="Yes"<?php if($row_Recordset1['perTransferee'] == 'Yes') { ?> checked="checked"<?php } ?>>Yes</label> 
									<label class="radio inline">
									<input type="radio" name="perTransferee" id="perTransferee" value="No"<?php if($row_Recordset1['perTransferee'] == 'No') { ?> checked="checked"<?php } ?>>No</label> </td>
                              <td nowrap align="right">Division : </td>
                              <td>
							 <select name="divId" id="divId" required >
							 <?php
							 $div=$row_Recordset1['divId'];
							 $result = $conn->query("select divId,divName from division ");
									while ($row = $result->fetch_assoc()) {

												  unset($id, $name);
												  $id = $row['divId'];
												  $name=$row['divName'];
									if($div == $id )
										{
											$selected = 'selected="selected"';
										}
										else
										{
										$selected = '';
										}
										 echo '<option value="'.$id.'" '.$selected.'"> '.$name.' </option>';
								}
							?>  
						   </select>
							  
							  
							  
							  
							  </td>
                            </tr>
                           
                            <tr valign="baseline" bgcolor="#DBDBDB">
                              <td nowrap align="right">Monthly Salary : </td>
                              <td><input type="number" placeholder="Required..." name="perMonSalary" value="<?php echo htmlentities($row_Recordset1['perMonSalary'], ENT_COMPAT, 'utf-8'); ?>" size="32" required></td>
							    <td nowrap align="right">Agency Employee No : </td>
                              <td><input type="text" placeholder="Required..." name="perAgenEmpNo" value="<?php echo htmlentities($row_Recordset1['perAgenEmpNo'], ENT_COMPAT, 'utf-8'); ?>" size="32" required></td>
                            </tr>
							 <tr valign="baseline" bgcolor="#DBDBDB">
                              <td nowrap align="right">Date Started : </td>
                              <td><input type="date" placeholder="If Applicable..." name="perDateStarted" value="<?php echo htmlentities($row_Recordset1['perDateStarted'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
							    <td nowrap align="right">GSISno : </td>
                              <td><input type="text" placeholder="If Applicable..." name="perGSISno" value="<?php echo htmlentities($row_Recordset1['perGSISno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#DBDBDB">
                              <td nowrap align="right">Date Ended : </td>
                              <td><input type="date" placeholder="If Applicable..." name="perDateEnded" value="<?php echo htmlentities($row_Recordset1['perDateEnded'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
							   <td nowrap align="right">PhilHealth No : </td>
                              <td><input type="text" placeholder="If Applicable..." name="perPhilHno" value="<?php echo htmlentities($row_Recordset1['perPhilHno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                            </tr>
                          
                            <tr valign="baseline" bgcolor="#DBDBDB">
                              <td nowrap align="right">SSS No : </td>
                              <td><input type="text" placeholder="If Applicable..." name="perSSSno" value="<?php echo htmlentities($row_Recordset1['perSSSno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
							   <td nowrap align="right">TIN No : </td>
                              <td><input type="number" placeholder="Required..." name="perTINno" value="<?php echo htmlentities($row_Recordset1['perTINno'], ENT_COMPAT, 'utf-8'); ?>" size="32" required></td>

                            </tr>
							  <tr valign="baseline" bgcolor="#DBDBDB">
                              <td nowrap align="right">BIR No : </td>
                              <td><input type="text" placeholder="If Applicable..." name="perBIRno" value="<?php echo htmlentities($row_Recordset1['perBIRno'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
							   <td nowrap align="right">PagIbig No : </td>
                              <td><input type="text" placeholder="If Applicable..." name="perPagIbigNo" value="<?php echo htmlentities($row_Recordset1['perPagIbigNo'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                            </tr>
                            <tr valign="baseline" bgcolor="#DBDBDB">
							
                              <td nowrap align="right"></td>
                               <td><input type="hidden" name="perDateModified" value="<?php echo date('Y-m-d');?>" size="32"></td>
							    <td nowrap align="right">&nbsp;</td>
                              <td align="center"><input type="submit" class="btn btn-large btn-inverse" value="Save Changes"></td>
                            </tr>
							 <tr valign="baseline" bgcolor="#DBDBDB">
                                <td colspan=4 nowrap align="right"><p>&nbsp;</p></td>
                              </tr>
                          </table>
                          <input type="hidden" name="MM_update" value="form2">
                          <input type="hidden" name="perId" value="<?php echo $row_Recordset1['perId']; ?>">
                        </form>
                        <p>&nbsp;</p>
                         </div>
                      <!--/.stream-headline-->
                    </div>
                  </div>
                  
                  <!--/.media .stream-->
              </div>
              
                  <!--/.row-fluid-->
                  
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
