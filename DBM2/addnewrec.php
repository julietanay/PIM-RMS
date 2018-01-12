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
        <title>RMS - Add New File</title>
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
              if(isset($_GET['typeid'])){
                $typeid = mysql_escape_string($_GET['typeid']);
                $gettype1 = mysql_query("SELECT type_name FROM type WHERE type_id = $typeid");
                $res = mysql_fetch_assoc($gettype1);
                $type_name5 = $res['type_name'];
                echo "<h3>".$type_name5."</h3>";
              }
              ?> 
              </div>
              <div class="module-body">
                  <?php
                  echo "<form class='form-horizontal row-fluid' method='post' enctype='multipart/form-data' action='newrec.php?typeid=$typeid' >";
                  ?>
                    <div class="control-group">
                      <label class="control-label" for="basicinput">Series No</label>
                      <div class="controls">
                        <input type="text" id="basicinput" name="series" class="span6" required="required">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Title</label>
                      <div class="controls">
                        <input type="text" id="basicinput" name="title" placeholder="Title of the File.." class="span8" required="required">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Date</label>
                      <div class="controls">
                        <input type="date" id="basicinput" name="file_date" class="span8" required="required">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Purpose</label>
                      <div class="controls">
                        <textarea class="span8" name="purpose" rows="8"></textarea>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Amount</label>
                      <div class="controls">
                         &#8369; <input type="number" id="basicinput" name="amount" class="span5">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Upload</label>
                      <div class="controls">
                      <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
                    </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Type</label>
                      <div class="controls">
                        <select tabindex="1" data-placeholder="Select here.." class="span8" name="rectype">
                        <option value="0">Select here..</option>
                        <?php
                        $gettype = mysql_query("SELECT DISTINCT(subtype_name),subtype_id FROM type,sub_type WHERE sub_type.type_id='$typeid' AND type.type_id = sub_type.type_id");
                          while ($ty=mysql_fetch_array($gettype)) {
                           $type_name2 = $ty['subtype_name'];
                           $id = $ty['subtype_id'];
                           echo "<option value=".$id.">".$type_name2."</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Agency</label>
                      <div class="controls">
                      <input list="agency" name="agency" tabindex="1" data-placeholder="Type/Select agency.." class="span5" required="required">
                        <datalist id="agency">
                        <option value="">Select here..</option>
                        <?php
                        $agency = mysql_query("SELECT DISTINCT agency FROM file WHERE type_id='$typeid'");
                          while ($ag=mysql_fetch_array($agency)) {
                           $agency_name = $ag['agency'];
                           echo "<option value=".$agency_name.">".$agency_name."</option>";
                          }
                          ?>
                        </datalist>
                      </div>
                    </div>

                    <div class="control-group">
                      <div class="controls">
                        <button type="submit" name="addnew" class="btn btn-info">SUBMIT</button>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
            

          </div><!--/.content-->
        </div><!--/.span9-->
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

