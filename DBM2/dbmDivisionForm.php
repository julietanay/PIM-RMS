
<?php @session_start(); 
if($_SESSION['username']==''){
header('location:dbmLoginPIM.php');
}
?>
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

<title>Untitled Document</title>
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
<style type="text/css">
.times {
	font-family: Times New Roman, Times, serif;
}



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

</head>

<body>
<p>&nbsp;</p>
<table align="center" width="850" border="1">

  <tr>
  
    <td><table align="center" width="850" border="0">
    <tr>
        <td colspan="7"><p>&nbsp;</p></td>
      </tr>
      
      <tr>
        <td colspan="7" align="center"><img src="images/logo.png" alt="" width="111" height="106" /></td>
      </tr>
      <tr>
        <td colspan="7" align="center"><div><strong><font size="3">REPULIC OF THE PHILIPPINES</font></strong></div>
          <div class="times"><strong>DEPARTMENT OF BUDGET AND MANAGEMENT</strong></div>
          <div class="times"><strong>REGIONAL OFFICE V, LEGAZPI CITY</strong></div></td>
      </tr>
      <tr>
        <td colspan="7"><p>&nbsp;</p></td>
      </tr>
      <tr>
       <tr>
        <td colspan="7"><p>&nbsp;</p></td>
      </tr>
       <tr>
        <td colspan="7"><table width="850" border="0">
  <tr>
   <td colspan="7"><table align="center" width="730" border="0">
   <tr>
    <td width="247">&nbsp;</td>
     <td width="473" ><table align="center" width="400" border="0">
       <tr>
         <td><div align="right"> <?php 
		 		$month=date('F');
			    $day=date('d');
			    $Year=date('Y');
			   echo ''.$month.' '.$day.', '.$Year.' ';?></div></td>
       </tr>
       <tr>
         <td><div align="right"><strong>Date</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
       </tr>
     </table></td>
      </tr>
  <tr>
    <td width="247"><div>
          <div align="left"><strong>Division Name :</strong>          </div>
    </div>      <div>
            <div align="left"><strong>
              <?php $desc= $row_Recordset1['divDesc'];
		  if ($desc!=null){
			  echo 'Description: ' ;
		  }?>
              </strong>            </div>
      </div></td>
     <td width="473" ><div>
       <div align="left"><?php echo $row_Recordset1['divName']; ?>       </div>
     </div>
          <div>
            <div align="left"><?php echo $row_Recordset1['divDesc'];
		   ?>            </div>
          </div></td>
      </tr>
       <tr>
 <td ><div align="left"><strong>Officer In Charge (OIC) :</strong></div></td>
   <td ><div align="left">
     <?php $oic=$row_Recordset1['perId']; 
		$query11="select * from personnel where personnel.perId='$oic'";
					$result11= mysql_query($query11);	
						 while($row11 = mysql_fetch_assoc($result11)) { 
								$id11 = $row11['perId'];
								 $name1=$row11['perFname'];
								 $name11=$row11['perMname'];
								 $name21=$row11['perLname'];
								 $name31=$row11['perExtName'];
						 }
									 echo ''. $name1.' '.$name11.' '.$name21.' '.$name31.' ';
		?>
   </div></td>
      </tr>
       <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
      </tr>
</table>
</td>
  </tr>
</table>
</td>
      
      <tr>
        <td colspan="7"><div align="center">
                <table width="750" border="1">
                  <tr>
                    <td><div align="center"><strong>No.</strong></div></td>
                    <td><strong>Name</strong></td>
                    <td><strong>Position Title</strong></td>
                  </tr>
                  <?php $div=$row_Recordset1['divId']; 
		$query1="select * from personnel where personnel.divid='$div'";
					$result1= mysql_query($query1);	
					$count=0;
						 while($row1 = mysql_fetch_assoc($result1)) { 
								$id1 = $row1['perId'];
								 $name11=$row1['perFname'];
								 $name1=$row1['perMname'];
								 $name2=$row1['perLname'];
								 $name3=$row1['perExtName'];
								 $position=$row1['perPosition'];
								 $count=$count+1;
								 ?>
					
                  <tr>
                    <td><div align="center"><?php echo $count; ?></div></td>
                    <td><?php  echo ' &nbsp;&nbsp;'. $name11.' '.$name1.' '.$name2.' '.$name3.' '; ?></td>
                    <td><?php  
					$queryPos="select * from positions where positions.posId='$position'";
					$resultPos= mysql_query($queryPos);	
					 while($rowpos = mysql_fetch_assoc($resultPos)) { 				
					 $posname=$rowpos['posName'];
					 echo '&nbsp;&nbsp;'.$posname;
					 } 
					
					 ?></td>
                  </tr>
				  <?php } ?>
                    <tr>
                    <td colspan=3><p>&nbsp;</p><p>&nbsp;</p></td>
                   
                  </tr>
                  <tr>
                    <td ><div align="center"><strong><p>Prepared By:</p> </strong></div></td>
                     <td colspan="2"></td>
                  </tr>
                  <tr>
                    <td ></td>
                     <td colspan="2"> <?php 								
					 $admin=$_SESSION['pid'];
					$query1="select * from personnel where personnel.perId='$admin'";
					$result1= mysql_query($query1);	
					$count=0;
						 while($row1 = mysql_fetch_assoc($result1)) { 
								$id1 = $row1['perId'];
								 $name11=$row1['perFname'];
								 $name1=$row1['perMname'];
								 $name2=$row1['perLname'];
								 $name3=$row1['perExtName'];
								 $position=$row1['perPosition'];
								 $count=$count+1; 
								 echo '&nbsp;&nbsp;'. $name11.' '.$name1.' '.$name2.' '.$name3.' ';
								 ?></td>
                  </tr>
                  <tr>
                    <td ></td>
                     <td colspan="2"><strong><?php  
					$queryPos="select * from positions where positions.posId='$position'";
					$resultPos= mysql_query($queryPos);	
					 while($rowpos = mysql_fetch_assoc($resultPos)) { 				
					 $posname=$rowpos['posName'];
					 echo '&nbsp;&nbsp;'.$posname;
					 } }
					
					 ?></strong></td>
                  </tr>
                </table>

									
        </div>  </td>
         
        </tr>
        <tr>
        <td colspan="7">    <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td colspan="7">    <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td colspan="7">    <p>&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
</table>
<p></p>
 <div class="container-fluid marg-2 no-print"  style="line-height: .7;">
   <a href="dbmManage.php" class="btn btn-danger loading bold">&nbsp;<i></i> Back &nbsp;</a> &nbsp; &nbsp;
  <button type="submit" name="insert" onclick="window.print()" class="btn btn-primary loading bold"> 
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-print"></i> Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
