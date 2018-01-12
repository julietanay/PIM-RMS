<?php require_once('../Connections/dbmrov.php'); ?>
<?php @session_start(); 
if($_SESSION['usernamerec']==''){
header('location:dbmLoginRECORD.php');
}
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

.img-circ{
 width: 200px;
 height: 200px;
 background-size:cover;
 display: block;
 border-radius: 100px;
 -webkit-border-radius: 100px;
 -moz-border-radius: 100px;
 border:thick;
 position:center;
 margin-left: 25%;
}
#myalert{
display:none;
position: fixed;
overflow: auto;
left: 0;
top: 0;
width: 100%;
height: 100%;
text-align: left;
z-index: 90;
background-color: rgba(0,0,0, .8); 
 
}
#myalert div{   
width: 470px;
margin: 25px auto;
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
    padding: 10px 0px;
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
        <title>RMS - Home</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
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
									$query0 = "SELECT *	FROM account, personnel, profile_pics 
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
												
								<?php	} ?>
                                    
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
                            <div class="btn-controls">
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
                                
                            </div>
                            <!--/.module-->
                            <div class="module-head">
                                <center><h3>Records Management System (RMS)</h3></center>
                            </div>
                                <form action="" method="POST">
                                <br>
                                <button class="btn btn-success pull-right" name="adsearch"><i class="menu-icon icon-search"></i> Advance Search</button>
                                <br>
                                 </form>
                <?php
                $display="block";
                if (isset($_POST['adsearch'])) {?>
                <div id="myalert" style="display:<?php echo $display ?>;">
                  <div id="header">
                  <form action="dbmIndexRMS.php" method="post">
                        <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                  </form>
                <form method="POST" action="dbmIndexRMS.php" class="form-horizontal row-fluid">
                    <div class="control-group">    
                    <center>
                        <h5 class="text-muted"><i class="menu-icon icon-search"></i> Search for a File</h5><hr>
                        </center>
                          <label class="control-label" for="basicinput" >Series No: </label>
                          <input type="text" name="series_no" class="span4" id="basicinput">
                          <br><br>
                          <label class="control-label" for="basicinput1">Title: </label>
                          <input type="text" name="title" class="span7" id="basicinput1">
                          <br><br>
                          <label class="control-label" for="basicinput2">Date: </label>
                          <input type="date" name="file_date" class="span4" id="basicinput2">
                          <br><br>
                          <label class="control-label" for="basicinput3">Amount: &#8369;</label>
                          <input type="number" name="amount" class="span4" id="basicinput3">
                          <br><br>
                          <label class="control-label" for="basicinput4">Agency: </label>
                          <input type="text" name="agency" class="span4" id="basicinput4">
                          <br><br>
                    <center>
                    <button name="searchbtn" class="btn btn-success"><i class="menu-icon icon-search"></i> Search</button> 
                    </center>
                    </div>
                </form>
                </div>
                  
                </div>
                <?php
                }
                ?>
            
            <div class="module-body">
            <?php
                if(isset($_POST['searchbtn'])){
                require_once('../Connections/dbmrov.php');
                if(mysql_escape_string($_POST['series_no']) !=null || mysql_escape_string($_POST['title']) != null || mysql_escape_string($_POST['file_date']) !=null || mysql_escape_string($_POST['amount']) !=null || mysql_escape_string($_POST['agency']) !=null){
            
                $series_no=mysql_escape_string($_POST['series_no']);
                $title=mysql_escape_string($_POST['title']);
                $file_date=mysql_escape_string($_POST['file_date']);
                $amount=mysql_escape_string($_POST['amount']);
                $agency=mysql_escape_string($_POST['agency']);
                $sqlsearch = mysql_query("SELECT * FROM file WHERE (series_no LIKE '%".$series_no."%' && title LIKE '%".$title."%' && file_date LIKE '%".$file_date."%' && amount LIKE '%".$amount."%' && agency LIKE '%".$agency."%')");
                if($sqlsearch){
                    $countresult = mysql_num_rows($sqlsearch);
                        if($countresult > 0){
                        echo "<div class='module-body table'>";
                        echo "<h4>Search Result(s)</h4>";
                        echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered table-condensed' width='100%'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Series No.</th>";
                        echo "<th>Title</th>";
                        echo "<th>Date</th>";
                        echo "<th>Purpose</th>";
                        echo "<th>Amount</th>";
                        echo "<th>Agency</th>";
                        echo "<th>Type</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($rows = mysql_fetch_array($sqlsearch)){
                        $series_no=$rows['series_no'];
                        $title=$rows['title'];
                        $file_date=$rows['file_date'];
                        $purpose=$rows['purpose'];
                        $amount=$rows['amount'];
                        $agency=$rows['agency'];
                        $type_id=$rows['type_id'];
                        $subtype_id=$rows['subtype_id'];
                        $file_id=$rows['file_id'];

                        $sqltypename=mysql_query("SELECT type_name FROM type WHERE type_id='$type_id'");
                        $type_name=mysql_fetch_assoc($sqltypename);

                        $sqlsubtype=mysql_query("SELECT subtype_name FROM sub_type WHERE subtype_id='$subtype_id'");
                        $subtype_name=mysql_fetch_assoc($sqlsubtype);

                        echo "<tr align='center'>";
                        echo "<td class='span1'><a href='images.php?fileid=$file_id'>".$series_no."</a></td>";
                        echo "<td class='span3'>". $title."</td>";
                        echo "<td>". $file_date."</td>";
                        echo "<td class='span3'>". $purpose."</td>";
                        echo "<td>&#8369;". $amount."</td>";
                        echo "<td>". $agency."</td>";
                        echo "<td>". $type_name['type_name']."</td>";
                        echo "<td>". $subtype_name['subtype_name']."</td>";
                        echo "</tr>";
                          }
                        echo "</tbody>";
                        echo "</table>";

                        echo "</div>";
                }
                        else{
                                echo "<div class='module-head'>";
                                echo "<h3>No Results Found.</h3>";
                                echo "</div>";
                        }
                }
                else{
                        echo mysql_error();
                }
        }
        else{
            echo "<script>
            window.location.href='dbmIndexRMS.php'
            </script>";

        }
    }

?>   </div>                          
                                <div class="btn-box-row row-fluid">
									<a href="dbmRecords.php" class="btn-box big span6"><img class="img-circ" align="center" src="rmsicons/managerecords.png" />
									    <b class="text-muted">Manage Records</b>
                                    </a>
									
                                    <a href="gen_reports.php" class="btn-box big span6"><img class="img-circ" align="center" src="rmsicons/reports.png" />
                                        <b class="text-muted">Generate Reports</b>
                                    </a>
                                </div>
                             
                            </div>
                            
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
      
    </body>
