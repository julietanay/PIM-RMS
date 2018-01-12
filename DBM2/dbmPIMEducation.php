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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "educAdd")) {
					if (isset($_POST['highUnitsEarned'])) 
						{ 
							  $hue = $_POST['highUnitsEarned']; 
							  $yg =Null;
						} 
						else {
							   $hue  = NULL;
							   $yg = $_POST['yearGraduated'];
						}
  $insertSQL = sprintf("INSERT INTO education (educLevel, schoolName, basicEduc, educFrom, educTo, highUnitsEarned, yearGraduated, scholarship, educDateModified, perId) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['educLevel'], "text"),
                       GetSQLValueString($_POST['schoolName'], "text"),
                       GetSQLValueString($_POST['basicEduc'], "text"),
                       GetSQLValueString($_POST['educFrom'], "date"),
                       GetSQLValueString($_POST['educTo'], "date"),
                       GetSQLValueString($hue, "text"),
                       GetSQLValueString($yg, "int"),
                       GetSQLValueString($_POST['scholarship'], "text"),
                       GetSQLValueString($_POST['educDateModified'], "date"),
                       GetSQLValueString($_POST['perId'], "int"));
		if(mysql_query($insertSQL))
						{ $per = mysql_real_escape_string($_GET['perId']);
							?><script type="text/javascript">
									window.alert("Added Successfully");
									window.location.href="dbmPIMEducation.php?perId=<?php echo $per; ?>";
							     </script>

					<?php	} else {
							echo '<script type="text/javascript">
								  alert("Failed!! Something went wrong...Please try Again later");
								  window.location.href="dbmAdminAccount.php";
								</script>';
						}
					
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
overflow: auto;
left: 0;
top: 0;
width: 100%;
height: 100%;
text-align: center;
z-index: 90;
background-color: rgba(0,0,0, .8); 
 
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
background-color: rgba(0,0,0, .7); 
 
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
            <table bgcolor="#333" width="100%">
              <tr>
                <td bgcolor="#333" width="13%"><h3> <img src="images/logo.png" height="70px" width="70px;" style="margin-top: 10px; margin-bottom: 10px; margin-left: 30px;  "></h3></td>
                <td bgcolor="#333" width="71%" align="left"><div><strong><font color="white">Department of Budget and Management</font></strong></div>
                  <div>Regional Office V</div>
                  <div>Legazpi City</div></td>
                <td bgcolor="#333"></td>
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
											$divdiv=$row['divId'];

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
                  <div class="profile-brief"> <strong> <?php  
					$queryPos="select * from positions where positions.posId='$position'";
					$resultPos= mysql_query($queryPos);	
					 while($rowpos = mysql_fetch_assoc($resultPos)) { 	
					 $posname=$rowpos['posName'];
					 echo $posname;
					 } 
					 ?></strong></div>
					  <div class="profile-brief">
					 <?php 
							$divresult = mysql_query("select * from division where `divId`='$divdiv'");
							while ($divrow = mysql_fetch_assoc($divresult)) 
							{
						     $divdivname = $divrow['divName'];
							}
							echo '<strong class="text-error">Department : </strong><strong>'.$divdivname.'</strong>';
											?></div>
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
                  <div class="profile-brief"> Regional Office V, Legazpi City </div>
                  <div class="profile-details muted">
                    <form name="formprofile" method="POST" action="">
                      <button class="btn" name="profile" id="profile"><i class="icon-picture "></i> Change Profile Picture</button>
                    </form>
                    <?php
						$display="block";
						if(isset($_POST['profile'])){ ?>
                    <div id="myalert"  style="display:<?php echo $display ?>;">
                      <div id="header">
                        <form action="dbmPIMEducation.php?perId=<?php echo $persid;?>" method="post">
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
                <li><a href="dbmPIMpersonnelView.php?perId=<?php echo $persid; ?>" >Personal</a></li>
                <!--<li><a href="dbmPIMFamily.php?perId=<?php //echo $persid; ?>" >Family </a></li>
				<li><a href="dbmPIMAddress.php?perId=<?php //echo $persid; ?>">Address</a></li>
				<li><a href="dbmPIMEligibility.php?perId=<?php echo $persid; ?>">Eligibility</a></li>-->
                <li  class="active"><a href="dbmPIMEducation.php?perId=<?php echo $persid; ?>">Education</a></li>
				<li><a href="dbmPIMWork.php?perId=<?php echo $persid; ?>">Work / Activities</a></li>
				<li><a href="dbm201.php?perId=<?php echo $persid; ?>">201 Files</a></li>

              </ul>
			  <?php } ?>
					<ul class="widget widget-menu unstyled">
                  <li><a style="background-color: #cccccc;"  class="collapsed" data-toggle="collapse" href="#family"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                   </i><strong><i class="icon-book"></i> Educational Background </strong></a>
                      <ul id="family" class=" unstyled">
                      <li>
									  <li><a  data-toggle="collapse" href="#familyadd"><div class="pull-right"><button class="btn btn-mini btn-info"><i class="icon-plus pull-right"> </i> Add Education</button></div>
									  <p></p>
									   </i><strong>&nbsp;</strong></a>
										  <ul id="familyadd" class="collapse unstyled">
										  <li>
									<p></p>
									<table align="center" width="96%">
									<tr>
									<td>
									<form name="educAdd" action="<?php echo $editFormAction; ?>"  method="POST" onsubmit="return validateForm()">
									  <table align="center" class="table table-striped" bordercolor="#cccccc" width="100%">
                                      <tr bgcolor="white" >
                                        <td><div align="center">Level :</div></td>
                                        <td colspan=3><div class="controls">
                                          <?php
									$perAddm1=$row_Recordset1['perId'];
									$querym1 = "SELECT * FROM education where education.perId='$perAddm1' and education.educLevel='Elementary'";
									$countm1=0;
									$resultm1= mysql_query($querym1);	
									while($rowm1 = mysql_fetch_assoc($resultm1)) {
										$countm1=$countm1+1;}
										if($countm1==0){ ?>
                                          <label class="radio inline">
                                            <input type="radio" name="educLevel" id="educLevel" value="Elementary" >
                                            Elementary </label>
                                          <?php  }?>
                                          <?php
									$perAddm2=$row_Recordset1['perId'];
									$querym2 = "SELECT * FROM education where education.perId='$perAddm2' and education.educLevel='Secondary'";
									$countm2=0;
									$resultm2= mysql_query($querym2);	
									while($rowm2 = mysql_fetch_assoc($resultm2)) {
										$countm2=$countm2+1;
										$relation2=$rowm2['educLevel'];}
									if($countm2<=0){  ?>
                                          <label class="radio inline">
                                            <input type="radio" name="educLevel" id="educLevel" value="Secondary">
                                            Secondary </label>
                                          <?php } ?>
                                         
                                          <label class="radio inline">
                                            <input type="radio" name="educLevel" id="educLevel" value="Vocational/Trade Course">
                                            Vocational/Trade Course </label>
                                          <label class="radio inline">
                                            <input type="radio" name="educLevel" id="educLevel" value="College">
                                            College </label>
                                          <label class="radio inline">
                                            <input type="radio" checked="" name="educLevel" id="educLevel" value="Graduate Studies" >
                                            Graduate Studies</label>
                                        </div></td>
                                      </tr>
                                      <tr bgcolor="white">
                                        <td ><div align="center">Name of School :</div><div align="center"><small>(Write in Full)</small></div></td>
                                        <td colspan=3><input type="text" name="schoolName" id="schoolName" class="span6" placeholder="required" required></td>
                                      </tr>
                                      <tr bgcolor="white">
                                        <td><div align="center"> Basic Education/Degree/Course</div></td>
                                        <td colspan=3><input type="text" class="span6" name="basicEduc" id="basicEduc" placeholder="required" required></td>
                                      </tr>
									  <tr bgcolor="white">
                                        <td ><div align="center">Scholarship/Academic Honors Received :</div><div align="center"><small>(Write in Full)</small></div></td>
                                        <td colspan=3><textarea type="text" name="scholarship" id="scholarship" class="span6" ></textarea></td>
                                      </tr>
                                      <tr bgcolor="white">
                                        <td><div align="center"> From : </div></td>
                                        <td><input type="text" maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" name="educFrom" id="educFrom" class="span2" placeholder="Enter Year..." required></td>
                                        <td><div align="center"> To :</div></td>
                                        <td><input type="text" maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" name="educTo" id="educTo" class="span2" placeholder="Enter Year..." required></td>
                                      </tr>
                                      <tr bgcolor="white">
                                         <td><label for="highUnitsEarned"><div align="center">Highest Level/Units Earned</div><div align="center"><small> (if not Graduated)</small></div></label></td>
									    <td><div align="center"> <input type="text" placeholder="Check box if applicable..." name="highUnitsEarned" id="highUnitsEarned" class="span2"  disabled="disabled" required> <input type="checkbox" onclick="var input = document.getElementById('highUnitsEarned');
												var input1 = document.getElementById('yearGraduated');
												if(this.checked){ 
												input.disabled = false; input.focus();
												input1.disabled=true;
												} else{
													input.disabled=true;
													input1.disabled = false; input1.focus();}" /> </div></td>
                                        <td><div align="center"> Year Graduated </div></td>
                                        <td><input onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" type="text" placeholder="Year..." maxlength="4" name="yearGraduated" id="yearGraduated" />
										<input name="educDateModified" id="educDateModified" type="hidden" value="<?php echo date('Y-m-d'); ?>">
                                        <input name="perId" id="perId" type="hidden" value="<?php echo $row_Recordset1['perId']; ?>">
                                        </td>
                                      </tr>
                                      <tr bgcolor="white">
                                        <td colspan="4"><div align="center">
                                          <button class="btn btn-info pull-right span2" type="submit" name="btnfamm">Add</button>
                                        </div></td>
                                      </tr>
                                      </table>
									  <input type="hidden" name="MM_insert" value="educAdd">
                                    </form>
									</td>
									</tr>
									</table>
					<p></p>
										  </li>
										  </li>
										</ul>
						<table align='center' width="100%" >										
							<tr>
							<td>
							<table align='center'  bordercolor="#cccccc" class='table table-striped table-bordered table-condensed'>										
											<?php
											$p=$row_Recordset1['perId'];
											$q = "select * from education where education.perId=$p";
											$r= mysql_query($q);	
											$c=0;
											while($rr = mysql_fetch_assoc($r)) {
											$c=$c+1;
											}
											if ($c>0){
											echo "
											<tr>
											<td><div align='center'><strong>No.</strong></div></td>
											<td><div align='left'><strong>Level</strong></div></td>
											<td><div align='left'><strong>Name of School</strong></div></td>
											<td><div align='left'><strong>Basic Education/Degree/Course</strong></div></td>
											<td colspan=2><div align='center'><form method='post' action='educVIF.php?perId=".$p."'><button class='btn btn-mini'>&nbsp; &nbsp;View in Form <i class='icon-file'></i></button></form></div></td>
											</tr>
											 ";
											} ?>
										 <?php 
											$perIdv=$row_Recordset1['perId'];
											$queryv = "select * from education where education.perId=$perIdv  order by educLevel asc";
											$resultv= mysql_query($queryv);	
											$countv=0;
											while($rowv = mysql_fetch_assoc($resultv)) {
											$countv=$countv+1;
											$educLevel=$rowv['educLevel'];
											$schoolName=$rowv['schoolName'];
											$basicEduc=$rowv['basicEduc'];
											$educFrom=$rowv['educFrom'];
											$educTo=$rowv['educTo'];
											$highUnitsEarned=$rowv['highUnitsEarned'];
											$yearGraduated=$rowv['yearGraduated'];
											$scholarship=$rowv['scholarship'];
											$educDateModified=$rowv['educDateModified'];
											$perId=$rowv['perId'];
											$educId=$rowv['educId'];
											?>
											<tr>
											<td><div align="center"><?php echo $countv ?></div></td>
											<td><div align="left"><?php echo $educLevel ?></div></td>
											<td><div align="left"><?php echo $schoolName ?></div></td>
											<td><div align="left"><?php echo $basicEduc ?></td>
											<td width="8%"><form action="" method="post">
							<input type="hidden" class="span2" name="educId" id="educId" value="<?php echo $educId; ?>" />
							<button  name="modaled" class="btn btn-mini btn-inverse" ><i class="icon-eye-open"></i> / <i class="icon-edit"></i></button>
							</form></td>
											<td width="5%"><form action=""  method="post">
						<input type="hidden" class="span2" name="educId" id="educId" value="<?php echo $educId; ?>" />
						<input type="hidden" class="span2" name="perId" id="perId" value="<?php echo $perId; ?>" />
						<button class="btn btn-mini btn-danger" name="delEd" onClick="return confirm('Are you sure you want to delete this??')"><i class="icon-remove-sign"></i></button></form></td>
											</tr>
											<?php } ?>
											</table>
						<?php if(isset($_POST['delEd'])){ 
							$edIddd=mysql_real_escape_string($_POST['educId']);
							$perIDDD=mysql_real_escape_string($_POST['perId']);
							  $del= "DELETE FROM education WHERE educId='$edIddd'";
										 if(mysql_query($del))
										{?>
												<script type="text/javascript">
												alert("Deleted!!");
												window.location.href="dbmPIMEducation.php?perId=<?php echo $perIDDD; ?>";
												 </script>
									<?php	} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
												 </script>';
										}
						} ?>					
											
										
					<?php $display="block";
					if(isset($_POST['modaled'])){ ?>
										<div id="mywarning"  style="display:<?php echo $display ?>;">
										  <div id="header">
											<form action="dbmPIMEducation.php?perId=<?php echo $perId; ?>" method="post">
											  <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
											</form>
											<p>&nbsp;</p>
											<center><h2>Educational background :</h2></center>
											<center>
				 <table align="center" bordercolor="#cccccc"   border=4 width="75%">
				  <tr>
				  <td>
			   <?php 
						$ed=mysql_real_escape_string($_POST['educId']);
											$perIdm=$row_Recordset1['perId'];
											$querym = "select * from education where education.educId='$ed'";
											$resultm= mysql_query($querym);	
											$countm=0;
											while($rowm = mysql_fetch_assoc($resultm)) {
											$countm=$countm+1;
											$educLevel=$rowm['educLevel'];
											$schoolName=$rowm['schoolName'];
											$basicEduc=$rowm['basicEduc'];
											$educFrom=$rowm['educFrom'];
											$educTo=$rowm['educTo'];
											$highUnitsEarned=$rowm['highUnitsEarned'];
											$yearGraduated=$rowm['yearGraduated'];
											$scholarship=$rowm['scholarship'];
											$educDateModified=$rowm['educDateModified'];
											$perId=$rowm['perId'];
											$educId=$rowm['educId'];
											?>
											<table align="center" class="table table-striped table-bordered table-condensed">
											<form method="POST" Action="dbmPIMEducation.php?perId=<?php echo $perIdm; ?>">
											<tr>
												<td colspan=3><p></p><h4 align="left">&nbsp;&nbsp;&nbsp; <i class="icon-circle"></i><?php echo ' '.$educLevel ?></h4></td>
											</tr>
											<tr>
											  <td colspan=3 style="background-color:#cccccc"></td>
											  </tr>
											<tr>
											<td colspan=2><label for="schoolName"><strong> Name of School :<small> (Write in full)</small></strong></label>
											<input type="text" name="schoolName" class="span4" value="<?php echo $schoolName ?>" required /></td>
											<td rowspan="2" width="50%"><?php if($scholarship==Null || $scholarship==" "){ ?>
												<strong> Scholarship/ Academic Honors Received : </strong>
												<p><p></p>
												<p class="text-error">*Empty</p>
												<textarea name="scholarship" type="text" class="span4" ><?php $null=null; echo $null; ?></textarea></p>
													
											<?php } else {?>
													<strong> Scholarship/ Academic Honors Received : </strong>
													<p><p></p>
													<textarea name="scholarship" type="text" class="span4" ><?php echo $scholarship; ?></textarea></p>
										<?php	} ?>
										<p>&nbsp;</p>
										<?php if($highUnitsEarned!=Null){ ?>
											<label><strong> Highest Level/Units Earned :<small> (If Not Graduated)</small></strong></label>
													<input name="highUnitsEarned" type="Text"  value="<?php echo $highUnitsEarned ?>" Required/>
													<input name="yearGraduated" type="hidden"  value="<?php $null=null; echo $null ?>" />
											<?php	} else{ ?>
											<label><strong> Year Graduated : </strong></label>
													<input name="yearGraduated" type="Text" maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" value="<?php echo $yearGraduated ?>" Required />
													<input name="highUnitsEarned" type="hidden"  value="<?php $null=null; echo $null; ?>" />
												<?php } ?>
										
										</td>
											</tr>
											<!--<tr>
											<td colspan=2><?php //echo '<strong> Basic Education/Degree/Course : </strong>'.$basicEduc.'' ?></td>
											</tr>
											<tr>-->
											<td colspan=2><p><strong> Period of Attendance : </strong></p>
											<p><ul><li><strong>&nbsp;&nbsp;From: </strong><input name="educFrom" value="<?php echo $educFrom; ?>" type="text" maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" required /></li>
											<li><strong>&nbsp;&nbsp;To: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><input name="educTo" value="<?php echo $educTo?>" maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" type="text" required /></li></ul></p>
										    </td>
											</tr>
											<tr>
											<td colspan=2>
											<?php if($basicEduc==Null || $basicEduc==" "){ ?>
												<strong> Basic Education/Degree/Course : <small> (Write in full)</small></strong>
												<p><p></p>
												<p class="text-error">*Empty</p>
												<input name="basicEduc" type="text" class="span4" value="<?php echo $basicEduc; ?>" /></</p>
													
											<?php } else {?>
													<strong> Basic Education/Degree/Course : <small> (Write in full)</small></strong>
													<p>
													<input name="basicEduc" type="text" class="span4" value="<?php echo $basicEduc; ?>" /></p>
										<?php	} ?>
										    <input name="educId" type="hidden" value="<?php echo $educId ?>">
											<input type="hidden" name="educDateModified" value="<?php echo date('Y-m-d'); ?>">
											<input type="hidden" name="perId" value="<?php echo $perIdm ?>">
									        </td>
											<td>
											<p></p>
											<p></p>
											<p align="center"><input type="submit" class="btn btn-large btn-inverse span3" name="educ1" onClick="return confirm('Save Changes?')" value="Update"></p></td>
											</tr>
											<tr>
											  <td colspan=3 style="background-color:#cccccc">&nbsp;</td>
											  </tr>
											
											</form>
											<?php } ?>
											</table>
						</td>
						</tr>
						</table>
											</center>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											  </div>
												</div>
											<?php } ?>	
								</td>
								</tr>
							</table>
						
					<!--Code for button educ2-->
					<?php if(isset($_POST['educ1'])){		
							$snB =$_POST['schoolName'];
						    $beB=$_POST['basicEduc'];
							$efB=$_POST['educFrom'];
							$etB=$_POST['educTo'];
							$hueB=$_POST['highUnitsEarned'];
							$ygB=$_POST['yearGraduated'];
							$edmB=$_POST['educDateModified'];
							$piB=$_POST['perId'];
							$scB=$_POST['scholarship'];
							$eiB=$_POST['educId'];
							$q2B = "select * from education where education.educId='$eiB' and education.perId='$piB'";
							$r2B= mysql_query($q2B);	
							$rr2B = mysql_fetch_assoc($r2B); 
								$educLevel2=$rr2B['educLevel'];
								$schoolName2=$rr2B['schoolName'];
								$basicEduc2=$rr2B['basicEduc'];
								$educFrom2=$rr2B['educFrom'];
								$educTo2=$rr2B['educTo'];
								$highUnitsEarned2=$rr2B['highUnitsEarned'];
								$yearGraduated2=$rr2B['yearGraduated'];
								$scholarship2=$rr2B['scholarship'];
								$educDateModified2=date('Y-m-d');
								$perId2=$rr2B['perId'];
								$educId2=$rr2B['educId'];
							if($schoolName2 == $snB && $basicEduc2 == $beB && $educFrom2 == $efB && $educTo2 == $etB && $highUnitsEarned2 == $hueB && $yearGraduated2 == $ygB && $scholarship2 == $scB ){
							echo '<script type="text/javascript">
							    alert("You Have not made any Changes..");
								history.back();
							     </script>';
								 }else {
									 $updateB=("UPDATE education SET schoolName='$snB',basicEduc='$beB',educFrom='$efB',educTo='$etB',highUnitsEarned='$hueB',yearGraduated='$ygB',scholarship='$scB',educDateModified='$edmB' WHERE educId='$eiB'");
									 if(mysql_query($updateB))
										{?>
												<script type="text/javascript">
												alert("Updated Successfully!!");
												window.location.href="dbmPIMEducation.php?perId=<?php echo $piB; ?>";
												 </script>
									<?php	} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
												 </script>';
										}
								 }


							}?>														
											
											
											
											
											
											
											
											
											
			

										
			  </li>
			 </li>
			</ul>
			</ul>
			 	<ul class="widget widget-menu unstyled">
                  <li><a style="background-color: #cccccc;"  class="collapsed" data-toggle="collapse" href="#eligibility"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                   </i><strong><i class="icon-book"></i> Civil Service Eligibility </strong></a>
                      <ul id="eligibility" class=" unstyled">
                      <li>
									<li><a  data-toggle="collapse" href="#addskill"><div class="pull-right"><button class="btn btn-mini btn-info"><i class="icon-plus pull-right"> </i> Add Eligibility</button></div>
									  <p></p>
									   <strong>&nbsp;</strong></a>
										  <ul id="addskill" class="collapse unstyled">
										  <li>
											<p></p>
								 <table align="center" width="90%">
									<tr valign="baseline">
									<td nowrap align="left" >	 
									<form name="formEli" method="POST" action="<?php echo $editFormAction; ?>">
										<table align="center"  bordercolor="#cccccc"  class="table table-striped">
											  <tr>
												<td align="center"><p>&nbsp;</p><div align="center">Eligibility Type</div></td>
												<td> <label class="radio">
                                            <input checked=" "  type="radio" name="elName" id="elName"   value="Career Service" onClick="
													var val1 = document.getElementById('elNumber');
													var val2 = document.getElementById('elDateValid');
													var val3 = document.getElementById('elRating');
													if(this.checked){ 
													val1.disabled = true; val1.focus();
													val2.disabled = true; val2.focus();
													val3.disabled = false; 
													} else{
														val1.disabled = false;
														val2.disabled = false;
														val3.disabled = true; val3.focus();
													}">
                                            Career Service </label>
												<label class="radio">
                                            <input type="radio" name="elName" id="elName"  value="RA 1080 (Board/ Bar) Under Special Laws"  onclick="
													var val1 = document.getElementById('elNumber');
													var val2 = document.getElementById('elDateValid');
													var val3 = document.getElementById('elRating');
													if(this.checked){ 
													val1.disabled = false; val1.focus();
													val2.disabled = false; val2.focus();
													val3.disabled = false; val3.focus();
													} else{
														val1.disabled = true;
														val2.disabled = true;
														val3.disabled = true; 
													}">
                                            <small>RA 1080 (Board/ Bar)<div> Under Special Laws</div></small></label>
												</td>
												<td align="center"><label class="radio">
                                            <input type="radio" name="elName" id="elName"  value="Career Service Executive Eligibility (CSEE)"  onclick="
													var val1 = document.getElementById('elNumber');
													var val2 = document.getElementById('elDateValid');
													var val3 = document.getElementById('elRating');
													if(this.checked){ 
													val1.disabled = true; val1.focus();
													val2.disabled = true; val2.focus();
													val3.disabled = false; val3.focus();
													} else{
														val1.disabled=false;
														val2.disabled = false;
														val3.disabled = true; 
													}">
                                           <small>Career Service Executive <div>Eligibility (CSEE)</div></small></label>
										   	<label class="radio">
                                            <input type="radio" name="elName" id="elName"  value="Career Executive Service (CES)"   onclick="
													var val1 = document.getElementById('elNumber');
													var val2 = document.getElementById('elDateValid');
													var val3 = document.getElementById('elRating');
													if(this.checked){ 
													val1.disabled = true; val1.focus();
													val2.disabled = true; val2.focus();
													val3.disabled = false; val3.focus();
													} else{
														val1.disabled=false;
														val2.disabled = false;
														val3.disabled = true;
													}">
                                           <small>Career Executive<div> Service (CES)</div></small></label>
											</td>
												<td><label class="radio">
                                            <input type="radio" name="elName" id="elName"  value="Driver's License"onclick="
													var val1 = document.getElementById('elNumber');
													var val2 = document.getElementById('elDateValid');
													var val3 = document.getElementById('elRating');
													if(this.checked){ 
													val1.disabled = false; 
													val2.disabled = false; 
													val3.disabled = false;
													} else{
														val1.disabled = true; val1.focus();
														val2.disabled = true; val2.focus();
														val3.disabled = true; val3.focus(); 
													}">Driver's License</label>
											<label class="radio"><input type="radio" name="elName" id="elName"  value="Barangay Eligibility"  onclick="
													var val1 = document.getElementById('elNumber');
													var val2 = document.getElementById('elDateValid');
													var val3 = document.getElementById('elRating');
													if(this.checked){ 
													val1.disabled = true; val1.focus();
													val2.disabled = true; val2.focus();
													val3.disabled = false;
													} else{
														val1.disabled = false;
														val2.disabled = false;
														val3.disabled = true; val3.focus(); 
													}">
                                           Barangay Eligibility</label>
												
												</td>
											  </tr>
											  <tr>
												<td align="center"><div align="center">Eligibility Title</div><div align="center"><small>(Write in Full)</small></small></td>
												<td><textarea type="date" name="elTitle" id="elTitle" required></textarea>
											   </td>
											   <td><div align="center">Rating </div><div align="center">(if applicable)</div></td>
											  <td>
												<input type="text" name="elRating" placeholder="(if applicable)" id="elRating" class="span2" />
												</td>
											  </tr>
											  <tr>
												<td align="center"><div>Date of Examination /</div><div align="center">Conferment</div></td>
												<td><input type="date" class="span2" name="elDate" id="elDate" placeholder="check box if Applicable..." required/>
											   </td>
											   <td align="center"><div align="center">Place of Examination /</div> <div align="center">Conferment</div></td>
												<td><textarea type="text" name="elPlace" id="elPlace" required></textarea>
											   </td>
											  </tr>
											  <tr>
												<td><div align="center">Licence's Number </div></td>
												<td><input type="text" disabled="disabled" name="elNumber" id="elNumber"  class="span2" required/></td>
												<td><div align="center">Licence's Date of Validity </iv></td>
												<td><input type="date" disabled="disabled" name="elDateValid" id="elDateValid" placeholder="check box if Applicable..."  required/></td>
											  </tr>
											  <tr>
											  <td colspan=4>
											  <input type="hidden" name="perId" id="perId" value=<?php echo $row_Recordset1['perId'];;; ?> >
                                              <input type="hidden" name="elDateModified" id="elDateModified" value=<?php echo date('Y-m-d'); ?> >
											  <input type="submit" name="elibtn" id="elibtn" value="Add" class="btn btn-mini btn-info pull-right span2">
											  </td>
											  </tr>
											</table>
										<input type="hidden" name="MM_insert" value="formEli">
                                            </form>
					<?php 	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formEli")) {
									 $ena = $_POST['elName'];
									  $ed=$_POST['elDate'];
									  $ep=$_POST['elPlace'];
									  $edm=$_POST['elDateModified'];
									  $pi=$_POST['perId'];
									  $elt=$_POST['elTitle'];
							if (!isset($_POST['elNumber']) && !isset($_POST['elDateValid'])) 
											{ 
												 $en=null;
												 $edv=null;
											} 
											else {
												    
												   $en=$_POST['elNumber'];
												   $edv=$_POST['elDateValid'];
											}
						  $insertSQL = sprintf("INSERT INTO eligibility (elName, elTitle,  elRating, elDate, elPlace, elNumber, elDateValid, elDateModified, perId) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
											   GetSQLValueString($_POST['elName'], "text"),
											   GetSQLValueString($_POST['elTitle'], "text"),
											   GetSQLValueString($_POST['elRating'], "double"),
											   GetSQLValueString($_POST['elDate'], "date"),
											   GetSQLValueString($_POST['elPlace'], "text"),
											   GetSQLValueString($en, "int"),
											   GetSQLValueString($edv, "date"),
											   GetSQLValueString($_POST['elDateModified'], "date"),
											   GetSQLValueString($_POST['perId'], "int"));			
								 if(mysql_query($insertSQL))
										{?>
											<script type="text/javascript">
											alert("Added Successfully!!");
											window.location.href="dbmPIMEducation.php?perId=<?php echo $pi; ?>";
											 </script>
										<?php	} 
										else {
												echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
													 </script>';
											 }		  			
											
											}	?>		
								 
											</td>
									</tr>
								</table>
										  </li>
										  </li>
										  </ul>
								 <table align="center" width="100%">
									<tr valign="baseline">
									<td nowrap align="left" >
									<table align="center"  bordercolor="#cccccc" class="table table-striped table-bordered table-condensed">
						 <?php
											$p=$row_Recordset1['perId'];
											$q = "select * from eligibility where eligibility.perId=$p";
											$r= mysql_query($q);	
											$c=0;
											while($rr = mysql_fetch_assoc($r)) {
											$c=$c+1;
											}
											if ($c>0){
											echo "
											<tr>
											<td><div align='center'><strong>No.</strong></div></td>
											<td><div align='left'><strong>Type</strong></div></td>
											<td><div align='left'><strong>Eligibility Title</strong></div></td>
											<td><div align='left'><strong>Rating</strong></div></td>
											<td colspan=2><div align='center'><form method='post' action='eligibilityVIF.php?perId=".$p."'><button class='btn btn-mini '>&nbsp;&nbsp;View in Form <i class='icon-file'></i></button></form></div></td>
											</tr>
											 ";
											} ?>
						

						 <?php 
											$perIdm=$row_Recordset1['perId'];
											$querym = "select * from eligibility where eligibility.perId=$perIdm";
											$resultm= mysql_query($querym);	
											$countm=0;
											while($rowm = mysql_fetch_assoc($resultm)) {
											$elId=$rowm['elId'];
											$countm=$countm+1;
											$elName=$rowm['elName'];
											$elRating=$rowm['elRating'];
											$elDate=$rowm['elDate'];
											$elPlace=$rowm['elPlace'];
											$elNumber=$rowm['elNumber'];
											$elDateValid=$rowm['elDateValid'];
											$elDateModified=$rowm['elDateModified'];
											$elPerId=$rowm['perId'];
											$elTitle=$rowm['elTitle'];
											?>
										  <tr>
										  <td><div align='center'><?php echo $countm ?></div></td>
										  <td><div align='left'><?php echo $elName ?></div></td>
										  <td><div align='left'><?php echo $elTitle ?></div></td>
										  <td><div align='left'><?php if ($elRating==null || $elRating==" "){
											  echo "N/A (not Applicable)";
										  } else {
											   echo $elRating;
										  }
										  ?></div></td>
										  <td width="8%"><form action=""  method="post">
						<input type="hidden" class="span2" name="elId" id="elId" value="<?php echo $elId; ?>" />
						<button class="btn btn-mini btn-inverse" name="elibtnUp" ><i class="icon-eye-open"></i> / <i class="icon-edit"></i></button></form></td>
										<td width="5%"><form action=""  method="post">
						<input type="hidden" class="span2" name="elId" id="elId" value="<?php echo $elId; ?>" />
						<input type="hidden" class="span2" name="perId" id="perId" value="<?php echo $elPerId; ?>" />
						<button class="btn btn-mini btn-danger" name="deluli" onClick="return confirm('Are you sure you want to delete this??')"><i class="icon-remove-sign"></i></button></form></td>
										  </tr><?php } ?>	
										  </table>
										  </td>
										   </tr>	  								
									  </table> 
				<?php if(isset($_POST['deluli'])){ 
							$elIddd=mysql_real_escape_string($_POST['elId']);
							$perIDDD=mysql_real_escape_string($_POST['perId']);
							  $del= "DELETE FROM eligibility WHERE elId='$elIddd'";
										 if(mysql_query($del))
										{?>
												<script type="text/javascript">
												alert("Deleted!!");
												window.location.href="dbmPIMEducation.php?perId=<?php echo $perIDDD; ?>";
												 </script>
									<?php	} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
												 </script>';
										}
						} ?>					
											
				
									  
					  	<?php $display="block";
					if(isset($_POST['elibtnUp'])){ ?>
										<div id="mywarning"  style="display:<?php echo $display ?>;">
										  <div id="header">
											<form action="dbmPIMEducation.php?perId=<?php echo $elPerId; ?>" method="post">
											  <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
											</form>
											<p>&nbsp;</p>
											<center><h2>Civil Service Eligibility :</h2></center>
											<center>
				 <table align="center" bordercolor="#cccccc"   border=4 width="90%">
				  <tr>
				  <td>
			  <?php 					$eliddd=mysql_real_escape_string($_POST['elId']);
											$perIdm=$row_Recordset1['perId'];
											$querym = "select * from eligibility where eligibility.elId=$eliddd";
											$resultm= mysql_query($querym);	
											$countm=0;
											while($rowm = mysql_fetch_assoc($resultm)) {
											$elId=$rowm['elId'];
											$countm=$countm+1;
											$elName=$rowm['elName'];
											$elRating=$rowm['elRating'];
											$elDate=$rowm['elDate'];
											$elTitle=$rowm['elTitle'];
											$elPlace=$rowm['elPlace'];
											$elNumber=$rowm['elNumber'];
											$elDateValid=$rowm['elDateValid'];
											$elDateModified=$rowm['elDateModified'];
											$elPerId=$rowm['perId'];
											?>
									  <form method="post" name="formeliUp" action="<?php echo $editFormAction; ?>">
									   <table align="center"  bordercolor="#cccccc" class="table table-striped table-bordered table-condensed">
										  <tr>
										  <td colspan=3 style="background-color:#cccccc"></td>
										  </tr>
										  <tr>
											<td><p align="center"><h4>Type: <?php echo $elName ?></h4></p></td>
											<td><p></p><p align="center"><label for="elRating">Rating <small>(If Applicable)</small></p></label></td>
											<td><p></p><input type="text" name="elRating" id="elRating" value="<?php echo $elRating; ?>"  /></td>
										  </tr>
										  <tr>
											<td rowspan="2"><label for="elTitle">Eligibility Title :</label><p align="center"><textarea class="span3" rows="3" name="elTitle" id="elTitle"  Required><?php echo $elTitle ?></textarea></td>
											<td><label for="elDate"><p align="center">Date of Examination / Conferment</p></label></td>
											<td><p></p><input type="date" name="elDate" id="elDate" value="<?php echo $elDate; ?>"  /></td>
										  </tr>
										  <tr>
											<td><label for="elPlace"><p align="center">Place of Examination / Conferment</p></label></td>
											<td><textarea class="span3" rows="2" name="elPlace" id="elPlace"  Required><?php echo $elPlace ?></textarea>
											</td>
										  </tr>
										  <tr>
											<td colspan=2>
											<?php if($elName=='RA 1080 (Board/ Bar) Under Special Laws' || $elName=="Driver's License") {?>
												<table width="100%">
												  <tr bgcolor="white">
													<td><p align="center"><label>Licence Number : </label><input type="text" name="elNumber" class="span2" id="elNumber" value="<?php echo $elNumber; ?>"  required/></p></td>
													<td><p align="center"><label>Licence Date of Validity : </label>
											<input type="date" class="span2" name="elDateValid" id="elDateValid" value="<?php echo $elDateValid; ?>"  required/></p></td>
												  </tr>
												</table>
												<?php } else {
													echo "<p></p><p class='text-error' align='center'>Licence No. Not Applicable...</p>"; ?>
													<input type="hidden" name="elNumber" class="span2" id="elNumber" value="<?php echo $elNumber; ?>"  required/>
													<input type="hidden" class="span2" name="elDateValid" id="elDateValid" value="<?php echo $elDateValid; ?>"  required/>
											<?php	} ?>
											</td>
											<td><p></p><p align="center"><input name="btnUpEli" class="btn btn-inverse span2" id="btnUpEli" type="submit" value="update" onClick="return confirm('Save Changes?')"/></p></td>
										  </tr>
										  <tr>
										  <td colspan=3 style="background-color:#cccccc"></td>
										  </tr>
										  </table>
							    <input type="hidden" name="perId" value="<?php echo $perIdm ?>">
							    <input type="hidden" name="elId" value="<?php echo $elId ?>">
										  </form>
										 
										  <?php
										  } ?>
										  </td>
										   </tr>										
									  </table>
											</center>
											<p>&nbsp;</p>
											  </div>
												</div>
											<?php } ?>
							<?php if(isset($_POST['btnUpEli'])){		
							//$elNameU=$_POST['elName'];
							$elRatingU=$_POST['elRating'];
							$elDateU=$_POST['elDate'];
							$elTitleU=$_POST['elTitle'];
							$elPlaceU=$_POST['elPlace'];
							$elNumberU=$_POST['elNumber'];
							$elDateValidU=$_POST['elDateValid'];
							$elPerIdU=$_POST['perId'];
							$elIdU=$_POST['elId'];
							$que = "select * from eligibility where eligibility.elId='$elIdU' and eligibility.perId='$elPerIdU'";
							$re= mysql_query($que);	
							$rere = mysql_fetch_assoc($re); 
							//	$elNameU2=$re['elName'];
								$elRatingU2=$rere['elRating'];
								$elDateU2=$rere['elDate'];
								$elTitleU2=$rere['elTitle'];
								$elPlaceU2=$rere['elPlace'];
								$elNumberU2=$rere['elNumber'];
								$elDateValidU2=$rere['elDateValid'];
								$elDateModifiedU2=date('Y-m-d');
								$elPerIdU2=$rere['perId'];
								$elIdU2=$rere['elId'];
								//	echo $elRatingU.' - '.$elRatingU2.'<p></p>' ;
								//	echo $elDateU.' - '.$elDateU2.'<p></p>';
								//	echo $elTitleU.' - '.$elTitleU2.'<p></p>';
								//	echo $elPlaceU.' - '.$elPlaceU2.'<p></p>';
								//	echo $elNumberU.' - '.$elNumberU2.'<p></p>';
								//	echo $elDateValidU.' - '.$elDateValidU2.'<p></p>';
								if($elRatingU == $elRatingU2 &&  $elDateU == $elDateU2 && $elTitleU == $elTitleU2 && $elPlaceU == $elPlaceU2 && $elNumberU == $elNumberU2 && $elDateValidU == $elDateValidU2){ ?>
							<script type="text/javascript">
												alert("You have not made any changes!!");
												window.location.href="dbmPIMEducation.php?perId=<?php echo $elPerIdU; ?>";
												 </script>
							<?php	 }else {
									$updateB=sprintf("UPDATE eligibility SET elTitle=%s,elRating=%s,elDate=%s,elPlace=%s,elNumber=%s,elDateValid=%s,elDateModified=%s,perId=%s WHERE elId=%s",
											   GetSQLValueString($_POST['elTitle'], "text"),
											   GetSQLValueString($_POST['elRating'], "double"),
											   GetSQLValueString($_POST['elDate'], "date"),
											   GetSQLValueString($_POST['elPlace'], "text"),
											   GetSQLValueString($_POST['elNumber'], "int"),
											   GetSQLValueString($_POST['elDateValid'], "date"),
											   GetSQLValueString($elDateModifiedU2, "date"),
											   GetSQLValueString($_POST['perId'], "int"),
											   GetSQLValueString($_POST['elId'], "int"));			
									 if(mysql_query($updateB))
										{?>
												<script type="text/javascript">
												alert("Updated Successfully!!");
												window.location.href="dbmPIMEducation.php?perId=<?php echo $elPerIdU; ?>";
												 </script>
									<?php	} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
												 </script>';
										//	echo mysql_error();
										}
								 }
							


							}?>	
							
					</li>
					 </li>
					</ul>
			 </ul>
			 
			 
			 </div>
			 
          </div>
          <!--/.module-->
        </div>
        <!--/.content-->
      </div>
      <!--/.span9-->
    </div>
  </div>
  </div>
          <!--/.container-->
        <!--/.wrapper-->
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
      
    </body>

<?php
mysql_free_result($Recordset1);
?>
