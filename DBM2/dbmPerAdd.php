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

mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = "SELECT * FROM personnel";
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
						$tfperAgenEmpNo1 = $_POST['perAgenEmpNo1'];
						$tfperAgenEmpNo2 = '-'.$_POST['perAgenEmpNo2'];
						$tfperAgenEmpNo3 = '-'.$_POST['perAgenEmpNo3'];
						$tfperAgenEmpNo4 = '-'.$_POST['perAgenEmpNo4'];
						$tfperAgenEmpNo = $tfperAgenEmpNo1.$tfperAgenEmpNo2.$tfperAgenEmpNo3.$tfperAgenEmpNo4;
						$tfperGSISno1 = $_POST['perGSISno1'];
						$tfperGSISno2 = '-'.$_POST['perGSISno2'];
						$tfperGSISno3 = '-'.$_POST['perGSISno3'];
						$tfperGSISno4 = '-'.$_POST['perGSISno4'];
						$tfperGSISno = $tfperGSISno1.$tfperGSISno2.$tfperGSISno3.$tfperGSISno4;
						$tfperPagIbigNo1 = $_POST['perPagIbigNo1'];
						$tfperPagIbigNo2 = '-'.$_POST['perPagIbigNo2'];
						$tfperPagIbigNo3 = '-'.$_POST['perPagIbigNo3'];
						$tfperPagIbigNo = $tfperPagIbigNo1.$tfperPagIbigNo2.$tfperPagIbigNo3;
						$tfperPhilno1 = $_POST['perPhilHno1'];
						$tfperPhilno2 = '-'.$_POST['perPhilHno2'];
						$tfperPhilno3 = '-'.$_POST['perPhilHno3'];
						$tfperPhilno = $tfperPhilno1.$tfperPhilno2.$tfperPhilno3;
						$tfperSSSno1 = $_POST['perSSSNo1'];
						$tfperSSSno2 = '-'.$_POST['perSSSNo2'];
						$tfperSSSno3 = '-'.$_POST['perSSSNo3'];
						$tfperSSSno = $tfperSSSno1.$tfperSSSno2.$tfperSSSno3;
						$tfperBIRno1 = $_POST['perBIRno1'];
						$tfperBIRno2 = '-'.$_POST['perBIRno2'];
						$tfperBIRno3 = '-'.$_POST['perBIRno3'];
						$tfperBIRno4 = '-'.$_POST['perBIRno4'];
						$tfperBIRno = $tfperBIRno1.$tfperBIRno2.$tfperBIRno3.$tfperBIRno4;
						$tfperTINno1 = $_POST['perTINno1'];
						$tfperTINno2 = '-'.$_POST['perTINno2'];
						$tfperTINno3 = '-'.$_POST['perTINno3'];
						$tfperTINno4 = '-'.$_POST['perTINno4'];
						$tfperTINno = $tfperTINno1.$tfperTINno2.$tfperTINno3.$tfperTINno4;
						$tfperMobileNo = $_POST['PerMobileNo'];
						$tfperTelNo = $_POST['perTelno'];
						$tfperEmail = $_POST['perEmail'];
						$null=Null;
						$query4 = "SELECT *	FROM personnel where perAgenEmpNo!=$null OR perGSISno!=$null OR perPagIbigNo!=$null OR perPhilHno!=$null OR perSSSno!=$null OR perBIRno!=$null OR perTINno!=$null OR perMobileNo!=$null OR perTelno!=$null OR perEmail!=$null";
						$result4= mysql_query($query4);	
						while($row4= mysql_fetch_assoc($result4)){
							$perperAgenEmpNo = $row4['perAgenEmpNo'];
							$perperGSISno = $row4['perGSISno'];
							$perperPagIbigNo = $row4['perPagIbigNo'];
							$perperPhilno = $row4['perPhilHno'];
							$perperSSSno = $row4['perSSSno'];
							$perperBIRno = $row4['perBIRno'];
							$perperTINno = $row4['perTINno'];
							$perperMobileNo = $row4['perMobileNo'];
							$perperTelNo = $row4['perTelno'];
							$perperId = $row4['perId'];
							$perperEmail = $row4['perEmail'];
						if($tfperAgenEmpNo==$perperAgenEmpNo ||
						$tfperGSISno==$perperGSISno|| 
						$tfperPagIbigNo==$perperPagIbigNo|| 
						$tfperPhilno==$perperPhilno|| 
						$tfperSSSno==$perperSSSno|| 
						$tfperBIRno==$perperBIRno|| 
						$tfperTINno==$perperTINno|| 
						$tfperMobileNo==$perperMobileNo|| 
						$tfperTelNo==$perperTelNo ||
						$tfperEmail==$perperEmail ){
						$equal='yes';
						}else {
							$equalno='no';
						}
					}	
					if($equal){
						 echo '<script type="text/javascript">
							    alert("OOPS!! Action cannot proceed...Duplicate Entry detected...");
							    history.back();
							     </script>';
								 
					} else {
  $insertSQL = sprintf("INSERT INTO personnel (perPosition, perAppStat, perFname, perMname, perLname, perExtName, perGender, perEmail, perBday, perBPlace, perMobileNo, perTelno, perHeight, perWeight, perBloodType, perBIRno, perAgenEmpNo, perGSISno, perPagIbigNo, perPhilHno, perSSSno, perStatus, perTransferee, perDateTrans, perTINno, perDateModified, divId, perCit, perCitNature, perCitCountry, perMonSalary, perDateStarted, perDateEnded, perHouseNo, perStreet, perSubdivision, perBrgy, perCity, perProvince, perAddType, perZip) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['perPosition'], "int"),
                       GetSQLValueString($_POST['perAppStat'], "text"),
                       GetSQLValueString($_POST['perFname'], "text"),
                       GetSQLValueString($_POST['perMname'], "text"),
                       GetSQLValueString($_POST['perLname'], "text"),
                       GetSQLValueString($_POST['perExtName'], "text"),
                       GetSQLValueString($_POST['perGender'], "text"),
                       GetSQLValueString($_POST['perEmail'], "text"),
                       GetSQLValueString($_POST['perBday'], "date"),
                       GetSQLValueString($_POST['perBPlace'], "text"),
                       GetSQLValueString($_POST['PerMobileNo'], "text"),
                       GetSQLValueString($_POST['perTelno'], "text"),
                       GetSQLValueString($_POST['perHeight'], "double"),
                       GetSQLValueString($_POST['perWeight'], "double"),
                       GetSQLValueString($_POST['perBloodType'], "text"),
                       GetSQLValueString($tfperBIRno, "text"),
                       GetSQLValueString($tfperAgenEmpNo, "text"),
                       GetSQLValueString($tfperGSISno, "text"),
                       GetSQLValueString($tfperPagIbigNo, "text"),
                       GetSQLValueString($tfperPhilno, "text"),
                       GetSQLValueString($tfperSSSno, "text"),
                       GetSQLValueString($_POST['perStatus'], "text"),
                       GetSQLValueString($_POST['perTransferee'], "text"),
                       GetSQLValueString($_POST['perDateTrans'], "date"),
                       GetSQLValueString($tfperTINno, "text"),
                       GetSQLValueString($_POST['perDateModified'], "date"),
                       GetSQLValueString($_POST['divId'], "int"),
                       GetSQLValueString($_POST['perCit'], "text"),
                       GetSQLValueString($_POST['perCitNature'], "text"),
                       GetSQLValueString($_POST['perCitCountry'], "text"),
                       GetSQLValueString($_POST['perMonSalary'], "double"),
                       GetSQLValueString($_POST['perDateStarted'], "date"),
                       GetSQLValueString($_POST['perDateEnded'], "date"),
					   GetSQLValueString($_POST['perHouseNo'], "date"),
					   GetSQLValueString($_POST['perStreet'], "date"),
					   GetSQLValueString($_POST['perSubdivision'], "date"),
					   GetSQLValueString($_POST['perBrgy'], "date"),
					   GetSQLValueString($_POST['perCity'], "date"),
					   GetSQLValueString($_POST['perProvince'], "date"),
					   GetSQLValueString($_POST['perAddType'], "date"),
					   GetSQLValueString($_POST['perZip'], "date"));
					  mysql_select_db($database_dbmrov, $dbmrov);
					  $Result1 = mysql_query($insertSQL, $dbmrov) or die(mysql_error());

					 $insertGoTo = "dbmPIMProfilePic.php";
				     if (isset($_SERVER['QUERY_STRING'])) {
					 $insertGoTo .= "?perId=" . mysql_insert_id();
					 // $insertGoTo .= $_SERVER['QUERY_STRING'];
				     }
				 header(sprintf("Location: %s", $insertGoTo));		
  
 }
}
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
background-color: rgba(0,0,0, .5); 
 
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
                              
                               
                                <div class="profile-tab-content tab-content">
                                    <div class="tab-pane fade active in" id="Division">
                                        <div class="stream-list">
                                            <div class="media stream">
                                                <div class="media-body">
                                                    <div class="stream-headline">
														<table align="center" width="100%">
														<tr bgcolor="#6699CC">
														<td >
														 <h2 class="stream-author">
                                                          <font color="white"> &nbsp;&nbsp;&nbsp; Add Personnel </font>
                                                        </h2>
														</td>
														</tr>
														<tr>
														<td bgcolor="#DBDBDB" colspan=2> 
                                                        <div class="stream-text">
														<p></p>
												<form action="<?php echo $editFormAction; ?>" name="form1" method="POST" class="form-horizontal row-fluid">
									<div class="control-group">
											<label class="control-label" for="perAgenEmpNo">Agency Employee No.</label>
											<div class="controls">
											<input class="span1" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perAgenEmpNo1" name="perAgenEmpNo1" required/> - 
											<input class="span1" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perAgenEmpNo2" name="perAgenEmpNo2" required/> - 
											<input class="span1" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perAgenEmpNo3" name="perAgenEmpNo3" required/> -
											<input class="span1" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perAgenEmpNo4" name="perAgenEmpNo4"/>    											
									</div>
										</div>
											<div class="control-group">
											  <label class="control-label" for="perPosition">Position Name</label> 
											<div class="controls">
											   <select tabindex="1" class="span5" name="perPosition" id="perPosition" required>
											    <option value="">Select Position...</option>
											    <?php 
													  $result = $conn->query("select * from positions"); 
													  while ($row = $result->fetch_assoc()) 
													  {

														  unset($id, $name);
														  $id = $row['posId'];
														  $name=$row['posName'];
														 
														  echo '<option value="'.$id.'"> '.$name.'  </option>';
														 
													 }
													  
													?>
										    </select> <a href="dbmAddPosition.php" class="btn btn-mini btn-primary"><i class="menu-icon icon-plus"></i> </a>
										   </div>
							  </div>
							  
							   <div class="control-group">
											<label class="control-label" for="divId">Division</label> 
											<div class="controls">
											  <select tabindex="1" class="span5" name="divId" id="divId" required>
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
										    </select> <a href="dbmAddDivision.php" class="btn btn-mini btn-primary"><i class="menu-icon icon-plus"> </i></a>
											</div>
										</div>
											<div class="control-group">
											<label class="control-label" for="perFname">Firstname</label>
											<div class="controls">
												<input type="text" placeholder="Required..." name="perFname" id="perFname"  class="span8" required>
											
											</div>
									  </div>
									  
										<div class="control-group">
											<label class="control-label" for="perMname">Middlename</label>
											<div class="controls">
												<input type="text" placeholder="Required..." name="perMname" id="perMname" class="span8" required> 
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="perLname">Lastname</label>
											<div class="controls">
												<input type="text" placeholder="Required..."  id="perLname" name="perLname"  class="span8" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="perExtName">Extension Name</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span5" name="perExtName" id="perExtName" >
													<option value="">Select here..</option>
													<option value="Jr" >Jr</option>
													<option value="Sr">Sr</option>
													<option value="II">II</option>
													<option value="II">II</option>
													<option value="IV">IV</option>
													<option value="V">V</option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="perMonSalary">Monthly Salary</label>
											<div class="controls">
												<input type="Number" placeholder="Required..." name="perMonSalary" id="perMonSalary" class="span8" required>
											</div>
									  </div>
									  
									 <div class="control-group">
									  <label class="control-label">Transferee ?</label>
											<div class="controls">
												<input type="checkbox" onclick="var select = document.getElementById('perTransferee');
												var input = document.getElementById('perDateTrans');
												if(this.checked){ 
												input.disabled = false; input.focus();
												select.disabled = false; select.focus();
												} else{
													input.disabled=true;
													select.disabled = true;
												}" />
												<select tabindex="1" class="span4" name="perTransferee" id="perTransferee" disabled="disabled" required>
											    <option value=" ">Select Previous Division...</option>
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
											Date transferred
											<input type="date" placeholder="Date Transferred..." name="perDateTrans" id="perDateTrans" class="span4" disabled="disabled" required>

											</div>
											
										</div>
									 
										  <div class="control-group">
											<label class="control-label" for="perAppStat">Employment Status</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span5" name="perAppStat" id="perAppStat" required>
													<option value="">Select here..</option>
													<option value="Permanent">Permanent</option>
													<option value="Provisional">Provisional</option>
													<option value="Temporary">Temporary</option>
													<option value="Substitute">Substitute</option>
													<option value="Co-terminous">Co-terminous</option>
													<option value="Contractual">Contractual</option>
													<option value="Casual">Casual</option>
												</select>
										   </div>
										</div>
										 <div class="control-group">
                                       
											<label class="control-label" for="perDateStarted">Date Started : </label>
											<div class="controls">
											<input class="span4" type="date" id="perDateStarted" name="perDateStarted"  required>  
											<input class="span4" placeholder="Unchecked If Applicable..." type="hidden" id="perDateEnded" name="perDateEnded"/> 
												</div>    
										</div>
										<div class="control-group">
											<label class="control-label" for="perTINno">TIN No.</label>
											<div class="controls ">
											<input class="span1" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perTINno1" name="perTINno1" Required/> - 
											<input class="span1" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perTINno2" name="perTINno2" Required/> - 
											<input class="span1" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perTINno3" name="perTINno3" Required/> - 
											<input class="span1" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perTINno4" name="perTINno4" /> 
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BIR No.
											<input class="span1"  maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perBIRno1" name="perBIRno1" /> - 
											<input class="span1"  maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perBIRno2" name="perBIRno2" /> - 
											<input class="span1"  maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perBIRno3" name="perBIRno3" /> - 
											<input class="span1"  maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perBIRno4" name="perBIRno4" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="perGSISno">GSIS No.</label>
											<div class="controls">
											<input class="span1"  maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perGSISno1" name="perGSISno1" /> - 
											<input class="span1"  maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perGSISno2" name="perGSISno2" /> - 
											<input class="span1"  maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perGSISno3" name="perGSISno3" /> - 
											<input class="span1"  maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000" type="text" id="perGSISno4" name="perGSISno4" /> 
											&nbsp;&nbsp;PhilHealth No.
											<input class="span1"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="00" type="text" id="perPhilHno1" name="perPhilHno1" /> - 
											<input class="span2"  maxlength="9" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000000000" type="text" id="perPhilHno2" name="perPhilHno2" /> - 
											<input class="span1"  maxlength="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="0" type="text" id="perPhilHno3" name="perPhilHno3" /> 
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="perPagIbigNo">PagIbig No.</label>
											<div class="controls">
											<input class="span1"  maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="0000" type="text" id="perPagIbigNo1" name="perPagIbigNo1" /> - 
											<input class="span1"  maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="0000" type="text" id="perPagIbigNo2" name="perPagIbigNo2" /> - 
											<input class="span1"  maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="0000" type="text" id="perPagIbigNo3" name="perPagIbigNo3" /> 
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SSS No.
											<input class="span1"  maxlength="2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="00" type="text" id="perSSSNo1" name="perSSSNo1" /> - 
											<input class="span2"  maxlength="9" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="000000000" type="text" id="perSSSNo2" name="perSSSNo2" /> - 
											<input class="span1"  maxlength="1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="0" type="text" id="perSSSNo3" name="perSSSNo3" /> 
											</div>
										</div>
                                        
										<div class="control-group">
											<label class="control-label">Gender</label>
											<div class="controls">
												<label class="radio">
													<input type="radio" name="perGender" id="perGender" value="Female" checked="">
													Female
												</label> 
												<label class="radio">
													<input type="radio" name="perGender" id="perGender" value="Male">
													Male
												</label> 
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="perBday">Birthday</label>
											<div class="controls">
												<input type="Date" name="perBday" id="perBday" placeholder="Type something here..." class="span8" required>
											</div>
										</div>	
										
										<div class="control-group">
											<label class="control-label" for="perBPlace">Birthplace</label>
											<div class="controls">
												<textarea class="span8" rows="3" name="perBPlace" id="perBPlace" required></textarea>
											</div>
										</div>		
										<div class="control-group">
											<label class="control-label" for="perStatus">Civil Status</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span5" name="perStatus" id="perStatus" required>
													<option value="">Select here..</option>
													<option value="Single">Single</option>
													<option value="Married">Married</option>
													<option value="Widowed">Widowed</option>
													<option value="Widowed">Separated</option>
												</select>
											</div>
											
										</div>

										<div class="control-group">
											<label class="control-label" for="perCit">Citizenship</label>
											<div class="controls">
											<label class="radio">
													<input type="radio" name="perCit" id="perCit" value="Filipino" checked="">
													Filipino
												</label> 
											<label class="radio"> Dual Citizenship
												<input type="checkbox" onclick="var select = document.getElementById('perCitNature');
												var input = document.getElementById('perCitCountry');
												if(this.checked){ 
												input.disabled = false; input.focus();
												select.disabled = false; select.focus();
												} else{
													input.disabled=true;
													select.disabled = true;
												}" />
												
													<select tabindex="1" data-placeholder="Select here.." class="span4" name="perCitNature" id="perCitNature" disabled="disabled" required>
													<option value="">Choose Nature...</option>
													<option value="By Birth">By Birth</option>
													<option value="By Naturalization">By Naturalization</option>
												</select>
												
												<select tabindex="1" data-placeholder="Select here.." class="span4" name="perCitCountry" id="perCitCountry" disabled="disabled" required>
													<option value="">Choose Country...</option>
													<option value="Afghanistan">Afghanistan</option>
													<option value="Albania">Albania</option>
													<option value="Algeria">Algeria</option>
													<option value="American Samoa">American Samoa</option>
													<option value="Andorra">Andorra</option>
													<option value="Angola">Angola</option>
													<option value="Anguilla">Anguilla</option>
													<option value="Antartica">Antarctica</option>
													<option value="Antigua and Barbuda">Antigua and Barbuda</option>
													<option value="Argentina">Argentina</option>
													<option value="Armenia">Armenia</option>
													<option value="Aruba">Aruba</option>
													<option value="Australia">Australia</option>
													<option value="Austria">Austria</option>
													<option value="Azerbaijan">Azerbaijan</option>
													<option value="Bahamas">Bahamas</option>
													<option value="Bahrain">Bahrain</option>
													<option value="Bangladesh">Bangladesh</option>
													<option value="Barbados">Barbados</option>
													<option value="Belarus">Belarus</option>
													<option value="Belgium">Belgium</option>
													<option value="Belize">Belize</option>
													<option value="Benin">Benin</option>
													<option value="Bermuda">Bermuda</option>
													<option value="Bhutan">Bhutan</option>
													<option value="Bolivia">Bolivia</option>
													<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
													<option value="Botswana">Botswana</option>
													<option value="Bouvet Island">Bouvet Island</option>
													<option value="Brazil">Brazil</option>
													<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
													<option value="Brunei Darussalam">Brunei Darussalam</option>
													<option value="Bulgaria">Bulgaria</option>
													<option value="Burkina Faso">Burkina Faso</option>
													<option value="Burundi">Burundi</option>
													<option value="Cambodia">Cambodia</option>
													<option value="Cameroon">Cameroon</option>
													<option value="Canada">Canada</option>
													<option value="Cape Verde">Cape Verde</option>
													<option value="Cayman Islands">Cayman Islands</option>
													<option value="Central African Republic">Central African Republic</option>
													<option value="Chad">Chad</option>
													<option value="Chile">Chile</option>
													<option value="China">China</option>
													<option value="Christmas Island">Christmas Island</option>
													<option value="Cocos Islands">Cocos (Keeling) Islands</option>
													<option value="Colombia">Colombia</option>
													<option value="Comoros">Comoros</option>
													<option value="Congo">Congo</option>
													<option value="Congo">Congo, the Democratic Republic of the</option>
													<option value="Cook Islands">Cook Islands</option>
													<option value="Costa Rica">Costa Rica</option>
													<option value="Cota D'Ivoire">Cote d'Ivoire</option>
													<option value="Croatia">Croatia (Hrvatska)</option>
													<option value="Cuba">Cuba</option>
													<option value="Cyprus">Cyprus</option>
													<option value="Czech Republic">Czech Republic</option>
													<option value="Denmark">Denmark</option>
													<option value="Djibouti">Djibouti</option>
													<option value="Dominica">Dominica</option>
													<option value="Dominican Republic">Dominican Republic</option>
													<option value="East Timor">East Timor</option>
													<option value="Ecuador">Ecuador</option>
													<option value="Egypt">Egypt</option>
													<option value="El Salvador">El Salvador</option>
													<option value="Equatorial Guinea">Equatorial Guinea</option>
													<option value="Eritrea">Eritrea</option>
													<option value="Estonia">Estonia</option>
													<option value="Ethiopia">Ethiopia</option>
													<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
													<option value="Faroe Islands">Faroe Islands</option>
													<option value="Fiji">Fiji</option>
													<option value="Finland">Finland</option>
													<option value="France">France</option>
													<option value="France Metropolitan">France, Metropolitan</option>
													<option value="French Guiana">French Guiana</option>
													<option value="French Polynesia">French Polynesia</option>
													<option value="French Southern Territories">French Southern Territories</option>
													<option value="Gabon">Gabon</option>
													<option value="Gambia">Gambia</option>
													<option value="Georgia">Georgia</option>
													<option value="Germany">Germany</option>
													<option value="Ghana">Ghana</option>
													<option value="Gibraltar">Gibraltar</option>
													<option value="Greece">Greece</option>
													<option value="Greenland">Greenland</option>
													<option value="Grenada">Grenada</option>
													<option value="Guadeloupe">Guadeloupe</option>
													<option value="Guam">Guam</option>
													<option value="Guatemala">Guatemala</option>
													<option value="Guinea">Guinea</option>
													<option value="Guinea-Bissau">Guinea-Bissau</option>
													<option value="Guyana">Guyana</option>
													<option value="Haiti">Haiti</option>
													<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
													<option value="Holy See">Holy See (Vatican City State)</option>
													<option value="Honduras">Honduras</option>
													<option value="Hong Kong">Hong Kong</option>
													<option value="Hungary">Hungary</option>
													<option value="Iceland">Iceland</option>
													<option value="India">India</option>
													<option value="Indonesia">Indonesia</option>
													<option value="Iran">Iran (Islamic Republic of)</option>
													<option value="Iraq">Iraq</option>
													<option value="Ireland">Ireland</option>
													<option value="Israel">Israel</option>
													<option value="Italy">Italy</option>
													<option value="Jamaica">Jamaica</option>
													<option value="Japan">Japan</option>
													<option value="Jordan">Jordan</option>
													<option value="Kazakhstan">Kazakhstan</option>
													<option value="Kenya">Kenya</option>
													<option value="Kiribati">Kiribati</option>
													<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
													<option value="Korea">Korea, Republic of</option>
													<option value="Kuwait">Kuwait</option>
													<option value="Kyrgyzstan">Kyrgyzstan</option>
													<option value="Lao">Lao People's Democratic Republic</option>
													<option value="Latvia">Latvia</option>
													<option value="Lebanon">Lebanon</option>
													<option value="Lesotho">Lesotho</option>
													<option value="Liberia">Liberia</option>
													<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
													<option value="Liechtenstein">Liechtenstein</option>
													<option value="Lithuania">Lithuania</option>
													<option value="Luxembourg">Luxembourg</option>
													<option value="Macau">Macau</option>
													<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
													<option value="Madagascar">Madagascar</option>
													<option value="Malawi">Malawi</option>
													<option value="Malaysia">Malaysia</option>
													<option value="Maldives">Maldives</option>
													<option value="Mali">Mali</option>
													<option value="Malta">Malta</option>
													<option value="Marshall Islands">Marshall Islands</option>
													<option value="Martinique">Martinique</option>
													<option value="Mauritania">Mauritania</option>
													<option value="Mauritius">Mauritius</option>
													<option value="Mayotte">Mayotte</option>
													<option value="Mexico">Mexico</option>
													<option value="Micronesia">Micronesia, Federated States of</option>
													<option value="Moldova">Moldova, Republic of</option>
													<option value="Monaco">Monaco</option>
													<option value="Mongolia">Mongolia</option>
													<option value="Montserrat">Montserrat</option>
													<option value="Morocco">Morocco</option>
													<option value="Mozambique">Mozambique</option>
													<option value="Myanmar">Myanmar</option>
													<option value="Namibia">Namibia</option>
													<option value="Nauru">Nauru</option>
													<option value="Nepal">Nepal</option>
													<option value="Netherlands">Netherlands</option>
													<option value="Netherlands Antilles">Netherlands Antilles</option>
													<option value="New Caledonia">New Caledonia</option>
													<option value="New Zealand">New Zealand</option>
													<option value="Nicaragua">Nicaragua</option>
													<option value="Niger">Niger</option>
													<option value="Nigeria">Nigeria</option>
													<option value="Niue">Niue</option>
													<option value="Norfolk Island">Norfolk Island</option>
													<option value="Northern Mariana Islands">Northern Mariana Islands</option>
													<option value="Norway">Norway</option>
													<option value="Oman">Oman</option>
													<option value="Pakistan">Pakistan</option>
													<option value="Palau">Palau</option>
													<option value="Panama">Panama</option>
													<option value="Papua New Guinea">Papua New Guinea</option>
													<option value="Paraguay">Paraguay</option>
													<option value="Peru">Peru</option>
													<option value="Pitcairn">Pitcairn</option>
													<option value="Poland">Poland</option>
													<option value="Portugal">Portugal</option>
													<option value="Puerto Rico">Puerto Rico</option>
													<option value="Qatar">Qatar</option>
													<option value="Reunion">Reunion</option>
													<option value="Romania">Romania</option>
													<option value="Russia">Russian Federation</option>
													<option value="Rwanda">Rwanda</option>
													<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
													<option value="Saint LUCIA">Saint LUCIA</option>
													<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
													<option value="Samoa">Samoa</option>
													<option value="San Marino">San Marino</option>
													<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
													<option value="Saudi Arabia">Saudi Arabia</option>
													<option value="Senegal">Senegal</option>
													<option value="Seychelles">Seychelles</option>
													<option value="Sierra">Sierra Leone</option>
													<option value="Singapore">Singapore</option>
													<option value="Slovakia">Slovakia (Slovak Republic)</option>
													<option value="Slovenia">Slovenia</option>
													<option value="Solomon Islands">Solomon Islands</option>
													<option value="Somalia">Somalia</option>
													<option value="South Africa">South Africa</option>
													<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
													<option value="Spain">Spain</option>
													<option value="SriLanka">Sri Lanka</option>
													<option value="St. Helena">St. Helena</option>
													<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
													<option value="Sudan">Sudan</option>
													<option value="Suriname">Suriname</option>
													<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
													<option value="Swaziland">Swaziland</option>
													<option value="Sweden">Sweden</option>
													<option value="Switzerland">Switzerland</option>
													<option value="Syria">Syrian Arab Republic</option>
													<option value="Taiwan">Taiwan, Province of China</option>
													<option value="Tajikistan">Tajikistan</option>
													<option value="Tanzania">Tanzania, United Republic of</option>
													<option value="Thailand">Thailand</option>
													<option value="Togo">Togo</option>
													<option value="Tokelau">Tokelau</option>
													<option value="Tonga">Tonga</option>
													<option value="Trinidad and Tobago">Trinidad and Tobago</option>
													<option value="Tunisia">Tunisia</option>
													<option value="Turkey">Turkey</option>
													<option value="Turkmenistan">Turkmenistan</option>
													<option value="Turks and Caicos">Turks and Caicos Islands</option>
													<option value="Tuvalu">Tuvalu</option>
													<option value="Uganda">Uganda</option>
													<option value="Ukraine">Ukraine</option>
													<option value="United Arab Emirates">United Arab Emirates</option>
													<option value="United Kingdom">United Kingdom</option>
													<option value="United States">United States</option>
													<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
													<option value="Uruguay">Uruguay</option>
													<option value="Uzbekistan">Uzbekistan</option>
													<option value="Vanuatu">Vanuatu</option>
													<option value="Venezuela">Venezuela</option>
													<option value="Vietnam">Viet Nam</option>
													<option value="Virgin Islands (British)">Virgin Islands (British)</option>
													<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
													<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
													<option value="Western Sahara">Western Sahara</option>
													<option value="Yemen">Yemen</option>
													<option value="Yugoslavia">Yugoslavia</option>
													<option value="Zambia">Zambia</option>
													<option value="Zimbabwe">Zimbabwe</option>
												</select>
												</label> 
											</div>
										</div>
<script>
var provinceCity = {};
provinceCity['Abra'] = ['Bangued', 'Boliney', 'Bucay ', 'Bucloc','Daguioman','Danglas','Dolores','La Paz','Lacub','Lagangilang','Lagayan','Langiden','Licuan-Baay','Luba','Malibcong','Manabo','Peñarrubia','Pidigan','Pilar','Sallapadan','San Isidro','San Juan','San Quintin','Tayum','Tineg','Tubo', 'Villaviciosa '];	
provinceCity['Agusan del Norte'] = ['Butuan City ',	'Cabadbaran City',	'Buenavista', 'Carmen','Jabonga','Kitcharao','Las Nieves','Magallanes','Nasipit','Remedios T. Romualdez','Santiago','Tubay']	;
provinceCity['Agusan del Sur'] = ['Bayugan',	'Bunawan',	'Esperanza','La Paz','Loreto','Prosperidad','Rosario','San Francisco','San Luis','Santa Josefa','Sibagat','Talacogon','Trento','Veruela'];	
provinceCity['Aklan'] = ['Altavas',	'Balete',	'Banga','Batan','Buruanga','Ibajay','Kalibo','Lezo','Libacao','Madalag','Makato','Malay','Malinao','Nabas','New Washington','Numancia','Tangalan'];
provinceCity['Albay'] = ['Ligao City',	'Tabaco City',	'Bacacay','Camalig','Daraga','Guinobatan','Jovellar','Libon','Malilipot','Malinao','Manito','Oas','Pio Duran','Polangui','Rapu-Rapu','Santo Domingo','Tiwi'];
provinceCity['Antique'] = ['Anini-y','Barbaza',	'Belison','Bugasong','Caluya','Culasi','Hamtic','Laua-an','Libertad','Pandan','Patnongon','San Jose','San Remigio','Sebaste','Sibalom','Tibiao','Tobias Fornier','Valderrama'];
provinceCity['Apayao'] = ['Calanasan',	'Conner',	'Kabugao','Luna','Pudtol','Santa Marcela'];
provinceCity['Aurora'] = ['Baler','Casiguran','Dilasag','Dinalungan','Dingalan','Dipaculao','Maria Aurora','San Luis']	;
provinceCity['Basilan'] = ['Isabela City',	'Lamitan City',	'Akbar','Al-Barka','Hadji Mohammad Aju','Lantawan','Maluso','Sumisip','Tipo-Tipo','Tuburan','Ungkaya Pukan'];
provinceCity['Bataan'] = ['Balanga City','Abucay','Bagac','Dinalupihan','Hermosa','Limay','Mariveles','Morong','Orani','Orion','Pilar','Samal'];
provinceCity['Batanes'] = ['Basco',	'Itbayat',	'Ivana','Mahatao','Sabtang','Uyugan'];  
provinceCity['Batangas'] = ['Batangas City',	'Lipa City',	'Tanauan City','Agoncillo','Alitagtag','Balayan','Balete','Bauan','Calaca','Calatagan','Cuenca','Ibaan','Laurel','Lemery','Lian','Lobo','Mabini','Malvar','Mataas na Kahoy','Nasugbu','Padre Garcia','Rosario','San Jose','San Juan','San Luis','San Nicolas','San Pascual','Santa Teresita','Santo Tomas','Taal','Talisay','Taysan','Tingloy','Tuy'];
provinceCity['Benguet'] = ['Baguio City',	'Atok',	'Bakun','Bokod','Buguias','Itogon','Kabayan','Kapangan','Kibungan','La Trinidad','Mankayan','Sablan','Tuba','Tublay'];
provinceCity['Biliran'] = ['Almeria',	'Biliran',	'Cabucgayan','Caibiran','Culaba','Kawayan','Maripipi','Naval']	;
provinceCity['Bohol'] = ['Tagbilaran City',	'Alburquerque',	'Alicia','Anda','Antequera','Baclayon','Balilihan','Batuan','Bien Unido','Bilar','Buenavista','Calape','Candijay','Carmen','Catigbian','Clarin','Corella','Cortes','Dagohoy','Danao','Dauis','Dimiao','Duero','Garcia Hernandez','Guindulman','Inabanga','Jagna','Jetafe','Lila','Loay','Loboc','Loon','Mabini','Maribojoc','Panglao','Pilar','Pres. Carlos P. Garcia','Sagbayan','San Isidro','San Miguel','Sevilla','Sierra Bullones','Sikatuna','Talibon','Trinidad','Tubigon','Ubay','Valencia'];
provinceCity['Bukidnon'] = ['Malaybalay City',	'Valencia City',	'Baungon','Cabanglasan','Damulog','Dangcagan','Don Carlos','Impasug-Ong','Kadingilan','Kalilangan','Kibawe','Kitaotao','Lantapan','Libona','Malitbog','Manolo Fortich','Maramag','Pangantucan','Quezon','San Fernando','Sumilao','Talakag']	;
provinceCity['Bulacan'] = ['Malolos City','Meycauayan City','San Jose del Monte City','Angat','Balagtas','Baliuag','Bocaue','Bulacan','Bustos','Calumpit','Doña Remedios Trinidad','Guiguinto','Hagonoy','Marilao','Norzagaray','Obando','Pandi','Paombong','Plaridel','Pulilan','San Ildefonso','San Miguel','San Rafael','Santa Maria'];
provinceCity['Cagayan'] = ['Tuguegarao City','Abulug','Alcala','Allacapan','Amulung','Aparri','Baggao','Ballesteros','Buguey','Calayan','Camalaniugan','Claveria','Enrile','Gattaran','Gonzaga','Iguig','Lal-Lo','Lasam','Pamplona','Peñablanca','Piat','Rizal','Sanchez-Mira','Santa Ana','Santa Praxedes','Santa Teresita','Santo Niño','Solana','Tuao'];
provinceCity['Camarines Norte'] = ['Basud','Capalonga','Daet','Jose Panganiban','Labo','Mercedes','Paracale','San Lorenzo Ruiz','San Vicente','Santa Elena','Talisay','Vinzons'];
provinceCity['Camarines Sur'] = ['Iriga City','Naga City','Baao','Balatan','Bato','Bombon','Buhi','Bula','Cabusao','Calabanga','Camaligan','Canaman','Caramoan','Del Gallego','Gainza','Garchitorena','Goa','Lagonoy','Libmanan','Lupi','Magarao','Milaor','Minalabac','Nabua','Ocampo','Pamplona','Pasacao','Pili','Presentacion','Ragay','Sagñay','San Fernando','San Jose','Sipocot','Siruma','Tigaon','Tinambac'];
provinceCity['Camiguin'] = ['Catarman','Guinsiliban','Mahinog','Mambajao','Sagay'];
provinceCity['Capiz'] = ['Roxas City','Cuartero','Dao','Dumalag','Dumarao','Ivisan','Jamindan','Ma-ayon','Mambusao','Panay','Panitan','Pilar','Pontevedra','President Roxas','Sapi-an','Sigma','Tapaz']	;
provinceCity['Catanduanes'] = ['Bagamanoc',	'Baras',	'Bato','Caramoran','Gigmoto','Pandan','Panganiban','San Andres','San Miguel','Viga','Virac'];
provinceCity['Cavite'] = ['Cavite City', 'Tagaytay City', 'Trece Martires City','Alfonso','Amadeo','Bacoor','Carmona','Dasmariñas','Gen. Mariano Alvarez','Gen. Emilio Aguinaldo','Gen. Trias','Imus','Indang','Kawit','Magallanes','Maragondon','Mendez','Naic','Noveleta','Rosario','Silang','Tanza','Ternate'];
provinceCity['Cebu'] = ['Argao City',	'Bogo City',	'Carcar City','Cebu City','Danao City','Lapu-Lapu City','Mandaue City','Talisay City','Toledo City','Naga City','Alcantara','Alcoy','Alegria','Aloguinsan','Argao','Asturias','Badian','Balamban','Bantayan','Barili','Boljoon','Borbon','Carmen','Catmon','Compostela','Consolacion','Cordoba','Daanbantayan','Dalaguete','Ginatilan','Liloan','Madridejos','Malabuyoc','Medellin','Minglanilla','Moalboal','Oslob','Pilar','Pinamungahan','Poro','Ronda','Samboan','San Fernando','San Francisco','San Remigio','Santa Fe','Santander','Sibonga','Sogod','Tabogon','Tabuelan','Tuburan','Tudela'];
provinceCity['Compostela Valley'] = ['Compostela',	'Laak',	'Mabini','Maco','Maragusan','Mawab','Monkayo','Montevista','Nabunturan','New Bataan','Pantukan'];
provinceCity['Cotabato'] = ['Kidapawan City','Alamada ','Aleosan','Antipas','Arakan','Banisilan','Carmen','Kabacan','Libungan',"M'Lang",'Magpet','Makilala','Matalam','Midsayap','Pigkawayan','Pikit','President Roxas','Tulunan'];
provinceCity['Davao del Norte'] = ['Island Garden City of Samal','Panabo City',	'Tagum City','Asuncion','Braulio E. Dujali','Carmen','Kapalong','New Corella','San Isidro','Santo Tomas','Talaingod'];
provinceCity['Davao del Sur'] = ['Davao City', 'Digos City', 'Bansalan','Don Marcelino','Hagonoy','Jose Abad Santos','Kiblawan','Magsaysay','Malalag','Malita','Matanao','Padada','Santa Cruz','Santa Maria','Sarangani','Sulop'];
provinceCity['Davao Oriental'] = ['Mati City',	'Baganga',	'Banaybanay','Boston','Caraga','Cateel', 'Governor Generoso','Lupon','Manay','San Isidro','Tarragona'];
provinceCity['Dinagat Islands'] = ['Basilisia (Rizal)',	'Cagdianao','Dinagat','Libjo (Albor)','Loreto', 'San Jose', 'Tubajon'];
provinceCity['Eastern Samar'] = ['Borongan City',	'Arteche',	'Balangiga','Balangkayan','Can-avid','Dolores','General MacArthur','Giporlos','Guiuan','Hernani','Jipapad','Lawaan','Llorente','Maslog','Maydolong','Mercedes','Oras','Quinapondan','Salcedo','San Julian','San Policarpo','Sulat','Taft'];
provinceCity['Guimaras'] = ['Buenavista',	'Jordan',	'Nueva Valencia','San Lorenzo','Sibunag'];
provinceCity['Ifugao'] = ['Aguinaldo',	'Alfonso Lista','Asipulo','Banaue','Hingyon','Hungduan','Kiangan','Lagawe','Lamut','Mayoyao','Tinoc'];
provinceCity['Ilocos Norte'] = ['Laoag City','Batac City','Adams','Bacarra','Badoc','Bangui','Banna','Burgos','Carasi','Currimao','Dingras','Dumalneg','Marcos','Nueva Era','Pagudpud','Paoay','Pasuquin','Piddig','Pinili','San Nicolas','Sarrat','Solsona','Vintar'];
provinceCity['Ilocos Sur'] = ['Candon City','Vigan City',	'Alilem',	'Banayoyo','Bantay','Burgos','Cabugao','Caoayan','Cervantes','Galimuyod','Gregorio Del Pilar','Lidlidda','Magsingal','Nagbukel','Narvacan','Quirino','Salcedo','San Emilio','San Esteban','San Ildefonso','San Juan','San Vicente','Santa','Santa Catalina','Santa Cruz','Santa Lucia','Santa Maria','Santiago','Santo Domingo','Sigay','Sinait','Sugpon','Suyo','Tagudin'];
provinceCity['Iloilo'] = ['Passi City',	'Iloilo City',	'Ajuy','Alimodian','Anilao','Badiangan','Balasan','Banate','Barotac Nuevo','Barotac Viejo','Batad','Bingawan','Cabatuan','Calinog','Carles','Concepcion','Dingle','Dueñas','Dumangas','Estancia','Guimbal','Igbaras','Janiuay','Lambunao','Leganes','Lemery','Leon','Maasin','Miagao','Mina','New Lucena','Oton','Pavia','Pototan','San Dionisio','San Enrique','San Joaquin','San Miguel','San Rafael','Santa Barbara','Sara','Tigbauan','Tubungan','Zarraga'];
provinceCity['Isabela'] = ['Cauayan City','Santiago City','Alicia','Angadanan','Aurora','Benito Soliven','Burgos','Cabagan','Cabatuan','Cordon','Delfin Albano','Dinapigue','Divilacan','Echague','Gamu','Ilagan','Jones','Luna','Maconacon','Mallig','Naguilian','Palanan','Quezon','Quirino','Ramon','Reina Mercedes','Roxas','San Agustin','San Guillermo','San Isidro','San Manuel','San Mariano','San Mateo','San Pablo','Santa Maria','Santo Tomas','Tumauini']; 
provinceCity['Kalinga'] = ['Tabuk City',	'Balbalan',	'Lubuagan','Pasil','Pinukpuk','Rizal','Tanudan','Tinglayan'];
provinceCity['La Union'] = ['San Fernando City','Agoo',	'Aringay','Bacnotan','Bagulin','Balaoan','Bangar','Bauang','Burgos','Caba','Luna','Naguilian','Pugo','Rosario','San Gabriel','San Juan','Santo Tomas','Santol','Sudipen','Tubao'];
provinceCity['Laguna'] = ['Calamba City ','San Pablo City', 'Santa Rosa City',	'Alaminos',	'Bay','Biñan','Cabuyao','Calauan','Cavinti','Famy','Kalayaan','Liliw','Los Baños','Luisiana','Lumban','Mabitac','Magdalena','Majayjay','Nagcarlan','Paete','Pagsanjan','Pakil','Pangil','Pila','Rizal','San Pedro','Santa Cruz','Santa Maria','Siniloan','Victoria'];
provinceCity['Lanao del Norte'] = ['Iligan City',	'Bacolod',	'Baloi','Baroy','Kapatagan','Kauswagan','Kolambugan','Lala','Linamon','Magsaysay','Maigo','Matungao','Munai','Nunungan','Pantao Ragat','Pantar','Poona Piagapo','Salvador','Sapad','Sultan Naga Dimaporo','Tagoloan','Tangcal','Tubod']	;
provinceCity['Lanao del Sur'] = ['Marawi City',	'Bacolod-Kalawi',	'Balabagan','Balindong','Bayang','Binidayan','Buadiposo-Buntong','Bubong','Bumbaran','Butig','Calanogas','Ditsaan-Ramain','Ganassi','Kapai','Kapatagan','Lumba-Bayabao','Lumbaca-Unayan','Lumbatan','Lumbayanague','Madalum','Madamba','Maguing','Malabang','Marantao','Marogong','Masiu','Mulondo','Pagayawan','Piagapo','Poona Bayabao','Pualas','Saguiaran','Sultan Dumalondong','Picong','Tagoloan Ii','Tamparan','Taraka','Tubaran','Tugaya','Wao'];
provinceCity['Leyte'] = ['Baybay City',	'Ormoc City','Tacloban City','Abuyog','Alangalang','Albuera','Babatngon','Barugo','Bato','Burauen','Calubian','Capoocan','Carigara','Dagami','Dulag','Hilongos','Hindang','Inopacan','Isabel','Jaro','Javier','Julita','Kananga','La Paz','Leyte','Macarthur','Mahaplag','Matag-ob','Matalom','Mayorga','Merida','Palo','Palompon','Pastrana','San Isidro','San Miguel','Santa Fe','','Tabango','Tabontabon','Tanauan','Tolosa','Tunga','Villaba']	;
provinceCity['Maguindanao'] = ['Cotabato City',	'Ampatuan',	'Buluan','Datu Abdullah Sangki','Datu Anggal Midtimbang','Datu Paglas','Datu Piang','Datu Saudi-Ampatuan','Datu Unsay','Gen. S. K. Pendatun','Guindulungan','Mamasapano','Mangudadatu','Pagagawan','Pagalungan','Paglat','Pandag','Rajah Buayan','Shariff Aguak','South Upi','Sultan sa Barongis','Talayan','Talitay']	;
provinceCity['Marinduque'] = ['Boac',	'Buenavista',	'Gasan','Mogpog','Santa Cruz','Torrijos'];
provinceCity['Masbate'] = ['Masbate City',	'Aroroy',	'Baleno','Balud','Batuan','Cataingan','Cawayan','Claveria','Dimasalang','Esperanza','Mandaon','Milagros','Mobo','Monreal','Palanas','Pio V. Corpuz','Placer','San Fernando','San Jacinto','San Pascual','Uson']	;
provinceCity['Metro Manila'] = ['Caloocan',	'Las Piñas',	'Makati','Malabon','Mandaluyong','Manila','Marikina','Muntinlupa','Navotas','Parañaque','Pasay','Pasig','Quezon City','San Juan','Taguig','Valenzuela']	;
provinceCity['Misamis Occidental'] = ['Oroquieta City', 'Ozamis City', 'Tangub City', 'Aloran', 'Baliangao', 'Bonifacio','Calamba', 'Clarin', 'Concepcion',  'Don Victoriano Chiongbian', 'Jimenez',  'Lopez Jaena',  'Panaon',  'Plaridel',  'Sapang Dalaga',  'Sinacaban',  'Tudela'];
provinceCity['Misamis Oriental'] = ['Cagayan de Oro','Gingoog City','El Salvador City','Alubijid','Balingasag','Balingoan','Binuangan','Claveria','El Salvador','Gitagum','Initao','Jasaan','Kinoguitan','Lagonglong','Laguindingan','Libertad','Lugait','Magsaysay','Manticao','Medina','Naawan','Opol','Salay','Sugbongcogon','Tagoloan','Talisayan','Villanueva']	;
provinceCity['Mountain Province'] = ['Barlig',	'Bauko','Besao','Bontoc','Natonin','Paracelis','Sabangan','Sadanga','Sagada','Tadian'];
provinceCity['Negros Occidental'] = ['Bacolod City','Bago City','Cadiz City','Escalante City','Himamaylan City','Kabankalan City','La Carlota City','Sagay City','San Carlos City','Silay City','Sipalay City','Talisay City','Victorias City','Binalbagan','Calatrava','Candoni','Cauayan','Enrique B. Magalona','Hinigaran','Hinoba-an','Ilog','Isabela','La Castellana','Manapla','Moises Padilla','Murcia','Pontevedra','Pulupandan','Salvador Benedicto','San Enrique','Toboso','Valladolid'];
provinceCity['Negros Oriental'] = ['Bais',	'Bayawan',	'Canlaon','Dumaguete','Guihulngan','Tanjay','Amlan','Ayungon','Bacong','Basay','Bindoy','Dauin','Jimalalud','La Libertad','Mabinay','Manjuyod','Pamplona','San Jose','Santa Catalina','Siaton','Sibulan','Tayasan','Valencia','Vallehermoso','Zamboanguita'];
provinceCity['Northern Samar'] = ['Allen',	'Biri',	'Bobon','Capul','Catarman','Catubig','Gamay','Laoang','Lapinig','Las Navas','Lavezares','Lope de Vega','Mapanas','Mondragon','Palapag','Pambujan','Rosario','San Antonio','San Isidro','San Jose','San Roque','San Vicente','Silvino Lobos','Victoria']	;
provinceCity['Nueva Ecija'] = ['Cabanatuan City',	'Gapan City',	'Palayan City','San Jose City','Science City of Muñoz','Aliaga','Bongabon','Cabiao','Carranglan','Cuyapo','Gabaldon','General Mamerto Natividad','General Tinio','Guimba','Jaen','Laur','Licab','Llanera','Lupao','Nampicuan','Pantabangan','Peñaranda','Quezon','Rizal','San Antonio','San Isidro','San Leonardo','Santa Rosa','Santo Domingo','Talavera','Talugtug','Zaragoza']	;
provinceCity['Nueva Vizcaya'] = ['Alfonso Castaneda','Ambaguio',	'Aritao','Bagabag','Bambang','Bayombong','Diadi','Dupax del Norte','Dupax del Sur','Kasibu','Kayapa','Quezon','Santa Fe','Solano','Villaverde']	;
provinceCity['Occidental Mindoro'] = ['Abra de Ilog',	'Calintaan',	'Looc','Lubang','Magsaysay','Mamburao','Paluan','Rizal','Sablayan','San Jose','Santa Cruz']	;
provinceCity['Oriental Mindoro'] = ['Calapan City',	'Baco',	'Bansud','Bongabong','Bulalacao','Gloria','Mansalay','Naujan','Pinamalayan','Pola','Puerto Galera','Roxas','San Teodoro','Socorro','Victoria'];
provinceCity['Palawan'] = ['Puerto Princesa City',	'Aborlan',	'Agutaya','Araceli','Balabac','Bataraza',"Brooke's Point",'Busuanga','Cagayancillo','Coron','Culion','Cuyo','Dumaran','El Nido','Kalayaan','Linapacan','Magsaysay','Narra','Quezon','Rizal','Roxas','San Vicente','Sofronio Española','Taytay']	;
provinceCity['Pampanga'] = ['Angeles City', 'City of San Fernando','Apalit','Arayat', 'Bacolor', 'Candaba', 'Floridablanca', 'Guagua', 'Lubao', 'Mabalacat', 'Macabebe', 'Magalang', 'Masantol', 'Mexico', 'Minalin', 'Porac', 'San Luis', 'San Simon', 'Santa Ana', 'Santa Rita','Santo Tomas', 'Sasmuan']	;
provinceCity['Pangasinan'] = ['Alaminos City','Dagupan City','San Carlos City','Urdaneta City','Agno','Aguilar','Alcala','Anda','Asingan','Balungao','Bani','Basista','Bautista','Bayambang','Binalonan','Binmaley','Bolinao','Bugallon','Burgos','Calasiao','Dasol','Infanta','Labrador','Laoac','Lingayen','Mabini','Malasiqui','Manaoag','Mangaldan','Mangatarem','Mapandan','Natividad','Pozzorubio','Rosales','San Fabian','San Jacinto','San Manuel','San Nicolas','San Quintin','Santa Barbara','Santa Maria','Santo Tomas','Sison','Sual','Tayug','Umingan','Urbiztondo','Villasis'];
provinceCity['Quezon'] = ['Lucena City','Lucena City',	'Tayabas City','Agdangan','Alabat','Atimonan','Buenavista','Burdeos','Calauag','Candelaria','Catanauan','Dolores','General Luna','General Nakar','Guinayangan','Gumaca','Infanta','Jomalig','Lopez','Lucban','Macalelon','Mauban','Mulanay','Padre Burgos','Pagbilao','Panukulan','Patnanungan','Perez','Pitogo','Plaridel','Polillo','Quezon','Real','Sampaloc','San Andres','San Antonio','San Francisco','San Narciso','Sariaya','Tagkawayan','Tiaong','Unisan']	;
provinceCity['Quirino'] = ['Aglipay',	'Cabarroguis',	'Diffun','Maddela','Nagtipunan','Saguday']	;
provinceCity['Rizal'] = ['Antipolo City',	'Angono',	'Baras','Binangonan','Cainta','Cardona','Jalajala','Morong','Pililla','Rodriguez','San Mateo','Tanay','Taytay','Teresa'];
provinceCity['Romblon'] = ['Alcantara',	'Banton','Cajidiocan','Calatrava','Concepcion','Corcuera','Ferrol','Looc','Magdiwang','Odiongan','Romblon','San Agustin','San Andres','San Fernando','San Jose','Santa Fe','Santa Maria'];
provinceCity['Samar'] = ['Catbalogan City',	'Calbayog City','Almagro','Basey','Calbiga','Daram','Gandara','Hinabangan','Jiabong','Marabut','Matuguinao','Motiong','Pagsanghan','Paranas','Pinabacdao','San Jorge','San Jose De Buan','San Sebastian','Santa Margarita','Santa Rita','Santo Niño','Tagapul-an','Talalora','Tarangnan','Villareal','Zumarraga']	;
provinceCity['Sarangani'] = ['Alabel',	'Glan',	'Kiamba','Maasim','Maitum','Malapatan','Malungon']	;
provinceCity['Shariff Kabunsuan'] = ['Barira', 'Buldon',	'Datu Blah T. Sinsuat',	'Datu Odin Sinsuat','Kabuntalan','Matanog','Northern Kabuntalan','Parang','Sultan Kudarat','Sultan Mastura','Upi'];
provinceCity['Siquijor'] = ['Enrique Villanueva',	'Larena',	'Lazi','Maria','San Juan','Siquijor']	;
provinceCity['Sorsogon'] = ['Sorsogon City','Barcelona','Bulan','Bulusan','Casiguran','Castilla','Donsol','Gubat','Irosin','Juban','Magallanes','Matnog','Pilar','Prieto Diaz','Santa Magdalena'];
provinceCity['South Cotabato'] = ['General Santos City', 'Koronadal City',	'Banga','Lake Sebu','Norala','Polomolok', 'Santo Niño','Surallah', "T'Boli",'Tampakan','Tantangan','Tupi']	;
provinceCity['Southern Leyte'] = ['Maasin CIty', 'Anahawan','Bontoc','Hinunangan','Hinundayan','Libagon,', 'Liloan','Limasawa','Macrohon','Malitbog','Padre Burgos','Pintuyan','Saint Bernard','San Francisco','San Juan','San Ricardo','Silago','Sogod','Tomas Oppus']	;
provinceCity['Sultan Kudarat'] = ['Tacurong City', 'Bagumbayan','Columbio',	'Esperanza','Isulan','Kalamansig', 'Lambayong','Lebak','Lutayan','Palimbang','President Quirino','Sen. Ninoy Aquino'];
provinceCity['Sulu'] = ['Hadji Panglima Tahil',	'Indanan',	'Jolo','Kalingalan Caluang','Lugus', 'Luuk','Maimbung','Old Panamao','Omar','Pandami','Panglima Estino','Pangutaran','Parang','Pata','Patikul','Siasi','Talipao','Tapul','Tongkil']	;
provinceCity['Surigao del Norte'] = ['Surigao City', 'Alegria',	'Bacuag',	'Burgos','Claver','Dapa', 'Del Carmen','General Luna','Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Francisco','San Isidro','Santa Monica','Sison','Socorro','Tagana-an','Tubod'];
provinceCity['Surigao del Sur'] = ['Bislig CIty', 'Tandag CIty','Barobo',	'Bayabas','Cagwait','Cantilan', 'Carmen','Carrascal','Cortes','Hinatuan','Lanuza','Lianga','Lingig','Madrid','Marihatag','San Agustin','San Miguel','Tagbina','Tago'];
provinceCity['Tarlac'] = ['Tarlac City', 'Anao','Bamban','Camiling','Capas','Concepcion', 'Gerona','La Paz','Mayantoc','Moncada','Paniqui','Pura','Ramos','San Clemente','San Jose','San Manuel','Santa Ignacia','Victoria'];
provinceCity['Tawi-Tawi'] = ['Bongao', 'Languyan',	'Mapun','Panglima Sugala','Sapa-Sapa','Sibutu','Simunul','Sitangkai','South Ubian ','Tandubas','Turtle Islands'];
provinceCity['Zambales'] = ['Olongapo City','Botolan','Cabangan','Candelaria','Castillejos', 'Iba','Masinloc','Palauig','San Antonio','San Felipe','San Marcelino','San Narciso','Santa Cruz','Subic']	;
provinceCity['Zamboanga del Norte'] = ['Dapitan City','Dipolog CIty','Bacungan','Baliguian','Godod','Gutalac','Jose Dalman','Kalawit','Katipunan','La Libertad','Labason','Liloy','Manukan','Mutia','Piñan','Polanco','Pres. Manuel A. Roxas','Rizal','Salug','Sergio Osmeña Sr.','Siayan','Sibuco','Sibutad','Sindangan','Siocon','Sirawai','Tampilisan'];
provinceCity['Zamboanga del Sur'] = ['Pagadian City','Zamboanga City','Aurora','Bayog','Dimataling','Dinas','Dumalinao','Dumingag','Guipos','Josefina','Kumalarang','Labangan','Lakewood','Lapuyan','Mahayag','Margosatubig','Midsalip','Molave','Pitogo','Ramon Magsaysay','San Miguel','San Pablo','Sominot','Tabina','Tambulig','Tigbao','Tukuran','Vincenzo A. Sagun'];
provinceCity['Zamboanga Sibugay'] = ['Alicia','Buug','Diplahan','Imelda','Ipil','Kabasalan','Mabuhay','Malangas','Naga','Olutanga','Payao','Roseller Lim','Siay','Talusan','Titay','Tungawan']	;

function ChangeCity() {
    var province = document.getElementById("perProvince");
    var city = document.getElementById("perCity");
    var selcity = province.options[province.selectedIndex].value;
	
    while (city.options.length) {
        city.remove(0);
    }
    var CityCity = provinceCity[selcity];
    if (CityCity) {
        var i;
        for (i = 0; i < CityCity.length; i++) {
            var CityCityCity = new Option(CityCity[i],CityCity[i] );
            city.options.add(CityCityCity);
        }
    }
}
</script>
										<div class="control-group">
										<label class="control-label">Permanent Address</label>
											<div class="controls">
											<select onchange="ChangeCity()" tabindex="1" class="span5" name="perProvince" id="perProvince" required>
													<option value="">Province...</option>
													<option value="Abra">Abra</option>
													<option value="Agusan del Norte">Agusan del Norte </option>
													<option value="Agusan del Sur">Agusan del Sur</option>
													<option value="Aklan">Aklan</option>
													<option value="Albay">Albay</option>
													<option value="Antique">Antique</option>
													<option value="Apayao">Apayao</option>
													<option value="Aurora">Aurora</option>
													<option value="Basilan">Basilan</option>
													<option value="Bataan">Bataan</option>
													<option value="Batanes">Batanes</option>
													<option value="Batangas">Batangas</option>
													<option value="Benguet">Benguet</option>
													<option value="Biliran">Biliran</option>
													<option value="Bohol">Bohol</option>
													<option value="Bukidnon">Bukidnon</option>
													<option value="Bulacan">Bulacan</option>
													<option value="Cagayan">Cagayan</option>
													<option value="Camarines Norte">Camarines Norte</option>
													<option value="Camarines Sur">Camarines Sur</option>
													<option value="Camiguin">Camiguin	</option>
													<option value="Capiz">Capiz</option>
													<option value="Catanduanes">Catanduanes</option>
													<option value="Cavite">Cavite</option>
													<option value="Cebu">Cebu</option>
													<option value="Compostela Valley">Compostela Valley</option>
													<option value="Cotabato">Cotabato</option>
													<option value="Davao del Norte">Davao del Norte</option>
													<option value="Davao del Sur">Davao del Sur</option>
													<option value="Davao Oriental">Davao Oriental</option>
													<option value="Dinagat Islands">Dinagat Islands</option>
													<option value="Eastern Samar">Eastern Samar</option>
													<option value="Guimaras">Guimaras</option>
													<option value="Ifugao">Ifugao</option>
													<option value="Ilocos Norte">Ilocos Norte</option>
													<option value="Ilocos Sur">Ilocos Sur</option>
													<option value="Iloilo">Iloilo</option>
													<option value="Isabela">Isabela</option>
													<option value="Kalinga">Kalinga</option>
													<option value="La Union">La Union</option>
													<option value="Laguna">Laguna</option>
													<option value="Lanao del Norte">Lanao del Norte</option>
													<option value="Lanao del Sur">Lanao del Sur</option>
													<option value="Leyte">Leyte</option>
													<option value="Maguindanao">Maguindanao</option>
													<option value="Marinduque">Marinduque</option>
													<option value="Masbate">Masbate</option>
													<option value="Metro Manila">Metro Manila</option>
													<option value="Misamis Occidental">Misamis Occidental</option>
													<option value="Misamis Oriental">Misamis Oriental</option>
													<option value="Mountain Province">Mountain Province</option>
													<option value="Negros Occidental">Negros Occidental</option>
													<option value="Negros Oriental">Negros Oriental</option>
													<option value="Northern Samar">Northern Samar</option>
													<option value="Nueva Ecija">Nueva Ecija</option>
													<option value="Nueva Vizcaya">Nueva Vizcaya</option>
													<option value="Occidental Mindoro">Occidental Mindoro</option>
													<option value="Oriental Mindoro">Oriental Mindoro</option>
													<option value="Palawan">Palawan</option>
													<option value="Pampanga">Pampanga</option>
													<option value="Pangasinan">Pangasinan</option>
													<option value="Quezon">Quezon</option>
													<option value="Quirino">Quirino</option>
													<option value="Rizal">Rizal</option>
													<option value="Romblon">Romblon</option>
													<option value="Samar">Samar</option>
													<option value="Sarangani">Sarangani</option>
													<option value="Shariff Kabunsuan">Shariff Kabunsuan</option>
													<option value="Siquijor">Siquijor</option>
													<option value="Sorsogon">Sorsogon</option>
													<option value="South Cotabato">South Cotabato</option>
													<option value="Southern Leyte">Southern Leyte</option>
													<option value="Sultan Kudarat">Sultan Kudarat</option>
													<option value="Sulu">Sulu</option>
													<option value="Surigao del Norte">Surigao del Norte</option>
													<option value="Surigao del Sur">Surigao del Sur</option>
													<option value="Tarlac">Tarlac</option>
													<option value="Tawi-Tawi">Tawi-Tawi</option>
													<option value="Zambales">Zambales</option>
													<option value="Zamboanga del Norte">Zamboanga del Norte</option>
													<option value="Zamboanga del Sur">Zamboanga del Sur</option>
													<option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
											</select>&nbsp;&nbsp;
											<select tabindex="1" class="span5" name="perCity" id="perCity" required>
													<option value="">City/Municipality...</option>
												</select>
											</div>

											<p></p>
											<div class="controls">
											<input type="text" tabindex="1" placeholder="Barangay" class="span5" name="perBrgy" id="perBrgy" required />
											&nbsp;&nbsp;
											<input class="span5" type="text" placeholder="Subdivision/Village..." id="perSubdivision" name="perSubdivision" >     
											</div>
											<p></p>
											<div class="controls">
											<input class="span5" type="text" placeholder="Street..." id="perStreet" name="perStreet"> &nbsp;    
											<input class="span5" type="text" maxlength="5" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" placeholder="House/Block/lot No..." id="perHouseNo" name="perHouseNo" required>     
											</div>
											<p></p>
											<div class="controls">
											<input class="span10" maxlength="5" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )){ alert('Numbers only Please!'); return false; }" type="text" placeholder="Zip Code..." id="perZip" name="perZip" required>     
											<input class="span5" type="hidden" value="Permanent" id="perAddType" name="perAddType" >     
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="perBloodType">Blood Type</label>
											<div class="controls">
											<select tabindex="1" data-placeholder="Select here.." class="span5" name="perBloodType" id="perBloodType" required>
													<option value="">Select here..</option>
													<option value="AB">AB</option>
													<option value="B">B</option>
													<option value="O">O</option>
													<option value="A">A</option>
												</select>
											
										  </div>
										</div>
										<div class="control-group">
                                        <table width="650" border="0" align="left">
										  <tr>
											<td align="center">
											<label class="control-label" for="perHeight">Height</label>
											<div class="controls">
											<input class="span12" type="number" placeholder="(m) - required" id="perHeight" name="perHeight" required>       
											</div>
											</td>
											<td>
											<label class="control-label" for="perWeight">Weight</label>
											<div class="controls">
											<input class="span12" type="number" placeholder="(kg) - required" name="perWeight" id="perWeight" required>       
											</div>
											</td>
										  </tr>
										</table>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="perEmail">Email Address</label>
											<div class="controls">
											<input class="span8" type="email" placeholder="sample@yahoo.com - optional" name="perEmail" id="perEmail">       
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="PerMobileNo">Mobile No.</label>
											<div class="controls">
											<input class="span5" placeholder="Optional..." type="number" id="PerMobileNo" name="PerMobileNo">  
											Tel No.
											<input class="span5" placeholder="Optional..." type="number" name="perTelno" id="perTelno">     											
											</div>
										</div>
										
											  <input class="span8" type="hidden" name="perDateModified" id="perDateModified" value="<?php echo date('Y-m-d'); ?>">       
									  
									  <p>&nbsp;</p>
										<div class="control-group">
											<div class="controls" align="right">
												<button type="submit" name="submitbtn" id="submitbtn" class="btn btn-large btn-primary">Submit Form</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											</div>
										</div>
										<input type="hidden" name="MM_insert" value="form1">
                                                </form>
											
                                               
												<p>&nbsp;</p>
												
                                                        </div>
                                                    </div>
                                                    <!--/.stream-headline-->
													</td>
														</tr>
														</table>
									   
                                            <div class="stream-options">
                                            <div class="module-body table">
			
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
		 </div>
        <!--/.wrapper-->
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
