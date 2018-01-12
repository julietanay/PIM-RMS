<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>RMS - Edit Details</title>
    <script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
</head>
<style type="text/css">
    body{
width: 10%;
height: 100%;
background-image: url("images/bghome.png");
background-size: cover;
background-repeat: no-repeat;
display: table;
top: 0;
}
</style>
<body>


<?php
        if(isset($_POST['editdet'])){
       require_once('../Connections/dbmrov.php');
        if(isset($_GET['agency']) && isset($_GET['subtype']) && isset($_GET['type'])){
        $agency =$_GET['agency'];
        $subtype_id =$_GET['subtype'];
        $type =$_GET['type'];
        echo $subtype_id;
        $check=mysql_query("SELECT * FROM detail WHERE (d_agency='$agency' && subtype_id='$subtype_id' && type_id='$type')");
        $res=mysql_num_rows($check);

        if($res >= 1){
        $agency =$_GET['agency'];
        $subtype_id = $_GET['subtype'];
        $type = $_GET['type'];
        $volume=$_POST['volume'];
        $location=$_POST['location'];
        $freq=$_POST['freq'];
        $duplication=$_POST['duplication'];
        $tvalue=$_POST['tvalue'];
        $uvalue=$_POST['uvalue'];
        $disposition=$_POST['disposition'];
        $active_RP=$_POST['active_RP'];
        $storage_RP=$_POST['storage_RP'];

        $update="UPDATE detail set volume='$volume', location='$location', freq='$freq', duplication='$duplication', time_value='$tvalue', utility_value='$uvalue', active_RP='$active_RP', storage_RP='$storage_RP', disposition='$disposition' WHERE d_agency='$agency' && type_id='$type' && subtype_id='$subtype_id'";
        if (mysql_query($update)) {
                echo "<script>swal('Details Updated!', 'Details was successfully Updated.', 'success');</script>";
                header("Refresh:1.5; url=files.php?agency=$agency&&subtype=$subtype_id&&type=$type");

        }
        else{
                echo mysql_error();

        }
        }
        else{
        $agency =$_GET['agency'];
        $subtype_id =$_GET['subtype'];
        $type =$_GET['type'];
        $volume=$_POST['volume'];
        $location=$_POST['location'];
        $freq=$_POST['freq'];
        $duplication=$_POST['duplication'];
        $tvalue=$_POST['tvalue'];
        $uvalue=$_POST['uvalue'];
        $disposition=$_POST['disposition'];
        $active_RP=$_POST['active_RP'];
        $storage_RP=$_POST['storage_RP'];
                $insert=mysql_query("INSERT INTO detail(detail_id,type_id,subtype_id,volume,location,freq,duplication,time_value,utility_value,active_RP,storage_RP,disposition,d_agency) VALUES(' ','$type','$subtype_id','$volume','$location','$freq','$duplication','$tvalue','$uvalue','$active_RP','$storage_RP','$disposition','$agency')");
                if ($insert) {
                echo "<script>swal('Details Updated!', 'Details was successfully Updated.', 'success');</script>";
                header("Refresh:1.5; url=files.php?agency=$agency&&subtype=$subtype_id&&type=$type");
                }
                else{
                        echo mysql_error();


                }
        }
        }
        else if (isset($_GET['agency']) && $_GET['type']) {
        $agency = $_GET['agency'];
        $type = $_GET['type'];
        $check=mysql_query("SELECT * FROM detail WHERE d_agency = '$agency' && type_id='$type'");
        $res=mysql_num_rows($check);

        if($res == 1){
        $volume=$_POST['volume'];
        $location=$_POST['location'];
        $freq=$_POST['freq'];
        $duplication=$_POST['duplication'];
        $tvalue=$_POST['tvalue'];
        $uvalue=$_POST['uvalue'];
        $disposition=$_POST['disposition'];
        $active_RP=$_POST['active_RP'];
        $storage_RP=$_POST['storage_RP'];

        $update="UPDATE detail set volume='$volume', location='$location', freq='$freq', duplication='$duplication', time_value='$tvalue', utility_value='$uvalue', active_RP='$active_RP', storage_RP='$storage_RP', disposition='$disposition' WHERE d_agency='$agency' && type_id='$type'";
        if (mysql_query($update)) {
                echo "<script>swal('Details Updated!', 'Details was successfully Updated.', 'success');</script>";
                header("Refresh:1.5; url=files.php?agency=$agency&&type=$type");
                
        }
        else{
                echo mysql_error();

        }
        }
        else{
        $agency = $_GET['agency'];
        $type = $_GET['type'];
        $volume=$_POST['volume'];
        $location=$_POST['location'];
        $freq=$_POST['freq'];
        $duplication=$_POST['duplication'];
        $tvalue=$_POST['tvalue'];
        $uvalue=$_POST['uvalue'];
        $disposition=$_POST['disposition'];
        $active_RP=$_POST['active_RP'];
        $storage_RP=$_POST['storage_RP'];
                $insert=mysql_query("INSERT INTO detail(detail_id,type_id,volume,location,freq,duplication,time_value,utility_value,active_RP,storage_RP,disposition,d_agency) VALUES('','$type','$volume','$location','$freq','$duplication','$tvalue','$uvalue','$active_RP','$storage_RP','$disposition','$agency')");
                if ($insert) {
                echo "<script>swal('Details Updated!', 'Details was successfully Updated.', 'success');</script>";
                header("Refresh:1.5; url=files.php?agency=$agency&&type=$type");
                }
                else{
                        echo mysql_error();


                }
                }
       
        }
         else if($_GET['subtype'] && $_GET['type']){
        $type_id = $_GET['type'];
        $subtype_id = $_GET['subtype'];
        $check=mysql_query("SELECT * FROM detail WHERE type_id = '$type_id' && subtype_id='$subtype_id'");
        $res=mysql_num_rows($check);

        if($res == 1){
        $volume=$_POST['volume'];
        $location=$_POST['location'];
        $freq=$_POST['freq'];
        $duplication=$_POST['duplication'];
        $tvalue=$_POST['tvalue'];
        $uvalue=$_POST['uvalue'];
        $disposition=$_POST['disposition'];
        $active_RP=$_POST['active_RP'];
        $storage_RP=$_POST['storage_RP'];

        $update="UPDATE detail set volume='$volume', location='$location', freq='$freq', duplication='$duplication', time_value='$tvalue', utility_value='$uvalue', active_RP='$active_RP', storage_RP='$storage_RP', disposition='$disposition' WHERE (type_id='$type_id' AND subtype_id='$subtype_id')";
        if (mysql_query($update)) {
                echo "<script>swal('Details Updated!', 'Details was successfully Updated.', 'success');</script>";
                header("Refresh:1.5; url=files.php?type=$type_id&&subtype=$subtype_id");
        }
        else{
                echo mysql_error();
        }
        }
        else{
        $type_id = $_GET['type'];
        $subtype_id =$_GET['subtype'];
        $volume=$_POST['volume'];
        $location=$_POST['location'];
        $freq=$_POST['freq'];
        $duplication=$_POST['duplication'];
        $tvalue=$_POST['tvalue'];
        $uvalue=$_POST['uvalue'];
        $disposition=$_POST['disposition'];
        $active_RP=$_POST['active_RP'];
        $storage_RP=$_POST['storage_RP'];
                $insert=mysql_query("INSERT INTO detail(detail_id,type_id,subtype_id,volume,location,freq,duplication,time_value,utility_value,active_RP,storage_RP,disposition) VALUES('','$type_id','$subtype_id','$volume','$location','$freq','$duplication','$tvalue','$uvalue','$active_RP','$storage_RP','$disposition')");
                if ($insert) {
                    echo "<script>swal('Details Updated!', 'Details was successfully Updated.', 'success');</script>";
                    header("Refresh:1.5; url=files.php?type=$type_id&&subtype=$subtype_id");
                       
                }
                else{
                        echo mysql_error();
                }
        }


        }

        else if ($_GET['type']){
        $type_id = $_GET['type'];
        $check=mysql_query("SELECT * FROM detail WHERE type_id = '$type_id'");
        $res=mysql_num_rows($check);

        if($res == 1){
        $volume=$_POST['volume'];
        $location=$_POST['location'];
        $freq=$_POST['freq'];
        $duplication=$_POST['duplication'];
        $tvalue=$_POST['tvalue'];
        $uvalue=$_POST['uvalue'];
        $disposition=$_POST['disposition'];
        $active_RP=$_POST['active_RP'];
        $storage_RP=$_POST['storage_RP'];

        $update="UPDATE detail set volume='$volume', location='$location', freq='$freq', duplication='$duplication', time_value='$tvalue', utility_value='$uvalue', active_RP='$active_RP', storage_RP='$storage_RP', disposition='$disposition' WHERE type_id='$type_id'";
        if (mysql_query($update)) {
                echo "<script>swal('Details Updated!', 'Details was successfully Updated.', 'success');</script>";
                header("Refresh:1.5; url=files.php?type=$type_id");
        }
        else{
                echo mysql_error();
        }
        }
        else{
        $type_id = $_GET['type'];
        $volume=$_POST['volume'];
        $location=$_POST['location'];
        $freq=$_POST['freq'];
        $duplication=$_POST['duplication'];
        $tvalue=$_POST['tvalue'];
        $uvalue=$_POST['uvalue'];
        $disposition=$_POST['disposition'];
        $active_RP=$_POST['active_RP'];
        $storage_RP=$_POST['storage_RP'];
                $insert=mysql_query("INSERT INTO detail(detail_id,type_id,volume,location,freq,duplication,time_value,utility_value,active_RP,storage_RP,disposition) VALUES('','$type_id','$volume','$location','$freq','$duplication','$tvalue','$uvalue','$active_RP','$storage_RP','$disposition')");
                if ($insert) {
                echo "<script>swal('Details Updated!', 'Details was successfully Updated.', 'success');</script>";
                header("Refresh:1.5; url=files.php?type=$type_id");
                       
                }
                else{
                        echo mysql_error();
                }
        }

        }
       
        }
        
?>
</body>
</html>
