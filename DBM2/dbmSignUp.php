<?php require_once('../Connections/dbmrov.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edmin</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<link type="text/css" href="css/styleLink.css" rel='stylesheet'>
<style>

.container1{
 margin:0px auto;
 width:750px;
 height:600px;
 text-align:center;
 background-color:white;
 background-size:cover;
 border:6px solid #BFBFBF;
 box-shadow:0px 0px 3px #BFBFBF;
}
.container2{
 margin:0px auto;
 width:500px;
 height:250px;
 text-align:center;
 background-color:white;
 background-size:cover;
 border:6px solid #BFBFBF;
 box-shadow:0px 0px 3px #BFBFBF;
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
background-color: rgba(0,0,0, .4); 
 
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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				
				<div class="nav-collapse collapse navbar-inverse-collapse">
					<ul class="nav pull-left">
						<li> <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="dbmHomepage.php"><img src="images/logo.png" class="nav-avatar" /> DBM-ROV</a></li>
					</ul>
					<ul class="nav pull-right">
						<li><a href="dbmHomepage.php"><img src="images\pimlogoo.png" width="25" height="25" style="margin-top: 2px; ">&nbsp;
							Home
						</a></li>
						
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
				<!--<div class="container" style="background-color:#333; width:100%; height: 100%;">
			  	<p class="brand">
			     <img src="images\dbmseal.png" height="100px" width="120px;" style="margin-top: 2px; margin-left: 80px;"> 
				 <img src="images\label.png" height="100px" width="400px;" style="margin-top: 2px; margin-left: 9px;"> 
				
			  	</p>

				
			</div>-->

		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->
 <div class="wrapper">
        <div class="container">
            <div class="row">
                <!--/.span3-->
				 <div class="span12">
                    <div class="content">
                        <div class="module">
                            <div class="module-body">
									<table align="center" class="table">
									<tr>
									<td bgcolor="#333"><ul><li ><strong id="StyleLink2">Login As : </strong><a href="dbmPimUserLogin.php" class="btn btn-primary">PIMS User</a></li></ul>
									</td>
									</tr>
									</table>
                            </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
				<?php
			//	$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
				//or die ('Cannot connect to db');
				
				?>
				<?php 	require_once('../Connections/dbmrov.php'); 
						$query = "SELECT * FROM account where account.accPrivilege=2 or account.accPrivilege=0";
						
						$result = mysql_query($query);
						if($result)				{	
						while($row = mysql_fetch_assoc($result)) {
						$accPerId=$row['perId'];
						$accUsername=$row['accUsername'];
						$accPassword=$row['accPassword'];
						$accPrivilege=$row['accPrivilege'];
								$query0 = "select * from personnel, profile_pics where personnel.perId=$accPerId and profile_pics.perId=personnel.perId";
								$result0= mysql_query($query0);	
								while($row0 = mysql_fetch_assoc($result0)) {
									$p0=$row0['perId'];
									$f0=$row0['perFname'];
									$l0=$row0['perLname'];
									$m0=$row0['perMname'];
									$e0=$row0['perExtName'];
									$img0=$row0['image']; 
									$type0=$row0['picType'];
									
				?>
                <div class="span3">
                    <div class="content">
                        <div class="module">
                            <div class="module-body">
									<table align="center" width="100%">
									<tr>
									<td align="center"> <?php if($img0==null){ ?>
										<div align="center"><img class="img-circulars"  src="images/user - Copy.png"></div>
										<?php } else{ ?>
										<div align="center"><img class="img-circulars" src="<?php echo 'data:image/'.$type0.';base64,'.base64_encode($img0); ?>" width="200" height="200"/></div>
										<?php	}?>
										<p></p>
									</td>
									</tr>
									<tr>
									<td><div align="center"><?php echo '<strong>'.$f0.' '.$m0.' '.$l0.' '.$e0.'</strong>'; ?> </div>
									</td>
									</tr>
									<?php if($accPrivilege=='0'){ ?>
									<tr>
									<td align="center">
									<p>
									<form method="post" action="dbmSignUp.php?perId=<?php echo $p0; ?>" ><button name="btnEmpNo" id="btnEmpNo" class="btn btn-large btn-danger span2" >Create Account</button></form></p>
									<?php $display="block";
											if(isset($_POST['btnEmpNo'])){ 
											$perId=mysql_real_escape_string($_GET['perId']);
											?>
										<div id="myalert"  style="display:<?php echo $display ?>;">
										  <div id="header">
											<form action="dbmSignUp.php" method="post">
											  <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
											</form>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											<center>
											<img src="images\lol.png" width="100" height="100" style="margin-top: 2px; ">
											  <label for="perAgenEmpNo"><h4 class="modal-title">&nbsp;Please Enter Your Agency Employee No.</h4></label>
											   <form name="form1" action="dbmconfirmEmployee.php" method="get" class="form-horizontal row-fluid">
											   <input type="hidden" class="span7" value="<?php echo $perId; ?>" name="perId" id="perId" Required/>
											   <input type="text" class="span7" placeholder="Agency Employee No" name="perAgenEmpNo" id="perAgenEmpNo" Required/><button type="submit" class="btn btn-primary" name="go" id="go">Go</button></form> 
											</center>
											<p>&nbsp;</p>
												<p>&nbsp;</p>
											  </div>
												</div>
											<?php } ?>
									</td>
									</tr>
									<?php } else { ?>
									<tr>
									<td align="center">
									<strong class="text-info">With Account</strong>
									
									
									</td>
									</tr>	
									<?php } 
									?>
									
									</table>
                            </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>					
						<?php } 
						
						
						
						
						} }	
									else{
										echo mysql_error();
									}
						?>
                <!--/.span9-->
            </div>
			
        </div>
        <!--/.container-->
    </div>

	<div class="footer">
		<div class="container">
			<b class="copyright">&copy; 2017 Department of Budget and Management Regional Office V</b> - All rights reserved.
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


</body>