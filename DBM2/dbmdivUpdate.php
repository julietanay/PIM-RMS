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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE division SET divName=%s, divDesc=%s, divModified=%s WHERE divId=%s",
                       GetSQLValueString($_POST['divName'], "text"),
                       GetSQLValueString($_POST['divDesc'], "text"),
                       GetSQLValueString($_POST['divModified'], "date"),
                       GetSQLValueString($_POST['divId'], "int"));

  mysql_select_db($database_dbmrov, $dbmrov);
  $Result1 = mysql_query($updateSQL, $dbmrov) or die(mysql_error());

  $updateGoTo = "dbmManage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['divId'])) {
  $colname_Recordset1 = $_GET['divId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = sprintf("SELECT * FROM division WHERE divId = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style>
#myModal {top:0%; outline: none; background-color: rgba(0,0,0,0.7); }
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<a href="dbmManage.php"><button type="button" class="close">&times;</button></a>
									  <center>
									    <h2 class="modal-title">Update Division "<?php echo $row_Recordset1['divName']; ?>"</h2>
									   
									  <hr>
									  <table width="100%" border="1">
									    <tr bgcolor="#333333">
									      <td>&nbsp;</td>
								        </tr>
									    </table>
									  <p>&nbsp;</p>
                                      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                                        <table align="center">
                                          <tr valign="baseline">
                                            <td width="69" align="right" nowrap="nowrap"><div align="center">Name:</div></td>
                                            <td width="259"><div align="left">
                                              <input class="span4" type="text" name="divName" value="<?php echo htmlentities($row_Recordset1['divName'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                                            </div></td>
                                          </tr>
                                          <tr valign="baseline">
                                            <td nowrap="nowrap" align="right"><div align="center">Description:</div></td>
                                            <td><div align="left">
                                                <textarea class="span4" name="divDesc" id="divDesc" cols="45" rows="3"><?php echo $row_Recordset1['divDesc']; ?></textarea>
                                            </div>
                                            <div align="left">(create a brief description of this division)</div>
                                            </td>
                                          </tr>
                                          <tr valign="baseline">
                                            <td nowrap="nowrap" align="right"><div align="center"></div></td>
                                            <td><input type="hidden" name="divModified" value="<?php echo date('Y-m-d'); ?>" size="32" /></td>
                                          </tr>
                                          <tr valign="baseline">
                                            <td nowrap="nowrap" align="right"><div align="center"></div></td>
                                            <td><input type="submit" value="Update record" class="btn btn-inverse pull-right"/></td>
                                          </tr>
                                        </table>
                                        <p>
                                          <input type="hidden" name="MM_update" value="form1" />
                                          <input type="hidden" name="divId" value="<?php echo $row_Recordset1['divId']; ?>" />
                                        </p>
                                      </form>
                                      <table width="100%" border="1">
                                        <tr bgcolor="#333333">
                                          <td>&nbsp;</td>
                                        </tr>
                                      </table>
                                      <p>&nbsp;</p>
                                      </center>
</div>
									</div>
								</div>
							</div>
					
	       <script src="bootstrap.min.js"></script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
