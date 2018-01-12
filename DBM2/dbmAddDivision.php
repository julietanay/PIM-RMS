
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formDivAdd")) {
  $insertSQL = sprintf("INSERT INTO division (divName, divModified) VALUES (%s, %s)",
                       GetSQLValueString($_POST['divName'], "text"),
                       GetSQLValueString($_POST['divModified'], "date"));
			if(mysql_query($insertSQL))
						{
								echo '<script type="text/javascript">
							    alert("Added Successfully!!");
								window.location.href="dbmAddDivision.php";
							     </script>';
						} else {
							echo '<script type="text/javascript">
							    alert("Something went wrong...Please Try Again...");
								window.location.href="dbmAddDivision.php";
							     </script>';}
  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($insertSQL, $dbmrov) or die(mysql_error());

  $insertGoTo = "dbmPerAdd.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = "SELECT * FROM division";
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Department of budget and Management</title>
<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<link type="text/css" href="css/styleLink.css" rel='stylesheet'>
<style>
body{
	backface-visibility:visible;
	background-attachment:fixed;
	background-origin:content-box;
	background-position:center;
	background-image:url(images/logo.png);
}

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
 border-color:#F90;
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
 border-color:#F90;
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
background-color: rgba(0,0,0, .6); 
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
background-color: rgba(0,0,0, .5); 
 
}

#myalert div{   
width: 800px;
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

</head>
<?php
$conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');
?>
<body>

								 <?php $display="block"; ?>
										<div id="myalert"  style="display:<?php echo $display ?>;">
										  <div id="header">
											<form action="dbmPerAdd.php" method="post">
											  <button type="submit" class="close">&times;&nbsp;&nbsp;&nbsp;</button>
											</form>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											<center>
											<table width="85%" bordercolor="#333" border="1">
											<tr>
											<td bgcolor="#333" align="center"><p></p>
											<h4 id="StyleLink2">Add Division</h4>
											</td>
											</tr>
											<tr>
											<td>
											<p></p>
											
								<form action="<?php echo $editFormAction; ?>" method="POST" name="formDivAdd" >
                                   <table align="center" >
                                     <tr valign="baseline">
                                       <td nowrap align="right">Division Name : </td>
                                       <td><input class="span4" type="text" name="divName" size="32" required></td>
                                     </tr>
									   <tr valign="baseline">
                                       <td nowrap align="right"></td>
                                       <td><input class="span4" type="hidden" name="divModified" size="32" value="<?php echo date('Y-m-d'); ?>">
                                       <input type="submit" value="Add Division" class="btn btn-inverse pull-right"></td>
                                     </tr>
									 </tr>
									   <tr valign="baseline">
                                       <td nowrap align="right">&nbsp;</td>
                                       <td>&nbsp;</td>
                                     </tr>
                                   </table>
                                   <input type="hidden" name="MM_insert" value="formDivAdd">
                                 </form>
						
											</td>
											</tr>
											</table>
								<table width="85%" bordercolor="#333" border="1">
                                          <tr bgcolor="#333" align="center">
                                            <td><font color="#FFFFFF">No. </font></td>
                                            <td><font color="#FFFFFF">Division Name </font></td>
											<td><font color="#FFFFFF">Personnel In Charge of Department</font></td>
											<td></td>
                                          </tr>
                                          <?php $count=1;
										     do { ?>
                                            <tr>
                                              <td align="center" width="10%"><?php echo $count; ?></td>
                                              <td> <form action="dbmDivUpdate2.php" name="updateDiv" method="get">
											<input type="text" value="<?php echo $row_Recordset1['divName']; ?>"  name="divName" id="divName"/>   
											<input type="hidden" value="<?php echo $row_Recordset1['divId']; ?>"  name="divId" id="divId"/> 
											<input type="hidden" value="<?php echo $row_Recordset1['perId']; ?>"  name="perId" id="perId"/> 
											</td>
											<td> 
											  <select name="perId" id="perId" required >
									   <option value=" ">Person In Charge...</option>
							 <?php
							 $dvd=$row_Recordset1['divId'];
							  $perId=$row_Recordset1['perId'];
							 $result = $conn->query("select * from personnel where personnel.divId='$dvd'");
									while ($row = $result->fetch_assoc()) {
												   unset($id, $name, $name1, $name2, $name3);
												  $id = $row['perId'];
												  $name=$row['perFname'];
												  $name1=$row['perMname'];
												  $name2=$row['perLname'];
												  $name3=$row['perExtName'];
									if($perId == $id )
										{
											$selected = 'selected="selected"';
										}
										else
										{
										$selected = '';
										}
										 echo '<option value="'.$id.'" '.$selected.'"> '.$name.' '.$name1.' '.$name2.' '.$name3.' </option>';
								}
							?>  
											
											
											</td>
											<td>
										<button type="submit" class="btn btn-mini btn-primary" name="btnnn" id="btnnn">	<i class="icon-edit"></i>Change</button>
											</form>											
											</td>
                                            </tr>
                                            <?php $count++;  } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                                        </table>
                                            </center>
											<p>&nbsp;</p>
												<p>&nbsp;</p>
											  </div>
												</div>
							
							
							
							
							

<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

?>
