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

  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($insertSQL, $dbmrov) or die(mysql_error());

  $insertGoTo = "dbmManage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
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
#myModal { outline: none;}
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
		
		
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                 <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="dbmIndexPIM.php"> DBM-ROV</a>
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
                            <ul class="widget widget-menu unstyled">
								
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
                                       <li align="center" style="background-color:#333">    <img src="images/user.png" width="200" height="200" style="margin-top: 8px; margin-left: 8px; margin-right: 8px; margin-bottom: 8px; border-radius: 120px;"/> </li>
									
									<?php } else{ ?>
                                      <li align="center" style="background-color:#333" > <img src="<?php echo 'data:image/'.$type0.';base64,'.base64_encode($img0); ?>" width="200" height="200" style="margin-top: 8px; margin-left: 8px; margin-right: 8px; margin-bottom: 8px; border-radius: 120px;"/> </li>
												
								<?php	} ?>
                                    
								<?php	}  ?>
								 <li class="active"><a href="dbmPIMpersonnelVIEW.php?perId=<?php echo $p0; ?>" title="View Personnel detail"><i class="menu-icon icon-eye-open"></i>View your Profile
                                </a></li>
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
                                    <li class="active"><a href="#Division" data-toggle="tab">Division</a></li>
                                    <li><a href="#Requirements" data-toggle="tab">Requirements</a></li>
									<li><a href="#friends" data-toggle="tab">Account</a></li>
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
                                                        <h5 class="stream-author">
                                                            Add Division: 
                                                        </h5>
                                                        <div class="stream-text">
												<form action="<?php echo $editFormAction; ?>" id="form1" name="form1"  method="POST" enctype="multipart/form-data">
												<table>
														<tr>
														<td>Division Name: </td>
														<td> <input type="text" name="divisionadd" id="divisionadd" placeholder="Type here..." class="span5" required></td>
														</tr>
														<tr>
														<td>Description (optional) :</td>
														<td> <textarea class="span5" type="text" name="divDesc" id="divDesc">  </textarea> <input class="span5" type="hidden" name="datediv" id="datediv" value="<?php echo date('Y-m-d'); ?>"> </td>
														</tr>
														<tr>
														<td></td>
														<td><div align="right"><input type="submit" name="btn_div" id="btn_div" value="Submit" class="btn btn-large btn-inverse"> </div></td>
														</tr>
												</table>
												<input type="hidden" name="MM_insert" value="form1">
                                                </form>
                                                        </div>
                                                    </div>
													<hr>
                                                    <!--/.stream-headline-->
													<div class="module-head" style="background-color:grey;" align="center">
													<h3><font color="white">List of Divisions (Department)</font></h3>
													</div>
													<p>&nbsp;</p>
                                                    <div class="stream-options">
                                                      <div class="module-body table">
                   <table width="60%" align="center" class="datatable-1 table " >
				  <?php	
						$query = "select * from division";
						$result= mysql_query($query);	
						$cnt=0;
						 while($row = mysql_fetch_assoc($result)) {
							 $divisionId=$row['divId'];
							 $name=$row['divName'];
							 $des=$row['divDesc'];
							 $cnt=$cnt+1;
							 ?>
				  
				  <tr bgcolor="#333" >
				  <td> <div></div>
				    <div align="left">
				      <h4><font color="white" style="margin-top: 500px; margin-left: 10px;"><?php echo $name.' - <small>'.$des.'</small>' ?></font></h4>
				    </div>
                       <td width="14%" >
                         <h4>
                           <form name="form1" method="post" action="dbmManage2.php?divId=<?php echo $divisionId; ?>">
							<input type="submit" name="btn" id="btn" value="Edit">
							</form>
                           </h4>
                         <?php  if(isset($_POST['btn'])){ ?>
 
					  <div class="modal show" id="myModal" role="dialog">
						<div class="modal-dialog">
						
						  <!-- Modal content-->
						  <div id="myModal"  class="modal-content">
								  <div class="modal-header">
									<span class="close"><a href="dbmManage2.php">&times;</a></span>
									<h2>Modal Header</h2>
								  </div>
								  <div class="modal-body">
									<p>Some text in the Modal Body Some text in the Modal BodySome text in the Modal BodySome text in the Modal BodySome text in the Modal BodySome text in the Modal Body</p>
									<p>Some other text...</p>
									<p>Some text in the Modal Body</p>
									<p>Some other text...</p>
									<p>Some text in the Modal Body</p>
									<p>Some other text...</p>
									<p>Some text in the Modal Body</p>
									<p>Some other text...</p>
									<p>Some text in the Modal Body</p>
									<p>Some other text...</p>
								  </div>
								  <div class="modal-footer">
									<h3>Modal Footer</h3>
								  </div>
								</div >

						  
						</div>
					  </div>
					<?php } ?>
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
							  	<td colspan=2> <h4>There (is/are) no Personnel Within this Division (Department)</h4></td>
							  </tr>
								<?php } ?>
					  </table>
					   <table width="100%" align="center" >
								 <tr bgcolor="#333">
								  <td align="center">****Nothing follows****</td>
								  </tr>
								  </table>
					  
					  <p>&nbsp;</p></td> 
				  </tr>
				 
				  <?php } ?>
							
				 </table>
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
                                    <div class="tab-pane fade" id="Requirements">
                                        <div class="module-option clearfix">
                                            <form>
                                            <div class="input-append pull-left">
                                                <input type="text" class="span3" placeholder="Filter by name...">
                                                <button type="submit" class="btn">
                                                    <i class="icon-search"></i>
                                                </button>
                                            </div>
                                            </form>
                                            <div class="btn-group pull-right" data-toggle="buttons-radio">
                                                <button type="button" class="btn">
                                                    All</button>
                                                <button type="button" class="btn">
                                                    Male</button>
                                                <button type="button" class="btn">
                                                    Female</button>
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                John Donga
                                                            </h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                Donga John</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                John Donga</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                Donga John</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                John Donga</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                Donga John</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                John Donga</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="media user">
                                                        <a class="media-avatar pull-left" href="#">
                                                            <img src="images/user.png">
                                                        </a>
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                Donga John</h3>
                                                            <p>
                                                                <small class="muted">Pakistan</small></p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <button class="btn btn-small">
                                                                    <i class="icon-envelope"></i>
                                                                </button>
                                                                <button class="btn btn-small">
                                                                    <i class="icon-share-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />
                                            <div class="pagination pagination-centered">
                                                <ul>
                                                    <li><a href="#"><i class="icon-double-angle-left"></i></a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#"><i class="icon-double-angle-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
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
        <div class="footer">
           <div class="container">
			 <p><b class="copyright">&copy; 2017 Department of Budget and Management Regional Office V</b> - All rights reserved.</p>
			 <p>&nbsp;</p>
			 <p>&nbsp;</p>
			 <p>&nbsp;</p>
             
           </div>
        </div>
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		        
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>
		   
		<script src="bootstrap.min.js"></script>
    </body>
<?php
mysql_free_result($Recordset1);
?>
