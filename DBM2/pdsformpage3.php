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

$colname_Recordset1 = "-1";
if (isset($_GET['perId'])) {
  $colname_Recordset1 = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = sprintf("SELECT * FROM personnel WHERE perId = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['perId'])) {
  $colname_Recordset2 = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset2 = sprintf("SELECT * FROM voluntary_work WHERE perId = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $dbmrov) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>PDS: Personal Data Sheet</title>

<style>
#bgcolor{
	background-color: #999;
	color: #FFF;
}
#bgcolor2{
	background-color: #CCC;
}
</style>
<style type="text/css">
    .navbar {
        background-color: black;
        background-image: none;
        height: 60px;
    }

 }
@media (max-width: 768px) { /* mobile view */
  ul.nav-pills   {
    position: relative;
  }
}

div.col-sm-9 div {

    font-size: 28px;
}

}
.centered-pills { text-align:center; }
.centered-pills ul.nav-pills { display:inline-block; }
.centered-pills li { display:inline; }
.centered-pills a { float:left; }
* html .centered-pills ul.nav-pills { display:inline; } /* IE6 */
*+html .centered-pills ul.nav-pills { display:inline; } /* IE7 */
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
    .yes-print {
            background-color: yellow !important;
    }
    .size-print {
      font-size: 9px;
    }
    .size-print2 {
      font-size: 10px;
      line-height: 1.5;
    }
}
.yes-print {
        background-color: yellow !important;
}
.marg-2 {
  position: fixed;
  height: 50px;
  bottom: 0;
}   
</style>
<style>
#bgcolor{
	background-color: #999;
	color: #FFF;

	}
#bgcolor1{
	background-color: #CCC;
	}
</style>
</head>

<body>
<table width="900" height="330" border="1" align="center">
  <tr>
   <td colspan="5" id="bgcolor"><i><b><font size="-1">&nbsp;VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S</font></b></i></td>
  </tr>
  <tr id="bgcolor2">
    <td width="358" rowspan="2"><div align="center"><font size="-2">&nbsp;29. NAME &amp; ADDRESS OF ORGANIZATION<br />    
      
    </font></div><center>
  <font size="-2">    (Write in full)
    </font>
</center>    </td>
    <td height="37" colspan="2" align="center"><font size="-2">INCLUSIVE DATES<br />(mm/dd/yyyy)</font></td>
    <td width="75" rowspan="2" align="center"><font size="-2">NUMBER OF HOURS</font></td>
    <td width="275" rowspan="2" align="center"><font size="-2">POSITION / NATURE OF WORK</font></td>
  </tr>
  <tr id="bgcolor2">
    <td width="84" height="23" align="center">From</td>
    <td width="74" align="center">To</td>
  </tr>
  <tr>
    <td><div align="center"><?php echo $row_Recordset2['orgName']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset2['volunteerFrom']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset2['volunteerTo']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset2['noOfHours']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset2['position']; ?></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19" colspan="5" align="center" id="bgcolor2"><font size="-1" color="#FF0000"><em>(Continue on separate sheet if necessary)</em></font></td>
  </tr>
</table>
<table width="900" height="330" border="1" align="center">
  <tr>
   <td colspan="6" id="bgcolor"><p></p><p><font size="-1"><strong><em>&nbsp;VII.  LEARNING AND DEVELOPMENT (L&amp;D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED</em></strong></font></p><font size="-2">&nbsp;(Start from the most recent L&amp;D/training program and include only the relevant L&amp;D/training taken for the last five (5) years for Division Chief/Executive/Managerial positions)</font></td>
  </tr>
  <tr id="bgcolor2">
    <td width="349" rowspan="2"><font size="-2">&nbsp;
        <div align="center">30. TITLE OF LEARNING AND DEVELOPMENTINTERVENTIONS/TRAINING PROGRAMS</div>
      
      <div align="center">
        (Write in full)
      </div>
    </font></td>
    <td height="37" colspan="2" align="center"><p></p>
    <p><font size="-2">INCLUSIVE DATES OF ATTENDANCE <br />(mm/dd/yyyy)</font></p></td>
    <td width="80" rowspan="2" align="center"><font size="-2">NUMBER OF HOURS</font></td>
    <td width="83" rowspan="2" align="center"><font size="-2">Type of LD<br />
( Managerial/ Supervisory/<br />
Technical/etc)</font></td>
    <td width="189" rowspan="2" align="center"><font size="-2">CONDUCTED/ SPONSORED BY<br />
    (Write in full)</font></td>
  </tr>
  <tr id="bgcolor2">
    <td width="83" height="23" align="center">From</td>
    <td width="76" align="center">To</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19" colspan="6" align="center" id="bgcolor2"><font size="-1" color="#FF0000"><em>(Continue on separate sheet if necessary)</em></font></td>
  </tr>
</table>
<table width="900" height="330" border="1" align="center">
  <tr>
   <td colspan="3" id="bgcolor"><i><b><font size="-1">VIII.  OTHER INFORMATION</font></b>
   </i></td>
  </tr>
  <tr id="bgcolor2">
    <td width="273"><div align="center"><font size="-1">31</font><font size="-1">.&emsp;  SPECIAL SKILLS and HOBBIES<br /><br />
    </font></div></td>
    <td width="328" height="37"><div align="center"><font size="-1">32.&emsp;NON-ACADEMIC DISTINCTIONS / RECOGNITION <br />
    </font></div><center>
  <font size="-1">    (Write in full)</font>
</center>    </td>
    <td width="277"><div align="center">
      <p><font size="-1">33.&emsp;MEMBERSHIP IN ASSOCIATION/ORGANIZATION
   </font></p>
      <div align="center"><font size="-1"> (Write in full)</font></div>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19" colspan="3" align="center" id="bgcolor2"><font size="-1" color="#FF0000"><em>(Continue on separate sheet if necessary)</em></font></td>
  </tr>  
</table>
<table width="900" border="1" align="center">
  <tr >
    <td width="88" height="39" align="center" id="bgcolor2"><font size="-1"><b><em>SIGNATURE</em></b></font></td>
    <td width="222">&nbsp;</td>
    <td width="59" align="center" id="bgcolor2"><font size="-1"><b><em>DATE</em></b></font></td>
    <td width="264">&nbsp;</td>
    <td width="233" align="center"><font size="-1"><b><em>CS FORM 212 (Revised 2017), Page 3 of 4</em></b></font></td>
  </tr>
</table>
 <p>&nbsp; </p>
  <div class="container-fluid marg-2 no-print"  style="line-height: .7;">
   <a href="dbmPIMPersonnelList.php" class="btn btn-danger loading bold"> <i class="icon-chevron-left"></i> Back to List</a> 
    <a href="PDSForm2.php<?php echo $row_Recordset1['perId']; ?>" class="btn btn-danger loading bold "> P1 </a> 
    <a href="PDSformPage2.php?perId=<?php echo $row_Recordset1['perId']; ?>" class="btn btn-danger loading bold"> P2 </a> 
    <a href="#" class="btn btn-danger loading bold active "> P3 </a> 
     <a href="PDSformPage4.php?perId=<?php echo $row_Recordset1['perId']; ?>" class="btn btn-danger loading bold "> P4 </a>
   &nbsp; &nbsp;
  <button type="submit" name="insert" onclick="window.print()" class="btn btn-primary loading bold"> 
  &nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-print"></i>&nbsp; Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
  
</div>
 
<style>
/*Author: Kosmom.ru*/.loading,.loading>td,.loading>th,.nav li.loading.active>
a,.pagination li.loading,.pagination>li.active.loading>a,.pager>li.loading>a{
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, rgba(0, 0, 0, 0) 25%, rgba(0, 0, 0, 0)
     50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(0, 0, 0, 0) 75%, rgba(0, 0, 0, 0));
    background-size: 40px 40px;

animation: 2s linear 0s normal none infinite progress-bar-stripes;
-webkit-animation: progress-bar-stripes 2s linear infinite;
}
.btn.btn-default.loading,input[type="text"].loading,select.loading,textarea.loading,.well.loading,.list-group-item.loading,.pagination>li.active.loading>a,.pager>li.loading>a{
background-image: linear-gradient(45deg, rgba(235, 235, 235, 0.15) 25%, rgba(0, 0, 0, 0) 25%, rgba(0, 0, 0, 0) 50%, rgba(235, 235, 235, 0.15) 50%, rgba(235, 235, 235, 0.15) 75%, rgba(0, 0, 0, 0) 75%, rgba(0, 0, 0, 0));
}
</style>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
