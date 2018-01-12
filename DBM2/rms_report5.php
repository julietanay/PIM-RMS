<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>RMS - Archives</title>

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
   <a href="rmsnotif.php" class="btn btn-danger loading bold"> <i class="icon-chevron-left"></i> Go to Archives</a> 
  <button type="submit" name="insert" onclick="window.print()" class="btn btn-primary loading bold"> 
  &nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-print"></i>&nbsp; Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
  
</div>

<div align="center">
<table width="900" border="0">
    
   <tr align="center">
      <td><h3><b>RECORDS FOR DISPOSAL</b></h3></td>
    </tr>
    <tr align="left">
      <td><b>Date: ___________________</b> <br><br></td>

    </tr>
    
  

<tr>
    <td>
    <table width="900" border="1" align="center">
      <tr>
        <td width="400" align="center"><b>Record Type</b></td>
        <td width="150" align="center"><b>Agency</b></td>
        <td width="150" align="center"><b>Year</b></td>
        <td width="200" align="center"><b>Location</b></td>
      </tr>
      <?php
      $qry=mysql_query("SELECT DISTINCT type_id FROM file where status='archive'");
              while($row=mysql_fetch_array($qry)){
                $typeid=$row['type_id'];
                $qrytype=mysql_query("SELECT type_name FROM type WHERE type_id='$typeid'");
                $row2=mysql_fetch_assoc($qrytype);
                echo "<tr>";
                echo "<td align='center' bgcolor='#CCCCCC'><b>".$row2['type_name']."<b></td>";
                echo "<td bgcolor='#CCCCCC'></td>";
                echo "<td bgcolor='#CCCCCC'></td>";
                echo "<td bgcolor='#CCCCCC'></td>";
                echo "</tr>";
                $qryst=mysql_query("SELECT DISTINCT subtype_id FROM file WHERE status='archive' && type_id='$typeid'");
                while($row3=mysql_fetch_array($qryst)){
                  $stypeid=$row3['subtype_id'];
                  $qrystype=mysql_query("SELECT subtype_name FROM sub_type WHERE subtype_id='$stypeid'");
                  $cnt=mysql_num_rows($qrystype);
                if($cnt != 0){
                  $row4=mysql_fetch_assoc($qrystype);
                echo "<tr>";
                echo "<td align='center'>".$row4['subtype_name']."</td>";
                echo "<td align='center'>";
                $qryag=mysql_query("SELECT DISTINCT agency FROM file WHERE type_id='$typeid' && subtype_id='$stypeid' && status='archive'");
                while($row5=mysql_fetch_array($qryag)){
                  echo $row5['agency'];
                  echo "<br>";
                }
                echo "</td>";
                echo "<td align='center'>";
                $qryyr=mysql_query("SELECT DISTINCT YEAR(file_date) as d_year FROM file WHERE type_id='$typeid' && subtype_id='$stypeid' && status='archive' ORDER BY file_date ASC");
                while($row6=mysql_fetch_array($qryyr)){
                  echo $row6['d_year']."<br>";
                  }

                echo "</td>";
                echo "<td align='center'>";
                $qryag2=mysql_query("SELECT DISTINCT agency FROM file WHERE type_id='$typeid' && subtype_id='$stypeid' && status='archive'");
                while($r=mysql_fetch_array($qryag2)){
                $ag=$r['agency'];
                $qryloc=mysql_query("SELECT location FROM detail WHERE type_id='$typeid' && subtype_id='$stypeid' AND d_agency='$ag'");
                while($row7=mysql_fetch_array($qryloc)){
                echo $row7['location']."<br>";
                }
              }
                echo "</td>";
                echo "</tr>";
                }
                else{
                echo "<tr>";
                echo "<td> </td>";
                echo "<td align='center'>";
                 $qryag=mysql_query("SELECT DISTINCT agency FROM file WHERE type_id='$typeid' && status='archive'");
                while($row5=mysql_fetch_array($qryag)){
                  echo $row5['agency'];
                  echo "<br>";
                }
                echo "</td>";
                echo "<td align='center'>";
                $qryyr=mysql_query("SELECT DISTINCT YEAR(file_date) as d_year FROM file WHERE type_id='$typeid' && status='archive' ORDER BY file_date ASC");
                while($row6=mysql_fetch_array($qryyr)){
                  echo $row6['d_year']."<br>";
                  }
                echo "</td>";
                echo "<td align='center'>";
                $qryag2=mysql_query("SELECT DISTINCT agency FROM file WHERE type_id='$typeid' && status='archive'");
                while($r=mysql_fetch_array($qryag2)){
                $ag=$r['agency'];
                $qryloc=mysql_query("SELECT location FROM detail WHERE type_id='$typeid' AND d_agency='$ag'");
                while($row7=mysql_fetch_array($qryloc)){
                echo $row7['location']."<br>";
                }
              }
                echo "</td>";
                echo "</tr>";
                } 
              }
      }
      ?>
      </table>
    

    </td>
  </tr>
  
</table>
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
  
<script>
function myFunction() {
    window.print();
}
</script>
</body>
</html>