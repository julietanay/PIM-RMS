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

$colname_Recordset2 = "-1";
if (isset($_GET['perId'])) {
  $colname_Recordset2 = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset2 = sprintf("SELECT * FROM address WHERE addressType='Residential' and perId = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $dbmrov) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_permanentAdd = "-1";
if (isset($_GET['perId'])) {
  $colname_permanentAdd = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_permanentAdd = sprintf("SELECT * FROM address  WHERE addressType='Permanent' and perId = %s", GetSQLValueString($colname_permanentAdd, "int"));
$permanentAdd = mysql_query($query_permanentAdd, $dbmrov) or die(mysql_error());
$row_permanentAdd = mysql_fetch_assoc($permanentAdd);
$totalRows_permanentAdd = mysql_num_rows($permanentAdd);

$colname_spouse = "-1";
if (isset($_GET['perId'])) {
  $colname_spouse = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_spouse = sprintf("SELECT * FROM family WHERE famRelationship='Spouse' and perId = %s", GetSQLValueString($colname_spouse, "int"));
$spouse = mysql_query($query_spouse, $dbmrov) or die(mysql_error());
$row_spouse = mysql_fetch_assoc($spouse);
$totalRows_spouse = mysql_num_rows($spouse);

$colname_father = "-1";
if (isset($_GET['perId'])) {
  $colname_father = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_father = sprintf("SELECT * FROM family WHERE famRelationship='Father' and perId = %s", GetSQLValueString($colname_father, "int"));
$father = mysql_query($query_father, $dbmrov) or die(mysql_error());
$row_father = mysql_fetch_assoc($father);
$totalRows_father = mysql_num_rows($father);

$colname_mother = "-1";
if (isset($_GET['perId'])) {
  $colname_mother = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_mother = sprintf("SELECT * FROM family WHERE famRelationship='Mother' and perId = %s", GetSQLValueString($colname_mother, "int"));
$mother = mysql_query($query_mother, $dbmrov) or die(mysql_error());
$row_mother = mysql_fetch_assoc($mother);
$totalRows_mother = mysql_num_rows($mother);

$colname_Recordset1 = "-1";
if (isset($_GET['perId'])) {
  $colname_Recordset1 = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Recordset1 = sprintf("SELECT * FROM personnel WHERE perId = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $dbmrov) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_elementary = "-1";
if (isset($_GET['perId'])) {
  $colname_elementary = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_elementary = sprintf("SELECT * FROM education WHERE education.educLevel='Elementary' AND perId = %s", GetSQLValueString($colname_elementary, "int"));
$elementary = mysql_query($query_elementary, $dbmrov) or die(mysql_error());
$row_elementary = mysql_fetch_assoc($elementary);
$totalRows_elementary = mysql_num_rows($elementary);

$colname_Secondary = "-1";
if (isset($_GET['perId'])) {
  $colname_Secondary = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Secondary = sprintf("SELECT * FROM education WHERE education.educLevel='Secondary' AND perId = %s", GetSQLValueString($colname_Secondary, "int"));
$Secondary = mysql_query($query_Secondary, $dbmrov) or die(mysql_error());
$row_Secondary = mysql_fetch_assoc($Secondary);
$totalRows_Secondary = mysql_num_rows($Secondary);

$colname_Vocational = "-1";
if (isset($_GET['perId'])) {
  $colname_Vocational = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_Vocational = sprintf("SELECT * FROM education WHERE education.educLevel='Vocational/Trade Course' AND perId = %s", GetSQLValueString($colname_Vocational, "int"));
$Vocational = mysql_query($query_Vocational, $dbmrov) or die(mysql_error());
$row_Vocational = mysql_fetch_assoc($Vocational);
$totalRows_Vocational = mysql_num_rows($Vocational);

$colname_college = "-1";
if (isset($_GET['perId'])) {
  $colname_college = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_college = sprintf("SELECT * FROM education WHERE education.educLevel='College' AND perId = %s", GetSQLValueString($colname_college, "int"));
$college = mysql_query($query_college, $dbmrov) or die(mysql_error());
$row_college = mysql_fetch_assoc($college);
$totalRows_college = mysql_num_rows($college);

$colname_graduate = "-1";
if (isset($_GET['perId'])) {
  $colname_graduate = $_GET['perId'];
}
mysql_select_db($database_dbmrov, $dbmrov);
$query_graduate = sprintf("SELECT * FROM education WHERE education.educLevel='Graduate Studies' and perId = %s", GetSQLValueString($colname_graduate, "int"));
$graduate = mysql_query($query_graduate, $dbmrov) or die(mysql_error());
$row_graduate = mysql_fetch_assoc($graduate);
$totalRows_graduate = mysql_num_rows($graduate);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
 <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
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
</head>

<body>
<div align="center">
  <table width="900" align="center" border="2">
    <tr>
      <td colspan="8"><table width="100%">
        <tr>
          <td >
            <div align="left"><font size="-1">&nbsp;&nbsp;&nbsp;<strong>CS Form No. 212</strong></font></div><div align="left"><strong><font size="-2">&nbsp;&nbsp;&nbsp;Revised 2017</font></strong></div>
            <div align="center">
            <font size="+3" class="ArialBlack">PERSONAL DATA SHEET</font>
          </div></td>
        </tr>
        <tr>
          <td class="Arial"><table width="100%" border="0">
            <tr>
              <td colspan="2"><table width="98%" align="center" border="0">
  <tr>
    <td><small><strong>WARNING: Any misinterpretation made in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administrative/criminal case/s against the person concerned.</strong></small></td>
  </tr>
</table>
</td>
              </tr>
            <tr>
              <td colspan="2"><table width="98%" align="center" border="0">
  <tr>
    <td><small><em>READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM.</em></small></td>
  </tr>
</table>
</td>
              </tr>
            <tr>
              <td width="71%"><table align="center" width="98%" border="0">
  <tr>
    <td><font size="-2">Print legibly. Tick appropriate boxes (     ) and use separate sheet if necessary. Indicate N/A if not applicable.</font><small><span class="ArialBlack"> DO NOT ABBREVIATE.</span></small></td>
  </tr>
</table>
</td>
              <td width="29%"><table width="100%" height="26" border="1">
                <tr>
                  <td width="41%" bgcolor="#666666"><small> &nbsp; 1. CS ID No.</small></td>
                  <td width="59%"> <div align="center"><font size="-2">(Do not fill up. For CSC use only)</font></div></td>
                </tr>
              </table></td>
              </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="8"bgcolor="#666666" class="Arial"> <font color="#FFFFFF"><em>I. PERSONNAL INFORMATION </em></font></td>
    </tr>
   
    <tr>
      <td width="176" rowspan="3"  bgcolor="#CCCCCC">
      <p align="center">2. SURNAME</p>        
      <p align="center">FIRST NAME</p>       
      <div align="center">MIDDLE NAME</div></td>
      <td colspan="7">&nbsp; <?php echo $row_Recordset1['perLname']; ?></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp; <?php echo $row_Recordset1['perFname']; ?></td>
      <td width="200" bgcolor="#CCCCCC"><table width="100%" border="0">
        <tr>
          <td><font size="-2">NAME EXTENSION (JR., SR)</font></td>
        </tr>
        <tr>
          <td> &nbsp; <?php echo $row_Recordset1['perExtName']; ?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="7"> &nbsp; <?php echo $row_Recordset1['perMname']; ?></td>
    </tr>
      <tr>
      <td colspan="8"><table align="center" width="900" border="1">
        <tr>
          <td width="174" bgcolor="#CCCCCC"><div align="center" >3. DATE OF BIRTH</div>
            <div align="center">(mm/dd/yy)</div></td>
          <td width="180">&nbsp; 
          
           <?php 
						 $bdy=$row_Recordset1['perBday'];
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
						 echo ''.$mon.' '.$day.', '.$Year.' '?>
            </td>         
          <td rowspan="3" bgcolor="#CCCCCC"><div>16.  CITIZENSHIP</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>
              <div align="center">If holder of  dual citizenship, </div>
              </div>
            <div>
              <div align="center">please indicate the details.</div>
            </div></td>
          <td rowspan="2"><div align="left">&nbsp; 
                <input type="checkbox" name="perCit" id="perCit" checked="checked"/>
            Filipino 
            <input type="checkbox" name="PerDualCit" id="PerDualCit" <?php if($row_Recordset1['perCitNature'] !=Null || $row_Recordset1['perCitCountry'] !=Null) { ?> checked="checked"<?php } ?>/>
            Dual Citizenship    
          </div>  
          <div align="right">
            <input type="checkbox" name="PerCitNature" id="PerCitNature" value="By Birth"<?php if($row_Recordset1['perCitNature'] == 'By Birth') { ?> checked="checked"<?php } ?>/>
          By Birth 
          <input type="checkbox" name="PerCitNature" id="PerCitNature" value="By Naturalization"<?php if($row_Recordset1['perCitNature'] == 'By Naturalization') { ?> checked="checked"<?php } ?>/>
          By Naturalization &nbsp;
          </div>
            <div align="center">Pls, Indicate Country</div></td>
        </tr>
        <tr>
          <td width="174" bgcolor="#CCCCCC"><div align="center">4. PLACE OF BIRTH</div></td>
          <td width="180"> &nbsp; <?php echo $row_Recordset1['perBPlace']; ?></td>
          </tr>
        <tr>
          <td width="174" bgcolor="#CCCCCC"><div align="center">5. SEX</div></td>
          <td width="180"><div align="center">
                <input type="checkbox" name="perGender" id="perGender" value="Male"<?php if($row_Recordset1['perGender'] == 'Male') { ?> checked="checked"<?php } ?>/>
            Male &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
              <input type="checkbox" name="perGender" id="perGender" value="Female"<?php if($row_Recordset1['perGender'] == 'Female') { ?> checked="checked"<?php } ?>/>
            Female</div></td>
          <td><div align="center"><?php echo $row_Recordset1['perCitCountry']; ?></div></td>
        </tr>
      </table>
        <table width="900" align="center" border="1">
          <tr>
            <td width="175" rowspan="2" bgcolor="#CCCCCC"><div align="center">6. CIVIL STATUS</div>              <div align="center"></div></td>
            <td width="180" rowspan="2"><div>&nbsp;
              <input type="checkbox" name="status" id="status" value="Single"<?php if($row_Recordset1['perStatus'] == 'Single') { ?> checked="checked"<?php } ?>/>
              Single &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; 
              <input type="checkbox" name="status" id="status" value="Married"<?php if($row_Recordset1['perStatus'] == 'Married') { ?> checked="checked"<?php } ?>/>
              Married
            </div>
              <div>&nbsp;
                <input type="checkbox" name="status" id="status" value="Widowed"<?php if($row_Recordset1['perStatus'] == 'Widowed') { ?> checked="checked"<?php } ?>/>
                <font size="-1">Widowed &nbsp; &nbsp;</font>
                <input type="checkbox" name="status" id="status" />
                <font size="-1">Separated </font></div>              <div>&nbsp;
                  <input type="checkbox" name="status" id="status" />
                 Other/s
                </div></td>
            <td width="182" rowspan="4" bgcolor="#CCCCCC"><div><font size="-1">17. RESIDENTIAL ADDRESS</font></div>
          <div>&nbsp;</div>
          <div>&nbsp;</div>
         <div>&nbsp;</div>
       
            <div align="center">&nbsp; </div>
  
            <div align="center"><font size="-1">ZIP CODE</font></div></td>
            <td width="364"><div align="center">
              <table width="340" border="0">
                <tr>
                  <td width="156"><div align="center"><?php echo $row_Recordset2['houseNo']; ?></div>
                    <div>
                      <div align="center"><font size="-2">House/Block/Lot No.</font></div>
                    </div></td>
                  <td width="142"><div align="center"><?php echo $row_Recordset2['street']; ?></div>
                    <div>
                      <div align="center"><font size="-2">Street</font></div>
                    </div></td>
                  </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td width="364"><div align="center">
              <table width="340" border="0">
                <tr>
                  <td width="156"><div align="center"><?php echo $row_Recordset2['subdivision']; ?></div>
                    <div>
                      <div align="center"><font size="-2">Subdivision/Village</font></div>
                    </div></td>
                  <td width="142"><div align="center"><?php echo $row_Recordset2['barangay']; ?></div>
                    <div>
                      <div align="center"><font size="-2">Barangay</font></div>
                    </div></td>
                  </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td width="175" bgcolor="#CCCCCC"><div align="center">7. HEIGHT (m)</div></td>
            <td width="180">&nbsp; <?php echo $row_Recordset1['perHeight']; ?></td>
            <td width="364"><div align="center">
              <table width="340" border="0">
                <tr>
                  <td width="156"><div align="center"><?php echo $row_Recordset2['houseNo']; ?></div>
                    <div>
                      <div align="center"><font size="-2">City/Municipality</font></div>
                    </div></td>
                  <td width="142"><div align="center"><?php echo $row_Recordset2['province']; ?></div>
                    <div>
                      <div align="center"><font size="-2">Province</font></div>
                    </div></td>
                  </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td width="175" bgcolor="#CCCCCC"><div align="center">8. WEIGHT (kg)</div></td>
            <td width="180">&nbsp; <?php echo $row_Recordset1['perWeight']; ?></td>
            <td width="364"><div align="center"><?php echo $row_Recordset2['zipcode']; ?></div></td>
          </tr>
          <tr>
          <td width="175" bgcolor="#CCCCCC"><div align="center">9. BLOOD TYPE</div></td>
          <td width="180">&nbsp; <?php echo $row_Recordset1['perBloodType']; ?></td>
          <td rowspan="4" bgcolor="#CCCCCC"><div><font size="-1">18. PERMANENT ADDRESS</font></div>
          <div>&nbsp;</div>
          <div>&nbsp;</div>
         <div>&nbsp;</div>
       
            <div align="center">&nbsp; </div>
  
            <div align="center"><font size="-1">ZIP CODE</font></div></td>
          <td width="364"><div align="center">
            <table width="340" border="0">
              <tr>
                <td width="156"><div align="center"><?php echo $row_Recordset1['perHouseNo']; ?></div>
                  <div>
                    <div align="center"><font size="-2">House/Block/Lot No.</font></div>
                    </div></td>
                <td width="142"><div align="center"><?php echo $row_Recordset1['perStreet']; ?></div>
                  <div>
                    <div align="center"><font size="-2">Street</font></div>
                    </div></td>
                </tr>
            </table>
          </div></td>
          </tr>
          <tr>
          <td width="175" bgcolor="#CCCCCC"><div align="center">10. GSIS ID NO.</div></td>
          <td width="180">&nbsp; <?php echo $row_Recordset1['perGSISno']; ?></td>
          <td width="364"><div align="center">
            <table width="340" border="0">
              <tr>
                <td width="156"><div align="center"><?php echo $row_Recordset1['perSubdivision']; ?></div>
                  <div>
                    <div align="center"><font size="-2">Subdivision/Village</font></div>
                    </div></td>
                <td width="142"><div align="center"><?php echo $row_Recordset1['perBrgy']; ?></div>
                  <div>
                    <div align="center"><font size="-2">Barangay</font></div>
                    </div></td>
                </tr>
            </table>
          </div></td>
          </tr>
          <tr>
          <td width="175" bgcolor="#CCCCCC"><div align="center">11. PAG-IBIG ID NO.</div></td>
          <td width="180">&nbsp; <?php echo $row_Recordset1['perPagIbigNo']; ?></td>
          <td width="364"><div align="center">
            <table width="340" border="0">
              <tr>
                <td width="156"><div align="center"><?php echo $row_Recordset1['perCity']; ?></div>
                  <div>
                    <div align="center"><font size="-2">City/Municipality</font></div>
                    </div></td>
                <td width="142"><div align="center"><?php echo $row_Recordset1['perProvince']; ?></div>
                  <div>
                    <div align="center"><font size="-2">Province</font></div>
                    </div></td>
                </tr>
            </table>
          </div></td>
          </tr>
          <tr>
          <td width="175" bgcolor="#CCCCCC"><div align="center">12. PHILHEALTH NO.</div></td>
          <td width="180">&nbsp; <?php echo $row_Recordset1['perPhilHno']; ?></td>
          <td width="364"><div align="center"><?php echo $row_Recordset1['perZip']; ?></div></td>
          </tr>
          <tr>
          <td width="175" bgcolor="#CCCCCC"><div align="center">13. SSS NO.</div></td>
          <td width="180">&nbsp; <?php echo $row_Recordset1['perSSSno']; ?></td>
          <td bgcolor="#CCCCCC">19. TELEPHONE NO.</td>
          <td width="364"><div align="center"><?php echo $row_Recordset1['perTelno']; ?></div></td>
          </tr>
          <tr>
          <td width="175" bgcolor="#CCCCCC"><div align="center">14. TIN NO.</div></td>
          <td width="180">&nbsp; <?php echo $row_Recordset1['perTINno']; ?></td>
          <td bgcolor="#CCCCCC">20. M OBILE NO. </td>
          <td width="364"><div align="center"><?php echo $row_Recordset1['perMobileNo']; ?></div></td>
          </tr>
          <tr>
          <td width="175" bgcolor="#CCCCCC"><div align="center">15. AGENCY EMPLOYEE NO.</div></td>
          <td width="180">&nbsp; <?php echo $row_Recordset1['perAgenEmpNo']; ?></td>
          <td bgcolor="#CCCCCC">21. EMAIL (if any)</td>
          <td width="364"><div align="center"><?php echo $row_Recordset1['perEmail']; ?></div></td>
          </tr>
          <tr>
          <td colspan="4" bgcolor="#666666" class="Arial"> <font color="#FFFFFF"><em>II.  FAMILY BACKGROUND</em></font></td>
          </tr>
        </table>
        <table width="900" align="center" border="1">
          <tr>
            <td width="175" rowspan="3" bgcolor="#CCCCCC"><div>&nbsp;22. SPOUSE'S SURNAME</div>
            <div align="center">&nbsp;FIRST NAME</div>
            <div align="center">&nbsp;MIDDLE NAME</div></td>
            <td colspan="2">&nbsp; <?php echo $row_spouse['famLname']; ?></td>
            <td width="200" bgcolor="#CCCCCC"><div align="left"><font size="-2">23. NAME of CHILDREN  (Write full name and list all)</font></div></td>
            <td width="150" valign="top" bgcolor="#CCCCCC"><div align="center"><font size="-2">3. DATE OF BIRTH</font></div>
            <div align="center"><font size="-2">(mm/dd/yy)</font></div></td>
          </tr>
          <tr>
            <td width="180">&nbsp; <?php echo $row_spouse['famFname']; ?></td>
            <td width="182" bgcolor="#CCCCCC"><div><font size="-2">NAME EXTENSION (JR., SR)</font></div>
            <div>&nbsp;<?php echo $row_spouse['famExtName']; ?></div></td>
            <td colspan="2" rowspan="12"><table width="364" border="1">
            <?php $perIdm=$row_Recordset1['perId'];
					$querym = "select * from family where family.perId=$perIdm and family.famRelationship='Children'";
					$resultm= mysql_query($querym);	
					while($rowm = mysql_fetch_assoc($resultm)) {
					$fname=$rowm['famFname'];
					$mname=$rowm['famMname'];
					$lname=$rowm['famLname'];
					$ext=$rowm['famExtName'];
					$bday=$rowm['famBday']; ?>
              <tr>
                <td width="200"><?php echo '<font size="-1"> '.$fname.' '.$mname.' '.$lname.' '.$ext.'</font>'; ?></td>
                <td width="150"><div align="center"><?php echo $bday; ?></div></td>
              </tr>
              <?php } ?>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
              <tr>
                <td width="200">&nbsp;</td>
                <td width="150"><div align="center"></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp; <?php echo $row_spouse['famMname']; ?></td>
          </tr>
          <tr>
          <td width="175" bgcolor="#CCCCCC"> <div align="center">OCCUPATION </div></td>
            <td colspan="2">&nbsp; <?php echo $row_spouse['famOccupation']; ?></td>
          </tr>
            <tr>
          <td width="175" bgcolor="#CCCCCC"> <div align="center">EMPLOYER/BUSINESS NAME</div></td>
            <td colspan="2">&nbsp; <?php echo $row_spouse['famEmployer']; ?></td>
          </tr>
            <tr>
          <td width="175" bgcolor="#CCCCCC" > <div align="center">BUSINESS ADDRESS</div></td>
            <td colspan="2">&nbsp; <?php echo $row_spouse['famBussAddress']; ?></td>
          </tr>
            <tr>
          <td width="175" bgcolor="#CCCCCC"> <div align="center">TELEPHONE NO.</div></td>
            <td colspan="2">&nbsp; <?php echo $row_spouse['famTelNo']; ?></td>
          </tr>
        
          <tr>
            <td width="175" rowspan="3" bgcolor="#CCCCCC"><div>&nbsp;24. FATHER'S SURNAME</div>
            <div align="center">&nbsp;FIRST NAME</div>
            <div align="center">&nbsp;MIDDLE NAME</div></td>
            <td colspan="2"> &nbsp; <?php echo $row_father['famLname']; ?></td>
          </tr>
          <tr>
            <td width="180">&nbsp; <?php echo $row_father['famFname']; ?></td>
            <td width="182" bgcolor="#CCCCCC"><div><font size="-2">NAME EXTENSION (JR., SR)</font></div>
            <div>&nbsp;<?php echo $row_father['famExtName']; ?></div></td>
          </tr>
          <tr>
            <td colspan="2"> &nbsp; <?php echo $row_father['famMname']; ?></td>
          </tr>
          <td width="175" rowspan="4" bgcolor="#CCCCCC"><div>&nbsp;25. MOTHER'S MAIDEN</div>
            <div align="center">&nbsp;SURNAME NAME</div>
            <div align="center">&nbsp;FIRST NAME</div>
            <div align="center">&nbsp;MIDDLE NAME</div></td>
            <td colspan="2"> &nbsp; <?php echo $row_mother['famMaidenName']; ?></td>
            </tr>
            <tr>
          <td colspan="2"> &nbsp; <?php echo $row_mother['famLname']; ?></td>
          </tr>
            <tr>
          <td colspan="2"> &nbsp; <?php echo $row_mother['famFname']; ?></td>
            <tr>
          <td colspan="2"> &nbsp; <?php echo $row_mother['famMname']; ?></td>
          <td colspan="2" bgcolor="#CCCCCC"><div align="center"><em><font size="-2" color="#FF0000">(Continue on separate sheet if necessary)</font></em></div></td>
        </table>
        <table width="900" align="center" border="1">
          <tr>
            <td bgcolor="#666666" class="Arial"> <font color="#FFFFFF"><em>III.  EDUCATIONAL BACKGROUND</em></font></td>
          </tr>
        </table>
        <table align="center" width="900" border="1">
          <tr>
            <td width="164" rowspan="2" bgcolor="#CCCCCC"><div align="center"><font size="-2">26. LEVEL</font></div></td>
            <td width="195" rowspan="2" bgcolor="#CCCCCC"><div align="center"><font size="-2">NAME OF SCHOOL </font></div>
            <div align="center"><font size="-2">(Write in Full)</font></div></td>
            <td width="164" rowspan="2" bgcolor="#CCCCCC"><div align="center"><font size="-2">BASIC EDUCATION/DEGREE/COURSE (Write in Full)</font></div></td>
            <td colspan="2" bgcolor="#CCCCCC"><div align="center"><font size="-2">PERIOD OF ATTENDANCE</font></div></td>
            <td width="72" rowspan="2" bgcolor="#CCCCCC"><div align="center"><font size="-2">HIGHEST LEVEL/UNITS EARNED (IF NOT GRADUATED)</font></div></td>
            <td width="73" rowspan="2" bgcolor="#CCCCCC"><font size="-2"><div align="center">YEAR GRADUATED</div></font></td>
            <td width="76" rowspan="2" bgcolor="#CCCCCC"><font size="-2"><div align="center">SCHOLARSHIP/ ACADEMIC HONORS RECEIVED</div></font></td>
          </tr>
          <tr>
            <td width="54" bgcolor="#CCCCCC"><div align="center"><font size="-2">FROM </font></div></td>
            <td width="55" bgcolor="#CCCCCC"><font size="-2"><div align="center">TO</div></font></td>
          </tr>
          <tr>
            <td width="164" bgcolor="#CCCCCC"><div align="center">ELEMENTARY</div></td>
            <td width="195"><div align="center"><font size="-2"><?php echo $row_elementary['schoolName']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_elementary['basicEduc']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_elementary['educFrom']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_elementary['educTo']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_elementary['highUnitsEarned']; ?></font></div></td>
            <td width="73"><div align="center"><font size="-2"><?php echo $row_elementary['yearGraduated']; ?></font></div></td>
            <td width="76"><div align="center"><font size="-2"><?php echo $row_elementary['scholarship']; ?></font></div></td>
          </tr>
          <tr>
            <td width="164" bgcolor="#CCCCCC"><div align="center">SECONDARY</div></td>
            <td width="195"><div align="center"><font size="-2"><?php echo $row_Secondary['schoolName']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_Secondary['basicEduc']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_Secondary['educFrom']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_Secondary['educTo']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_Secondary['highUnitsEarned']; ?></font></div></td>
            <td width="73"><div align="center"><font size="-2"><?php echo $row_Secondary['yearGraduated']; ?></font></div></td>
            <td width="76"><div align="center"><font size="-2"><?php echo $row_Secondary['scholarship']; ?></font></div></td>
          </tr>
          <tr>
            <td width="164" bgcolor="#CCCCCC"><div align="center"><font size="-1">VOCATIONAL /                                                                                                                                                                                                        TRADE COURSE</font></div></td>
            <td width="195"><div align="center"><font size="-2"><?php echo $row_Vocational['schoolName']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_Vocational['basicEduc']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_Vocational['educFrom']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_Vocational['educTo']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_Vocational['highUnitsEarned']; ?></font></div></td>
            <td width="73"><div align="center"><font size="-2"><?php echo $row_Vocational['yearGraduated']; ?></font></div></td>
            <td width="76"><div align="center"><font size="-2"><?php echo $row_Vocational['scholarship']; ?></font></div></td>
          </tr>
          <tr>
            <td width="164" bgcolor="#CCCCCC"><div align="center">COLLEGE</div></td>
            <td width="195"><div align="center"><font size="-2"><?php echo $row_college['schoolName']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_college['basicEduc']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_college['educFrom']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_college['educTo']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_college['highUnitsEarned']; ?></font></div></td>
            <td width="73"><div align="center"><font size="-2"><?php echo $row_college['yearGraduated']; ?></font></div></td>
            <td width="76"><div align="center"><font size="-2"><?php echo $row_college['scholarship']; ?></font></div></td>
          </tr>
          <tr>
            <td width="164" bgcolor="#CCCCCC"><div align="center">GRADUATE STUDIES </div></td>
            <td width="195"><div align="center"><font size="-2"><?php echo $row_graduate['schoolName']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_graduate['basicEduc']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_graduate['educFrom']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_graduate['educTo']; ?></font></div></td>
            <td><div align="center"><font size="-2"><?php echo $row_graduate['highUnitsEarned']; ?></font></div></td>
            <td width="73"><div align="center"><font size="-2"><?php echo $row_graduate['yearGraduated']; ?></font></div></td>
            <td width="76"><div align="center"><font size="-2"><?php echo $row_graduate['scholarship']; ?></font></div></td>
          </tr>
        </table>
        <table width="900" align="center" border="1">
          <tr>
            <td bgcolor="#cccccc" class="Arial"> <div align="center"><font size="-2" color="#FF0000"><em>(Continue on separate sheet if necessary)</em></font></div></td>
          </tr>
        </table>
        <table width="900" align="center" border="1">
          <tr>
            <td width="165"><div align="center"><strong>SIGNATURE</strong></div></td>
            <td width="233">&nbsp;</td>
            <td width="89"><div align="center"><strong>DATE</strong></div></td>
            <td width="158" align="center"><?php echo date('F').' '.date('d').', '.date('Y') ?></td>
            <td width="221"><div align="center"><font size="-2">CS FORM 212 (Revised 2017), Page 1 of 4</font></div></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <p>&nbsp; </p>
  <div class="container-fluid marg-2 no-print"  style="line-height: .7;">
   <a href="dbmPIMPersonnelList.php" class="btn btn-danger loading bold"> <i class="icon-chevron-left"></i> Back to List</a> 
     <a href="#" class="btn btn-danger loading bold active"> P1 </a> 
    <a href="PDSformPage2.php?perId=<?php echo $row_Recordset1['perId']; ?>" class="btn btn-danger loading bold"> P2 </a> 
    <a href="PDSformPage3.php?perId=<?php echo $row_Recordset1['perId']; ?>" class="btn btn-danger loading bold "> P3 </a> 
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
</div>
</body>
</html>
<?php
mysql_free_result($Recordset2);

mysql_free_result($permanentAdd);

mysql_free_result($spouse);

mysql_free_result($father);

mysql_free_result($mother);

mysql_free_result($Recordset1);

mysql_free_result($elementary);

mysql_free_result($Secondary);

mysql_free_result($Vocational);

mysql_free_result($college);

mysql_free_result($graduate);
?>
