<?php require_once('../Connections/dbmrov.php'); ?>
<?php @session_start(); 
if($_SESSION['usernamerec']==''){
header('location:dbmLoginRECORD.php');
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
                         
                        <ul class="nav pull-right">
                            
                             <li><a href="rmsnotif.php">Notification : &nbsp;<b class="label pull-right" style="background-color: red;">
                                    11</b></a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="rmsicons/rms.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                  
									<li class="nav-header">HR Admin :</li>
									<li ><?php 
									$f=$_SESSION['fnamerec'];
									$l=$_SESSION['lnamerec'];
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
                            <ul class="widget widget-menu unstyled" style="background-color:#333" >
								
							<?php 										
									$accountid=$_SESSION['aidrec'];
									$pertid=$_SESSION['pidrec'];
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
                                <li class="active"><a href="dbmIndexRMS.php"><i class="menu-icon icon-dashboard"></i>Home
                                </a></li>
                                  <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-briefcase">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Records</a>
                                    <ul id="togglePages" class="collapse unstyled">
                                   <li><a href="allotmentfiles.php"><i class="icon-inbox"></i>Allotment Files</a></li>
                                        <li><a href="nosca.php"><i class="icon-inbox"></i>Notice of Staffing and Compensation Action (NOSCA)</a></li>
                                        <li><a href="debitvouchers.php"><i class="icon-inbox"></i>Debit Vouchers</a></li>
                                        <li><a href="PSI-POP.php"><i class="icon-inbox"></i>Personal Services Itemization and Plantilla of Positions</a></li>
                                        <li><a href="files.php?type=5"><i class="icon-inbox"></i>Action Documents/Reply Letters</a></li>
                                        <li><a href="files.php?type=6"><i class="icon-inbox"></i>Acknowledgement Receipts</a><a href="remittances.php">List of Remittances</a></li>
                                        <li><a href="vouchers.php"><i class="icon-inbox"></i>Vouchers Including Bills, Invoices & Other Supporting Documents</a></li>
                                        <li><a href="budgetreports.php"><i class="icon-inbox"></i>Budget Reports</a></li>
                                        <li><a href="budgetreleases.php"><i class="icon-inbox"></i>Budget Releases</a></li>
                                    </ul>
                                </li>
                            </ul>
                                <?php 
                            $contacrh =mysql_query("SELECT COUNT(file_id) as count FROM file WHERE archive = 1");
                            $row5 = mysql_fetch_assoc($contacrh);
                            $arch = $row5['count'];
                             ?>
                                <li><a href="archive.php"><i class="menu-icon icon-tasks"></i>Archives<b class="label green pull-right"><?php echo $arch; ?></b> </a></li>
                               <li><a href="appraisalreport.php"><i class="menu-icon icon-book"></i>Appraisal Report
                                </a></li>
                            </ul>
                            <!--
                            <ul class="widget widget-menu unstyled">
                                <li><a href="ui-button-icon.html"><i class="menu-icon icon-inbox"></i> Notifications  <b class="label orange pull-right">19</b></a></li>
                            </ul>
                            -->
                          
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
								<table width="100%"><tr>
								<td><h3>
								Types of Records :
								</h3></td>
								<td align="right"><h3>
                               <a href=<?php echo "addnewrec.php?typeid=3"; ?> class="btn btn-large btn-inverse pull-right"><i class="icon-plus shaded"></i> Add New</a>
                </h3></td>
								</tr></table>
                                    
                                </div>
                                <div class="module-body table">
                                   <table cellpadding="0" cellspacing="0" border="0" class="table-bordered table-striped	 display"
                                        width="100%">
                                        <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>List of Agency</th>
                                      
                                    </tr>
                                     </thead>
                                     <tbody>
                                         
                                         <?php
                                         
                                            $agency = mysql_query("SELECT DISTINCT agency FROM file WHERE type_id=3");
                                            $no = 0;
                                            while ($ag=mysql_fetch_array($agency)) {
                                               $agency_name = $ag['agency'];
                                               $no += 1;
                                               echo "<tr>";
                                               echo "<td>".$no."</td>";
                                               echo "<td>";
                                               echo "<li><a href='files.php?agency=$agency_name&&type=3'>".$agency_name. "</a></li>";
                                               echo "</td>";
                                               echo "</tr>";
                                            }
                                           
                                         ?>
                                            
                                     </tbody>
									
                                   
                                  </table>
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

