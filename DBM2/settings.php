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

.img-circ{
 width: 150px;
 height: 150px;
 background-size:cover;
 display: block;
 border-radius: 100px;
 -webkit-border-radius: 100px;
 -moz-border-radius: 100px;
 border:thick;
 position:center;
 margin-left: 10%;
 margin-right: 10%;
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
width: 400px;
margin: 25px auto;
background: #fff;    
padding: 3px;
text-align: center;
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
        <title>RMS - Settings</title>
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
                <?php
                    if(isset($_POST['addrectype'])){
                      $newrec=$_POST['rectype'];
                      $qryadd=mysql_query("INSERT INTO type(type_id, type_name) VALUES('', '$newrec')");
                      if($qryadd){
                        echo "<script>swal('Record Added!', 'New Record type was added in the Records Section.', 'success');</script>";
                        header("Refresh:1.5; url=settings.php");
                      }
                    }
                    ?>
                    <?php
                    if(isset($_POST['addsubtype'])){
                      $newstype=$_POST['subtype'];
                      $type_id=$_POST['type'];
                      $type_name=$_GET['type_name'];
                      $qryadd2=mysql_query("INSERT INTO sub_type(subtype_id, type_id, subtype_name) VALUES('', '$type_id', '$newstype')");
                      if($qryadd2){
                        echo "<script>swal('Record Added!', 'New Record subtype was added under ".$type_name.".', 'success');</script>";
                        header("Refresh:1.5; url=settings.php");
                      }
                    }
                    ?>
                    <?php
                    if(isset($_POST['editfile'])){
                      $series=$_POST['series'];
                      $seriesqry=mysql_query("SELECT * FROM file WHERE series_no = '$series'");
                      $cntres=mysql_num_rows($seriesqry);
                      if($cntres != 0){
                        $res=mysql_fetch_assoc($seriesqry);
                        $fileid=$res['file_id'];
                        header("location:editrec.php?file=$fileid");
                      }
                      else{
                        echo "<script>swal('Not Found!', 'Series No. was not found Make sure you typed it correctly.', 'error');</script>";
                      }
                    }
                    ?>
                    <?php
                    if(isset($_POST['newfile'])){
                      $typeid=$_POST['type'];
                        header("location:addnewrec.php?typeid=$typeid");
                    }
                    ?>
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
							<table bgcolor="#333" width="100%"><tr>
								<td bgcolor="#333" width="13%"><h3>
								<img src="images/logo.png" height="70px" width="70px;" style="margin-top: 10px; margin-bottom: 10px; margin-left: 30px;  "> 
								</h3></td>
								<td bgcolor="#333" width="71%" align="left"><div><strong><font color="white">Department of Budget and Management</font></strong></div>
                                <div>Regional Office V</div>
								<div>Legazpi City</div></td>
								
								</tr>
								<tr>
								<td colspan="3"><h3>
								</td>
								</tr>
								</table>
                               
                                <div class="module-body">
                                   <table border="0" class="table-bordered table-striped display" width="100%"><tr>
                                <td><h3>&nbsp;&nbsp;<i class="menu-icon icon-cog"></i>
                                Settings:
                                </h3></td>
                                </tr>
                                </table>
                                <div class="btn-box-row row-fluid">
                                    <form method="POST" action="">
                                        <button class="btn-box small span3" name="rep1"><img class="img-circ" src="rmsicons/addrec2.png" align="center" /><br>
                                        <h5 class="text-muted">Add Record Type</h5></button>
                                    </form>
                                    <form method="POST" action="">
                                        <button class="btn-box small span3" name="rep2"><img class="img-circ" src="rmsicons/addsub.png" align="center" /><br>
                                        <h5 class="text-muted">Add Record Subtype</h5></button> 
                                    </form>
                                    <form name="editdetails" method="POST" action="">
                                        <button class="btn-box small span3" name="rep3"><img class="img-circ" src="rmsicons/editfile.png" align="center" /><br>
                                        <h5 class="text-muted">Edit File</h5></button> 
                                    </form>
                                     <form name="editdetails" method="POST" action="">
                                        <button class="btn-box small span3" name="rep4"><img class="img-circ" src="rmsicons/addfile.ico" align="center" /><br>
                                        <h5 class="text-muted">Add New File</h5></button> 
                                    </form>
                                    
                                </div>
            
            
            <?php
                $display="block";
                if (isset($_POST['rep1'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form action="settings.php" method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
                  <form method="POST" action="" class="form-horizontal row-fluid">
                        <center>
                        <br><h5 class="text-muted">Add Record Type</h5><hr>
                        </center>
                        <div>
                          <label for="basicinput">Enter New Record Type </label>
                          <input type="text" id="basicinput" name="rectype" class="span9" required="required">
                          <br><br>
                          <center>
                    <input type="submit" name="addrectype" class="btn btn-warning" value="Add">
                    </center>
                    </div>
                </form>
                  </div>
                </div>
                <?php
                }
                ?>

                <?php
                $display="block";
                if (isset($_POST['rep2'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form action="settings.php" method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
              <?php echo "<form method='POST' action='settings.php?type_name=$type_name' class='form-horizontal row-fluid'>"; ?>
                        <center>
                        <br><h5 class="text-muted">Add Records Subtype</h5><hr>
                        </center>
                        <div>
                          <label for="basicinput">Select Type: </label>
                          <select class="span8" name="type" id="basicinput" >
                          <?php
                          $qry = mysql_query("SELECT * FROM type");
                          while($rowtype=mysql_fetch_array($qry)){
                            $type = $rowtype['type_id'];
                            $type_name =$rowtype['type_name'];
                            echo "<option value='".$type."'>".$type_name."</option>"; 
                        }
                          ?>
                          </select>
                          <br><br>
                          <label for="basicinput2">Enter Subtype: </label>
                          <input type="text" name="subtype" class="span9" required="required">
                          <br><br>
                          <center>
                    <input type="submit" name="addsubtype" class="btn btn-warning" value="Add">
                    </center>
                        </div>
                </form>
                  </div>
                </div>
                <?php
                }
                ?> 
                <?php
                $display="block";
                if (isset($_POST['rep3'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form action="settings.php" method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
              <?php echo "<form method='POST' action='settings.php' class='form-horizontal row-fluid'>"; ?>
                        <center>
                        <br><h5 class="text-muted">Edit File</h5><hr>
                        </center>
                        <div>
                          <label for="basicinput2">Enter Series No: </label>
                          <input type="text" name="series" class="span6" required="required">
                          <br><br>
                          <center>
                    <input type="submit" name="editfile" class="btn btn-warning" value="Confirm">
                    </center>
                        </div>
                </form>
                  </div>
                </div>
                <?php
                }
                ?>
                <?php
                $display="block";
                if (isset($_POST['rep4'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form action="settings.php" method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
              <?php echo "<form method='POST' action='settings.php' class='form-horizontal row-fluid'>"; ?>
                        <center>
                        <br><h5 class="text-muted">Add New File</h5><hr>
                        </center>
                        <div>
                          <label for="basicinput">Select Type: </label>
                          <select class="span9" name="type" id="basicinput" >
                          <?php
                          $qry = mysql_query("SELECT * FROM type");
                          while($rowtype=mysql_fetch_array($qry)){
                            $type = $rowtype['type_id'];
                            $type_name =$rowtype['type_name'];
                            echo "<option value='".$type."'>".$type_name."</option>"; 
                        }
                          ?>
                          </select>
                          <br><br>
                          <center>
                    <input type="submit" name="newfile" class="btn btn-warning" value="Confirm">
                    </center>
                        </div>
                </form>
                  </div>
                </div>
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
      
    </body>

