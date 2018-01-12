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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "dbmIndexRMS.php";
  $MM_redirectLoginFailed = "dbmLoginRECORD.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_dbmrov, $dbmrov);
  
  $LoginRS__query=sprintf("SELECT accUsername, accPassword, accPrivilege FROM account WHERE accUsername=%s AND accPassword=%s AND accPrivilege=3",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $dbmrov) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Your log-in was unsuccessful!')
        window.location.href='dbmLoginRECORD.php'
        </SCRIPT>");
  }
}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width-device-width, initial-scale=1">
    <title>Department of budget and Management</title>
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>

<style>

*{
margin: 0px;
padding: 0px;
height 100%;
width: 100%;
}

.intro{
width: 100%;
height: 100%;
background-image: url("images/bghome1.png");
background-size: cover;
background-repeat: no-repeat;
display: table;
top: 0;

}

.inner{
display: table-cell;
vertical-align: middle;
width: 100%;
}

.content{
padding: 1%;
width: 32vw;
height: 74vh;
background: rgba(255,255,255,0.55);
margin: auto;
border-radius: 1%;
display: table;
}

.photo{
display: table-cell;
width: 40%;
height: 33%;
margin:auto;
border:2px solid #726b6;
border-radius: 100%;
}
.input1{
display: table-cell;
margin-left:3.5vw;
margin-top: 6vh;
padding: 1% 1% 1% 10%;
background: url("images/user-512.png");
background-size: contain;
background-repeat: no-repeat;
font-size: 15Px;
border: 0px;
border-bottom: 1px solid white;
width: 25.5vw;

}
.input2{
display: table-cell;
margin-left:3.5vw;
margin-top: 6vh;
padding: 1% 1% 1% 10%;
background: url("images/user-512.png");
background-size: contain;
background-repeat: no-repeat;
font-size: 20Px;
border: 0px;
border-bottom: 1px solid white;
width: 25.5vw;
}

.input1[placeholder]{
padding-left: 30%;
font-size: 1.5vw;
}

.input2[placeholder]{
padding-left: 30%;
font-size: 1.5vw;
}

.btn{
text-decoration: none;
display: table;
text-align: center;
margin-top:6%;
height: 5vh;
padding; 3% 0% 3% 0%;
background: #6699CC;
font-family:Arial, Helvetica, sans-serif;
font-size: 1.8vw;
color: white;
cursor: pointer;
border-radius: 4%;
}
.btn:hover{
background-color:#003366;
padding; 3% 0% 3% 0%;
color:white;
cursor: pointer;
	}

.btnH{
text-decoration: none;
text-align: center;
margin-top:4%;
height: 3vh;
width: 7vh;
padding; 3% 0% 3% 0%;
font-family:'Lobster';
font-size: 1.4vw;
color: #666666;
border-radius: 10%;
padding-right:6px;
}
.btnH:Hover{
text-decoration: none;
text-align: center;
margin-top:4%;
height: 3vh;
width: 7vh;
padding; 3% 0% 3% 0%;
font-family:'Lobster';
font-size: 1.4vw;
color: #cccccc;
padding-right:6px;
}
</style>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>
</head>

<body>
        <section class="intro">
			<div class="inner">
				<div class="content">
				<table border=0 width="100%" align="center"><tr>
				<td align="right">
				<a href="dbmHomepage.php" title="back to home" class="btnH">Home</a>
				</td></tr>
				</table>
					<img src="images/rmsportal copy.PNG" class="photo">
					<div align="center"><font color="#666666"><h3>Login as: <small>Records Admin<small/></h3></font> </div>
					<form ACTION="<?php echo $loginFormAction; ?>" method="POST" class="form-vertical" id="loginform">
						<span id="sprytextfield1">
							 <input class="input1" required="required" type="text" id="inputEmail" placeholder="Username..." name="username">
						</span>
						<span id="sprytextfield2">
							<input class="input2" required="required" type="password" id="inputPassword" placeholder="Password..." name="password">
							
						</span>
							<button type="submit" title="Login" class="btn" name="logbtn">Login</button>
							
						<?php
							if (isset($_POST['logbtn'])){
							$logUrec = $_POST['username'];
							$logPrec = $_POST['password'];
							$qry2 = mysql_query("SELECT account.accId, 
												account.perId,
												personnel.perId,
												personnel.perFname,
												personnel.perLname,
												personnel.perMname,
												personnel.perExtName,
												account.accUsername, 
												account.accPassword 	
												FROM account, personnel 
												WHERE account.accUsername = '$logUrec'
												AND account.accPassword = '$logPrec' 
												AND account.perId=personnel.perId ");
							while($row2 = mysql_fetch_assoc($qry2)){
									$_SESSION['fnamerec'] = $row2['perFname'];
									$_SESSION['lnamerec'] = $row2['perLname'];
									$_SESSION['mnamerec'] = $row2['perMname'];
									$_SESSION['extnamerec'] = $row2['perExtName'];
									$_SESSION['usernamerec'] = $row2['accUsername'];
									$_SESSION['passrec'] = $row2['accPassword'];
									$_SESSION['aidrec'] = $row2['accId'];
									$_SESSION['pidrec'] = $row2['perId'];
							}
							}
						?>               
					</form>
			</div>
	</div>
		</section>
	<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>	
</body>
</html>
