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
   <a href="rmsnotif.php" class="btn btn-danger loading bold"> <i class="icon-chevron-left"></i> Go Back</a> 
  <button type="submit" name="insert" onclick="window.print()" class="btn btn-primary loading bold"> 
  &nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-print"></i>&nbsp; Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
  
</div>

<div align="center">
<table width="900" border="0">
   
    
   <tr align="center">
      <td><h3><b>FILES FOR DISPOSAL</b></h3></td>
    </tr>
    <tr align="left">
      <td><b>Date: ___________________</b><br><br></td>
    </tr>
<?php
  if(isset($_GET['typeid']) && isset($_GET['stypeid'])){
    $typeid=$_GET['typeid'];
    $stypeid=$_GET['stypeid'];
    $qrytype=mysql_query("SELECT type_name FROM type WHERE type_id='$typeid'");
    $row=mysql_fetch_assoc($qrytype);
    $qrystype=mysql_query("SELECT subtype_name FROM sub_type WHERE subtype_id='$stypeid'");
    $row2=mysql_fetch_assoc($qrystype);
 // echo $stypeid;
?>
    <tr>
      <td align="center"><h4><?php echo strtoupper($row['type_name']); ?> </h4></td>
    </tr>
    <tr>
      <td align="center"><h5><?php echo $row2['subtype_name']; ?> </h5></td>
    </tr>
    
<tr>
    <td>
    <table width="900" border="1" align="center">
      <tr>
        <td width="101" align="center"><b>Series no.</b></td>
        <td width="205" align="center"><b>Title</b></td>
        <td width="239" align="center"><b>Purpose</b></td>
        <td width="75" align="center"><b>Date</b></td>
        <td width="93" align="center"><b>Amount</b></td>
        <td width="95" align="center"><b>Agency</b></td>
      </tr>
      <?php
      $qry=mysql_query("SELECT * FROM file WHERE type_id='$typeid' && subtype_id='$stypeid' && status='archive'");
      while($rows=mysql_fetch_array($qry)){
        $series=$rows['series_no'];
        $title=$rows['title'];
        $file_date=$rows['file_date'];
        $purpose=$rows['purpose'];
        $agency=$rows['agency'];
        $amount=$rows['amount'];
        echo "<tr>";
        echo "<td align='center'>".$series."</td>";
        echo "<td align='center'>".$title."</td>";
        echo "<td align='center'>".$purpose."</td>";
        echo "<td align='center'>".$file_date."</td>";
        echo "<td align='center'>".$amount."</td>";
        echo "<td align='center'>".$agency."</td>";
        echo "</tr>";
      }
      ?>
    </table>
    </td>
  </tr>
 <?php
      }elseif(isset($_GET['typeid'])) {
      $typeid=$_GET['typeid'];
      $qrytype=mysql_query("SELECT type_name FROM type WHERE type_id='$typeid'");
      $row=mysql_fetch_assoc($qrytype);
    
?>
    <tr>
      <td align="center"><h4><?php echo strtoupper($row['type_name']); ?> </h4></td>
    </tr>  
  <tr>
    <td>
    <table width="900" border="1" align="center">
      <tr>
        <td width="101" align="center"><b>Series no.</b></td>
        <td width="205" align="center"><b>Title</b></td>
        <td width="239" align="center"><b>Purpose</b></td>
        <td width="75" align="center"><b>Date</b></td>
        <td width="93" align="center"><b>Amount</b></td>
        <td width="95" align="center"><b>Agency</b></td>
      </tr>
      <?php
      $qry=mysql_query("SELECT * FROM file WHERE type_id='$typeid' && status='archive'");
      while($rows=mysql_fetch_array($qry)){
        $series=$rows['series_no'];
        $title=$rows['title'];
        $file_date=$rows['file_date'];
        $purpose=$rows['purpose'];
        $agency=$rows['agency'];
        $amount=$rows['amount'];
        echo "<tr>";
        echo "<td align='center'>".$series."</td>";
        echo "<td align='center'>".$title."</td>";
        echo "<td align='center'>".$purpose."</td>";
        echo "<td align='center'>".$file_date."</td>";
        echo "<td align='center'>".$amount."</td>";
        echo "<td align='center'>".$agency."</td>";
        echo "</tr>";
      }
      ?>
    </table>
    </td>
  </tr>
  <?php
      }
  ?>
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