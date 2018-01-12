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
 .docsexample2{
  margin: 20px 0 0;
  padding: 10px 19px 10px;
  background-color: #fff;
  border: 1px solid #e5e5e5;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  overflow: hidden
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
width: 530px;
margin: 30px auto;
background: #fff;    
padding: 25px;
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
</style>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RMS - Files</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
		    <link type="text/css" href="bootstrap/css/styleLink.css" rel="stylesheet" rel='stylesheet'>
		    <link type="text/css" href="css/styleLink.css" rel='stylesheet'>
        <script src="dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
       
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                     <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="dbmIndexRMS.php"><img src="images/logo.png" class="nav-avatar" /> DBM-ROV</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="rmsicons/rms.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-header">RECORDS Admin :</li>
                                    <li ><?php 
                                    $f=$_SESSION['fnamerec'];
                                    $l=$_SESSION['lnamerec'];
                                    echo '<div align="center"> '.$f.' '.$l.' </div>' ?></li>
                                     <li><a href="#" ><div class="menu-icon icon-dashboard">&nbsp; Go to Profile</div></a></li>
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
                                    $query0 = "SELECT * FROM account, personnel, profile_pics 
                                                WHERE account.accId = '$accountid'
                                                AND account.perId = '$pertid' 
                                                AND account.perId=personnel.perId 
                                                AND profile_pics.perId=personnel.perId";
                                            $result0= mysql_query($query0); 
                                            while($row0 = mysql_fetch_assoc($result0)) {
                                            $p0=$row0['perId'];
                                            $f0=$row0['perFname'];
                                            $l0=$row0['perLname'];
                                            $img0=$row0['image']; 
                                            $type0=$row0['picType'];?>
                                    <?php if($img0==null){ ?>
                                       <li align="center" ><p></p><img class="img-circular" src="images/user - Copy.png" /> <p></p></li>
                                    
                                    <?php } else{ ?>
                                      <li align="center" ><p></p><img align="center" class="img-circular" src="<?php echo 'data:image/'.$type0.';base64,'.base64_encode($img0); ?>"/> <p></p></li>
                                                
                                <?php   } ?>
                                    
                              <li class="active"><a href="#" >(<?php echo $f0." ".$l0; ?>)
                                </a></li><?php  }  ?>
                            </ul>
							               <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="dbmIndexRMS.php"><i class="menu-icon icon-dashboard"></i>Home
                                </a></li>
                                  <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-briefcase">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Records</a>
                                     <?php
                        $typeqry=mysql_query("SELECT * FROM type ORDER BY type_id ");
                        echo "<ul id='togglePages' class='collapse unstyled'>";
                                while($rows = mysql_fetch_array($typeqry)){
                                    $type_id=$rows['type_id'];
                                    $type_name=$rows['type_name'];
                            echo "<li><a href='file_cat.php?type=$type_id'><i class='icon-inbox'></i>".$type_name."</a></li>";} 
                            echo "</ul>";?>
                                </li>
                            </ul>
                                <li><a href="gen_reports.php"><i class="menu-icon icon-book"></i> Reports
                                </a></li>
                        <?php 
                        $contacrh =mysql_query("SELECT DISTINCT type_id, subtype_id FROM file where status='archive'");
                        $arch = mysql_num_rows($contacrh);
                             ?>
                                <li><a href="rmsnotif.php"><i class="menu-icon icon-tasks"></i>Archives<b class="label green pull-right"><?php echo $arch; ?></b> </a></li>
                                <li><a href="settings.php"><i class="menu-icon icon-cog"></i>Settings</a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="module">
							
                <div class="module-head">
							
                     <?php
                        if(isset($_GET['agency']) && isset($_GET['subtype']) && isset($_GET['type'])){
                        $agency_name=$_GET['agency'];
                        $subtype_id=$_GET['subtype'];
                        $type=$_GET['type'];
                        $getst=mysql_query("SELECT subtype_name FROM sub_type WHERE subtype_id='$subtype_id'");
                        $stype=mysql_fetch_assoc($getst);
                        $subtype_name=$stype['subtype_name'];
                      ?>
                 <h2><?php echo $subtype_name; ?> </h2>
                <h3> <?php echo "Agency: ".$agency_name ; ?>
                <a class="collapsed pull-right" data-toggle="collapse" href="#toggledetails">See Details<i class="icon-chevron-down pull-right"></i></a></h3>
               
                <form method="POST">
               <?php
                $sqldetails=mysql_query("SELECT * FROM detail WHERE d_agency='$agency_name' && subtype_id = '$subtype_id' && type_id='$type'");
                $drow=mysql_fetch_assoc($sqldetails);
                $volume=$drow['volume'];
                $location=$drow['location'];
                $freq=$drow['freq'];
                $duplication=$drow['duplication'];
                $time_value=$drow['time_value'];
                $utility_value=$drow['utility_value'];
                $active_RP=$drow['active_RP'];
                $storage_RP=$drow['storage_RP'];
                $disposition=$drow['disposition'];
                 $total_RP = $active_RP + $storage_RP;
                ?>
              <ul id="toggledetails" class="collapse unstyled">
              <div class="docsexample2">
                <table width="100%" cellpadding="6" cellspacing="0" border="0" class="table-bordered table-striped">
                <form name="editdetails" method="POST" action="">
              <button class="btn btn-small btn-primary pull-right" name="editdet"><i class="menu-icon icon-cog"></i> Edit Details</button><br><br>
                </form>
            
                 <tbody>
                <?php
                echo "<tr>";
                echo "<td><b>Volume in cubic Meter:  </b>".$volume."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Location of Records: </b>".$location."</td>";
                echo "</tr>";
               
                echo "<tr>";
                echo "<td><b>Frequency of Use: </b>".$freq."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Duplication: </b>".$duplication."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Time Value:  </b>".$time_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Utility Value: </b>".$utility_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Disposition Provision: </b>".$disposition."</td>";
                echo "</tr>";
                ?>
                </tbody>
                </table>
                <br>
                <table width="30%" cellpadding="4" cellspacing="0" border="1" class="table-bordered table-striped">
                <tbody>
                <tr><td><b>Retention Period</b></td></tr>
                <tr>
                <?php
                echo "<td><b>Active: </b>".$active_RP." Years <br><b>Storage: </b>".$storage_RP." Years <br> <b>Total: </b>".$total_RP." Years</td>";
                ?>
                </tr>
                </tbody>
                </table>
                
              </div>
                </ul>
                </form>
                
                 <?php
                $display="block";
                if (isset($_POST['editdet'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form <?php 
                        $agencyname=$_GET['agency'];
                        $stype_id2=$_GET['subtype'];
                        $type=$_GET['type'];
                        echo "action='files.php?agency=$agencyname&&subtype=$stype_id2&&type=$type'"; ?> method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
                  <form method="POST" <?php echo "action='editdet.php?agency=$agencyname&&subtype=$stype_id2&&type=$type'"; ?> class="form-horizontal row-fluid">
                        <br>
                        <center>
                          <h2 class="modal-title"><b> &nbsp;Edit Details</b></h2>
                         <h3><b> for <?php 
                         echo $subtype_name;
                         echo " - ".$agencyname; ?></b></h3>
                        </center>
                        <hr>
                        <div class="control-group">
                          <label class="control-label" for="basicinput1">Volume in cubic Meters: </label>&nbsp;
                          <input type="text" name="volume" id="basicinput1" class="span6" <?php echo "value='".$volume."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput2">Location of Records: </label>&nbsp;
                          <input type="text" name="location" id="basicinput2" class="span6" <?php echo "value='".$location."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput3">Frequency of Use: </label>&nbsp;
                          <input type="text" name="freq" id="basicinput3" class="span4" <?php echo "value='".$freq."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput4">Duplication: </label>&nbsp;
                          <select class="span6" name="duplication" id="basicinput4" >
                            <option <?php echo "value='".$duplication."'"; ?>><?php echo $duplication; ?></option>
                            <option value="Division A">Division A</option>
                            <option value="Division B">Division B</option>
                            <option value="Division C">Division C</option>
                            <option value="O.D.">O.D. C</option>
                            <option value="Records">Records</option>
                            <option value="Personnel">Personnel</option>
                            <option value="Supply">Supply</option>
                            <option value="Office Use">Office Use</option>
                            <option value="Accounting">Accounting</option>
                            <option value="CPRU">CPRU</option>
                            <option value="Cashier">Cashier</option>
                            <option value="Auditor">Auditor</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput5">Time Value: </label>&nbsp;
                          <select class="span4" name="tvalue" id="basicinput5">
                            <option <?php echo "value='".$time_value."'"; ?>><?php echo $time_value; ?></option>
                            <option value="Temporary">Temporary</option>
                            <option value="Permanent">Permanent</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput6">Utility Value: </label>&nbsp;
                          <select class="span4" name="uvalue" id="basicinput6">
                            <option <?php echo "value='".$utility_value."'"; ?>><?php echo $utility_value; ?></option>
                            <option value="Administrative">Administrative</option>
                            <option value="Fiscal">Fiscal</option>
                            <option value="Legal">Legal</option>
                            <option value="Archival">Archival</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput7">Disposition Provision: </label>&nbsp;
                          <input type="text" name="disposition" id="basicinput7" class="span6" <?php echo "value='".$disposition."'"; ?>>
                          <hr>
                          <label class="control-label">Retention Period</label>&nbsp;
                          <br><br>
                          <label class="control-label" for="basicinput8">Active: </label>&nbsp;
                          <input type="number" name="active_RP" id="basicinput8" class="span2" <?php echo "value='".$active_RP."'"; ?>> Yrs.
                          <br><br>
                          <label class="control-label" for="basicinput9">Storage: </label>&nbsp;
                          <input type="number" name="storage_RP" id="basicinput9" class="span2" <?php echo "value='".$storage_RP."'"; ?>> Yrs.
                         
                        </div>
                        <center>
                          <input type="submit" class="btn btn-success span2" name="editdet" value="Update">
                          </center>
                          <br>
                        </form>
                  </div>
                </div>
                <?php
                }
                ?> 



                <?php
                }
                 else if (isset($_GET['agency']) && isset($_GET['type'])){
                        $agency_name=$_GET['agency'];
                        $type=$_GET['type'];
                        $gett=mysql_query("SELECT type_name FROM type WHERE type_id='$type'");
                        $typen=mysql_fetch_assoc($gett);
                        $type_name=$typen['type_name'];
                      ?>
                <tr>
                 <h2>
                      <?php
                      echo $type_name;
                      ?>
                </h2>
                </tr>
                <tr>
                <td><h3>
                 <?php
                  echo "Agency: ".$agency_name ;
                  ?>
                <a class="collapsed pull-right" data-toggle="collapse" href="#toggledetails">See Details<i class="icon-chevron-down pull-right"></i>
                </a>
                </h3></td>
                </tr>
               </table>
                <form method="POST">
               <?php
                $sqldetails=mysql_query("SELECT * FROM detail WHERE d_agency='$agency_name' && type_id='$type'");
                $drow=mysql_fetch_assoc($sqldetails);
                $volume=$drow['volume'];
                $location=$drow['location'];
                $freq=$drow['freq'];
                $duplication=$drow['duplication'];
                $time_value=$drow['time_value'];
                $utility_value=$drow['utility_value'];
                $active_RP=$drow['active_RP'];
                $storage_RP=$drow['storage_RP'];
                $disposition=$drow['disposition'];
                 $total_RP = $active_RP + $storage_RP;
                ?>
              <ul id="toggledetails" class="collapse unstyled">
              <div class="docsexample2">
                <table width="100%" cellpadding="6" cellspacing="0" border="0" class="table-bordered table-striped">
                <form name="editdetails" method="POST" action="">
              <button class="btn btn-small btn-primary pull-right" name="editdet"><i class="menu-icon icon-cog"></i> Edit Details</button><br><br>
                </form>
            
                 <tbody>
                <?php
                echo "<tr>";
                echo "<td><b>Volume in cubic Meter:  </b>".$volume."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Location of Records: </b>".$location."</td>";
                echo "</tr>";
               
                echo "<tr>";
                echo "<td><b>Frequency of Use: </b>".$freq."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Duplication: </b>".$duplication."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Time Value:  </b>".$time_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Utility Value: </b>".$utility_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Disposition Provision: </b>".$disposition."</td>";
                echo "</tr>";
                ?>
                </tbody>
                </table>
                <br>
                <table width="30%" cellpadding="4" cellspacing="0" border="1" class="table-bordered table-striped">
                <tbody>
                <tr><td><b>Retention Period</b></td></tr>
                <tr>
                <?php
                echo "<td><b>Active: </b>".$active_RP." Years <br><b>Storage: </b>".$storage_RP." Years <br> <b>Total: </b>".$total_RP." Years</td>";
                ?>
                </tr>
                </tbody>
                </table>
                
              </div>
                </ul>
                </form>
                
                 <?php
                $display="block";
                if (isset($_POST['editdet'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form <?php 
                        $agencyname=$_GET['agency'];
                        $type=$_GET['type'];
                        echo "action='files.php?agency=$agencyname&&type=$type'"; ?> method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
                  <form method="POST" <?php echo "action='editdet.php?agency=$agencyname&&type=$type'"; ?> class="form-horizontal row-fluid">
                        <br>
                        <center>
                          <h2 class="modal-title"><b> &nbsp;Edit Details</b></h2>
                         <h3><b> for <?php 
                         echo $type_name;
                         echo " - ".$agencyname; ?></b></h3>
                        </center>
                        <hr>
                        <div class="control-group">
                          <label class="control-label" for="basicinput1">Volume in cubic Meters: </label>&nbsp;
                          <input type="text" name="volume" id="basicinput1" class="span6" <?php echo "value='".$volume."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput2">Location of Records: </label>&nbsp;
                          <input type="text" name="location" id="basicinput2" class="span6" <?php echo "value='".$location."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput3">Frequency of Use: </label>&nbsp;
                          <input type="text" name="freq" id="basicinput3" class="span4" <?php echo "value='".$freq."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput4">Duplication: </label>&nbsp;
                          <select class="span6" name="duplication" id="basicinput4" >
                            <option <?php echo "value='".$duplication."'"; ?>><?php echo $duplication; ?></option>
                            <option value="Division A">Division A</option>
                            <option value="Division B">Division B</option>
                            <option value="Division C">Division C</option>
                            <option value="O.D.">O.D. C</option>
                            <option value="Records">Records</option>
                            <option value="Personnel">Personnel</option>
                            <option value="Supply">Supply</option>
                            <option value="Office Use">Office Use</option>
                            <option value="Accounting">Accounting</option>
                            <option value="CPRU">CPRU</option>
                            <option value="Cashier">Cashier</option>
                            <option value="Auditor">Auditor</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput5">Time Value: </label>&nbsp;
                          <select class="span4" name="tvalue" id="basicinput5">
                            <option <?php echo "value='".$time_value."'"; ?>><?php echo $time_value; ?></option>
                            <option value="Temporary">Temporary</option>
                            <option value="Permanent">Permanent</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput6">Utility Value: </label>&nbsp;
                          <select class="span4" name="uvalue" id="basicinput6">
                            <option <?php echo "value='".$utility_value."'"; ?>><?php echo $utility_value; ?></option>
                            <option value="Administrative">Administrative</option>
                            <option value="Fiscal">Fiscal</option>
                            <option value="Legal">Legal</option>
                            <option value="Archival">Archival</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput7">Disposition Provision: </label>&nbsp;
                          <input type="text" name="disposition" id="basicinput7" class="span6" <?php echo "value='".$disposition."'"; ?>>
                          <hr>
                          <label class="control-label">Retention Period</label>&nbsp;
                          <br><br>
                          <label class="control-label" for="basicinput8">Active: </label>&nbsp;
                          <input type="number" name="active_RP" id="basicinput8" class="span2" <?php echo "value='".$active_RP."'"; ?>> Yrs.
                          <br><br>
                          <label class="control-label" for="basicinput9">Storage: </label>&nbsp;
                          <input type="number" name="storage_RP" id="basicinput9" class="span2" <?php echo "value='".$storage_RP."'"; ?>> Yrs.
                        </div>
                         <center>
                          <input type="submit" class="btn btn-success span2" name="editdet" value="Update">
                          </center>
                          <br>
                        </form>
                  </div>
                </div>
                <?php
                }
                ?> 

               <?php
                }
                else if (isset($_GET['type'])){

                  echo "<tr>";
                  echo "<td><h3>";
                
                if (isset($_GET['type'])){
                ?>
               
                <?php
                $type_id=$_GET['type'];
                $sq = mysql_query("SELECT type_name from type where type_id = '$type_id'");
                $row = mysql_fetch_assoc($sq);
                $name = $row['type_name'];
                echo $name;
                  if($type_id == 5){
                    echo "
                  <a href='addnewrec.php?typeid=5' class='btn btn-large btn-inverse pull-right'><i class='icon-plus shaded'></i> Add New</a>";
                  
              ?>
               <tr>
                <td><h3>
                
                <a class="collapsed pull-right" data-toggle="collapse" href="#toggledetails2">See Details<i class="icon-chevron-down pull-right"></i>
                </a>
                </h3></td>
                </tr>
               </table>
              <form method="POST">
               <?php
                $sqldetails=mysql_query("SELECT * FROM detail WHERE type_id = '$type_id'");
                $drow=mysql_fetch_assoc($sqldetails);
                $volume=$drow['volume'];
                $location=$drow['location'];
                $freq=$drow['freq'];
                $duplication=$drow['duplication'];
                $time_value=$drow['time_value'];
                $utility_value=$drow['utility_value'];
                $active_RP=$drow['active_RP'];
                $storage_RP=$drow['storage_RP'];
                $disposition=$drow['disposition'];
                 $total_RP = $active_RP + $storage_RP;
                ?>
              <ul id="toggledetails2" class="collapse unstyled">
              <div class="docsexample2">
                <table width="100%" cellpadding="6" cellspacing="0" border="0" class="table-bordered table-striped">
                <form name="editdetails" method="POST" action="">
              <button class="btn btn-small btn-primary pull-right" name="editdet"><i class="menu-icon icon-cog"></i> Edit Details</button><br><br>
                </form>
            
                 <tbody>
                <?php
                echo "<tr>";
                echo "<td><b>Volume in cubic Meter:  </b>".$volume."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Location of Records: </b>".$location."</td>";
                echo "</tr>";
               
                echo "<tr>";
                echo "<td><b>Frequency of Use: </b>".$freq."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Duplication: </b>".$duplication."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Time Value:  </b>".$time_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Utility Value: </b>".$utility_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Disposition Provision: </b>".$disposition."</td>";
                echo "</tr>";
                ?>
                </tbody>
                </table>
                <br>
                <table width="30%" cellpadding="4" cellspacing="0" border="1" class="table-bordered table-striped">
                <tbody>
                <tr><td><b>Retention Period</b></td></tr>
                <tr>
                <?php
                echo "<td><b>Active: </b>".$active_RP." Years <br><b>Storage: </b>".$storage_RP." Years <br> <b>Total: </b>".$total_RP." Years</td>";
                ?>
                </tr>
                </tbody>
                </table>
                
              </div>
                </ul>
                </form>
              <?php
                $display="block";
                if (isset($_POST['editdet'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form <?php 
                $type_id=$_GET['type'];
                $sq = mysql_query("SELECT type_name from type where type_id = '$type_id'");
                $row = mysql_fetch_assoc($sq);
                $name = $row['type_name'];
                        echo "action='files.php?type=$type_id'"; ?> method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
                  <form method="POST" <?php echo "action='editdet.php?type=$type_id'"; ?> class="form-horizontal row-fluid">
                        <br>
                        <center>
                          <h2 class="modal-title"><b> &nbsp;Edit Details</b></h2>
                         <h3><b> for <?php 
                         echo $name;
                         ?></b></h3>
                        </center>
                        <hr>
                        <div class="control-group">
                          <label class="control-label" for="basicinput1">Volume in cubic Meters: </label>&nbsp;
                          <input type="text" name="volume" id="basicinput1" class="span6" <?php echo "value='".$volume."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput2">Location of Records: </label>&nbsp;
                          <input type="text" name="location" id="basicinput2" class="span6" <?php echo "value='".$location."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput3">Frequency of Use: </label>&nbsp;
                          <input type="text" name="freq" id="basicinput3" class="span4" <?php echo "value='".$freq."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput4">Duplication: </label>&nbsp;
                          <select class="span6" name="duplication" id="basicinput4" >
                            <option <?php echo "value='".$duplication."'"; ?>><?php echo $duplication; ?></option>
                            <option value="Division A">Division A</option>
                            <option value="Division B">Division B</option>
                            <option value="Division C">Division C</option>
                            <option value="O.D.">O.D. C</option>
                            <option value="Records">Records</option>
                            <option value="Personnel">Personnel</option>
                            <option value="Supply">Supply</option>
                            <option value="Office Use">Office Use</option>
                            <option value="Accounting">Accounting</option>
                            <option value="CPRU">CPRU</option>
                            <option value="Cashier">Cashier</option>
                            <option value="Auditor">Auditor</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput5">Time Value: </label>&nbsp;
                          <select class="span4" name="tvalue" id="basicinput5">
                            <option <?php echo "value='".$time_value."'"; ?>><?php echo $time_value; ?></option>
                            <option value="Temporary">Temporary</option>
                            <option value="Permanent">Permanent</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput6">Utility Value: </label>&nbsp;
                          <select class="span4" name="uvalue" id="basicinput6">
                            <option <?php echo "value='".$utility_value."'"; ?>><?php echo $utility_value; ?></option>
                            <option value="Administrative">Administrative</option>
                            <option value="Fiscal">Fiscal</option>
                            <option value="Legal">Legal</option>
                            <option value="Archival">Archival</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput7">Disposition Provision: </label>&nbsp;
                          <input type="text" name="disposition" id="basicinput7" class="span6" <?php echo "value='".$disposition."'"; ?>>
                          <hr>
                          <label class="control-label">Retention Period</label>&nbsp;
                          <br><br>
                          <label class="control-label" for="basicinput8">Active: </label>&nbsp;
                          <input type="number" name="active_RP" id="basicinput8" class="span2" <?php echo "value='".$active_RP."'"; ?>> Yrs.
                          <br><br>
                          <label class="control-label" for="basicinput9">Storage: </label>&nbsp;
                          <input type="number" name="storage_RP" id="basicinput9" class="span2" <?php echo "value='".$storage_RP."'"; ?>> Yrs.
                        </div>
                        <center>
                          <input type="submit" class="btn btn-success span2" name="editdet" value="Update">
                          </center>
                          <br>
                        </form>
                  </div>
                </div>
                <?php
                }
                ?> 


                  <?php      
                  }
                  else if($type_id == 6){
                    echo "
                              <a href='addnewrec.php?typeid=6' class='btn btn-large btn-inverse pull-right'><i class='icon-plus shaded'></i> Add New</a>";
                 ?>
                 <tr>
                <td><h3>
                
                <a class="collapsed pull-right" data-toggle="collapse" href="#toggledetails2">See Details<i class="icon-chevron-down pull-right"></i>
                </a>
                </h3></td>
                </tr>
               </table>
                <form method="POST">
               <?php
                $sqldetails=mysql_query("SELECT * FROM detail WHERE type_id = '$type_id'");
                $drow=mysql_fetch_assoc($sqldetails);
                $volume=$drow['volume'];
                $location=$drow['location'];
                $freq=$drow['freq'];
                $duplication=$drow['duplication'];
                $time_value=$drow['time_value'];
                $utility_value=$drow['utility_value'];
                $active_RP=$drow['active_RP'];
                $storage_RP=$drow['storage_RP'];
                $disposition=$drow['disposition'];
                 $total_RP = $active_RP + $storage_RP;
                ?>
              <ul id="toggledetails2" class="collapse unstyled">
              <div class="docsexample2">
                <table width="100%" cellpadding="6" cellspacing="0" border="0" class="table-bordered table-striped">
                <form name="editdetails" method="POST" action="">
              <button class="btn btn-small btn-primary pull-right" name="editdet"><i class="menu-icon icon-cog"></i> Edit Details</button><br><br>
                </form>
            
                 <tbody>
                <?php
                echo "<tr>";
                echo "<td><b>Volume in cubic Meter:  </b>".$volume."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Location of Records: </b>".$location."</td>";
                echo "</tr>";
               
                echo "<tr>";
                echo "<td><b>Frequency of Use: </b>".$freq."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Duplication: </b>".$duplication."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Time Value:  </b>".$time_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Utility Value: </b>".$utility_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Disposition Provision: </b>".$disposition."</td>";
                echo "</tr>";
                ?>
                </tbody>
                </table>
                <br>
                <table width="30%" cellpadding="4" cellspacing="0" border="1" class="table-bordered table-striped">
                <tbody>
                <tr><td><b>Retention Period</b></td></tr>
                <tr>
                <?php
                echo "<td><b>Active: </b>".$active_RP." Years <br><b>Storage: </b>".$storage_RP." Years <br> <b>Total: </b>".$total_RP." Years</td>";
                ?>
                </tr>
                </tbody>
                </table>
                
              </div>
                </ul>
                </form>
                <?php
                $display="block";
                if (isset($_POST['editdet'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form <?php 
                $type_id=$_GET['type'];
                $sq = mysql_query("SELECT type_name from type where type_id = '$type_id'");
                $row = mysql_fetch_assoc($sq);
                $name = $row['type_name'];
                        echo "action='files.php?type=$type_id'"; ?> method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
                  <form method="POST" <?php echo "action='editdet.php?type=$type_id'"; ?> class="form-horizontal row-fluid">
                        <br>
                        <center>
                          <h2 class="modal-title"><b> &nbsp;Edit Details</b></h2>
                         <h3><b> for <?php 
                         echo $name;
                         ?></b></h3>
                        </center>
                        <hr>
                        <div class="control-group">
                          <label class="control-label" for="basicinput1">Volume in cubic Meters: </label>&nbsp;
                          <input type="text" name="volume" id="basicinput1" class="span6" <?php echo "value='".$volume."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput2">Location of Records: </label>&nbsp;
                          <input type="text" name="location" id="basicinput2" class="span6" <?php echo "value='".$location."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput3">Frequency of Use: </label>&nbsp;
                          <input type="text" name="freq" id="basicinput3" class="span4" <?php echo "value='".$freq."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput4">Duplication: </label>&nbsp;
                          <select class="span6" name="duplication" id="basicinput4" >
                            <option <?php echo "value='".$duplication."'"; ?>><?php echo $duplication; ?></option>
                            <option value="Division A">Division A</option>
                            <option value="Division B">Division B</option>
                            <option value="Division C">Division C</option>
                            <option value="O.D.">O.D. C</option>
                            <option value="Records">Records</option>
                            <option value="Personnel">Personnel</option>
                            <option value="Supply">Supply</option>
                            <option value="Office Use">Office Use</option>
                            <option value="Accounting">Accounting</option>
                            <option value="CPRU">CPRU</option>
                            <option value="Cashier">Cashier</option>
                            <option value="Auditor">Auditor</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput5">Time Value: </label>&nbsp;
                          <select class="span4" name="tvalue" id="basicinput5">
                            <option <?php echo "value='".$time_value."'"; ?>><?php echo $time_value; ?></option>
                            <option value="Temporary">Temporary</option>
                            <option value="Permanent">Permanent</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput6">Utility Value: </label>&nbsp;
                          <select class="span4" name="uvalue" id="basicinput6">
                            <option <?php echo "value='".$utility_value."'"; ?>><?php echo $utility_value; ?></option>
                            <option value="Administrative">Administrative</option>
                            <option value="Fiscal">Fiscal</option>
                            <option value="Legal">Legal</option>
                            <option value="Archival">Archival</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput7">Disposition Provision: </label>&nbsp;
                          <input type="text" name="disposition" id="basicinput7" class="span6" <?php echo "value='".$disposition."'"; ?>>
                          <hr>
                          <label class="control-label">Retention Period</label>&nbsp;
                          <br><br>
                          <label class="control-label" for="basicinput8">Active: </label>&nbsp;
                          <input type="number" name="active_RP" id="basicinput8" class="span2" <?php echo "value='".$active_RP."'"; ?>> Yrs.
                          <br><br>
                          <label class="control-label" for="basicinput9">Storage: </label>&nbsp;
                          <input type="number" name="storage_RP" id="basicinput9" class="span2" <?php echo "value='".$storage_RP."'"; ?>> Yrs.
                        </div>
                        <center>
                          <input type="submit" class="btn btn-success span2" name="editdet" value="Update">
                          </center>
                          <br>
                        </form>
                  </div>
                </div>
                <?php
                }
                ?> 
               
                
                <?php
                echo "</h3></td>";
                }
                else if($_GET['subtype'] && $_GET['type']){
                ?>
                  <tr>
                    <td><h5>
                <?php
                $stype_id=$_GET['subtype'];
                $type_id=$_GET['type'];
                $sq = mysql_query("SELECT subtype_name from sub_type where subtype_id = '$stype_id'");
                $row = mysql_fetch_assoc($sq);
                $tname = $row['subtype_name'];
                echo $tname;
                 echo "
                  <a href='addnewrec.php?typeid=$type_id&&subtype=$stype_id' class='btn btn-large btn-inverse pull-right'><i class='icon-plus shaded'></i> Add New</a>";
                ?>

                </h5></td>
                  </tr>
               <td>
                    <a class="collapsed pull-right" data-toggle="collapse" href="#toggledetails3">See Details<i class="icon-chevron-down pull-right"></i>
                </a>
                  </td>
                    </table>
                <form method="POST">
               <?php
                $sqldetails=mysql_query("SELECT * FROM detail WHERE type_id = '$type_id' AND subtype_id='$stype_id'");
                $drow=mysql_fetch_assoc($sqldetails);
                $volume=$drow['volume'];
                $location=$drow['location'];
                $freq=$drow['freq'];
                $duplication=$drow['duplication'];
                $time_value=$drow['time_value'];
                $utility_value=$drow['utility_value'];
                $active_RP=$drow['active_RP'];
                $storage_RP=$drow['storage_RP'];
                $disposition=$drow['disposition'];
                 $total_RP = $active_RP + $storage_RP;
                ?>
              <ul id="toggledetails3" class="collapse unstyled">
              <div class="docsexample2">
                <table width="100%" cellpadding="6" cellspacing="0" border="0" class="table-bordered table-striped">
                <form name="editdetails" method="POST" action="">
              <button class="btn btn-small btn-primary pull-right" name="editdet"><i class="menu-icon icon-cog"></i> Edit Details</button><br><br>
                </form>
            
                 <tbody>
                <?php
                echo "<tr>";
                echo "<td><b>Volume in cubic Meter:  </b>".$volume."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Location of Records: </b>".$location."</td>";
                echo "</tr>";
               
                echo "<tr>";
                echo "<td><b>Frequency of Use: </b>".$freq."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Duplication: </b>".$duplication."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Time Value:  </b>".$time_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Utility Value: </b>".$utility_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Disposition Provision: </b>".$disposition."</td>";
                echo "</tr>";
                ?>
                </tbody>
                </table>
                <br>
                <table width="30%" cellpadding="4" cellspacing="0" border="1" class="table-bordered table-striped">
                <tbody>
                <tr><td><b>Retention Period</b></td></tr>
                <tr>
                <?php
                echo "<td><b>Active: </b>".$active_RP." Years <br><b>Storage: </b>".$storage_RP." Years <br> <b>Total: </b>".$total_RP." Years</td>";
                ?>
                </tr>
                </tbody>
                </table>
                
              </div>
                </ul>
                </form>
                <?php
                $display="block";
                if (isset($_POST['editdet'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form <?php 
                $type_id=$_GET['type'];
                $stype_id=$_GET['subtype'];
                $sq = mysql_query("SELECT subtype_name from sub_type where subtype_id = '$stype_id'");
                $row = mysql_fetch_assoc($sq);
                $stypname = $row['subtype_name'];
                        echo "action='files.php?type=$type_id&&subtype=$stype_id'"; ?> method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
                  <form method="POST" <?php echo "action='editdet.php?type=$type_id&&subtype=$stype_id'"; ?> class="form-horizontal row-fluid">
                        <br>
                        <center>
                          <h2 class="modal-title"><b> &nbsp;Edit Details</b></h2>
                         <h3><b> for <?php 
                         echo $stypname;
                         ?></b></h3>
                        </center>
                        <hr>
                        <div class="control-group">
                          <label class="control-label" for="basicinput1">Volume in cubic Meters: </label>&nbsp;
                          <input type="text" name="volume" id="basicinput1" class="span6" <?php echo "value='".$volume."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput2">Location of Records: </label>&nbsp;
                          <input type="text" name="location" id="basicinput2" class="span6" <?php echo "value='".$location."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput3">Frequency of Use: </label>&nbsp;
                          <input type="text" name="freq" id="basicinput3" class="span4" <?php echo "value='".$freq."'"; ?>>
                          <br><br>
                          <label class="control-label" for="basicinput4">Duplication: </label>&nbsp;
                          <select class="span6" name="duplication" id="basicinput4" >
                            <option <?php echo "value='".$duplication."'"; ?>><?php echo $duplication; ?></option>
                            <option value="Division A">Division A</option>
                            <option value="Division B">Division B</option>
                            <option value="Division C">Division C</option>
                            <option value="O.D.">O.D. C</option>
                            <option value="Records">Records</option>
                            <option value="Personnel">Personnel</option>
                            <option value="Supply">Supply</option>
                            <option value="Office Use">Office Use</option>
                            <option value="Accounting">Accounting</option>
                            <option value="CPRU">CPRU</option>
                            <option value="Cashier">Cashier</option>
                            <option value="Auditor">Auditor</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput5">Time Value: </label>&nbsp;
                          <select class="span4" name="tvalue" id="basicinput5">
                            <option <?php echo "value='".$time_value."'"; ?>><?php echo $time_value; ?></option>
                            <option value="Temporary">Temporary</option>
                            <option value="Permanent">Permanent</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput6">Utility Value: </label>&nbsp;
                          <select class="span4" name="uvalue" id="basicinput6">
                            <option <?php echo "value='".$utility_value."'"; ?>><?php echo $utility_value; ?></option>
                            <option value="Administrative">Administrative</option>
                            <option value="Fiscal">Fiscal</option>
                            <option value="Legal">Legal</option>
                            <option value="Archival">Archival</option>
                          </select>
                          <br><br>
                          <label class="control-label" for="basicinput7">Disposition Provision: </label>&nbsp;
                          <input type="text" name="disposition" id="basicinput7" class="span6" <?php echo "value='".$disposition."'"; ?>>
                          <hr>
                          <label class="control-label">Retention Period</label>&nbsp;
                          <br><br>
                          <label class="control-label" for="basicinput8">Active: </label>&nbsp;
                          <input type="number" name="active_RP" id="basicinput8" class="span2" <?php echo "value='".$active_RP."'"; ?>> Yrs.
                          <br><br>
                          <label class="control-label" for="basicinput9">Storage: </label>&nbsp;
                          <input type="number" name="storage_RP" id="basicinput9" class="span2" <?php echo "value='".$storage_RP."'"; ?>> Yrs.
                        </div>
                        <center>
                          <input type="submit" class="btn btn-success span2" name="editdet" value="Update">
                          </center>
                          <br>
                        </form>
                  </div>
                </div>
                <?php
                }
                ?> 
                  <?php
                }
              }
            }
                ?>

                </div>
                

            <?php
           if(isset($_POST['activefiles'])){
            ?>

                      <table width="100%" class="table table-striped table-condensed">
                      <tr class="heading">
                      <td width=1%>
                      <form action="" method="post">
                      <button title="All Files" type="submit" name="all" class="btn btn-info">All</button>
                      </form> 
                      </td>
                      <td width="1%">
                      <form action="" method="post">
                      <button title="Active Files" type="submit" name="activefiles" class="btn btn-warning active">Active</button>
                      </form> 
                     </td>
                     <td width="1%">
                      <form action="" method="post">
                      <button title="Stored Files" type="submit" name="storedfiles" class="btn btn-success">On Storage</button>
                      </form> 
                      </td>
                      <td width="90">  </td>
                      </tr>
              </table>
                              <div class="module">
                                <div class="module-body table">
                                   <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped   display"
                                        width="100%">
                                        <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Series No.</th>
                                      <th>Title</th>
                                      <th>Date</th>
                                      <th>Purpose</th>
                                      <th>Amount</th>
                                      <th>Status</th>
                                      <th>View</th>
                                    </tr>
                                     </thead>
                                      <tbody>
            <?php
           
                                         if (isset($_GET['agency']) && isset($_GET['type']) && isset($_GET['subtype'])){
                                        $agency_name=mysql_escape_string($_GET['agency']);
                                        $stype_id=$_GET['subtype'];
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE (agency = '$agency_name' AND subtype_id='$stype_id' AND type_id='$type' AND status='active')");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";
                                     
                                      $retper=mysql_query("SELECT * from detail WHERE (d_agency = '$agency_name' AND subtype_id='$stype_id' AND type_id='$type')");
                                      $resultRP=mysql_fetch_array($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                      if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open'></i> View</a></td>";
                                        echo "</tr>";
                                        
                                        }
                                      }
                                      else if (isset($_GET['agency']) && $_GET['type']) {
                                        $agency_name=mysql_escape_string($_GET['agency']);
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE (agency = '$agency_name' && type_id='$type' && status='active')");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";
                                     
                                      $retper=mysql_query("SELECT * from detail WHERE (d_agency = '$agency_name' && type_id='$type')");
                                      $resultRP=mysql_fetch_array($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                      if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                        //echo "<a href='addarchive.php?fileid=$fileid'><button class='btn-danger'  name='arch'>Archive</button></a>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                       
                                        }
                                      }

                                      elseif(isset($_GET['subtype']) && isset($_GET['type'])){
                                        $subtype = $_GET['subtype'];
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE (subtype_id = '$subtype' && type_id='$type' && status='active')");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";

                                      $retper=mysql_query("SELECT * from detail WHERE type_id='$type' AND subtype_id = '$subtype'");
                                      $resultRP=mysql_fetch_assoc($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                      if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                      }
                                    }
                                
                                    else{
                                        if (isset($_GET['type'])){
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE type_id = '$type' && status='active'");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";
                                      
                                      $retper=mysql_query("SELECT * from detail WHERE type_id = '$type'");
                                      $resultRP=mysql_fetch_array($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                    if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                      }
                                    }
                                  }
                                  ?>
                                  </tbody>
                                  </table>
                                  <?php
                                         
           } else if(isset($_POST['storedfiles'])){
            ?>
              <table width="100%" class="table table-striped table-condensed">
                      <tr class="heading">
                      <td width=1%>
                      <form action="" method="post">
                      <button title="All Files" type="submit" name="all" class="btn btn-info">All</button>
                      </form> 
                      </td>
                      <td width="1%">
                      <form action="" method="post">
                      <button title="Active Files" type="submit" name="activefiles" class="btn btn-warning">Active</button>
                      </form> 
                     </td>
                     <td width="1%">
                      <form action="" method="post">
                      <button title="Stored Files" type="submit" name="storedfiles" class="btn btn-success active">On Storage</button>
                      </form> 
                      </td>
                      <td width="90">  </td>
                      </tr>
              </table>
                                <div class="module-body table">
                                   <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped   display"
                                        width="100%">
                                        <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Series No.</th>
                                      <th>Title</th>
                                      <th>Date</th>
                                      <th>Purpose</th>
                                      <th>Amount</th>
                                      <th>Status</th>
                                      <th>View</th>
                                    </tr>
                                     </thead>
                                      <tbody>

            <?php
          
                                         if (isset($_GET['agency']) && isset($_GET['type']) && isset($_GET['subtype'])){
                                        $agency_name=mysql_escape_string($_GET['agency']);
                                        $stype_id=$_GET['subtype'];
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE (agency = '$agency_name' && subtype_id='$stype_id' && type_id='$type' && status='storage')");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        //$f_year = $row['d_year'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";
                                     
                                      $retper=mysql_query("SELECT * from detail WHERE (d_agency = '$agency_name' AND subtype_id='$stype_id' AND type_id='$type')");
                                      $resultRP=mysql_fetch_array($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                      if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                        //echo "<a href='addarchive.php?fileid=$fileid'><button class='btn-danger'  name='arch'>Archive</button></a>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                       
                                        }
                                      }
                                      else if (isset($_GET['agency']) && $_GET['type']) {
                                        $agency_name=mysql_escape_string($_GET['agency']);
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE (agency = '$agency_name' && type_id='$type' && status='storage')");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";
                                     
                                      $retper=mysql_query("SELECT * from detail WHERE (d_agency = '$agency_name' && type_id='$type')");
                                      $resultRP=mysql_fetch_array($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                      if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                        //echo "<a href='addarchive.php?fileid=$fileid'><button class='btn-danger'  name='arch'>Archive</button></a>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                       
                                        }
                                      }

                                      elseif(isset($_GET['subtype']) && isset($_GET['type'])){
                                        $subtype = $_GET['subtype'];
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE (subtype_id = '$subtype' && type_id='$type' && status='storage')");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";

                                      $retper=mysql_query("SELECT * from detail WHERE type_id='$type' AND subtype_id = '$subtype'");
                                      $resultRP=mysql_fetch_assoc($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                      if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                        //echo "<a href='addarchive.php?fileid=$fileid'><button class='btn-danger'  name='arch'>Archive</button></a>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                      }
                                    }
                                
                                    else{
                                        if (isset($_GET['type'])){
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE type_id = '$type' && status='storage'");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";
                                      
                                      $retper=mysql_query("SELECT * from detail WHERE type_id = '$type'");
                                      $resultRP=mysql_fetch_array($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                    if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                      }
                                    }
                                  }
                                  ?>
                    </tbody>
                    </table>
                              <?php          
                              } else {
                    ?>
                    <table width="100%" class="table table-striped table-condensed">
                      <tr class="heading">
                      <td width=1%>
                      <form action="" method="post">
                      <button title="All Files" type="submit" name="all" class="btn btn-info active">All</button>
                      </form> 
                      </td>
                      <td width="1%">
                      <form action="" method="post">
                      <button title="Active Files" type="submit" name="activefiles" class="btn btn-warning">Active</button>
                      </form> 
                     </td>
                     <td width="1%">
                      <form action="" method="post">
                      <button title="Stored Files" type="submit" name="storedfiles" class="btn btn-success">On Storage</button>
                      </form> 
                      </td>
                      <td width="90">  </td>
                      </tr>
              </table>
                                <div class="module-body table">
                                   <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped   display"
                                        width="100%">
                                        <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Series No.</th>
                                      <th>Title</th>
                                      <th>Date</th>
                                      <th>Purpose</th>
                                      <th>Amount</th>
                                      <th>Status</th>
                                      <th>View</th>
                                    </tr>
                                     </thead>
                                      <tbody>




                    <?php
                                
                                         if (isset($_GET['agency']) && isset($_GET['type']) && isset($_GET['subtype'])){
                                        $agency_name=mysql_escape_string($_GET['agency']);
                                        $stype_id=$_GET['subtype'];
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE (agency = '$agency_name' AND subtype_id='$stype_id' AND type_id='$type')");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";
                                     
                                      $retper=mysql_query("SELECT * from detail WHERE (d_agency = '$agency_name' AND subtype_id='$stype_id' AND type_id='$type')");
                                      $resultRP=mysql_fetch_array($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                      if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                        //echo "<a href='addarchive.php?fileid=$fileid'><button class='btn-danger'  name='arch'>Archive</button></a>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                       
                                        }
                                      }
                                      else if (isset($_GET['agency']) && $_GET['type']) {
                                        $agency_name=mysql_escape_string($_GET['agency']);
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE (agency = '$agency_name' && type_id='$type')");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";
                                     
                                      $retper=mysql_query("SELECT * from detail WHERE (d_agency = '$agency_name' && type_id='$type')");
                                      $resultRP=mysql_fetch_array($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                      if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                        //echo "<a href='addarchive.php?fileid=$fileid'><button class='btn-danger'  name='arch'>Archive</button></a>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                       
                                        }
                                      }

                                      elseif(isset($_GET['subtype']) && isset($_GET['type'])){
                                        $subtype = $_GET['subtype'];
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE (subtype_id = '$subtype' && type_id='$type')");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";

                                      $retper=mysql_query("SELECT * from detail WHERE type_id='$type' AND subtype_id = '$subtype'");
                                      $resultRP=mysql_fetch_assoc($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                      if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                        //echo "<a href='addarchive.php?fileid=$fileid'><button class='btn-danger'  name='arch'>Archive</button></a>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                      }
                                    }
                                
                                    else{
                                        if (isset($_GET['type'])){
                                        $type = $_GET['type'];
                                        $query = mysql_query("SELECT *, YEAR(file_date) as d_year FROM file WHERE type_id = '$type'");
                                        $no = 0;
                                        while($row = mysql_fetch_array($query)){
                                        $no += 1;
                                        $file_id = $row['file_id'];
                                        $series = $row['series_no'];
                                        $title = $row['title'];
                                        $f_year = $row['d_year'];
                                        $purpose = $row['purpose'];
                                        $amount = $row['amount'];
                                        $fileid=$row['file_id'];

                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id'>".$series."</a></td>";
                                        echo "<td>".$title."</td>";
                                        echo "<td>".$f_year."</td>";
                                        echo "<td>".$purpose."</td>";
                                        echo "<td>".$amount."</td>";
                                        echo "<td align='right'><h3>";
                                      
                                      $retper=mysql_query("SELECT * from detail WHERE type_id = '$type'");
                                      $resultRP=mysql_fetch_array($retper);
                                      $active_RP=$resultRP['active_RP'];
                                      $storage_RP=$resultRP['storage_RP'];
                                      $forarch=$active_RP+$storage_RP;
                                      
                                      $resactive=$f_year+$active_RP;
                                      $resstorage=$f_year+$forarch;
                                      $curdate = date("Y");
                                    if($curdate <= $resactive){
                                        echo "<h4>Active</h4>";
                                        echo "<p>Until Year: ".$resactive."</p>";
                                        $statusqry=mysql_query("UPDATE file set status='active' WHERE file_id=$fileid");
                                      }
                                      elseif($curdate <= $resstorage){
                                        echo "<h4>Storage</h4>";
                                        $statusqry=mysql_query("UPDATE file set status='storage' WHERE file_id=$fileid");
                                      }
                                      else{
                                        echo "<h4>For Archival</h4>";
                                       $statusqry=mysql_query("UPDATE file set status='archive' WHERE file_id=$fileid");
                                      }  
                                        echo "</h3></td>";
                                        echo "<td><a href='file_img.php?fileid=$file_id' class='btn btn-mini btn-danger'><i class='icon-eye-open mini'></i> View</a></td>";
                                        echo "</tr>";
                                      }
                                    }
                                  }
                  ?>
                   </tbody>
                    </table>
                  <?php
                  }
                  ?>
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
        <script src="scripts/jquery-1.9.1.min.js"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="scripts/datatables/jquery.dataTables.js"></script>
  <script>
    $(document).ready(function() {
      $('.datatable-1').dataTable();
      $('.dataTables_paginate').addClass("btn-group datatable-pagination");
      $('.dataTables_paginate > a').wrapInner('<span />');
      $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
      $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    } );
  </script>
      
    </body>

