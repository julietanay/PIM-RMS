<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>RECORDS INVENTORY AND APPRAISAL</title>

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

    font-size: 20px;
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
<div class="container-fluid marg-2 no-print"  style="line-height: .7;">
   <a href="gen_reports.php" class="btn btn-danger loading bold"> <i class="icon-chevron-left"></i> Back to Home</a> 
  <button type="submit" name="insert" onclick="window.print()" class="btn btn-primary loading bold"> 
  &nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-print"></i>&nbsp; Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
  
</div>

<table width="1170" border="1" align="center">
  <tr>
    <td width="314" rowspan="2" align="center">
      <font size="-1">NATIONAL ARCHIVES OF THE PHILIPPINES</font><br />
      <font size="-1"><em>Pambansang Sinupan ng Pilipinas</em></font><br /><br />
        <font size="-1"><strong>RECORDS INVENTORY AND APPRAISAL</strong></font>
    </td>
    <td width="314" height="50">
      <font size="-2">AGENCY</font><br />
        <font size="-1"><center><strong>DEPARTMENT OF BUDGET AND MANAGEMENT REGIONAL OFFICE V</strong></center></font>
        
    </td>
    <td width="370">
      <font size="-2">ORGANIZATIONAL UNIT</font><br />
        <font size="-1"><center><strong>FINANCIAL AND ADMINISTRATIVE DIVISION - RECORDS</strong></center></font><br />
    </td>
    <td width="124">
      <font size="-2">TELEPHONE NO:</font><br />
        <font size="-1"><center><strong>482-01-76</strong></center></font>
        <br />
    </td>
  </tr>
  <tr>
    <td height="54">
      <font size="-2">ADDRESS</font><br />
         <font size="-1"><center><strong>REGIONAL CENTER SITE, RAWIS, LEGAZPI CITY</strong></center></font>    <br />
    </td>
    <td>
      <font size="-2">PERSON-IN-CHARGE OF FILES</font><br />
         <font size="-1"><center><strong>RUBY V. LOSITAÑO</strong></center></font>    <br />
    </td>
    <td>
      <font size="-2">DATE PREPARED</font><br />
             <br /><br />
    </td>
  </tr>
</table>
<table width="1170" border="1" align="center">
  <tr>
    <td width="212" rowspan="2"><font size="-2"><center><strong>RECORDS SERIES TITLE & DESCRIPTION</strong></center></font></td>
    <td width="101" rowspan="2"><font size="-2"><center><strong>PERIOD COVERED</strong></center></font></td>
    <td width="79" rowspan="2"><font size="-2"><center><strong>VOLUME IN CUBIC METER</strong></center></font></td>
    <td width="74" rowspan="2"><font size="-2"><center><strong>LOCATION OF RECORDS</strong></center></font></td>
    <td width="72" rowspan="2"><font size="-2"><center><strong>FREQUENCY OF USE</strong></center></font></td>
    <td width="66" rowspan="2"><font size="-2"><center><strong>DUPLICATION</strong></center></font></td>
    <td width="65" rowspan="2"><font size="-2"><center><strong>TIME VALUE<br />T/P</strong></center></font></td>
    <td width="65" rowspan="2"><font size="-2"><center><strong>UTILITY VALUE<br />Adm/F/L/Arc</strong></center></font></td>
    <td colspan="3"><font size="-2"><center><strong>RETENTION PERIOD</strong></center></font></td>
    <td width="124" rowspan="2"><center>
      <font size="-2"><strong>DISPOSITION PROVISION</strong></font>
    </center></td>
  </tr>
  <tr>
    <td width="30"><center>
      <font size="-2"><strong>Active</strong></font>
    </center></td>
    <td width="30"><center>
      <font size="-2"><strong>Storage</strong></font>
    </center></td>
    <td width="30"><center>
      <font size="-2"><strong>Total</strong></font>
    </center></td>
  </tr>
  <?php
  $typeqry=mysql_query("SELECT * FROM type");
  while($row=mysql_fetch_array($typeqry)){
    $type=$row['type_id'];
    $type_name=$row['type_name'];
  
  echo "<tr>";
  echo "<td align='center' bgcolor='#CCCCCC'><h5><b>".strtoupper($type_name)."</b></h5></td>";
  ?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
    $stypesql=mysql_query("SELECT * FROM sub_type WHERE type_id= '$type'");
    $countstype=mysql_num_rows($stypesql);
    if($countstype >= 1){
    while($subtype=mysql_fetch_array($stypesql)){
      $stypeid=$subtype['subtype_id'];
      $stype=$subtype['subtype_name'];
      echo "<tr>";
      echo "<td><b>".$stype."</b></td>";
      echo "<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>";
      echo "</tr>";
      $agencysql=mysql_query("SELECT DISTINCT(agency) as ag FROM file WHERE (type_id='$type' AND subtype_id='$stypeid')");
      while($agency=mysql_fetch_array($agencysql)){
        $ag=$agency['ag'];
       
      echo "<tr>";
      echo "<td align='center'>".$ag."</td>";
      echo "<td align='center'>"; 
      $datesql=mysql_query("SELECT DISTINCT YEAR(file_date) as fdate FROM file WHERE (type_id='$type' AND subtype_id='$stypeid' AND agency='$ag')");
      $fdate=mysql_fetch_array($datesql);
        $file_date=$fdate['fdate'];
      echo "<font size='-1'>".$file_date."</font>"; 
      echo "</td>";
      $detailsql=mysql_query("SELECT * FROM detail WHERE type_id='$type' AND subtype_id='$stypeid' AND d_agency='$ag'");
      $dets=mysql_fetch_array($detailsql);
                $volume=$dets['volume'];
                $location=$dets['location'];
                $freq=$dets['freq'];
                $duplication=$dets['duplication'];
                $time_value=$dets['time_value'];
                $utility_value=$dets['utility_value'];
                $active_RP=$dets['active_RP'];
                $storage_RP=$dets['storage_RP'];
                $disposition=$dets['disposition'];
                $total_RP = $active_RP + $storage_RP;
           
            echo"<td align='center'>".$volume."</td>";
            echo "<td align='center'><font size='-1'>".$location."</font></td>";
            echo "<td align='center'>".$freq."</td>
            <td align='center'><font size='-1'>".$duplication."</font></td>
            <td align='center'><font size='-1'>".$time_value."</font></td>
            <td align='center'><font size='-1'>".$utility_value."</font></td>
            <td align='center'><font size='-1'>".$active_RP."</font></td>
            <td align='center'><font size='-1'>".$storage_RP."</font></td>
            <td align='center'><font size='-1'>".$total_RP."</font></td>
            <td align='center'><font size='-1'>".$disposition."</font></td>";
           
      echo "</tr>";
    }
    }
  }
        else{
          $agencysql=mysql_query("SELECT DISTINCT(agency) as ag FROM file WHERE (type_id='$type')");
      while($agency=mysql_fetch_array($agencysql)){
        $ag=$agency['ag'];
       
      echo "<tr>";
      echo "<td align='center'>".$ag."</td>";
      echo "<td align='center'>"; 
      $datesql=mysql_query("SELECT DISTINCT YEAR(file_date) as fdate FROM file WHERE (type_id='$type' AND agency='$ag')");
      $fdate=mysql_fetch_array($datesql);
        $file_date=$fdate['fdate'];
      echo "<font size='-1'>".$file_date."</font>"; 
      echo "</td>";
      $detailsql=mysql_query("SELECT * FROM detail WHERE type_id='$type' AND d_agency='$ag'");
      $dets=mysql_fetch_array($detailsql);
                $volume=$dets['volume'];
                $location=$dets['location'];
                $freq=$dets['freq'];
                $duplication=$dets['duplication'];
                $time_value=$dets['time_value'];
                $utility_value=$dets['utility_value'];
                $active_RP=$dets['active_RP'];
                $storage_RP=$dets['storage_RP'];
                $disposition=$dets['disposition'];
                $total_RP = $active_RP + $storage_RP;
           
            echo"<td align='center'>".$volume."</td>";
            echo "<td align='center'><font size='-1'>".$location."</font></td>";
            echo "<td align='center'>".$freq."</td>
            <td align='center'><font size='-1'>".$duplication."</font></td>
            <td align='center'><font size='-1'>".$time_value."</font></td>
            <td align='center'><font size='-1'>".$utility_value."</font></td>
            <td align='center'><font size='-1'>".$active_RP."</font></td>
            <td align='center'><font size='-1'>".$storage_RP."</font></td>
            <td align='center'><font size='-1'>".$total_RP."</font></td>
            <td align='center'><font size='-1'>".$disposition."</font></td>";
           
      echo "</tr>";
    }
        }
  ?>
   <?php
  }
  ?>
  
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1150" border="0" align="center">
  <tr>
    <td><strong><font size="-1">LEGEND:</font></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
   <td width="52">&nbsp;</td>
    <td width="123"><strong><font size="-1">TIME VALUE:</font></strong></td>
    <td width="136"><strong><font size="-1">T- </font></strong><font size="-1">Temporary</font></td>
    <td width="118"><strong><font size="-1">P- </FONT></strong><font size="-1">Permanent</font></td>
    <td width="100">&nbsp;</td>
    <td width="585">&nbsp;</td>
  </tr>
  <tr>
    <td width="52">&nbsp;</td>
    <td><strong><font size="-1">UTILITY VALUE:</font></strong></td>
    <td><strong><font size="-1">Adm- </font></strong><font size="-1">Administrative</font></td>
    <td><strong><font size="-1">F-</font> </strong><font size="-1">Fiscal</font></td>
    <td><strong><font size="-1">L- </font></strong><font size="-1">Legal</font></td>
    <td><strong><font size="-1">Arc- </font></strong><font size="-1">Archival</font></td>
  </tr>
</table>
  <p>&nbsp;</p>
<p>&nbsp;</p>
  <table width="1150" border="0" align="center">
    <tr>
      <td width="248"><strong><font size="-1">PREPARED BY:</FONT></strong></td>
      <td width="97">&nbsp;</td>
      <td width="256"><strong><font size="-1">ASSISTED BY:</FONT></strong></td>
      <td width="92">&nbsp;</td>
      <td width="301"><strong><font size="-1">APPROVED BY:</font></strong></td>
      <td width="130">&nbsp;</td>
    </tr>
    <tr>
      <td><p align="center"><font size="-1"><strong><u>RUBY V. LOSITAÑO</u></strong></font><br>
        Administrative Officer III-Records</p></td>
      <td>&nbsp;</td>
      <td><div align="center">
        <p><font size="-1"><strong><u>JAYSON NACIONAL</u></strong></font><BR>
        NAP Records Management Analyst</p>
</div></td>
      <td>&nbsp;</td>
      <td><p align="center"><u><font size="-1"><strong>MARIA ANGELITA C. CELLS </strong></font></u><font size="-1"><strong></strong></font><br />
        Director IV</p></td>
      <td>&nbsp;</td>
    </tr>
</table>
  <p>&nbsp;</p>
 
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
  
<script>
function myFunction() {
    window.print();
}
</script>

</body>
</html>
