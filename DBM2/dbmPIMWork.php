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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formwork")) {
  $insertSQL = sprintf("INSERT INTO work (workFrom, workTo, workPosTitle, workAgency, workMonthlySalary, workSalary1, workSalary2, workStatAppointment, workGovtService, workDateModified, perId) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['workFrom'], "date"),
                       GetSQLValueString($_POST['workTo'], "date"),
                       GetSQLValueString($_POST['workPosTitle'], "text"),
                       GetSQLValueString($_POST['workAgency'], "text"),
                       GetSQLValueString($_POST['workMonthlySalary'], "double"),
                       GetSQLValueString($_POST['workSalary1'], "int"),
                       GetSQLValueString($_POST['workSalary2'], "int"),
                       GetSQLValueString($_POST['workStatAppointment'], "text"),
                       GetSQLValueString($_POST['workGovtService'], "text"),
                       GetSQLValueString($_POST['workDateModified'], "date"),
                       GetSQLValueString($_POST['perId'], "int"));
					if(mysql_query($insertSQL))
						{ $per = mysql_real_escape_string($_GET['perId']);
							?><script type="text/javascript">
									window.alert("Added Successfully");
									window.location.href="dbmPIMWork.php?perId=<?php echo $per; ?>";
							     </script>

					<?php	} else {
							echo '<script type="text/javascript">
								  alert("Failed!! Something went wrong...Please try Again later");
								  window.location.href="dbmPIMWork.php";
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
                      <button class="btn" name="profile" id="profile"><i class="icon-picture"></i> Change Profile Picture</button>
                    </form>
                    <?php
						$display="block";
						if(isset($_POST['profile'])){ ?>
                    <div id="myalert"  style="display:<?php echo $display ?>;">
                      <div id="header">
                        <form action="dbmPIMFamily.php?perId=<?php echo $persid;?>" method="post">
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
				<li><a href="dbmPIMEligibility.php?perId=<?php// echo $persid; ?>">Eligibility</a></li>-->
                <li ><a href="dbmPIMEducation.php?perId=<?php echo $persid; ?>">Education</a></li>
				<li class="active"><a href="dbmPIMWork.php?perId=<?php echo $persid; ?>">Work / Activities</a></li>
				<li><a href="dbm201.php?perId=<?php echo $persid; ?>">201 Files</a></li>

              </ul>
									 <?php } ?>
								
				<ul class="widget widget-menu unstyled">
                  <li><a style="background-color: #cccccc;"  class="collapsed" data-toggle="collapse" href="#family"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                   </i><strong><i class="icon-book"></i> Work Experience </strong>
				   <small class="text-info">&nbsp;&nbsp;&nbsp;(Include private employment. Start from recent work).</small>
				   </a>
                      <ul id="family" class=" unstyled">
                      <li>
									  <li><a  data-toggle="collapse" href="#familyadd"><div class="pull-right"><button class="btn btn-mini btn-info"><i class="icon-plus pull-right"> </i> Add Work</button></div>
									  <p></p>
									   </i><strong>&nbsp;</strong></a>
										  <ul id="familyadd" class="collapse unstyled">
										  <li>
									<p></p>
									<table align="center" width="95%">
									<tr>
									<td><form action="<?php echo $editFormAction; ?>" name="formwork" method="POST">
									  <table align="center" class="table table-striped" bordercolor="#cccccc" width="100%">
                                                <tr>
												 <td align="center"><div align="center"><label for="workGovtService">Government Service</label> </div></td>
												 <td align="center">
												 <label class="radio inline">
												 <input type="radio" name="workGovtService" id="workGovtService" value="Y" checked=""> Yes</label>
												 <label class="radio inline">
												 <input type="radio" name="workGovtService" id="workGovtService" value="N"> No  </label>
                                                  </td>
												 <td align="center"><div align="center"><small>Inclusive Date : </small><label for="workFrom">From</label></div> </td>
                                                 <td align="center">
                                                     <input type="date" name="workFrom" id="workFrom" placeholder="Required..." class="span2" required/></td>
                                                </tr>
                                              <tr>
												 <td align="center"><div align="center"><label for="workPosTitle">Position Title  </div><div align="center"><small>(Write in full/ Do not Abbreviate)</small></div></label></td>
                                                 <td align="center">
                                                    <textarea type="text" name="workPosTitle" id="workPosTitle" required></textarea></td>
												 <td align="center"><div align="center"><small>Inclusive Date : </small><label for="workTo">To</label> </div></td>
                                                 <td align="center">
                                                   <input type="date" name="workTo" id="workTo" placeholder="Required..." class="span2" required/></td>
                                                </tr>   
                                        <tr>
												 <td align="center"><label for="workAgency"><div align="center">
                                                    Department/ Agency/ Office/ Company</div>
                                                    <div align="center"><small>(Write in full/ Do not Abbreviate)</small></div>
                                                    </label> </td>
                                                 <td align="center">
                                                   <textarea type="text" name="workAgency" id="workAgency" required></textarea>
												 <td align="center"><div align="center"><label for="workMonthlySalary">Monthly Salary</label> <div></td>
                                                 <td align="center">
												 <div class="input-prepend">
													<span class="add-on">Php</span><input type="number" class="span2" name="workMonthlySalary" id="workMonthlySalary" placeholder="Required..."  required/>       
												</div>

                                                    </td>
                                                </tr>  
										<tr>
												 <td align="center"><div align="center"><label for="workStatAppointment">Status of Appointment</label></div></td>
                                                 <td align="center">
                                                   <select tabindex="1" data-placeholder="Select here.."  name="workStatAppointment" id="workStatAppointment" required>
                                                     <option value="">Select here..</option>
													<option value="Permanent">Permanent</option>
													<option value="Provisional">Provisional</option>
													<option value="Temporary">Temporary</option>
													<option value="Substitute">Substitute</option>
													<option value="Co-terminous">Co-terminous</option>
													<option value="Contractual">Contractual</option>
													<option value="Casual">Casual</option>
                                                    </select>
												 <td align="center"><div align="center"><label for="workSalary"><small>Salary/ Job/ Pay Grade & STEP / Increment</small></div></td>
                                                 <td align="center"> 
												 <input type="text" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" class="span1" name="workSalary1" id="workSalary1" placeholder="if applicable...format (00-0)" /> -
												 <input type="text" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }"  class="span1" name="workSalary2" id="workSalary2" placeholder="if applicable...format (00-0)" /></td>
                                                </tr>   
                                                <tr>
                                                  <td colspan=4><p></p>
                                                    <input type="hidden" name="perId" id="perId" value=<?php echo $row_Recordset1['perId']; ?> >
                                                    <input type="hidden" name="workDateModified" id="workDateModified" value=<?php echo date('Y-m-d'); ?> >
                                                    <input type="submit" name="work" id="work" value="Add" class="btn btn-mini btn-info pull-right span2"></td>
                                                </tr>
                                              </table>
                                              <input type="hidden" name="MM_insert" value="formwork">

                                              </form></td>
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
											$q = "select * from work where work.perId=$p";
											$r= mysql_query($q);	
											$c=0;
											while($rr = mysql_fetch_assoc($r)) {
											$c=$c+1;
											}
											if ($c>0){
											echo "
											<tr>
											<td><div align='center'><strong>No.</strong></div></td>
											<td><div align='left'><strong>Position Title</strong></div></td>
											<td><div align='left'><strong>Department/ Agency/ Office/ Company</strong></div></td>
											<td><div align='left'><strong>Status of Appointment</strong></div></td>
											<td colspan=2><div align='center'><form method='post' action='workVIF.php?perId=".$p."'><button class='btn btn-mini'>&nbsp; &nbsp;View in Form <i class='icon-file'></i></button></form></div></td>
											</tr> ";
											} ?>										
							<?php
											$perIdwork=$row_Recordset1['perId'];
											$queryw = "select * from work where work.perId='$perIdwork'";
											$resultw= mysql_query($queryw);	
											$countw=0;
											while($roww = mysql_fetch_assoc($resultw)) {
											$countw=$countw+1;
											$workFrom=$roww['workFrom'];
											$workTo=$roww['workTo'];
											$workAgency=$roww['workAgency'];
											$workGovtService=$roww['workGovtService'];
											$workMonthlySalary=$roww['workMonthlySalary'];
											$workPosTitle=$roww['workPosTitle'];
											$workSalary1=$roww['workSalary1'];
											$workSalary2=$roww['workSalary2'];
											$workDateModified=$roww['workDateModified'];
											$workStatAppointment=$roww['workStatAppointment'];
											$perId=$roww['perId']; 
											$workId=$roww['workId']; 
											?>
										<tr>
										<td><div align="center"><?php echo $countw; ?></div></td>
										<td><div align="Left"><?php echo $workPosTitle; ?></div></td>
										<td><div align="left"><?php echo $workAgency; ?></div></td>
										<td><div align="left"><?php echo $workStatAppointment; ?></div></td>
										<td width="8%"><form action="" method="post">
										<input type="hidden" class="span2" name="workId" id="workId" value="<?php echo $workId; ?>" />
										<button  name="modalwork" class="btn btn-mini btn-inverse" ><i class="icon-eye-open"></i> / <i class="icon-edit"></i></button>
										</form></td>
										<td width="5%"><form action=""  method="post">
										<input type="hidden" class="span2" name="workId" id="workId" value="<?php echo $workId; ?>" />
										<input type="hidden" class="span2" name="perId" id="perId" value="<?php echo $perId; ?>" />
										<button class="btn btn-mini btn-danger" name="delwork" onClick="return confirm('Are you sure you want to delete this??')"><i class="icon-remove-sign"></i></button></form></td>
										</tr>	
								<?php	} ?>				
								</table>
						</td>
						</tr>
						</table>
										<?php if(isset($_POST['delwork'])){ 
							$workIddd=mysql_real_escape_string($_POST['workId']);
							$perIDDD=mysql_real_escape_string($_POST['perId']);
							  $delwork= "DELETE FROM work WHERE workId='$workIddd'";
										 if(mysql_query($delwork))
										{?>
												<script type="text/javascript">
												alert("Deleted!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perIDDD; ?>";
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
					if(isset($_POST['modalwork'])){ ?>
										<div id="mywarning"  style="display:<?php echo $display ?>;">
										  <div id="header">
											<form action="dbmPIMWork.php?perId=<?php echo $perId; ?>" method="post">
											  <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
											</form>
											<p>&nbsp;</p>
											<center><h2>Work Experience :</h2></center>
											<center>
				 <table align="center" bordercolor="#cccccc"   border=4 width="90%">
				  <tr>
				  <td>
			  <table align="center" border=0 width="100%">
					    <?php
					$work=mysql_real_escape_string($_POST['workId']);
					$querym = "SELECT * FROM work where work.workId='$work'";
					$countm=0;
					$resultm= mysql_query($querym);	
					while($rowm = mysql_fetch_assoc($resultm)) {
						$workFrom=$rowm['workFrom'];
						$workTo=$rowm['workTo'];
						$workAgency=$rowm['workAgency'];
						$workGovtService=$rowm['workGovtService'];
						$workMonthlySalary=$rowm['workMonthlySalary'];
						$workPosTitle=$rowm['workPosTitle'];
						$workSalary1=$rowm['workSalary1'];
						$workSalary2=$rowm['workSalary2'];
						$workDateModified=$rowm['workDateModified'];
						$workStatAppointment=$rowm['workStatAppointment'];
						$perId=$rowm['perId']; 
						$workId=$rowm['workId']; 
					?> 
						<form action="<?php echo $editFormAction; ?>" name="formworkU" method="POST">
									  <table align="center" class="table table-striped" bordercolor="#cccccc" width="100%">
                                                <tr>
												 <td align="center"><p align="center"><label for="workGovtService">Government Service</label> </p></td>
												 <td align="center">
												 <label class="radio inline">
												 <input type="radio" name="workGovtService" id="workGovtService" value ="Y"<?php if($workGovtService == 'Y') { ?> checked="checked"<?php } ?> > Yes</label>
												 <label class="radio inline">
												 <input type="radio" name="workGovtService" id="workGovtService" value ="N"<?php if($workGovtService == 'N') { ?> checked="checked"<?php } ?>> No  </label>
                                                  </td>
												 <td align="center"><p align="center"><small>Inclusive Date : </small><label for="workFrom">From</label></p> </td>
                                                 <td align="center">
                                                     <input type="date" name="workFrom" id="workFrom" placeholder="Required..." class="span2" value="<?php echo $workFrom; ?>" required/></td>
                                                </tr>
                                              <tr>
												 <td align="center"><p align="center"><label for="workPosTitle">Position Title  <small>(Write in full)</small></p></label></td>
                                                 <td align="center">
                                                    <textarea type="text" name="workPosTitle" id="workPosTitle" required><?php echo $workPosTitle ?></textarea></td>
												 <td align="center"><p align="center"><small>Inclusive Date : </small><label for="workTo">To</label> </p></td>
                                                 <td align="center">
                                                   <input type="date" name="workTo" id="workTo" placeholder="Required..." value="<?php echo $workTo; ?>" class="span2" required/></td>
                                                </tr>   
                                        <tr>
												 <td align="center"><label for="workAgency"><p align="center">
                                                    Department/ Agency/ Office/ Company <small>(Write in full)</small></p>
                                                    </label> </td>
                                                 <td align="center">
                                                   <textarea type="text" name="workAgency" id="workAgency" required><?php echo $workAgency; ?></textarea>
												 <td align="center"><p align="center"><label for="workMonthlySalary">Monthly Salary</label> <p></td>
                                                 <td align="center">
												 <p class="input-prepend">
													<span class="add-on">Php</span><input type="number" class="span2" name="workMonthlySalary" id="workMonthlySalary" placeholder="Required..." value="<?php echo $workMonthlySalary; ?>" required/>       
												</p>

                                                    </td>
                                                </tr>  
										<tr>
												 <td align="center"><p align="center"><label for="workStatAppointment">Status of Appointment</label></p></td>
                                                 <td align="center">
                                                   <select tabindex="1" data-placeholder="Select here.."  name="workStatAppointment" id="workStatAppointment" required>
													<option value="Permanent"<?php if($workStatAppointment == 'Permanent') { ?> selected="selected"<?php } ?>>Permanent</option>
													<option value="Provisional"<?php if($workStatAppointment == 'Provisional') { ?> selected="selected"<?php } ?>>Provisional</option>
													<option value="Temporary"<?php if($workStatAppointment == 'Temporary') { ?> selected="selected"<?php } ?>>Temporary</option>
													<option value="Substitute"<?php if($workStatAppointment == 'Substitute') { ?> selected="selected"<?php } ?>>Substitute</option>
													<option value="Co-terminous"<?php if($workStatAppointment == 'Co-terminous') { ?> selected="selected"<?php } ?>>Co-terminous</option>
													<option value="Contractual"<?php if($workStatAppointment == 'Contractual') { ?> selected="selected"<?php } ?>>Contractual</option>
													<option value="Casual"<?php if($workStatAppointment == 'Casual') { ?> selected="selected"<?php } ?>>Casual</option>
                                                    </select>
												 <td align="center"><p align="center"><label for="workSalary"><small>Salary/ Job/ Pay Grade & STEP / Increment</small></p></td>
                                                 <td align="center"> 
												 <input type="text" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" class="span1" name="workSalary1" id="workSalary1" placeholder="if applicable...format (00-0)" value="<?php echo $workSalary1 ?>" /> -
												 <input type="text" maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }"  class="span1" name="workSalary2" id="workSalary2" placeholder="if applicable...format (00-0)" value="<?php echo $workSalary2 ?>" /></td>
                                                </tr>   
                                                <tr>
                                                  <td colspan=4><p></p>
                                                    <input type="hidden" name="perId" id="perId" value=<?php echo $row_Recordset1['perId']; ?> >
													  <input type="hidden" name="workId" id="workId" value=<?php echo $workId; ?> >
                                                    <input type="hidden" name="workDateModified" id="workDateModified" value=<?php echo date('Y-m-d'); ?> >
                                                    <input type="submit" name="workup" id="workup" value="Update" class="btn btn-mini btn-inverse pull-right span2"></td>
                                                </tr>
                                              </table>
                                              </form>
						<?php } ?>
					    </table>
						</td>
						</tr>
						</table>
												<p></p>
											</center>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											  </div>
												</div>
											<?php } ?>
											
						<?php if(isset($_POST['workup'])){		
							$workFrom1=$_POST['workFrom'];
							$workTo1=$_POST['workTo'];
							$workAgency1=$_POST['workAgency'];
							$workGovtService1=$_POST['workGovtService'];
							$workMonthlySalary1=$_POST['workMonthlySalary'];
							$workPosTitle1=$_POST['workPosTitle'];
							$workSalary11=$_POST['workSalary1'];
							$workSalary21=$_POST['workSalary2'];
							$workDateModified1=$_POST['workDateModified'];
							$workStatAppointment1=$_POST['workStatAppointment'];
							$perId1=$_POST['perId']; 
							$workId1=$_POST['workId']; 
							$workDateModifiedU2=date('Y-m-d');
							$que = "select * from work where work.workId='$workId1' and work.perId='$perId1'";
							$re= mysql_query($que);	
							$rere = mysql_fetch_assoc($re); 
								$workFrom2=$rere['workFrom'];
								$workTo2=$rere['workTo'];
								$workAgency2=$rere['workAgency'];
								$workGovtService2=$rere['workGovtService'];
								$workMonthlySalary2=$rere['workMonthlySalary'];
								$workPosTitle2=$rere['workPosTitle'];
								$workSalary12=$rere['workSalary1'];
								$workSalary22=$rere['workSalary2'];
								$workDateModified2=$rere['workDateModified'];
								$workStatAppointment2=$rere['workStatAppointment'];
								$perId2=$rere['perId']; 
								$workId2=$rere['workId']; 
								//echo $workFrom2.' - '.$workFrom1.'<p></p>' ;
								//echo $workTo2.' - '.$workTo1.'<p></p>' ;
								//echo $workAgency2.' - '.$workAgency1.'<p></p>' ;
								//echo $workGovtService2.' - '.$workGovtService1.'<p></p>' ;
								//echo $workMonthlySalary2.' - '.$workMonthlySalary1.'<p></p>' ;
								//echo $workPosTitle2.' - '.$workPosTitle1.'<p></p>' ;
								//echo $workSalary12.' - '.$workSalary11.'<p></p>' ;
								//echo $workSalary22.' - '.$workSalary21.'<p></p>' ;
								//echo $workStatAppointment2.' - '.$workStatAppointment1.'<p></p>' ;
								if($workFrom2 == $workFrom1 &&
								$workTo2 == $workTo1 &&
								$workAgency2 == $workAgency1 &&
								$workGovtService2 == $workGovtService1 &&
								$workMonthlySalary2 == $workMonthlySalary1 &&
								$workPosTitle2 == $workPosTitle1 &&
								$workSalary12 == $workSalary11 &&
								$workSalary22 == $workSalary21 &&
								$workStatAppointment2 == $workStatAppointment1 )
								{ ?>
							<script type="text/javascript">
												alert("You have not made any changes!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perId1; ?>";
												 </script>
							<?php	 }else {
									$updateB=sprintf("UPDATE work SET workFrom=%s,workTo=%s,workPosTitle=%s,workAgency=%s,workMonthlySalary=%s,workSalary1=%s,workSalary2=%s,workStatAppointment=%s,workGovtService=%s,workDateModified=%s,perId=%s WHERE workId=%s",
											   GetSQLValueString($_POST['workFrom'], "date"),
											   GetSQLValueString($_POST['workTo'], "date"),
											   GetSQLValueString($_POST['workPosTitle'], "text"),
											   GetSQLValueString($_POST['workAgency'], "text"),
											   GetSQLValueString($_POST['workMonthlySalary'], "double"),
											   GetSQLValueString($_POST['workSalary1'], "int"),
											   GetSQLValueString($_POST['workSalary2'], "int"),
											   GetSQLValueString($_POST['workStatAppointment'], "text"),
											   GetSQLValueString($_POST['workGovtService'], "text"),
											   GetSQLValueString($workDateModifiedU2, "date"),
											   GetSQLValueString($_POST['perId'], "int"),
											   GetSQLValueString($_POST['workId'], "int"));			
									 if(mysql_query($updateB))
										{?>
												<script type="text/javascript">
												alert("Updated Successfully!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perId1; ?>";
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
			 
			<ul class="widget widget-menu unstyled">
                  <li><a style="background-color: #cccccc;"  class="collapsed" data-toggle="collapse" href="#voluntary"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                   </i><strong><i class="icon-book"></i> Voluntary Work or Involvement in Civic / Non-Government / People / Voluntary Organization(s) </strong>
				   </a>
                      <ul id="voluntary" class=" unstyled">
                      <li>
									  <li><a  data-toggle="collapse" href="#addVol"><div class="pull-right"><button class="btn btn-mini btn-info"><i class="icon-plus pull-right"> </i> Add Voluntary Work</button></div>
									  <p></p>
									   </i><strong>&nbsp;</strong></a>
										  <ul id="addVol" class="collapse unstyled">
										  <li>
									<p></p>
									<table align="center" width="95%">
									<tr>
									<td><form action="" name="formworkvol" method="POST">
									  <table align="center" class="table table-striped" bordercolor="#cccccc" width="100%">
                                                <tr>
												 <td align="center"><div align="center"><label for="orgName">Organization Name</label> </div></td>
												 <td align="center">
												 <textarea type="text" name="orgName" id="orgName" required></textarea>
                                                  </td>
												 <td align="center"><div align="center"><label for="orgAddress">Organization Address</label></div> </td>
                                                 <td align="center">
                                                 <textarea type="text" name="orgAddress" id="orgAddress" required></textarea> </td>
                                                </tr>
												 <tr>
												 <td align="center"><div align="center"><label for="position">Position/Nature of Work</label> </div></td>
												 <td align="center">
												 <input type="text" name="position" id="position" placeholder="required..." required />
                                                  </td>
												 <td align="center"><div align="center"><label for="noOfHours">No. of Hours</label></div> </td>
                                                 <td align="center">
												<input type="text" name="noOfHours" id="noOfHours" placeholder="required..." maxlength="5" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" required />   
												</td>                                            
												</tr>
												
												 <tr>
												 <td align="center"><div align="center"><small>Inclusive Date</small><label for="volunteerFrom">From</label> </div></td>
												 <td align="center">
												 <input type="date" name="volunteerFrom" id="volunteerFrom" placeholder="required..." required />
                                                  </td>
												 <td align="center"><div align="center"><small>Inclusive Date</small><label for="volunteerTo">To</label></div> </td>
                                                 <td align="center">
												<input type="date" name="volunteerTo" id="volunteerTo" placeholder="required..."required /><input type="hidden" name="perId" id="perId" value="<?php echo $row_Recordset1['perId']; ?>">
												<input type="hidden" name="volunteerDateModified" id="volunteerDateModified" value="<?php echo date('Y-m-d'); ?>">
												</td>                                            
												</tr>
												<tr>
												<td colspan="4"><button type="submit" name="btnAddVol" id="btnVol" class="btn btn-mini btn-info span2 pull-right">Add</button></td>
												</tr>
										</table>
                                              </form>
									</tr>
									</table>
									<p></p>
									<?php if(isset($_POST['btnAddVol'])){		
											$orgNamepostPost=$_POST['orgName'];
											$orgAddressPost=$_POST['orgAddress'];
											$volunteerFromPost=$_POST['volunteerFrom'];
											$volunteerToPost=$_POST['volunteerTo'];
											$noOfHoursPost=$_POST['noOfHours'];
											$positionPost=$_POST['position'];
											$volunteerDateModifiedPost=$_POST['volunteerDateModified'];
											$perIdPost=$_POST['perId']; 
											$volunteerIdPost=$_POST['volunteerId']; 
									    $insertVol= "INSERT INTO voluntary_work(orgName, orgAddress, volunteerFrom, volunteerTo, noOfHours, position, volunteerDateModified, perId) VALUES ('$orgNamepostPost','$orgAddressPost','$volunteerFromPost','$volunteerToPost','$noOfHoursPost','$positionPost','$volunteerDateModifiedPost','$perIdPost')";
										 if(mysql_query($insertVol))
										{?>
												<script type="text/javascript">
												alert("Added Successfully!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perIdPost; ?>";
												 </script>
									<?php	} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
												 </script>';
										}
									  
									  }?>
									
									
									
										  </li>
										  </li>
										</ul>	
							<table align='center' width="100%" >										
							<tr>
							<td>
							<table align='center'  bordercolor="#cccccc" class='table table-striped table-bordered table-condensed'>										
											<?php
											$p=$row_Recordset1['perId'];
											$q = "select * from voluntary_work where voluntary_work.perId=$p";
											$r= mysql_query($q);	
											$c=0;
											while($rr = mysql_fetch_assoc($r)) {
											$c=$c+1;
											}
											if ($c>0){
											echo "
											<tr>
											<td><div align='center'><strong>No.</strong></div></td>
											<td><div align='left'><strong>Name of the Organization</strong></div></td>
											<td><div align='left'><strong>Address</strong></div></td>
											<td><div align='left'><strong>Position/Nature of Works</strong></div></td>
											<td colspan=2><div align='center'><form method='post' action='volunteerVIF.php?perId=".$p."'><button class='btn btn-mini'>&nbsp; &nbsp;View in Form <i class='icon-file'></i></button></form></div></td>
											</tr> ";
											} ?>										
							<?php
											$perIdVwork=$row_Recordset1['perId'];
											$queryvw = "select * from voluntary_work where voluntary_work.perId='$perIdVwork'";
											$resultvw= mysql_query($queryvw);	
											$countvw=0;
											while($rowvw = mysql_fetch_assoc($resultvw)) {
											$countvw=$countvw+1;
											$orgName=$rowvw['orgName'];
											$orgAddress=$rowvw['orgAddress'];
											$volunteerFrom=$rowvw['volunteerFrom'];
											$volunteerTo=$rowvw['volunteerTo'];
											$noOfHours=$rowvw['noOfHours'];
											$position=$rowvw['position'];
											$volunteerDateModified=$rowvw['volunteerDateModified'];
											$perId=$rowvw['perId']; 
											$volunteerId=$rowvw['volunteerId']; 
											?>
										<tr>
										<td><div align="center"><?php echo $countvw; ?></div></td>
										<td><div align="Left"><?php echo $orgName; ?></div></td>
										<td><div align="left"><?php echo $orgAddress; ?></div></td>
										<td><div align="left"><?php echo $position; ?></div></td>
										<td width="8%"><form action="" method="post">
										<input type="hidden" class="span2" name="volunteerId" id="volunteerId" value="<?php echo $volunteerId; ?>" />
										<button  name="modalworkv" class="btn btn-mini btn-inverse" ><i class="icon-eye-open"></i> / <i class="icon-edit"></i></button>
										</form></td>
										<td width="5%"><form action=""  method="post">
										<input type="hidden" class="span2" name="volunteerId" id="volunteerId" value="<?php echo $volunteerId; ?>" />
										<input type="hidden" class="span2" name="perId" id="perId" value="<?php echo $perId; ?>" />
										<button class="btn btn-mini btn-danger" name="delworkvol" onClick="return confirm('Are you sure you want to delete this??')"><i class="icon-remove-sign"></i></button></form></td>
										</tr>	
								<?php	} ?>				
								</table>
						</td>
						</tr>
						</table>
										<?php if(isset($_POST['delworkvol'])){ 
							$volIddd=mysql_real_escape_string($_POST['volunteerId']);
							$perIDVol=mysql_real_escape_string($_POST['perId']);
							  $delworkvol= "DELETE FROM voluntary_work WHERE volunteerId='$volIddd'";
										 if(mysql_query($delworkvol))
										{?>
												<script type="text/javascript">
												alert("Deleted!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perIDVol; ?>";
												 </script>
									<?php	} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
												 </script>';
										}
						} ?>	

			  </li>
			 </li>
			</ul>
			</ul>									
			
			 <?php
					if(isset($_POST['modalworkv'])){ ?>
							<div id="mywarning"  style="display:<?php echo $display ?>;">
							 <div id="header">
								<form action="dbmPIMWork.php?perId=<?php echo $perId; ?>" method="post">
								 <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
								</form>
								<p>&nbsp;</p>
								<center><h2>Voluntary Works :</h2></center>
								<center>
				 <table align="center" bordercolor="#cccccc"   border=4 width="90%">
				  <tr>
				  <td>
			  <table align="center" border=0 width="100%">
					    <?php
					$volunteer=mysql_real_escape_string($_POST['volunteerId']);
					$queryv = "SELECT * FROM voluntary_work where volunteerId='$volunteer'";
					$countv=0;
					$resultv= mysql_query($queryv);	
					while($rowv = mysql_fetch_assoc($resultv)) {
						$orgNamev=$rowv['orgName'];
						$orgAddressv=$rowv['orgAddress'];
						$volunteerFromv=$rowv['volunteerFrom'];
						$volunteerTov=$rowv['volunteerTo'];
						$noOfHoursv=$rowv['noOfHours'];
						$positionv=$rowv['position'];
						$volunteerDateModifiedv=$rowv['volunteerDateModified'];
						$perIdv=$rowv['perId']; 
						$volunteerIdv=$rowv['volunteerId']; 
					?> 
						<form action="<?php echo $editFormAction; ?>" name="formworkVU" method="POST">
									<table align="center" class="table table-striped" bordercolor="#cccccc" width="100%">
                                                <tr>
												 <td align="center"><p align="center"><label for="orgName">Organization Name</label> </p></td>
												 <td align="center">
												 <textarea type="text" name="orgName" id="orgName" required><?php echo $orgNamev; ?></textarea>
                                                  </td>
												 <td align="center"><p align="center"><label for="orgAddress">Organization Address</label></p> </td>
                                                 <td align="center">
                                                 <textarea type="text" name="orgAddress" id="orgAddress" required><?php echo $orgAddress; ?></textarea> </td>
                                                </tr>
												 <tr>
												 <td align="center"><p align="center"><label for="position">Position/Nature of Work</label> </p></td>
												 <td align="center">
												 <input type="text" name="position" id="position" placeholder="required..." value="<?php echo $positionv; ?>" required />
                                                  </td>
												 <td align="center"><p align="center"><label for="noOfHours">No. of Hours</label></p> </td>
                                                 <td align="center">
												<input type="text" name="noOfHours" id="noOfHours" placeholder="required..." maxlength="5" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" value="<?php echo $noOfHoursv; ?>"required />   
												</td>                                            
												</tr>
												
												 <tr>
												 <td align="center"><p align="center"><small>Inclusive Date</small><label for="volunteerFrom">From</label> </p></td>
												 <td align="center">
												 <input type="date" name="volunteerFrom" id="volunteerFrom" value="<?php echo $volunteerFromv; ?>" placeholder="required..." required />
                                                  </td>
												 <td align="center"><p align="center"><small>Inclusive Date</small><label for="volunteerTo">To</label></p> </td>
                                                 <td align="center">
												<input type="date" name="volunteerTo" id="volunteerTo" placeholder="required..." value="<?php echo $volunteerTov; ?>" required />
												</td>                                            
												</tr>
												<tr>
												<td colspan="4">
												<input type="hidden" name="perId" id="perId" value="<?php echo $perIdv; ?>">
												<input type="hidden" name="volunteerId" id="volunteerId" value="<?php echo $volunteerIdv; ?>">
												<button type="submit" name="btnUpVol" id="btnVol" class="btn btn-mini btn-inverse span2 pull-right">Update</button></td>
												</tr>
										</table>
                                              </form>
						<?php } ?>
					    </table>
						</td>
						</tr>
						</table>
												<p></p>
											</center>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											  </div>
												</div>
											<?php } ?>
											
						<?php if(isset($_POST['btnUpVol'])){		
							$orgNamep=$_POST['orgName'];
							$orgAddressp=$_POST['orgAddress'];
							$volunteerFromp=$_POST['volunteerFrom'];
							$volunteerTop=$_POST['volunteerTo'];
							$noOfHoursp=$_POST['noOfHours'];
							$positionp=$_POST['position'];
							$perIdp=$_POST['perId']; 
							$volunteerIdp=$_POST['volunteerId']; 
							$volunteerDateModifiedp=date('Y-m-d');
							$querv = "select * from voluntary_work where voluntary_work.volunteerId='$volunteerIdp' and voluntary_work.perId='$perIdp'";
							$rev= mysql_query($querv);	
							$rerev = mysql_fetch_assoc($rev); 
								$orgNamep2=$rerev['orgName'];
								$orgAddressp2=$rerev['orgAddress'];
								$volunteerFromp2=$rerev['volunteerFrom'];
								$volunteerTop2=$rerev['volunteerTo'];
								$noOfHoursp2=$rerev['noOfHours'];
								$positionp2=$rerev['position']; 
								if($orgNamep2 == $orgNamep &&
								$orgAddressp2 == $orgAddressp &&
								$volunteerFromp2 == $volunteerFromp &&
								$volunteerTop2 == $volunteerTop &&
								$noOfHoursp2 == $noOfHoursp &&
								$positionp2 == $positionp )
								{ ?>
							<script type="text/javascript">
												alert("You have not made any changes!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perIdp; ?>";
												 </script>
							<?php	 }else {
									$updatev=sprintf("UPDATE voluntary_work SET orgName=%s,orgAddress=%s,volunteerFrom=%s,volunteerTo=%s,noOfHours=%s,position=%s,volunteerDateModified=%s,perId=%s WHERE volunteerId=%s",
											   GetSQLValueString($_POST['orgName'], "text"),
											   GetSQLValueString($_POST['orgAddress'], "text"),
											   GetSQLValueString($_POST['volunteerFrom'], "date"),
											   GetSQLValueString($_POST['volunteerTo'], "date"),
											   GetSQLValueString($_POST['noOfHours'], "int"),
											   GetSQLValueString($_POST['position'], "text"),
											   GetSQLValueString($volunteerDateModifiedp, "date"),
											   GetSQLValueString($_POST['perId'], "int"),
											   GetSQLValueString($_POST['volunteerId'], "int"));			
									 if(mysql_query($updatev))
										{?>
												<script type="text/javascript">
												alert("Updated Successfully!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perIdp; ?>";
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
							
							
					<ul class="widget widget-menu unstyled">
                  <li><a style="background-color: #cccccc;"  class="collapsed" data-toggle="collapse" href="#train"><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                   </i><strong><i class="icon-book"></i> Learning and Development (L&D) Interventions and Training Programs Attended </strong>
				   </a>
                      <ul id="train" class=" unstyled">
                      <li>
									  <li><a  data-toggle="collapse" href="#addtrainings"><div class="pull-right"><button class="btn btn-mini btn-info"><i class="icon-plus pull-right"> </i> Add Training </button></div>
									  <p></p>
									   </i><strong>&nbsp;</strong></a>
										  <ul id="addtrainings" class="collapse unstyled">
										  <li>
									<p></p>
									<table align="center" width="95%">
									<tr>
									<td><form action="" name="formworkvol" method="POST">
									  <table align="center" class="table table-striped" bordercolor="#cccccc" width="100%">
                                                <tr>
												 <td align="center"><p></p><div align="center"><label for="learningTitle">Title : <small>(Write in Full)</small></label> </div></td>
												 <td align="center">
												 <textarea type="text" name="learningTitle" id="learningTitle" required></textarea>
                                                  </td>
												 <td align="center"><div align="center"><label for="learningSponsor">Conducted/ Sponsored By : <small>(Write in Full)</small></label></div> </td>
                                                 <td align="center">
                                                 <textarea type="text" name="learningSponsor" id="learningSponsor" required></textarea> </td>
                                                </tr>
												 <tr>
												 <td align="center"><div align="center"><label for="learningType">Type of LD :</label> </div></td>
												 <td align="center">
												<select name="learningType" id="learningType" required>
												<option value="">Select Here...</option>
												<option value="Managerial">Managerial</option>
												<option value="Supervisory">Supervisory</option>
												<option value="Technical">Technical</option>
												</select>
                                                  </td>
												 <td align="center"><div align="center"><label for="LearningNOH">No. of Hours</label></div> </td>
                                                 <td align="center">
												<input type="text" name="LearningNOH" id="LearningNOH" placeholder="required..." maxlength="5" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" required />   
												</td>                                            
												</tr>
												
												 <tr>
												 <td align="center"><div align="center"><small>Inclusive Date</small><label for="incluDateFrom">From</label> </div></td>
												 <td align="center">
												 <input type="date" name="incluDateFrom" id="incluDateFrom" placeholder="required..." required />
                                                  </td>
												 <td align="center"><div align="center"><small>Inclusive Date</small><label for="incluDateTo">To</label></div> </td>
                                                 <td align="center">
												<input type="date" name="incluDateTo" id="incluDateTo" placeholder="required..."required /><input type="hidden" name="perId" id="perId" value="<?php echo $row_Recordset1['perId']; ?>">
												<input type="hidden" name="dateModified" id="dateModified" value="<?php echo date('Y-m-d'); ?>">
												</td>                                            
												</tr>
												<tr>
												<td colspan="4"><button type="submit" name="btnAddLearn" id="btnAddLearn" class="btn btn-mini btn-info span2 pull-right">Add</button></td>
												</tr>
										</table>
                                              </form>
									</tr>
									</table>
									<p></p>
									<?php if(isset($_POST['btnAddLearn'])){		
											$learningTitlePost=$_POST['learningTitle'];
											$learningSponsorPost=$_POST['learningSponsor'];
											$learningTypePost=$_POST['learningType'];
											$LearningNOHToPost=$_POST['LearningNOH'];
											$incluDateFromPost=$_POST['incluDateFrom'];
											$incluDateToPost=$_POST['incluDateTo'];
											$dateModifiedPost=$_POST['dateModified'];
											$perIdPost=$_POST['perId']; 
									    $insertLearn= "INSERT INTO learning( learningType, learningTitle, incluDateFrom, incluDateTo, LearningNOH, learningSponsor, perId, dateModified) VALUES ('$learningTypePost','$learningTitlePost','$incluDateFromPost','$incluDateToPost','$LearningNOHToPost','$learningSponsorPost','$perIdPost','$dateModifiedPost')";
										 if(mysql_query($insertLearn))
										{?>
												<script type="text/javascript">
												alert("Added Successfully!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perIdPost; ?>";
												 </script>
									<?php	} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
												 </script>';
										}
									  
									  }?>
										  </li>
										  </li>
										</ul>	
							<table align='center' width="100%" >										
							<tr>
							<td>
							<table align='center'  bordercolor="#cccccc" class='table table-striped table-bordered table-condensed'>										
											<?php
											$p=$row_Recordset1['perId'];
											$q = "select * from learning where learning.perId=$p";
											$r= mysql_query($q);	
											$c=0;
											while($rr = mysql_fetch_assoc($r)) {
											$c=$c+1;
											}
											if ($c>0){
											echo "
											<tr>
											<td><div align='center'><strong>No.</strong></div></td>
											<td><div align='left'><strong>Title of Learning and Development Interventions and Training Programs</strong></div></td>
											<td><div align='left'><strong>Conducted/ Sponsored By</strong></div></td>
											<td colspan=2><div align='center'><form method='post' action='learningVIF.php?perId=".$p."'><button class='btn btn-mini'>&nbsp; &nbsp;View in Form <i class='icon-file'></i></button></form></div></td>
											</tr> ";
											} ?>										
							<?php
											$perIdLearning=$row_Recordset1['perId'];
											$queryl = "select * from learning where learning.perId='$perIdLearning'";
											$resultl= mysql_query($queryl);	
											$countl=0;
											while($rowl= mysql_fetch_assoc($resultl)) {
											$countl=$countl+1;
											$learningTitle=$rowl['learningTitle'];
											$learningSponsor=$rowl['learningSponsor'];
											$learningType=$rowl['learningType'];
											$LearningNOH=$rowl['LearningNOH'];
											$incluDateFrom=$rowl['incluDateFrom'];
											$incluDateTo=$rowl['incluDateTo'];
											$dateModified=$rowl['dateModified'];
											$perId=$rowl['perId']; 
											$learningId=$rowl['learningId']; 
											?>
										<tr>
										<td><div align="center"><?php echo $countl; ?></div></td>
										<td><div align="Left"><?php echo $learningTitle; ?></div></td>
										<td><div align="left"><?php echo $learningSponsor; ?></div></td>
										<td width="8%"><form action="" method="post">
										<input type="hidden" class="span2" name="learningId" id="learningId" value="<?php echo $learningId; ?>" />
										<button  name="modallearn" class="btn btn-mini btn-inverse" ><i class="icon-eye-open"></i> / <i class="icon-edit"></i></button>
										</form></td>
										<td width="5%"><form action=""  method="post">
										<input type="hidden" class="span2" name="learningId" id="learningId" value="<?php echo $learningId; ?>" />
										<input type="hidden" class="span2" name="perId" id="perId" value="<?php echo $perId; ?>" />
										<button class="btn btn-mini btn-danger" name="dellearn" onClick="return confirm('Are you sure you want to delete this??')"><i class="icon-remove-sign"></i></button></form></td>
										</tr>	
								<?php	} ?>				
								</table>
						</td>
						</tr>
						</table>
										<?php if(isset($_POST['dellearn'])){ 
							$learningIddd=mysql_real_escape_string($_POST['learningId']);
							$perIDlearn=mysql_real_escape_string($_POST['perId']);
							  $dellearnning= "DELETE FROM learning WHERE learningId='$learningIddd'";
										 if(mysql_query($dellearnning))
										{?>
												<script type="text/javascript">
												alert("Deleted!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perIDlearn; ?>";
												 </script>
									<?php	} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
												 </script>';
										}
						} ?>	

			  </li>
			 </li>
			</ul>
			</ul>										
					 <?php
					if(isset($_POST['modallearn'])){ ?>
							<div id="mywarning"  style="display:<?php echo $display ?>;">
							 <div id="header">
								<form action="dbmPIMWork.php?perId=<?php echo $perId; ?>" method="post">
								 <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
								</form>
								<p>&nbsp;</p>
								<center><h2>Voluntary Works :</h2></center>
								<center>
				 <table align="center" bordercolor="#cccccc"   border=4 width="90%">
				  <tr>
				  <td>
			  <table align="center" border=0 width="100%">
					    <?php
					$learn=mysql_real_escape_string($_POST['learningId']);
					$queryLe = "SELECT * FROM learning where learningId='$learn'";
					$resultLe= mysql_query($queryLe);	
					while($rowLe = mysql_fetch_assoc($resultLe)) {
						$learningTitleLe=$rowLe['learningTitle'];
						$learningSponsorLe=$rowLe['learningSponsor'];
						$learningTypeLe=$rowLe['learningType'];
						$LearningNOHLe=$rowLe['LearningNOH'];
						$incluDateFromLe=$rowLe['incluDateFrom'];
						$incluDateToLe=$rowLe['incluDateTo'];
						$dateModifiedLe=$rowLe['dateModified'];
						$perIdLe=$rowLe['perId']; 
						$learningIdLe=$rowLe['learningId']; 
					?> 
						<form action="<?php echo $editFormAction; ?>" name="formworkVU" method="POST">
								<table align="center" class="table table-striped" bordercolor="#cccccc" width="100%">
                                                <tr>
												 <td align="center"><p></p><p align="center"><label for="learningTitle">Title : <small>(Write in Full)</small></label> </p></td>
												 <td align="center">
												 <textarea type="text" name="learningTitle" id="learningTitle"  required><?php echo $learningTitleLe; ?></textarea>
                                                  </td>
												 <td align="center"><p align="center"><label for="learningSponsor">Conducted/ Sponsored By : <small>(Write in Full)</small></label></p> </td>
                                                 <td align="center">
                                                 <textarea type="text" name="learningSponsor" id="learningSponsor" required><?php echo $learningSponsorLe; ?></textarea> </td>
                                                </tr>
												 <tr>
												 <td align="center"><p align="center"><label for="learningType">Type of LD :</label> </p></td>
												 <td align="center">
												<select name="learningType" id="learningType" required>
												<option value="Managerial"<?php if($learningTypeLe == 'Managerial') { ?> selected="selected"<?php } ?>>Managerial</option>
												<option value="Supervisory"<?php if($learningTypeLe == 'Supervisory') { ?> selected="selected"<?php } ?>>Supervisory</option>
												<option value="Technical"<?php if($learningTypeLe == 'Technical') { ?> selected="selected"<?php } ?>>Technical</option>
												</select>
                                                  </td>
												 <td align="center"><p align="center"><label for="LearningNOH">No. of Hours</label></p> </td>
                                                 <td align="center">
												<input type="text" name="LearningNOH" id="LearningNOH" placeholder="required..." maxlength="5" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" value="<?php echo $LearningNOHLe ?>" required />   
												</td>                                            
												</tr>
												
												 <tr>
												 <td align="center"><p align="center"><small>Inclusive Date</small><label for="incluDateFrom">From</label> </p></td>
												 <td align="center">
												 <input type="date" name="incluDateFrom" id="incluDateFrom" placeholder="required..."  value="<?php echo $incluDateFromLe ?>" required />
                                                  </td>
												 <td align="center"><p align="center"><small>Inclusive Date</small><label for="incluDateTo">To</label></p> </td>
                                                 <td align="center">
												<input type="date" name="incluDateTo" value="<?php echo $incluDateToLe ?>" id="incluDateTo" placeholder="required..."required />
												<input type="hidden" name="perId" id="perId" value="<?php echo $perIdLe; ?>">
												<input type="hidden" name="learningId" id="learningId" value="<?php echo $learningIdLe; ?>">
												<input type="hidden" name="dateModified" id="dateModified" value="<?php echo date('Y-m-d'); ?>">
												</td>                                            
												</tr>
												<tr>
												<td colspan="4"><button type="submit" name="btnUpLearn" id="btnUpLearn" class="btn btn-mini btn-inverse span2 pull-right">Update</button></td>
												</tr>
										</table>
                                              </form>
						<?php } ?>
					    </table>
						</td>
						</tr>
						</table>
												<p></p>
											</center>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											  </div>
												</div>
											<?php } ?>
							<?php if(isset($_POST['btnUpLearn'])){		
							//$elNameU=$_POST['elName'];
							$learningTitleP=$_POST['learningTitle'];
							$learningSponsorP=$_POST['learningSponsor'];
							$learningTypeP=$_POST['learningType'];
							$LearningNOHToP=$_POST['LearningNOH'];
							$incluDateFromP=$_POST['incluDateFrom'];
							$incluDateToP=$_POST['incluDateTo'];
							$dateModifiedP=$_POST['dateModified'];
							$perIdP=$_POST['perId']; 
							$learningIdP=$_POST['learningId'];
							$queHaha = "select * from learning where learning.learningId='$learningIdP' and learning.perId='$perIdP'";
							$reHaha= mysql_query($queHaha);	
							$rereHaha = mysql_fetch_assoc($reHaha); 
								$learningTitle=$rereHaha['learningTitle'];
								$learningSponsor=$rereHaha['learningSponsor'];
								$learningType=$rereHaha['learningType'];
								$LearningNOHTo=$rereHaha['LearningNOH'];
								$incluDateFrom=$rereHaha['incluDateFrom'];
								$incluDateTo=$rereHaha['incluDateTo'];
								$dateModified=$rereHaha['dateModified'];
								$perId=$rereHaha['perId']; 
								$learningId=$rereHaha['learningId'];
							
								if($learningTitle == $learningTitleP &&  
								$learningSponsor == $learningSponsorP && 
								$learningType == $learningTypeP && 
								$LearningNOHTo == $LearningNOHToP && 
								$incluDateFrom == $incluDateFromP && 
								$incluDateTo == $incluDateToP){ ?>
							<script type="text/javascript">
												alert("You have not made any changes!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perIdP; ?>";
												 </script>
							<?php	 }else {
									$updateLearn=sprintf("UPDATE learning SET learningType=%s,learningTitle=%s,incluDateFrom=%s,incluDateTo=%s,LearningNOH=%s,learningSponsor=%s,perId=%s,dateModified=%s WHERE learningId=%s",
											   GetSQLValueString($_POST['learningType'], "text"),
											   GetSQLValueString($_POST['learningTitle'], "text"),
											   GetSQLValueString($_POST['incluDateFrom'], "date"),
											   GetSQLValueString($_POST['incluDateTo'], "date"),
											   GetSQLValueString($_POST['LearningNOH'], "int"),
											   GetSQLValueString($_POST['learningSponsor'], "text"),
											   GetSQLValueString($_POST['perId'], "int"),
											   GetSQLValueString($_POST['dateModified'], "date"),
											   GetSQLValueString($_POST['learningId'], "int"));			
									 if(mysql_query($updateLearn))
										{?>
												<script type="text/javascript">
												alert("Updated Successfully!!");
												window.location.href="dbmPIMWork.php?perId=<?php echo $perIdP; ?>";
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
