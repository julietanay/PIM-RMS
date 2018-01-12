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
        <title>RMS - Edit File</title>
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
        <?php
        if(isset($_GET['file'])){
                $file_id = mysql_escape_string($_GET['file']);
                $qryfile = mysql_query("SELECT * FROM file WHERE file_id = '$file_id'");
                $res = mysql_fetch_assoc($qryfile);
                    $series = $res['series_no'];
                    $title = $res['title'];
                    $purpose = $res['purpose'];
                    $amount = $res['amount'];
                    $file_date = $res['file_date'];
                    $agency = $res['agency'];
                    $status = $res['status'];
                
              }
        ?>
         <?php
      if(isset($_POST['editrec'])){
        $title = $_POST['title'];
        $purpose = $_POST['purpose'];
        $amount = $_POST['amount'];
        $file_date = $_POST['file_date'];
        $agency = $_POST['agency'];
        $status = $_POST['status'];

        $qryedit = mysql_query("UPDATE file set title='$title', purpose='$purpose', file_date='$file_date', amount='$amount', agency='$agency', status='$status' WHERE file_id='$file_id'");
        if($qryedit){
          echo "<script>swal('File Updated!', 'File has been Successfully updated.', 'success');</script>";
          header("Refresh:1; url=file_img.php?fileid=$file_id");
        }
      }
    ?>
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
                            <!--/.widget-nav-->
                            
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->


                    <div class="span9">
          <div class="content">
            <div class="module">
              <div class="module-head">
              <?php
             
                echo "<h3>Edit File: ".$series."</h3>";
             
              ?>
     
 
              </div>
              <div class="module-body">
                  <?php
                  echo "<form class='form-horizontal row-fluid' method='post' enctype='multipart/form-data' action='editrec.php?file=$file_id' >";
                  ?>
                    <div class="control-group">
                      <label class="control-label" for="basicinput" >Series No</label>
                      <div class="controls">
                      <?php
                   echo "<input type='text' id='basicinput' name='series' value='".$series."' class='span6' required='required' disabled>";
                      ?>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Title</label>
                      <div class="controls">
                      <?php
                    echo "<input type='text' id='basicinput' name='title' value='".$title."' class='span8' required='required'>";
                      ?>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Date</label>
                      <div class="controls">
                      <?php
                      echo "<input type='date' id='basicinput' name='file_date' class='span8' value='".$file_date."' required='required'>";
                      ?>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Purpose</label>
                      <div class="controls">
                      <?php  
                      echo "<textarea class='span8' name='purpose' rows='8'>".$purpose."</textarea>";
                      ?>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Status</label>
                      <div class="controls">
                      <?php  
                      echo "<select tabindex='1' class='span5' name='status' value='".$status."' required='required'>";
                      ?>  
                        <option value="active">Active</option>
                        <option value="storage">Storage</option>
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Amount</label>
                      <div class="controls">
                      <?php
                      echo "&#8369; <input type='number' id='basicinput' name='amount' value='".$amount."' class='span5'>";
                      ?>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="basicinput">Agency</label>
                      <div class="controls">
                      <?php
                      echo "<input list='agency' name='agency' tabindex='1' value='".$agency."' class='span5' required='required'>";
                      ?>
                      </div>
                    </div>

                    <div class="control-group">
                      <div class="controls">
                        <button type="submit" name="editrec" class="btn btn-info">SUBMIT</button>
                      </div>
                    </div>
                  </form>

           
              </div>
            </div>
          </div><!--/.content-->
        </div><!--/.span9-->
                </div>
            </div>
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

