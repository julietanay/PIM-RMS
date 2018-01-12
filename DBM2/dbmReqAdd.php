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
  $insertSQL = sprintf("INSERT INTO requirement (reqTitle, reqDescription, reqTransferee, reqDateModified) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['reqDesc'], "text"),
					   GetSQLValueString($_POST['transfer'], "text"),
                       GetSQLValueString($_POST['reqdate'], "date"));

  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($insertSQL, $dbmrov) or die(mysql_error());

  $insertGoTo = "dbmReqAdd.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form4")) {
  $updateSQL = sprintf("UPDATE requirement SET reqTitle=%s, reqDescription=%s, reqTransferee=%s, reqDateModified=%s WHERE reqId=%s",
                       GetSQLValueString($_POST['reqTitle'], "text"),
                       GetSQLValueString($_POST['reqDescription'], "text"),
					   GetSQLValueString($_POST['reqTransferee'], "text"),
                       GetSQLValueString($_POST['reqDateModified'], "date"),
                       GetSQLValueString($_POST['reqId'], "int"));

  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($updateSQL, $dbmrov) or die(mysql_error());

  $updateGoTo = "dbmReqAdd.php";
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
if (isset($_GET['reqId'])) {
  $colname_Recordset2 = $_GET['reqId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset2 = sprintf("SELECT * FROM requirement WHERE reqId = %s", GetSQLValueString($colname_Recordset2, "int"));
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
                                       <li align="center" ><p></p><img class="img-circular" src="images/user.png" width="200" height="200" /><p></p> </li>
									
									<?php } else{ ?>
                                      <li align="center" style="background-color:#333" > <p></p><img class="img-circular" src="<?php echo 'data:image/'.$type0.';base64,'.base64_encode($img0); ?>"/> <p></p></li>
												
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
                                    <li class="active"><a href="dbmReqAdd.php">Requirements</a></li>
									<li><a href="dbmPIMAcct.php" >User Accounts</a></li>
                                </ul>
                                <div class="profile-tab-content tab-content">
                                    <div class="tab-pane fade active in" id="Division">
                                        <div class="stream-list">
                                            <div class="media stream">
                                                <div class="media-body">
                                                    <div class="stream-headline">
                                                        <div class="stream-text">
											<!--	<form action="<?php// echo $editFormAction; ?>" id="form1" name="form1"  method="POST" enctype="multipart/form-data">
												<table width="60%" align="center" class="datatable-1 table ">
														<tr>
														<td>Requirement Title: </td>
														<td> <input type="text" name="title" id="title" placeholder="Type here..." class="span5" required></td>
														</tr>
														<tr>
														<td>Requirement (for transferee): </td>
														<td> <div class="controls">
												<label class="radio inline">
													<input type="radio" name="transfer" id="transfer" value="yes" checked="">
													Yes
												</label> 
												<label class="radio inline">
													<input type="radio" name="transfer" id="transfer" value="no">
													No
												</label> 
											</div></td>
														</tr>
														<tr>
														<td>Description (optional) :</td>
														<td> <textarea class="span5" type="text" name="reqDesc" id="reDesc">  </textarea> <input class="span5" type="hidden" name="reqdate" id="reqdate" value="<?php // echo date('Y-m-d'); ?>"> 
														<div align="right"><input type="submit" name="btn_req" id="btn_req" value="&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;" class="btn btn-large btn-inverse">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
														</tr>
												</table>
												<input type="hidden" name="MM_insert" value="form1">
                                                </form>-->
												
                                                        </div>
                                                    </div>
                                                    <!--/.stream-headline-->
								<?php $que= "select * from requirement";
								$res= mysql_query($que);	
								$cnts=0;
								 while($row = mysql_fetch_assoc($res)) {
								 $cnts=$cnts+1; }
									  ?>
									   <div class="module-head" style="background-color:grey" align="center">
									  <div class="module-option clearfix">
									    <div class="btn-group pull-left" >
                                         
											<h4><font color="white"><?php
												echo '('.$cnts.')';
											?> Requirement(s)</font></h4>
											</div>
                                            <form name="searcform" method="post" action="dbmReqAdd.php">
                                            <div class="input-append pull-right">
                                                <input type="text" class="span3" placeholder="Search Here..." name="search" id="search">
                                                <button type="submit" class="btn" name="submit" id="submit">
                                                    <i class="icon-search"></i> </button>
                                            </div>
                                            </form>
                                           </div>
                                        </div>
											
                                            <div class="stream-options">
                                            <div class="module-body table">
			<table width="60%" align="center" class="datatable-1 table " border=1> 
			<tr bgcolor="#333">
							</tr>
			<tr>
							<td bgcolor="#333">&nbsp;<div align="center"></td>
							</tr>
                 <?php
					if(isset($_POST['submit'])){
					$ss = $_POST['search'];
					$query = "select * from requirement where reqTitle LIKE '%$ss%' order by reqDateModified Desc";
						$result= mysql_query($query);	
						$cnt=0;
						 while($row = mysql_fetch_assoc($result)) {
							 $requirementId=$row['reqId'];
							 $title=$row['reqTitle'];
							 $des=$row['reqDescription'];
							 $cnt=$cnt+1;
							 ?>
							 <tr >
				  <td> <div></div>
				    <div align="left">
				      <h4><?php
						if (($des==null)||($des==' ')){
							echo $cnt.'.) '.$title.' - <small> (Description Not Available) </small>';
						} else{
							echo $cnt.'.) '.$title.' - <small>'.$des.'</small>';
						}  ?></h4>
				    </div></td>
                       <td width="11%" >
                         <h4>
						  <form name="form2" method="POST" action="dbmReqAdd.php?reqId=<?php echo $requirementId; ?>" class="form-horizontal row-fluid">
                      <button id="dbt" name="dbt" class="btn btn-mini btn-inverse" title="Edit or Update"><i class="icon-edit"></i> Edit</button>
                           </form>
						   
                           </h4>
                        <?php 
						$display="block";
							if(isset($_POST['dbt'])){
								$dvd=mysql_real_escape_string($_GET['reqId']);
								?>
								<div id="myalert" style="display:<?php echo $display ?>;">
								  <div id="header">
										<form action="dbmReqAdd.php" method="post">
										<button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
										</form><p>&nbsp;</p>
                                 <center><h2 class="modal-title"><b> &nbsp;Update Division "<?php echo $row_Recordset2['divName']; ?>"</b></h2></center>
								 <hr>
                                 <form method="post" name="form4" action="<?php echo $editFormAction; ?>">
                                   <table align="center">
                                     <tr valign="baseline">
                                       <td nowrap align="right"> Requirement Title:</td>
                                       <td><input type="text" name="reqTitle" value="<?php echo htmlentities($row_Recordset2['reqTitle'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                     </tr>
									  <tr valign="baseline">
                                       <td nowrap align="right"> Requirement (for transferee):</td>
                                       <td>  
												<label class="radio inline">
													<input type="radio" name="transfer" id="transfer" value="Yes"<?php if($row_Recordset2['reqTransferee'] == 'Yes') { ?> checked="checked"<?php } ?>>
													Yes
												</label> 
												<label class="radio inline">
													<input type="radio" name="transfer" id="transfer" value="No"<?php if($row_Recordset2['reqTransferee'] == 'No') { ?> checked="checked"<?php } ?>>
													No
												
											</div> </td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right"> Description:</td>
                                       <td><textarea type="text" name="reqDescription" id="reqDescription" cols="45" rows="3"><?php echo $row_Recordset2['reqDescription']; ?></textarea></td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right">ReqDateModified:</td>
                                       <td><input type="hidden" name="reqDateModified" value="<?php echo date('Y-m-d'); ?>" size="32"></td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right">&nbsp;</td>
                                       <td><input type="submit" value="Update record"></td>
                                     </tr>
                                   </table>
                                   <input type="hidden" name="MM_update" value="form4">
                                   <input type="hidden" name="reqId" value="<?php echo $row_Recordset2['reqId']; ?>">
                                 </form>
                                 <p>&nbsp;</p>
								<p>&nbsp;</p>
                                  </div>
									
						</div>
							
						<?php 	}
						?>

                       </td> 
                  </tr> 
				 
				 
				  <?php } if ($cnt<1){ ?>
				   <div class="module-body table">
					   <?php echo '<h3 align="center">"'.$ss.'" Not found!!</h3>'; ?>
                                </div>
				   <?php } ?>
							
				 </table>
							 
							 
					<?php }else{?>
						<table width="60%" align="center" class="datatable-1 table " border=1>
							<tr bgcolor="#333">
							</tr>	
				  <?php	
						$query = "select * from requirement order by reqDateModified Desc";
						$result= mysql_query($query);	
						$cnt=0;
						 while($row = mysql_fetch_assoc($result)) {
							 $requirementId=$row['reqId'];
							 $title=$row['reqTitle'];
							 $des=$row['reqDescription'];
							 $cnt=$cnt+1;
							 ?>
				  <tr>
				  <td> <div></div>
				    <div align="left">
				      <h4><?php
						if (($des==null)||($des==' ')){
							echo $cnt.'.) '.$title.' - <small> (Description Not Available) </small>';
						} else{
							echo $cnt.'.) '.$title.' - <small>'.$des.'</small>';
						}  ?></h4>
				    </div></td>
                       <td width="11%" >
                         <h4>
						  <form name="form2" method="POST" action="dbmReqAdd.php?reqId=<?php echo $requirementId; ?>" class="form-horizontal row-fluid">
                      <button id="dbt" name="dbt" class="btn btn-mini btn-inverse" title="Edit or Update"><i class="icon-edit"></i> Edit</button>
                           </form>
						   
                           </h4>
                        <?php 
						$display="block";
							if(isset($_POST['dbt'])){
								$dvd=mysql_real_escape_string($_GET['reqId']);
								?>
								<div id="myalert" style="display:<?php echo $display ?>;">
								  <div id="header">
										<form action="dbmReqAdd.php" method="get">
										<button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
										</form><p>&nbsp;</p>
                                 <center><h2 class="modal-title"><b> &nbsp;Update "<?php echo $row_Recordset2['reqTitle']; ?>"</b></h2></center>
								 <hr>
                                 <table width="100%" border="1">
									    <tr bgcolor="#333333">
									      <td>&nbsp;</td>
								        </tr>
									    </table>
									  <p>&nbsp;</p>
                               <form method="post" name="form4" action="<?php echo $editFormAction; ?>">
                                   <table align="center">
                                     <tr valign="baseline">
                                       <td nowrap align="right">ReqTitle:</td>
                                       <td><input type="text" name="reqTitle" value="<?php echo htmlentities($row_Recordset2['reqTitle'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
                                     </tr>
									  <tr valign="baseline">
                                       <td nowrap align="right"> Requirement (for transferee):</td>
                                       <td>  
												<label class="radio inline">
													<input type="radio" name="transfer" id="transfer" value="yes"<?php if($row_Recordset2['reqTransferee'] == 'yes') { ?> checked=" "<?php } ?>>
													Yes
												</label> 
												<label class="radio inline">
													<input type="radio" name="transfer" id="transfer" value="no"<?php if($row_Recordset2['reqTransferee'] == 'no') { ?> checked=" "<?php } ?>>
													No
												
											</div> </td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right">ReqDescription:</td>
                                       <td><textarea  type="text" name="reqDescription" id="reqDescription" cols="45" rows="3"><?php echo $row_Recordset2['reqDescription']; ?></textarea></td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right"></td>
                                       <td><input type="hidden" name="reqDateModified" value="<?php echo date('Y-m-d'); ?>" size="32"></td>
                                     </tr>
                                     <tr valign="baseline">
                                       <td nowrap align="right">&nbsp;</td>
                                       <td><input type="submit" value="Update record" class="btn btn-inverse pull-right"></td>
                                     </tr>
                                   </table>
                                   <input type="hidden" name="MM_update" value="form4">
                                   <input type="hidden" name="reqId" value="<?php echo $row_Recordset2['reqId']; ?>">
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

mysql_free_result($Recordset2);
?>
