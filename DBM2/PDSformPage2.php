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
$query_Recordset1 = sprintf("SELECT * FROM eligibility WHERE perId = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>PDS: Personal Data Sheet</title>
<style type="text/css">
.Arial {
	font-family: Arial, Helvetica, sans-serif;
}
.ArialBlack {
	font-family: Arial Black, Gadget, sans-serif;
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
<table width="900" border="1" align="center">
  <tr>
    <th height="30" colspan="6" scope="col" id="bgcolor"><div align="left">&nbsp;&nbsp;&nbsp;<i>IV.  CIVIL SERVICE ELIGIBILITY</i></div></th>
  </tr>
  <tr>
    <td width="287" rowspan="2" id="bgcolor1"><div align="center"><font size="-2">27.</font>&emsp; <font size="-2">  CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/ CSEE                                                    BARANGAY ELIGIBILITY / DRIVER'S LICENSE</font></div></td>
    <td width="116" rowspan="2" id="bgcolor1"><div align="center"><font size="-2">RATING<br />
    (If Applicable)</font></div></td>
    <td width="121" rowspan="2" id="bgcolor1"><div align="center"><font size="-2">DATE OF EXAMINATION / CONFERMENT</font></div></td>
    <td width="234" rowspan="2" id="bgcolor1"><div align="center"><font size="-2">PLACE OF EXAMINATION / CONFERMENT</font></div></td>
    <td height="25" colspan="2" id="bgcolor1"><div align="center"><font size="-2">LICENSE (if applicable)</font></div></td>
  </tr>
  <tr>
    <td width="78" height="34" id="bgcolor1"><div align="center"><font size="-1">NUMBER</font></div></td>
    <td width="70" id="bgcolor1"><div align="center" ><font size="-1">Date of<br>
    Validity</font></div></td>
  </tr>
 <?php  			$perId=$row_Recordset1['perId'];
					$querym = "select * from eligibility where eligibility.perId=$perId ";
					$resultm= mysql_query($querym);	
					while($rowm = mysql_fetch_assoc($resultm)) {
						$elName=$rowm['elName'];
						$elRating=$rowm['elRating'];
						$elTitle=$rowm['elTitle'];
						$elDate=$rowm['elDate'];
						$elPlace=$rowm['elPlace'];
						$elNumber=$rowm['elNumber'];
						$elDateValid=$rowm['elDateValid'];
						 ?>
  <tr>
    <td height="24"><div align="center"><?php echo $elTitle; ?></div></td>
    <td><div align="center"><small><?php echo $elRating ?></small></div></td>
    <td><div align="center">  <?php 
						 $bdy=$elDate;
						 $d = date_parse_from_format("Y-m-d", $bdy);
						 $month=$d["month"];
						 $day=$d["day"];
						 $Year=$d["year"];
						 if($month==1){
							 $mon="January";
						 }else if($month==2){
							 $mon="February";
						 }else if($month==3){
							 $mon="March";
						 }else if($month==3){
							 $mon="April";
						 }else if($month==5){
							 $mon="May";
						 }else if($month==6){
							 $mon="June";
						 }else if($month==7){
							 $mon="July";
						 }else if($month==8){
							 $mon="August";
						 }else if($month==9){
							 $mon="September";
						 }else if($month==10){
							 $mon="October";
						 }else if($month==11){
							 $mon="November";
						 }else if($month==12){
							 $mon="December";
						 }
						 echo '<small>'.$mon.' '.$day.', '.$Year.'</small>'?>
    
    
    
    
    
    
    </div></td>
    <td><div align="center"><small><?php echo $elPlace ?></small></div></td>
    <td><div align="center"><small><?php echo $elNumber ?></small></div></td>
      <td><div align="center"> <?php 
						 $bdy=$elDateValid;
						 $d = date_parse_from_format("Y-m-d", $bdy);
						 $month=$d["month"];
						 $day=$d["day"];
						 $Year=$d["year"];
						 if($month==1){
							 $mon="January";
						 }else if($month==2){
							 $mon="February";
						 }else if($month==3){
							 $mon="March";
						 }else if($month==3){
							 $mon="April";
						 }else if($month==5){
							 $mon="May";
						 }else if($month==6){
							 $mon="June";
						 }else if($month==7){
							 $mon="July";
						 }else if($month==8){
							 $mon="August";
						 }else if($month==9){
							 $mon="September";
						 }else if($month==10){
							 $mon="October";
						 }else if($month==11){
							 $mon="November";
						 }else if($month==12){
							 $mon="December";
						 }else $mon="";
						 
						 echo '<font size="-2">'.$mon.' '.$day.' '.$Year.'</font>'?></div></td>
  </tr>
  <?php } ?>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
   <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" id="bgcolor1"><div align="center"><font color="red" size="-1"><i>(Continue on separate sheet if necessary)</i></font></div></td>
  </tr>
</table>
<table width="900" border="1" align="center">
  <tr>
    <td height="45" colspan="8" id="bgcolor"><div align="left"><i><strong>&nbsp;&nbsp;&nbsp;V.  WORK EXPERIENCE </strong></i><br>
    <font size="-2"><i>&nbsp;(Include private employment.  Start from your recent work) Description of duties should be indicated in the attached Work Experience sheet.)</i></font></div></td>
  </tr>
  <tr>
    <td height="43" colspan="2" id="bgcolor1"><div align="center"><font size="-2">28.</font> <font size="-2">INCLUSIVE DATES <br>
      (mm/dd/yyyy)</font></div></td>
    <td width="194" rowspan="2" id="bgcolor1"><div align="center">
      <font size="-2">POSITION TITLE <br>      
     (Write in full/Do not abbreviate)
    </font></div></td>
    <td width="173" rowspan="2" id="bgcolor1"><div align="center"><font size="-2">DEPARTMENT / AGENCY / OFFICE / COMPANY<br>  (Write in full/Do not abbreviate)</font></div></td>
    <td width="111" rowspan="2" id="bgcolor1"><div align="center"><font size="-1">MONTHLY SALARY</font></div></td>
    <td width="68" rowspan="2" id="bgcolor1"><div align="center"><font size="-2">SALARY/ JOB/ PAY GRADE <br>(if applicable)&amp; STEP  (Format &quot;00-0&quot;)/ INCREMENT</font></div></td>
    <td width="82" rowspan="2" id="bgcolor1"><div align="center"><font size="-2">STATUS OF APPOINTMENT</font></div></td>
    <td width="85" rowspan="2" id="bgcolor1"><div align="center"><font size="-2">GOV'T SERVICE<br>(Y/ N)</font></div></td>
  </tr>
  <tr>
    <td width="68" height="29" id="bgcolor1"><div align="center"><font size="-1">From</font></div></td>
    <td width="67" id="bgcolor1"><div align="center"><font size="-1">To</font></div></td>
  </tr>
   <?php  			$perId=$row_Recordset1['perId'];
					$querym = "select * from work where work.perId=$perId ";
					$resultm= mysql_query($querym);	
					while($rowm = mysql_fetch_assoc($resultm)) {
						$workId=$rowm['workId'];
						$workFrom=$rowm['workFrom'];
						$workTo=$rowm['workTo'];
						$workPosTitle=$rowm['workPosTitle'];
						$workAgency=$rowm['workAgency'];
						$workMonthlySalary=$rowm['workMonthlySalary'];
						$workStatAppointment=$rowm['workStatAppointment'];
						$workGovtService=$rowm['workGovtService'];
						$workDateModified=$rowm['workDateModified'];
						$workSalary1=$rowm['workSalary1'];
						$workSalary2=$rowm['workSalary2'];
	   				    $perId=$rowm['perId'];
						 ?>
  <tr>
    <td height="24"><small><div align="center"> <?php 
						 $bdy=$workFrom;
						 $d = date_parse_from_format("Y-m-d", $bdy);
						 $month=$d["month"];
						 $day=$d["day"];
						 $Year=$d["year"];
						 if($month==1){
							 $mon="January";
						 }else if($month==2){
							 $mon="February";
						 }else if($month==3){
							 $mon="March";
						 }else if($month==3){
							 $mon="April";
						 }else if($month==5){
							 $mon="May";
						 }else if($month==6){
							 $mon="June";
						 }else if($month==7){
							 $mon="July";
						 }else if($month==8){
							 $mon="August";
						 }else if($month==9){
							 $mon="September";
						 }else if($month==10){
							 $mon="October";
						 }else if($month==11){
							 $mon="November";
						 }else if($month==12){
							 $mon="December";
						 }else $mon="";
						 
						 echo '<font size="-2">'.$mon.' '.$day.' '.$Year.'</font>'?></div></small></td>
    <td><small><div align="center">
    <?php 
						 $bdy=$workTo;
						 $d = date_parse_from_format("Y-m-d", $bdy);
						 $month=$d["month"];
						 $day=$d["day"];
						 $Year=$d["year"];
						 if($month==1){
							 $mon="January";
						 }else if($month==2){
							 $mon="February";
						 }else if($month==3){
							 $mon="March";
						 }else if($month==3){
							 $mon="April";
						 }else if($month==5){
							 $mon="May";
						 }else if($month==6){
							 $mon="June";
						 }else if($month==7){
							 $mon="July";
						 }else if($month==8){
							 $mon="August";
						 }else if($month==9){
							 $mon="September";
						 }else if($month==10){
							 $mon="October";
						 }else if($month==11){
							 $mon="November";
						 }else if($month==12){
							 $mon="December";
						 }else $mon="";
						 
						 echo '<font size="-2">'.$mon.' '.$day.' '.$Year.'</font>'?></div></small></td>
    <td><div align="center"><?php echo $workPosTitle; ?></div></td>
    <td><div align="center"><?php echo $workAgency; ?></div></td>
    <td><div align="center"><?php echo $workMonthlySalary; ?></div></td>
    <td><div align="center"><?php echo $workSalary1.'-'.$workSalary2; ?></div></td>
    <td><div align="center"><?php echo $workStatAppointment; ?></div></td>
    <td><div align="center"><?php echo $workGovtService; ?></div></td>
  </tr>
  <?php } ?>
   <tr>
   <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
   <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
   <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
   <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
 <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
   <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
   <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
   <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
<td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
 <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
 <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
<td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
<td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
<td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
<td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
<td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
<td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
<td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8" id="bgcolor1"><div align="center"><font color="red" size="-1"><i>(Continue on separate sheet if necessary)</i></font></div></td>
  </tr>
</table>
<table width="900" border="1" align="center">
  <tr >
    <td width="88" height="39" align="center" bgcolor="#CCCCCC" "><font size="-1"><b>SIGNATURE</b></font></td>
    <td width="222">&nbsp;</td>
    <td width="59" align="center" bgcolor="#CCCCCC" ><font size="-1"><b>DATE</b></font></td>
    <td width="264">&nbsp;</td>
    <td width="233" align="center"><font size="-2"><b><em>CS FORM 212 (Revised 2017), Page 2 of 4</em></b></font></td>
  </tr>
</table>
 <p>&nbsp; </p>
  <div class="container-fluid marg-2 no-print"  style="line-height: .7;">
     <a href="dbmPIMPersonnelList.php" class="btn btn-danger loading bold"> Back to List</a> 
   <a href="PDSForm2.php?perId=<?php echo $row_Recordset1['perId']; ?>" class="btn btn-danger loading bold"> P1</a>
    <a href="PDSformPage2.php?perId=<?php echo $row_Recordset1['perId']; ?>" class="btn btn-danger loading bold active"> P2 </a>
    <a href="PDSformPage3.php?perId=<?php echo $row_Recordset1['perId']; ?>" class="btn btn-danger loading bold "> P3 </a> 
     <a href="PDSformPage4.php?perId=<?php echo $row_Recordset1['perId']; ?>" class="btn btn-danger loading bold "> P4 </a>  &nbsp; &nbsp;
  <button type="submit" name="insert" onclick="window.print()" class="btn btn-primary loading bold"> 
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
