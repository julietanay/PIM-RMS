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
        <title>Edmin</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        <link type="text/css" href="bootstrap/css/styleLink.css" rel="stylesheet" rel='stylesheet'>
        <link type="text/css" href="css/styleLink.css" rel='stylesheet'>
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <script src="dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">

      
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="dbmIndexPIM.php"><img src="images/logo.png" class="nav-avatar" /> DBM-ROV</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="rmsicons/rms.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                  
                  <li class="nav-header">Records Admin :</li>
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
            <div class="span12">
              <div class="content">
                <div class="module">
                <div class="module-head">
                  <h2>File Details</h2>
                </div>
                <div class="module-body">
                    <div class="docsexample2">
                    <table width="100%" cellpadding="6" cellspacing="0" border="0" class="table-striped table-condensed">
                    <form name="editdetails" method="POST" action="">
                    <?php 
                  if (isset($_GET['fileid'])){
                    $file_id=$_GET['fileid'];
                    $query1=mysql_query("SELECT * FROM file WHERE file_id='$file_id'");
                    $file1=mysql_fetch_assoc($query1);
                    $type_id1=$file1['type_id'];
                    echo "<a href='file_cat.php?type=$type_id1' class='btn btn-standard btn-primary pull-left' name='back'> Back</a> ";
                    echo "<a href='editrec.php?file=$file_id' class='btn btn-standard btn-warning pull-right'><i class='icon-cog'></i> Edit Details</a>"; ?>
                    <br><br>
                    </form>
    <?php
    $query=mysql_query("SELECT * FROM file WHERE file_id='$file_id'");
    $file=mysql_fetch_assoc($query);
    $type_id=$file['type_id'];
    $subtype_id=$file['subtype_id'];
    $series_no=$file['series_no'];
    $title=$file['title'];
    $agency=$file['agency'];
    $file_date=$file['file_date'];
    $status=$file['status'];
    $purpose=$file['purpose'];
    $amount=$file['amount'];

    $qry2=mysql_query("SELECT * FROM type WHERE type_id='$type_id'");
    $r = mysql_fetch_assoc($qry2);
    $type_name=$r['type_name'];
  }
                    ?>
                 <tbody>
    <?php
                echo "<tr><td class='span1'>Series No:</td>
                <td class='span6'><b>".$series_no."</b></td>
                <td class='span1'>Date:</td>
                <td class='span4'><b>".$file_date."</b></td>
                </tr>";
                echo "<tr><td class='span1'>Title: </td>
                <td class='span6'><b>".strtoupper($title)."</b></td>
                <td class='span1'>Status:</td>
                <td class='span4'><b>".strtoupper($status)."</b></td>
                </tr>";
                echo "<tr><td class='span1'>Agency: </td>
                <td class='span6'><b>".strtoupper($agency)."</b></td>
                <td class='span1'>Type:</td>
                <td class='span4'><b>".strtoupper($type_name)."</b></td>
                </tr>";
                echo "<tr><td class='span1'>Purpose: </td>
                <td><b>".$purpose."</b></td>
                <td class='span1'>Amount:</td>
                <td class='span4'><b>&#8369; ".$amount."</b></td>
                </tr>";
    ?>
                </tbody>
                </table>
                </div>
                  </div>
                    </div>
                     </div>
              
               <div class="content">
                <div class="module">
                <div class="module-body">
                  <div class="module-body">
                      <div class="docsexample2">
                    <table width="100%" cellpadding="6" cellspacing="0" border="0" class="table-bordered table-striped">
                    <form name="editdetails" method="POST" action="">
                    <h3 class="pull-left">Scanned Files</h3>
                    <button class="btn btn-standard btn-success pull-right" name="addimg"><i class="icon-plus"></i> Add New</button>
                     <br>
                    <?php
                $display="block";
                if (isset($_POST['addimg'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form action="" method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
                  <?php $file_id=$_GET['fileid'];
           echo "<form action='uploadnew.php?file_id=$file_id' method='POST' enctype='multipart/form-data' >"; ?> 
                        <center>
                        <br><h5 class="text-muted">Upload Scanned Files</h5><hr>
                        </center>
                        <div><center>
                        <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" /><br><br>
                        <input type="submit" name="newim" class="btn btn-success" value="Upload">
                        </center>
                        </div>
                  </form>
                  </div>
                </div>
                <?php
                }
                ?>
                    <br><br>
                    </form>
                    <tbody>
                      <?php
                        $imgqry=mysql_query("SELECT * FROM file_image WHERE file_id='$file_id' ORDER BY fimage_date limit 0,4");
                        $count=mysql_num_rows($imgqry);
                        if($count > 0){
                        ?>
                  <div class="btn-box-row row-fluid">
                  <?php
                  $page=0;
                  while($res=mysql_fetch_assoc($imgqry)){
                    $f_image=$res['f_image'];
                    $page +=1;
                    echo "<a href='fullimg.php?fileid=$file_id&&img=$f_image&&page=$page' class='btn-box big span3'>";
                    echo "<img src='scanned/".$f_image."' width='100%' height='100%'>"; 
                    echo "<b class='text-muted'>Page ".$page."</b>";
                    echo "</a>";
                      } ?>
                      </div>
                      <?php
                        }
                        else{
                        echo "<form action='' method='POST'><div class='btn-box-row row-fluid'>";
                        echo "<button name='addimg' class='btn-box big span2'>
                        <img src='rmsicons/green.png' width='80%' height='80%'>
                        <h3 class='text-muted'>Add New</h3>
                        </button>"; 
                        echo "</div></form>";
                        }
                echo "<hr>";
                echo "<form method='POST' action=''>";
                echo "<label class='control-label text-muted' for='basicinput'>Permanently Delete this file </label>";
                echo "<button id='basicinput' name='delete' class='btn btn-standard btn-danger pull-left'><i class='icon-remove'></i> Delete File</button>"; 
                echo "</form><br><br>";
                        
                      ?>
                    </tbody>
                    </table>
                <?php
                if(isset($_POST['delete'])){
                  echo "<script>
                  swal({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this file.',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, delete it.',
                        closeOnConfirm: false
                        },
                          function(){
                          window.location.href='del_file.php?fileid=$file_id';
                        });
                  </script>";
                }
                ?>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>



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
        <script src="scripts/common.js" type="text/javascript"></script>
       </body>
       </html>
  