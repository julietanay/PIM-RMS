<?php require_once('../Connections/dbmrov.php');
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
 @session_start(); 
if($_SESSION['usernameU']==''){
header('location:dbmPIMUserLogin.php');
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


$pertid1=$_SESSION['pidU'];
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = "SELECT * FROM personnel where personnel.perId='$pertid1'";
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
					  $perMname2= $_POST['perMname'];
                      $perLname2= $_POST['perLname'];
                      $perEmail2= $_POST['perEmail'];
                      $perMobileNo2= $_POST['perMobileNo'];
                      $perTelno2= $_POST['perTelno'];
                      $perHeight2= $_POST['perHeight'];
                      $perWeight2= $_POST['perWeight'];
                      $perStatus2= $_POST['perStatus'];
			 if (($perMname2==$row_Recordset1['perMname']) && ($perLname2==$row_Recordset1['perLname']) && ($perEmail2==$row_Recordset1['perEmail'])&& ($perMobileNo2==$row_Recordset1['perMobileNo']) && ($perTelno2==$row_Recordset1['perTelno']) && ($perHeight2==$row_Recordset1['perHeight']) && ($perWeight2==$row_Recordset1['perWeight']) && ($perStatus2==$row_Recordset1['perStatus'])) { ?>
				<SCRIPT LANGUAGE='JavaScript'>
					window.alert('No Changes Identified...Your Request to change your Information has not been sent!');
					history.back();
					</SCRIPT>
	<?php 			}	else {									
  $insertSQL = sprintf("INSERT INTO personnel_update ( perMname2, perLname2, perEmail2, perMobileNo2, perTelno2, perHeight2, perWeight2, perStatus2, perDateModified2, status2, perId22, seen) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['perMname'], "text"),
                       GetSQLValueString($_POST['perLname'], "text"),
                       GetSQLValueString($_POST['perEmail'], "text"),
                       GetSQLValueString($_POST['perMobileNo'], "text"),
                       GetSQLValueString($_POST['perTelno'], "text"),
                       GetSQLValueString($_POST['perHeight'], "double"),
                       GetSQLValueString($_POST['perWeight'], "double"),
                       GetSQLValueString($_POST['perStatus'], "text"),
                       GetSQLValueString($_POST['perDateModified'], "date"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['perId2'], "int"),
                       GetSQLValueString($_POST['seen'], "text"));
					
  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($insertSQL, $dbmrov) or die(mysql_error());

  $insertGoTo = "dbmPIMUserIndex.php?perId=" . $row_Recordset1['perId'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
}
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
						 <?php $pertid1=$_SESSION['pidU'];
									$query1 = "SELECT *	FROM personnel WHERE personnel.perId = '$pertid1' ";
											$result1= mysql_query($query1);	
											while($row1= mysql_fetch_assoc($result1)){
												$perId1=$row1['perId'];?>
                        <ul class="nav pull-right">
						<li class="active"><a href="dbmPIMUserIndex.php?perId=<?php echo $perId1; ?>">Home &nbsp; <?php } ?></a></li>
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
								$perId01=$_SESSION['pidU'];
								$query01 = "SELECT * FROM personnel where personnel.PerId='$perId01'";
								$result01= mysql_query($query01);	
								while($row01 = mysql_fetch_assoc($result01)) { 
								$per01=$row01['perId'];
								?>
								<a href="dbmUserNotification.php?perId=<?php echo $per01; ?>">Notification  &nbsp;	<?php } ?>
								<?php
								$perId01=$_SESSION['pidU'];	
								//echo $perId01;
								$query0 = "SELECT *	FROM personnel_update where personnel_Update.perId22='$perId01' AND personnel_update.status2='Allowed' ";
								$result0= mysql_query($query0);	
								$count=0;
								while($row0 = mysql_fetch_assoc($result0)) { 
								$count=$count+1;
								}  
								//if($count!=0){
									echo '<b class="label pull-right" style="background-color: red;">'.$count.'</b>';
								//}
								 ?></a></li>
							
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user - Copy.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                   <!-- <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li> -->
									<li class="nav-header">User :</li>
									<li ><?php 
									$f=$_SESSION['fnameU'];
									$l=$_SESSION['lnameU'];
									echo '<div align="center"> '.$f.' '.$l.' </div>' ?></li>
									 <li><a href="#" ><div class="menu-icon icon-cog">&nbsp; Account Setting</div></a></li>
									 
                                    <li class="divider"></li>
                                     <li><a href="dbmlogoutUser.php" ><div class="menu-icon icon-signout">&nbsp; Logout</div></a></li>
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
             <div class="span12">
			<div class="widget widget-menu unstyled">
				 <table align="center" border="0" width="100%">
				 <tr bgcolor="#666666">
				 <td>
				 <p></p>
				 </td>
				 </tr>
				 <tr bgcolor="#333">
				 <td>
				  <table width="90%" border="0" align="center">
					  <tr>
						<td width="12%" rowspan="2"><?php 
									$pertid=$_SESSION['pidU'];
									$query = "SELECT *	FROM account, personnel, profile_pics 
												WHERE account.perId = '$pertid' 
												AND account.perId=personnel.perId 
												AND profile_pics.perId=personnel.perId";
											$result= mysql_query($query);	
											while($row= mysql_fetch_assoc($result)){
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
											$type=$row['picType'];?>
								
                                     <?php if($img==null){ ?>
                <img class="img-circulars pull-left"  src="images/user - Copy.png">
                <?php } else{ ?>
                <img class="img-circulars pull-left" src="<?php echo 'data:image/'.$type.';base64,'.base64_encode($img); ?>" width="200" height="200"/>
                <?php	}?>
											</td>
						<td width="58%"><p><div class="media-body">
                  <h4>
                    <?php
					echo '<font color="white">'.$first.' '.$middle.' '.$last.' '.$ext.'</font>'; ?>
                  </h4>
					<div class="profile-brief">  <strong> <?php  
					$queryPos="select * from positions where positions.posId='$position'";
					$resultPos= mysql_query($queryPos);	
					 while($rowpos = mysql_fetch_assoc($resultPos)) { 	
					 $posname=$rowpos['posName'];
					 echo  '<font color="white">'.$posname.'</font>';
					 } 
					 ?></strong></div>                  <div class="profile-brief">
                    <?php if($tel!=NULL){
											  echo ' <strong> <font color="white">  Tel. No :</strong> '.$tel.' - </font>';
										  }
										  if($mob!=NULL){
											  echo ' <strong><font color="white">  Mobile No :</strong> '.$mob.' - </font>';
										  }
										  if($em!=NULL){
											  echo ' <strong><font color="white"> Email No :</strong> '.$em.'</font> ';
										  }
										  ?>
                    </strong></div>
                  <div class="profile-brief"><font color="white"> Department of Budget and Management </font> </div>
                  <div class="profile-brief"><font color="white"> Regional Office V </font> </div>
                  <div class="profile-brief"><font color="white"> Legazpi City </font> </div>
                  
                </div></p></td>
					  </tr>
					  <tr>
					<td><div class="profile-details muted">
                    <form name="formprofile" method="POST" action="">
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn" name="profile" id="profile"><i class="icon-plus shaded"></i> Change Profile Picture</button></p>
                    </form>
                    <?php
						$display="block";
						if(isset($_POST['profile'])){ ?>
                    <div id="myalert"  style="display:<?php echo $display ?>;">
                      <div id="header">
                        <form action="dbmPIMUserIndex.php?perId=<?php echo $persid;?>" method="post">
                          <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                        </form>
                        <p>&nbsp;</p>
                        <center>
                          <h2 class="modal-title"><b> &nbsp;Change Profile Picture</b></h2>
                        </center>
                        <hr>
                        <form id="uploadform"  action ="dbmpictureUser.php" method="post" enctype="multipart/form-data">
                          <table  width="100%">
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
                  </div></td>
					  </tr>
					
					</table>
					<?php } ?>
				 </td>
				 </tr>
				 <tr bgcolor="#666666">
				 <td>
				 <p></p>
				 </td>
				 </tr>
				 </table> </li>
                   </div>            
            </div>
			 </div>            
            </div>
			
			<p></p>
		<div class="container">
			<div class="row">
				<div class="span3">
					<div class="sidebar">
						 <?php $pertid2=$_SESSION['pidU'];
									$query2 = "SELECT *	FROM personnel WHERE personnel.perId = '$pertid2' ";
											$result2= mysql_query($query2);	
											while($row2= mysql_fetch_assoc($result2)){
												$perId2=$row2['perId'];?>
						<ul class="widget widget-menu unstyled">
							<li class="active">
								<a href="dbmPIMUserIndex.php?perId=<?php echo $perId2; ?>">
									<i class="menu-icon icon-eye-open"></i>
									User Profile <small>(Home)</small>
								</a>
							</li>
							<li>
								<a href="dbmUserLeaveApp.php?perId=<?php echo $perId2 ?>">
									<i class="menu-icon icon-briefcase"></i>
									Your Leave Application
								</a>
							</li>
							<li>
								<a href="dbmUserPDSView.php?perId=<?php echo $perId2 ?>">
									<i class="menu-icon icon-briefcase"></i>
									PDS
								</a>
							</li>
							<li>
								 <?php 
									$pertid5=$_SESSION['pidU'];
									$query5 = "SELECT *	FROM personnel WHERE personnel.perId = '$pertid1' ";
											$result5= mysql_query($query5);	
											while($row5= mysql_fetch_assoc($result5)){
											$perId5=$row5['perId'];
													$query6 = "SELECT *	FROM division WHERE division.perId = '$perId5' ";
													$result6= mysql_query($query6);	
													while($row6= mysql_fetch_assoc($result6)){
													$perId6=$row6['perId'];
													$divId6=$row6['divId'];
													?>
								<a href="dbmPIMLeaveRequest.php?perId=<?php echo $perId2 ?>">
									<i class="menu-icon icon-inbox"></i>
									Leave Request (of Staff)
									<b class="label green pull-right">
									<?php
									$query7 = "SELECT * FROM apply_leave, personnel WHERE apply_leave.perId = personnel.perId and  personnel.divId=$divId6";
													$result7= mysql_query($query7);	
													$count7=0;
													while($row7= mysql_fetch_assoc($result7)){
													$perId7=$row7['perId'];
												    $appLeave7=$row7['appLeaveId'];
													$approve17=$row7['Approve1'];
													if($approve17==Null){
														$count7=$count7+1;
													}
													} echo $count7; 
													  ?>
									</b>
								</a>
								<?php } } ?>
							</li> 
							<li>
							 <?php 
									
									$query9 = "SELECT *	FROM positions where positions.posName='Director IV'";
									$result9= mysql_query($query9);	
									while($row9= mysql_fetch_assoc($result9)){
									$perId9=$row9['posId'];
											$pertid8=$_SESSION['pidU'];
											$query8 = "SELECT *	FROM personnel WHERE personnel.perPosition = '$perId9' and personnel.perId='$pertid8'";
											$result8= mysql_query($query8);	
											while($row8= mysql_fetch_assoc($result8)){
											$perId8=$row8['perId'];
											?>
								<a href="dbmPIMDirector.php?perId=<?php echo $perId2 ?>">
									<i class="menu-icon icon-tasks"></i>
									Leave Application (DBM Staff)
									<b class="label green pull-right">
									<?php
									$queryv = "SELECT * FROM apply_leave";
													$resultv= mysql_query($queryv);	
													$countv=0;
													while($rowv= mysql_fetch_assoc($resultv)){
													$approve1v=$rowv['Approve1'];
													$approve2v=$rowv['Approve2'];
													if ($approve2v==null && $approve1v!='No'){
														$countv=$countv+1;
													}
													} echo $countv;
													  ?>
									</b>
								</a>
									<?php } } ?>
							</li>
							
						</ul><!--/.widget-nav-->
											<?php } ?>
					</div><!--/.sidebar-->
				</div><!--/.span3-->


				<div class="span9">
					<div class="content">

						<div class="module">
						
							<div class="module-body">
							<!--<ul class="profile-tab nav nav-tabs">
                                    <li class="active"><a href="#">Personal Information</a></li>
                                    <li><a href="#" >Family Background</a></li>
									<li><a href="#" >Requirements</a></li>
                            </ul>-->
									<div class="profile-tab-content tab-content">
                                    <div class="tab-pane fade active in" id="activity">
                                        <div class="stream-list">
                                            <div class="media stream">
                                                <div class="media-body">
												<table align="center" border=1 width="100%" >
                                                      <tr valign="baseline" bgcolor="#333">
                                                        <td nowrap align="center" colspan=2><h3 id="StyleLink2"><?php echo $row_Recordset1['perFname']; ?> : Your Personal Information</h3></td>
                                                      </tr>
												</table>
                         <form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
                            <table align="center" width="85%" border=0>
                              <tr valign="baseline">
                                <td nowrap align="left" colspan=4 ><p></p><h3>Personal Information : </h3></td>
							  <tr valign="baseline">
                               <td nowrap align="left" colspan=4><h5>Identification :</h5></td>
                             </tr>
                             <tr valign="baseline">
                               <td nowrap align="right">First Name : </td>
                               <td><?php echo '&nbsp; '.$row_Recordset1['perFname']; ?></td>
							    <td nowrap align="right"><strong  class="text-error" >Middle Name</strong></td>
                              <td><input type="text" name="perMname" value="<?php echo $row_Recordset1['perMname']; ?>" size="32" required></td>
                             </tr>
							  <tr valign="baseline">
                              <td nowrap align="right"><strong  class="text-error" >Last Name :</strong></td>
                               <td><input type="text" name="perLname" value="<?php echo $row_Recordset1['perLname']; ?>" size="32" required></td>
							    <td nowrap align="right">Extension Name :</td>
                               <td><?php if ($row_Recordset1['perExtName']==Null || $row_Recordset1['perExtName']==" "){
								   echo '&nbsp;  None/Not Applicable' ;
							   } else {
								    echo $row_Recordset1['perExtName'];
							   } ?>
							   
							  </td>
                             </tr>
                             <tr valign="baseline">
                              <td nowrap align="right">Birthday :</td>
                               <td><?php echo $row_Recordset1['perBday'] ?></td>
							    <td nowrap align="right">Place of Birth :</td>
                               <td><?php echo $row_Recordset1['perBPlace'] ?></td>
                             </tr>
                             <tr valign="baseline">
                              <td nowrap align="right">Gender :</td>
                               <td><?php echo $row_Recordset1['perGender'] ?></td>
							    <td nowrap align="right"><strong  class="text-error" >Civil Status :</strong></td>
                               <td><select name="perStatus" id="perStatus" required>
                                  <option value = "Single"<?php if($row_Recordset1['perStatus'] == 'Single') { ?> selected="selected"<?php } ?>>Single</option>
                                  <option value = "Married"<?php if($row_Recordset1['perStatus'] == 'Married') { ?> selected="selected"<?php } ?>>Married</option>
                                  <option value = "Widowed"<?php if($row_Recordset1['perStatus'] == 'Widowed') { ?> selected="selected"<?php } ?>>Widowed</option>
								  <option value = "Separated"<?php if($row_Recordset1['perStatus'] == 'Separated') { ?> selected="selected"<?php } ?>>Separated</option>
                                </select></td>
                             </tr>
                             <tr valign="baseline">
                              <td nowrap align="right">Age :</td>
                               <td><?php echo $row_Recordset1['perAge'] ?></td>  
							     <td nowrap align="right">Blood Type:</td>
                               <td><?php echo $row_Recordset1['perBloodType'] ?>
							   
							   
							   </td>
                             </tr>
                             </tr>
                             <tr valign="baseline">
							    <td nowrap align="right"><strong  class="text-error" >Height :</strong></td>
                               <td><input type="number" name="perHeight" value="<?php echo $row_Recordset1['perHeight']; ?>" size="32" required></td>
							    <td nowrap align="right"><strong  class="text-error" >Weight :</strong></td>
                               <td><input type="number" name="perWeight" value="<?php echo $row_Recordset1['perWeight']; ?>" size="32" required></td>
                             </tr>
                          
                             <tr valign="baseline">
                               <td nowrap align="right"><strong  class="text-error" >Email Address :</strong></td>
                               <td ><input  type="text" name="perEmail" placeholder=" " value="<?php echo $row_Recordset1['perEmail']; ?>" size="32"  /></td>
							   <td nowrap align="right"><strong  class="text-error" >Mobile No : </strong></td>
                               <td><input type="text" name="perMobileNo" placeholder=" " value="<?php echo $row_Recordset1['perMobileNo']; ?>" size="32"  /></td>
                             </tr>
                          
                             <tr valign="baseline">
                                <td nowrap align="right">Citizenship :</td>
                                <td><?php echo $row_Recordset1['perCit'] ?></td>
							    <td nowrap align="right"><strong  class="text-error" >Telephone No : </strong></td>
                               <td><input type="text" name="perTelno" placeholder=" " value="<?php echo $row_Recordset1['perTelno']; ?>" size="32"></td>
                             </tr>
							  <?php 
							  $citnature=$row_Recordset1['perCitNature'];
							  $citCountry=$row_Recordset1['perCitCountry'];
							  if($citnature!=Null || $citCountry!=null){ ?>
							  
                               <tr valign="baseline">
                                <td nowrap align="left" colspan=4 ><hr><h5>With Dual Citizenship : </h5></td>
								</tr>
							  <tr valign="baseline">
								  <td nowrap align="right">Nature :</td>
                                <td><?php echo $row_Recordset1['perCitNature'];?></option>
								</td>
								  <td nowrap align="right">Country :</td>
                                <td><?php echo $row_Recordset1['perCitCountry'];?>
								</td>
                              </tr> 
							  <?php } ?>
							  <tr valign="baseline">
                                <td nowrap align="left" colspan=4 ><p></p></td>
							  <tr valign="baseline">
							  <tr valign="baseline">
                                <td nowrap align="left" colspan=4 ><hr><h3>Employment Information : </h3></td>
							  <tr valign="baseline">
							   <tr valign="baseline">
                                <td nowrap align="right">Agency Employee no:</td>
                                <td><div align="center"><?php echo $row_Recordset1['perAgenEmpNo']; ?></div></td>
								 <td nowrap align="right">Status of Appointment :</td>
                                <td><div align="center"><?php echo $row_Recordset1['perAppStat']; ?>
                                </div></td>
                              </tr>
							   <tr valign="baseline">
                                <td nowrap align="right">Position Title :</td>
                                <td>
								  <div align="center"><?php  $positionNiya=$row_Recordset1['perPosition'];
								$querypos = "SELECT * FROM positions where positions.posId='$positionNiya'";
									$resultpos= mysql_query($querypos);	
									while($rowpos= mysql_fetch_assoc($resultpos)){
									$perIdpos=$rowpos['posId'];
									$perPosName=$rowpos['posName'];
									echo $perPosName; }
								  ?>
								    
						         </div></td>
								 <td nowrap align="right">Monthly Salary:</td>
                                <td><div align="center"><?php echo $row_Recordset1['perMonSalary']; ?></div></td>
                              </tr>
							   <tr valign="baseline">
                                <td nowrap align="right">Division:</td>
                                <td><div align="center"><?php  $divisionNiya=$row_Recordset1['divId'];
								$querydiv = "SELECT * FROM division where division.divId='$divisionNiya'";
									$resultdiv= mysql_query($querydiv);	
									while($rowdiv= mysql_fetch_assoc($resultdiv)){
									$perIdDiv=$rowdiv['divId'];
									$perDivName=$rowdiv['divName'];
									echo $perDivName; }
								  ?></div></td>
                              </tr>
							   <tr valign="baseline">
                                <td nowrap align="left" colspan=4 ><hr><h5>Length of Service  : </h5></td>
								</tr>
							   <tr valign="baseline">
                                <td nowrap align="right">Date Started :</td>
                                <td><div align="center"><?php echo $row_Recordset1['perDateStarted']; ?></div></td>
								 <td nowrap align="right"><div>Expected Date of</div><div> End of Service :</div></td>
                                <td><div align="center"><?php echo $row_Recordset1['perDateEnded']; ?></div></td>
                              </tr>
							  <?php 
							  $perTransferee=$row_Recordset1['perTransferee'];
							  $perDateTrans=$row_Recordset1['perDateTrans'];
							  if ($perTransferee!=Null || $perDateTrans!=Null){ ?>
							    <tr valign="baseline">
                                <td nowrap align="left" colspan=4 ><hr><h5>Transferee  Details: </h5></td>
								</tr>
							  <tr valign="baseline">
                                <td nowrap align="right">Previous Department :</td>
                                <td><div align="center"><?php echo $row_Recordset1['perTransferee']; ?>
                                </div></td>
                                <td nowrap align="right">Date Transferred :</td>
                                <td><div align="center">
                                  <?php $row_Recordset1['perDateTrans']; ?>
                                </div></td>
                              </tr> <?php } ?>
							  
							   <tr valign="baseline">
                                <td nowrap align="left" colspan=4 ><hr><h5>Employee ID's  : </h5></td>
								</tr>
                              <tr valign="baseline">
							  <td nowrap align="right">TIN No:</td>
                                <td><div align="center"><?php
								if ($row_Recordset1['perTINno']==Null || $row_Recordset1['perTINno']==" "){
								   echo '&nbsp;  None/Not Applicable at this moment.' ;
							   } else {
							   echo $row_Recordset1['perTINno']; } ?></div></td>
								 <td nowrap align="right">GSIS No:</td>
                                <td><div align="center"><?php 
								if ($row_Recordset1['perGSISno']==Null || $row_Recordset1['perGSISno']==" "){
								   echo '&nbsp;  None/Not Applicable at this moment.' ;
							   } else {
							   echo $row_Recordset1['perGSISno']; } ?></div></td>
                              </tr>
                              <tr valign="baseline">
                                <td nowrap align="right">PagIbig No:</td>
                                <td><div align="center"><?php 
								if ($row_Recordset1['perPagIbigNo']==Null || $row_Recordset1['perPagIbigNo']==" "){
								   echo '&nbsp;  None/Not Applicable at this moment.' ;
							   } else {
							   echo $row_Recordset1['perPagIbigNo']; } ?></div></td>
								  <td nowrap align="right">PhilHealth no:</td>
                                <td><div align="center"><?php if ($row_Recordset1['perPhilHno']==Null || $row_Recordset1['perPhilHno']==" "){
								   echo '&nbsp;  None/Not Applicable at this moment.' ;
							   } else { echo $row_Recordset1['perPhilHno']; }?></div></td>
                              </tr>
                              <tr valign="baseline">
                                <td nowrap align="right">SSS No:</td>
                                <td><div align="center"><?php if ($row_Recordset1['perSSSno']==Null || $row_Recordset1['perSSSno']==" "){
								   echo '&nbsp;  None/Not Applicable at this moment.' ;
							   } else{ echo $row_Recordset1['perSSSno']; }?></div></td>
								  <td nowrap align="right">BIR No:</td>
                                <td><div align="center"><?php if ($row_Recordset1['perBIRno']==Null || $row_Recordset1['perBIRno']==" "){
								   echo '&nbsp;  None/Not Applicable at this moment.' ;
							   } else{ echo $row_Recordset1['perBIRno']; } ?></div></td>
                              </tr>
							  <tr>
							  <td colspan=4><p>&nbsp;</p></td>
							  </tr>
                              <tr valign="baseline" >
                                  <td align="right" nowrap><input type="hidden" name="perDateModified" value="<?php echo date('Y-m-d'); ?>" size="32"></td>
                                  <td><input type="hidden" name="perId2" value="<?php echo $row_Recordset1['perId']; ?>" size="32">
                                  <input type="hidden" name="seen" value="No" size="32">
                                  <input type="hidden" name="status" value="Pending" size="32"></td>
                                  <td align="right" nowrap>&nbsp;</td>
                                  <td align="right"><input type="submit" value="Update record" class="btn btn-large btn-inverse"
 onClick="return confirm('Update Record? Your action will be sent first to the HR Admin for checking and Confirmation...Thank you!!')"></td>
                                                      </tr>
                            </table>
                            <input type="hidden" name="MM_insert" value="form1">
                         </form>
                                                  <p>&nbsp;</p>
                                                  <p>&nbsp;</p>
                                                </div>
                                            </div>
											
											</div>
                                                </div>
                                            </div>
							</div>
						</div>

					</div><!--/.content-->
					
					
					
				</div><!--/.span9-->
			</div>
			</div><!--/.container-->

			 </div>            
		
	
			
		

        <div class="footer" style="background-color:white;">
           <div class="container" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="copyright">&copy; 2017 Department of Budget and Management Regional Office V</b> - All rights reserved.
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
