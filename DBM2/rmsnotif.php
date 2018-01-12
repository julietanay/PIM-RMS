<?php require_once('../Connections/dbmrov.php'); ?>
<?php @session_start(); 
if($_SESSION['usernamerec']==''){
header('location:dbmLoginRECORD.php');
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
 </style>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RMS - Archives</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
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
				<?php
							if(isset($_GET['typeid']) && isset($_GET['stypeid'])){
										$typeid2=$_GET['typeid'];
										$stypeid2=$_GET['stypeid'];
										echo "<script>
										swal({
  										title: 'Are you sure?',
  										text: 'This file will be removed from the Records List.',
  										type: 'warning',
  										showCancelButton: true,
  										confirmButtonColor: '#DD6B55',
  										confirmButtonText: 'Yes, archive it!',
  										closeOnConfirm: false
										},
										function(){
  										window.location.href='addarchive.php?typeid=$typeid2&&stypeid=$stypeid2';
										});
										</script>";
									}

							elseif(isset($_GET['typeid'])){
										$typeid2=$_GET['typeid'];
										//$stypeid2=$_GET['stypeid'];
										echo "<script>
										swal({
  										title: 'Are you sure?',
  										text: 'This file will be removed from the Records List.',
  										type: 'warning',
  										showCancelButton: true,
  										confirmButtonColor: '#DD6B55',
  										confirmButtonText: 'Yes, archive it!',
  										closeOnConfirm: false
										},
										function(){
  										window.location.href='addarchive.php?typeid=$typeid2';
										});
										</script>";
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
						
					
						
					
					</div><!--/.sidebar-->
				</div><!--/.span3-->


				<div class="span9">
					<div class="content">

						<div class="module message">
							<div class="module-head">
								<h3>Records for Archival</h3>
								<div class="pull-right">
								<a href="rms_report5.php" class="btn btn-standard btn-success"><i class="menu-icon icon-book"></i> Generate Report</a>
								<br><br>
							</div>
							</div>

							
							<div class="module-body table">								
								<form method="POST">
								<table class="table table-message">
									<tbody>
										<tr class="heading">
											<td class="cell-icon"></td>
											<td class="cell-title">Record Type</td>
											<td class="cell-title">Agency(s)</td>
											<td class="cell-status hidden-phone hidden-tablet">Year</td>
											<td class="cell-time align-right">View</td>
											<td class="cell-time align-right">Archive</td>
										</tr>
						<?php
						$qry=mysql_query("SELECT DISTINCT type_id FROM file where status='archive'");
							while($row=mysql_fetch_array($qry)){
								$typeid=$row['type_id'];
								$qrytype=mysql_query("SELECT type_name FROM type WHERE type_id='$typeid'");
								$row2=mysql_fetch_assoc($qrytype);
								$qryst=mysql_query("SELECT DISTINCT subtype_id FROM file WHERE status='archive' && type_id='$typeid'");
								while($row3=mysql_fetch_array($qryst)){
									$stypeid=$row3['subtype_id'];
									$qrystype=mysql_query("SELECT subtype_name FROM sub_type WHERE subtype_id='$stypeid'");
									$cnt=mysql_num_rows($qrystype);
								if($cnt != 0){
									$row4=mysql_fetch_assoc($qrystype);
									echo "<tr class='task'>";
									echo "<td class='cell-icon'><i class='icon-checker high'></i></td>";
									echo "<td class='cell-title'><div>".$row2['type_name'].": <br>&nbsp;&nbsp;&nbsp;".$row4['subtype_name']."<br>";
									echo "</div></td>";
									echo "<td class='cell-title'><div>";
							$qryag=mysql_query("SELECT DISTINCT agency FROM file WHERE type_id='$typeid' && subtype_id='$stypeid' && status='archive'");
							while($row5=mysql_fetch_array($qryag)){
									echo $row5['agency'];
									echo "<br>";
								}
									echo "</div></td>";
									echo "<td class='cell-status hidden-phone hidden-tablet'>";
							$qryyr=mysql_query("SELECT DISTINCT YEAR(file_date) as d_year FROM file WHERE type_id='$typeid' && subtype_id='$stypeid' && status='archive' ORDER BY file_date ASC");
							while($row6=mysql_fetch_array($qryyr)){
									echo $row6['d_year']."<br>";
									}
									echo "</td>";
									echo "<td class='cell-time align-right'><a href='rms_report6.php?typeid=$typeid&&stypeid=$stypeid' class='btn btn-mini btn-primary'>View</a></td>";
									echo "<td class='cell-time align-right'><a href='rmsnotif.php?typeid=$typeid&&stypeid=$stypeid' class='btn btn-mini btn-danger'>Archive</a></td>";
									echo "</tr>";

									//href='addarchive.php?typeid=$typeid&&stypeid=$stypeid' 
									//if(isset($_POST['addarchive'])){
									
								
									
									
								}
								else{
									echo "<tr class='task'>";
									echo "<td class='cell-icon'><i class='icon-checker high'></i></td>";
									echo "<td class='cell-title'><div>".$row2['type_name'];
									echo "</div></td>";
									echo "<td class='cell-title'><div>";
							$qryag=mysql_query("SELECT DISTINCT agency FROM file WHERE type_id='$typeid' && status='archive'");
							while($row5=mysql_fetch_array($qryag)){
									echo $row5['agency'];
									echo "<br>";
								}
									echo "</div></td>";
									echo "<td class='cell-status hidden-phone hidden-tablet'>";
							$qryyr=mysql_query("SELECT DISTINCT YEAR(file_date) as d_year FROM file WHERE type_id='$typeid' && status='archive' ORDER BY file_date ASC");
							while($row6=mysql_fetch_array($qryyr)){
									echo $row6['d_year']."<br>";
									}
									echo "</td>";
									echo "<td class='cell-time align-right'><a href='rms_report6.php?typeid=$typeid' class='btn btn-mini btn-primary'>View</a></td>";
									echo "<td class='cell-time align-right'><a href='rmsnotif.php?typeid=$typeid' class='btn btn-mini btn-danger'>Archive</a></td>";
									echo "</tr>";
							/*	
								if(isset($_POST['addarchive2'])){
										echo "<script>
										swal({
  										title: 'Are you sure?',
  										text: 'This file will be removed from the Records List.',
  										type: 'warning',
  										showCancelButton: true,
  										confirmButtonColor: '#DD6B55',
  										confirmButtonText: 'Yes, archive it!',
  										closeOnConfirm: false
										},
										function(){
  										window.location.href='addarchive.php?typeid=$typeid';
										});
										</script>";
									}*/
									}
							}
						}
						?>
									</tbody>
								</table>
								</form>
							</div>
							<div class="module-foot">
							</div>
						</div>
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			<p><b class="copyright">&copy; 2017 Department of Budget and Management Regional Office V</b> - All rights reserved.</p>
		</div>
	</div>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.table-message tbody tr').click(
				function() 
				{
					$(this).toggleClass('resolved');
				}
			);
		} );
	</script>
</body>