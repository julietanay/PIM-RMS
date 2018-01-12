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
                <li><a href="dbmPIMEducation.php?perId=<?php echo $persid; ?>">Education</a></li>
				<li><a href="dbmPIMWork.php?perId=<?php echo $persid; ?>">Work / Activities</a></li>
				<li class="active"><a href="dbm201.php?perId=<?php echo $persid; ?>">201 Files</a></li>
              </ul>
			
			  <?php } ?>
			  <form name="addReq" method="post" action="">
			   <table class="table"   bordercolor="#cccccc">
						 <thead> <tr bgcolor="#cccccc">
						 <td width=100%><div align="right"><input type="text" name="reqTitle" id="reqTitle" placeholder="Folder Name..." required/></div>
						<input type="hidden" name="reqDateModified" id="reqDateModified"  value=<?php echo date('Y-m-d')?> required /></td>
						 <td > <button name="reqbtn" id="reqbtn" class="btn btn-mini btn-info" ><small>Add <i class="icon-plus"></i></small></button></td>
						 </tr> </thead>
			  </table>
			</form>
					<?php 	if (isset($_POST["reqbtn"])) {
							$reqTitle = $_POST['reqTitle'];
							$reqDateModified = $_POST['reqDateModified'];
							$q = "select * from requirement where reqTitle='$reqTitle'";
							$r= mysql_query($q);	
							$c=0;
							while($rr = mysql_fetch_assoc($r)) {
							$reqT=$rr['reqTitle'];
							$c=$c+1;
							}			 
						if($c>0){
									echo '<script type="text/javascript">
												alert("Name/Title Already Exist...");
												history.back();
													 </script>';
								}else{
									$insertSQL = "INSERT INTO requirement( reqTitle, reqDateModified) VALUES ('$reqTitle','$reqDateModified')";
								 if(mysql_query($insertSQL))
										{?>
											<script type="text/javascript">
											alert("Added Successfully!!");
											window.location.href="dbm201.php?perId=<?php echo $row_Recordset1['perId']; ?>";
											 </script>
										<?php	} 
										else {
												echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
													 </script>';
											 }		
								}
							  			
											
											}	?>		
			
			
			
				<table>
				<tr bgcolor="white">
				<td> <?php $queryl = "select * from requirement order by reqDateModified desc";
						 $resultl= mysql_query($queryl);	
						 while($rowl= mysql_fetch_assoc($resultl)) { 
						 $reqId= $rowl['reqId'];
						 $reqTitle = $rowl['reqTitle'];
						 ?>
						 <div class="span2">
								<div class="content"><p></p>
									<div class="module" style="background: rgba(255,255,255,0.55); height: 30vh; padding: 0% 0% 0% 0%">
										<div class="module-body">
										<table  align="center"  width="100%" >
												<tr>
												<td align="center">	
												<a href="dbm201View.php?reqId=<?php echo $reqId; ?>&perId=<?php echo $row_Recordset1['perId']; ?>" id="StyleLink" title="View Files Inside">
												<div><img src="images/folder.png" width="100vh" height="100vh"></div></a>
												</td> 
												<td><?php 
												/*$perer=$row_Recordset1['perId'];
												$q = "select * from req_image where reqId='$reqId' and perId='$perer'";
												$r= mysql_query($q);	
												$c=0;
												while($rr = mysql_fetch_assoc($r)) {
												$c=$c+1;
												}
												if($c<=0){ ?>
													<form method="post"><button title="Delete folder" class="btn btn-danger big pull-right" name="delfolder" id="delfolder" onClick="return confirm('Are you sure you want to delete this??')"><i class="icon-trash"></i></button>
													<input type="hidden" name="reqId" id="reqId" value="<?php echo $reqId; ?>">
													<input type="hidden" name="perId" id="perId" value="<?php echo $row_Recordset1['perId']; ?>">
													</form>
													<div class="text-error pull-right"><small>(empty)</small></div> 
												<?php }*/
												?> </td>
												</tr>
												<tr>
												<td align="center" colspan=2><p></p><strong><?php echo $reqTitle ?></strong></td>
												</tr>
												</table>
										</div>
									</div>
								</div>
                    <!--/.content-->
                </div>
						 <?php } ?>	</td>
				</tr>
				</table>	
				<?php if(isset($_POST['delfolder'])){ 
							$reqIDDD=mysql_real_escape_string($_POST['reqId']);
							$perIDDD=mysql_real_escape_string($_POST['perId']);
							  $del= "DELETE FROM requirement WHERE reqId='$reqIDDD'";
										 if(mysql_query($del))
										{?>
												<script type="text/javascript">
												alert("Deleted!!");
												window.location.href="dbm201.php?perId=<?php echo $perIDDD; ?>";
												 </script>
									<?php	} 
										else {
											echo '<script type="text/javascript">
												alert("Failed!! Something went wrong...");
												history.back();
												 </script>';
										}
						} ?>
				
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
