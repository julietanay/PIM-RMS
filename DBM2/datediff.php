<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>
		DDDDDDD
	</title>
</head>
<body>

	<div class="docsexample2">
                <table width="100%" cellpadding="6" cellspacing="0" border="0" class="table-bordered table-striped">
                
               <tbody>
                <?php
                $dets=mysql_query("SELECT * FROM detail");
                while ($rows=mysql_fetch_array($dets)){
    $type_id=$rows['type_id'];
	$subtype_id=$rows['subtype_id'];
	$volume=$rows['volume'];
	$location=$rows['location'];
	$freq=$rows['freq'];
	$duplication=$rows['duplication'];
	$time_value=$rows['time_value'];
	$utility_value=$rows['utility_value'];
	$active_RP=$rows['active_RP'];
	$storage_RP=$rows['storage_RP'];
	$disposition=$rows['disposition'];
	$d_agency=$rows['d_agency'];
	$total_RP=$active_RP+$storage_RP;
                echo "<tr>";
                echo "<td><b>Volume in cubic Meter:  </b>".$volume."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Location of Records: </b>".$location."</td>";
                echo "</tr>";
               
                echo "<tr>";
                echo "<td><b>Frequency of Use: </b>".$freq."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Duplication: </b>".$duplication."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Time Value:  </b>".$time_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Utility Value: </b>".$utility_value."</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><b>Disposition Provision: </b>".$disposition."</td>";
                echo "</tr>";
           
                ?>
               
                
                <tr>
                <?php
                echo "<td><b>Active: </b>".$active_RP." Years <br><b>Storage: </b>".$storage_RP." Years <br> <b>Total: </b>".$total_RP." Years</td>";
                ?>
                </tr>
                <?php
                 }
                ?>
                </tbody>
                </table>
                
              </div>
<?php

	
$dat=date_create("2013-03-15");
echo date_format($dat,'Y');

?>

</body>
</html>
