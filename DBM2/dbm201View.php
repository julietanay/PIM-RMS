<?php require_once('../Connections/dbmrov.php'); ?>
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




$colname_Recordset1 = "-1";
if (isset($_GET['perId'])) {
  $colname_Recordset1 = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = sprintf("SELECT * FROM personnel WHERE perId = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
 @session_start(); 
if($_SESSION['username']==''){
header('location:dbmLoginPIM.php');
}
?>

<?php
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
?>
<!DOCTYPE html>
<html lang="en">
<style>
body {
  font-family: Verdana, sans-serif;
  margin: 0;
}


* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modals {
   display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 20px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}


/* Modal Content */
	.modals-content {
	margin: auto;
    display: block;
   
}

/* The Close Button */
.closes {
   position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 30px;
    font-weight: bold;
    transition: 0.3s;
}

.closes:hover,
.closes:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer
}

.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}


.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}

.wrappers {
    margin: auto;
    height: 100%;
    width: 90%;
    max-width: 100%;
    overflow: hidden;
    background-size: cover;
    background-position: center center;
	padding-bottom: 30px;
}

</style>
<style>
div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: center;
    width: 180px;
	height: 175px;
	padding: 4% 2% 2% 2%;
}
div.gallery2 {
    margin: 5px;
    border: 1px solid #ccc;
    float: center;
    width: 180px;
	height: 175px;
	padding: 10% 10% 10% 10%;
}

div.gallery:hover {
    border: 1px solid #C4C4FF;
	background-color: #C4C4FF;
}

div.desc {
	padding: 20px;
    text-align: left;
}
</style>
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
overflow: auto;
left: 0;
top: 0;
width: 100%;
height: 100%;
text-align: center;
z-index: 90;
background-color: rgba(0,0,0, .8); 
 
}

#mywarning div{   
width: 850px;
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
background-color: rgba(0,0,0, .7); 
 
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
        <title>Department of budget and Management</title>
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
                        <ul class="nav pull-right">
                            
                             <li><a href="dbmIndexPIM.php"><i class="icon-home"></i> Home </a> </li>
							<li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                   <!-- <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li> -->
									<li class="nav-header">Quick Links :</li>
									 <li><a href="dbmPerAdd.php" ><div class="menu-icon icon-plus">&nbsp; Add personnel</div></a></li>
									 <li><a href="dbmReports.php" ><div class="menu-icon icon-book">&nbsp; Reports</div></a></li>
                                     <li><a href="dbmLeaveAppList.php" ><div class="menu-icon icon-briefcase">&nbsp; Leave Application</div></a></li>
									  <li><a href="dbmPIMAcct.php" ><div class="menu-icon icon-cog">&nbsp; Manage User Accounts</div></a></li>
                                </ul>
                            </li>
                            <li><?php
								$perId01=$_SESSION['pid'];
								$query01 = "SELECT * FROM personnel where personnel.PerId='$perId01'";
								$result01= mysql_query($query01);	
								while($row01 = mysql_fetch_assoc($result01)) { 
								$per01=$row01['perId'];
								?>
								<a href="dbmPIMNotification.php?perId=<?php echo $per01; ?>"><i class="icon-exclamation-sign"></i> Notification  &nbsp;	<?php } ?>
								<?php	$query0 = "SELECT *	FROM personnel_update where personnel_update.seen='No'";
								$result0= mysql_query($query0);	
								$count=0;
								while($row0 = mysql_fetch_assoc($result0)) { 
								$count=$count+1;
								}  
								if($count!=0){
									echo '<b class="label pull-right" style="background-color: red;">'.$count.'</b>';
								}
								 ?></a></li> 
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user - Copy.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                   <!-- <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li> -->
									<li class="nav-header">HR Admin :</li>
									<li ><?php 
									$f=$_SESSION['fname'];
									$l=$_SESSION['lname'];
									echo '<div align="center"> '.$f.' '.$l.' </div>' ?></li>
									 <li><a href="dbmAdminAccount.php" ><div class="menu-icon icon-cog">&nbsp; Your Account</div></a></li>
                                    <li class="divider"></li>
                                     <li><a href="logoutPimAdmin.php" ><div class="menu-icon icon-signout">&nbsp; Logout</div></a></li>
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
      <!--/.span3--> 
      <div class="span12">
        <div class="content">
          <div class="module">
			<?php
			$reqId=mysql_real_escape_string($_GET['reqId']);
			$queryl = "select * from requirement where reqId='$reqId'";
						 $resultl= mysql_query($queryl);	
						 while($rowl= mysql_fetch_assoc($resultl)) { 
						 $reqId= $rowl['reqId'];
						 $reqTitle = $rowl['reqTitle'];
						 ?>
			
			   <table width=100% border=1 bordercolor="white">
					<form method="post" action="">
						<tr bgcolor="#cccccc">
						  <td  width="10%" align="center"> <a id="StyleLink" href="dbm201.php?perId=<?php echo $row_Recordset1['perId']; ?>"><strong class="text-error"> <i class="icon-arrow-left"></i> Back </strong></a></td>
						 <td><p></p>
						 <div class="input-append pull-left">
                           <input style="width: 55vw;background: rgba(255,255,255,0.1);  font-size: 19Px; height: 3vw" value="<?php echo $reqTitle ?>" type="text" name="reqTitle" id="reqTitle" required/>
                            <button style="font-size: 19Px; height: 3vw; border: 0px;" type="submit" name="reUp" id="reUp" class="btn btn-info">
                                <i class="icon-edit" style="font-size: 19Px;"> Save </i>
                             </button>
                         </div>
						</td>
						 </tr> 
						 </form>
			  </table>
			 		<?php 
						$reqId=mysql_real_escape_string($_GET['reqId']);
						if (isset($_POST["reUp"])) {
							$reqTitle = $_POST['reqTitle'];
							
								$q2 = "select * from requirement where reqId='$reqId'";
								$r2= mysql_query($q2);	
								$rr2 = mysql_fetch_assoc($r2);
								$reqT2=$rr2['reqTitle'];
								if($reqT2==$reqTitle){
									echo '<script type="text/javascript">
											alert("You Have not made any Changes..");
											history.back();
												 </script>';
								}else{
									$q = "select * from requirement where reqTitle='$reqTitle' and reqId!='$reqId'";
									$r = mysql_query($q);	
									$c=0;
									while($rr = mysql_fetch_assoc($r)) {
									$reqT=$rr['reqTitle'];
									$c=$c+1;
									}			 
								if($c>0){
											echo '<script type="text/javascript">
														alert("Name/Title Already Exist...");
														history.back();
															 </script>';
										}else {
								$updateO=("UPDATE requirement SET reqTitle='$reqTitle' WHERE reqId='$reqId'");
								if(mysql_query($updateO))
									{?>
										<script type="text/javascript">
										alert("Updated Successfully!!");
										window.location.href="dbm201View.php?perId=<?php echo $row_Recordset1['perId']; ?>&reqId=<?php echo $reqId; ?>";
										 </script>
									<?php	} 
									else {
											echo '<script type="text/javascript">
											alert("Failed!! Something went wrong...");
											history.back();
												 </script>';
											 }	
										}
					
									}
											}	?>					  
					  
			  
					<?php } ?>
            <div class="module-body">
              <div class="profile-head media">
                <?php 
											$Per1=mysql_real_escape_string($_GET['perId']);
											$query = "select * from personnel, profile_pics where personnel.perId=$Per1 and profile_pics.perId=personnel.perId";
											$result= mysql_query($query);	
											while($row = mysql_fetch_assoc($result)) {
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
											$type=$row['picType'];
											$divdiv=$row['divId'];

									?>
                <div class="media-body">
                    <table width=100% >
						 <tr >
						 <td> <?php
					echo '<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="icon-circle"></i> &nbsp;&nbsp;'.$first.' '.$middle.' '.$last.' '.$ext.' </h4>'; ?></td>
						 </tr> 
			  </table>
                   
                 <p></p>
                </div>
               
              </div>
			  <?php } ?>
			  <p></p>
			  
				<table>
				<tr bgcolor="white">
				<td>
				 <div class="span2">
								<div class="content"><p></p>
									<div class="module" style="background: rgba(255,255,255,0.55); height: 27vh;">
										<div class="module-body">
										<table align="center"  width="100%" >
												<tr >
												</tr>
												<tr>
												<td align="center">
												<form method="post"><button class="btn" name="butAdd" id="butAdd"><img  src="images/hg.png" width="100%" height="100%"> <p></p><h5><div>Add New</div></h5></button>
												<input type="hidden" name="reqId" id="reqId" value="<?php echo $reqId; ?>">
												<input type="hidden" name="perId" id="perId" value="<?php echo $row_Recordset1['perId']; ?>">
												</form><p></p></td>
												</tr>
										</table>
										
										
									<?php
						$display="block";
						if(isset($_POST['butAdd'])){
						$perID = $_POST['perId'];
						$reqID = $_POST['reqId'];
						?>
                    <div id="myalert"  style="display:<?php echo $display ?>;">
                      <div id="header">
                        <form action="dbm201View.php?perId=<?php echo $perID; ?>&reqId=<?php echo $reqID; ?>" method="post">
                          <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
                        </form>
                        <p>&nbsp;</p>
                        <center>
                          <h2 class="modal-title"><b> &nbsp;Add New File</b></h2>
                        </center>
                        <hr>
                        <form method="post" enctype="multipart/form-data">
                          <table  width="90%"  align="center">
                          <tr>
                            <td colspan=3 ><p>&nbsp;</p></td>
                          </tr>
                          <tr>
                            <td><input type="hidden" name="perId" id="perId" value="<?php echo $perID ?>" />
								<input type="hidden" name="reqId" id="reqId" value="<?php echo $reqID ?>" />
								<input type="hidden" name="imageDateModified" id="imageDateModified" value="<?php echo date('Y-m-d'); ?>"></td>
                            <td ><input class="btn" type="file" name="image[]" id="image" multiple required/></td>
                            <td  ><input type="submit" name="btn_upload" id="btn_upload" value="upload" class="btn btn-large btn-info"></td>
                          </tr>
                          <tr>
                            <td align="center" colspan=3 ><p>&nbsp;</p></td>
                          </tr>
                          </table>
                        </form>
                      </div>
                    </div>
                    <?php  } ?>	
										
						<?php						
						if(isset($_POST['btn_upload'])){
							$imageUpload=0;
							$allImage=0;
							$duplicate=0;
							$perIDUpload = $_POST['perId'];
							$reqIDUpload = $_POST['reqId'];
							$idm = $_POST['imageDateModified'];
							for($i=0; $i<count($_FILES['image']['name']); $i++)
							{
								$allImage++;
								$filetmp = $_FILES['image']['tmp_name'][$i];
								$filename = $_FILES['image']['name'][$i];
								$filetype = $_FILES['image']['type'][$i];
								$filepath = "requirement/".$filename;
								$extension=strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
								if($extension =='png' || $extension =='jpeg' || $extension =='jpg' || $extension =='gif')
								{
									if(!file_exists($filepath))
									{
										if(move_uploaded_file($filetmp,$filepath)){
											$imageUpload++;
											 $insertOther= "INSERT INTO req_image( imageName, imagePath, imageDateModified, reqId, perId) VALUES ('$filename','$filepath','$idm','$reqIDUpload','$perIDUpload')";
											  if(mysql_query($insertOther))
												{?>
												<script type="text/javascript">
												alert("<?php echo $imageUpload; ?>Uploaded Successfully!!");
												window.location.href="dbm201View.php?perId=<?php echo $perIDUpload; ?>&reqId=<?php echo $reqIDUpload; ?>";
												 </script>
											<?php	} else {
															echo '<script type="text/javascript">
																alert("Failed!! Something went wrong...");
																history.back();
																 </script>';
														}
									  }
									}else{
										$duplicate++;
										if($duplicate>0){
											echo '<script type="text/javascript">
																alert("The file you are trying to upload already exist..");
																history.back();
																 </script>';
										}
									}
								}
							}
								//move_uploaded_file($filetmp, $filepath);
					}
					
						
						?>	
										</div>
									</div>
								</div>
                    <!--/.content-->
                </div>
				


				<?php
				$Pers=mysql_real_escape_string($_GET['perId']);
				$reqIds=mysql_real_escape_string($_GET['reqId']);
				$queryl = "select * from req_image where req_image.perId='$Pers' and req_image.reqId='$reqIds'";
						 $resultl= mysql_query($queryl);	
						 $count=0;
						 while($rowl= mysql_fetch_assoc($resultl)) { 
						 $count++;
						 $imageId= $rowl['imageId'];
						 $imageName= $rowl['imageName'];
						 $image= $rowl['imagePath'];
						 $imageReqId= $rowl['reqId'];
						 $imagePerId= $rowl['perId'];
						$inputwidth = 800;
						$inputheight = 600;
						$inputheight2 = 160;
						list($width,$height) = getimagesize($image);
						// wider image
						if (($width/$height) > ($inputwidth/$inputheight)) {
									$outputwidth = $inputwidth;
									$outputheight = ($inputwidth * $height)/ $width;
								}
						// taller image
								elseif (($width/$height) < ($inputwidth/$inputheight2)) {
									$outputwidth = ($inputheight2 * $width)/ $height;
									$outputheight = $inputheight2;
								}
						// exact same size/aspect ratio of area
								elseif (($width/$height) == ($inputwidth/$inputheight)) {
									$outputwidth = $inputwidth;
									$outputheight = $inputheight;
									} ?>
						 <table align="center"  class="span2" width="100%" >
												<tr>
											<td align="center" class="content">	
											<div class="gallery">
								<?php 
								$r=$outputwidth-$outputheight;
								if ($r >= 300 ){ 
								?>
									<p>&nbsp;</p>
									<img src="<?php echo $image ?>" width="<?php echo $outputwidth ?>" height=" <?php echo $outputheight ?>" class="hover-shadow cursor" onclick="openModal();currentSlide(<?php echo $count ?>)">
							<?php } else { ?>
										<img src="<?php echo $image ?>" width="<?php echo $outputwidth ?>" height=" <?php echo $outputheight ?>" class="hover-shadow cursor" onclick="openModal();currentSlide(<?php echo $count ?>)"> 
						<?php } ?>
						
									
								<div id="myModals" class="modals">
								  <span class="closes cursor" onclick="closeModal()">&times;</span>
								  <div class="wrappers">
								   <div class="modals-content">
					<?php
									
						 $query22 = "select * from req_image where req_image.perId='$imagePerId' and req_image.reqId='$imageReqId'";
						 $result22= mysql_query($query22);	
						 	 $co=mysql_num_rows($result22);
						 $count22=0;
						 while($row22= mysql_fetch_assoc($result22)) { 
						 $count22++;
						 $imageId22= $row22['imageId'];
						 $imageName22= $row22['imageName'];
						 $image22= $row22['imagePath'];
						 list($widthh,$heightt) = getimagesize($image22);
						
						 ?> 		
									<div class="mySlides">
									 <?php  echo $widthh.'<p></p>';
						 echo $heightt; ?>
									  <div class="numbertext"> page <?php echo $count22.' of '.$co.''; ?></div>
									 <img onclick="plusSlides(1)" src="<?php echo $image22 ?>"  class="img-responsive" style=" padding-left: 200px; padding-right:200px; padding-bottom: 200px;"> 
									
									</div>
						<?php } ?>	
								    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
									<a class="next" onclick="plusSlides(1)">&#10095;</a>
									  </div>
								</div>							
								</div>
											
											</div>
												</td>
												</tr>
												<tr>
												<td align="center"><strong><?php// echo $reqTitle ?></strong></td>
												</tr>
												</table>
						
						
						
						 <?php	}  ?>	</td>
				</tr>
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
  
  
  
  
  
  
  
  
  
  
  
  </div>
          <!--/.container-->
        <!--/.wrapper-->
		 
		
		
		
		
		
		
		
		
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
									<script>
function openModal() {
  document.getElementById('myModals').style.display = "block";
}

function closeModal() {
  document.getElementById('myModals').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

    </body>

<?php
mysql_free_result($Recordset1);
?>
