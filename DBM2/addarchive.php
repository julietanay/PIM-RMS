<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html>
<html>
<head>
        <title>RMS - Add Archive</title>
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

        if(isset($_GET['typeid']) && isset($_GET['stypeid'])){
        $typeid=$_GET['typeid'];
        $stypeid=$_GET['stypeid'];
       // echo $typeid.$stypeid;
        $qry=mysql_query("SELECT * FROM file WHERE type_id='$typeid' && subtype_id='$stypeid' && status='archive'");
        while($row=mysql_fetch_array($qry)){
                $file_id=$row['file_id'];
                $series_no=$row['series_no'];
                $title=$row['title'];
                $purpose=$row['purpose'];
                $file_date=$row['file_date'];
                $agency=$row['agency'];
                $amount=$row['amount'];

                $qryinsert=mysql_query("INSERT INTO archive(a_id, type_id, subtype_id, file_id, series_no, title, purpose, f_date, agency, amount) VALUES('', '$typeid', '$stypeid', '$file_id', '$series_no', '$title', '$purpose', '$file_date', '$agency', '$amount')");
                if($qryinsert){
                    //    $qrydel=mysql_query("DELETE FROM file WHERE file_id='$file_id'");
                   //     if($qrydel){
                                echo "<script>swal('Added to Archives!', 'File was succesfully added to Archives!', 'success');</script>";
                                header("Refresh:1.5; url=rmsnotif.php");
                     //   }
                     //   else{
                     //           mysql_error();
                     //   }
                //pag may scanned files pa di pa maddelete and file
                //YAWQOUHNAAAAAA SYET

                //para ma Optimize ang DB kaylangan ng ARCHIVE engine. Hanap ng latest version ng mysql XAMPP
                }
                
        }
}       
        elseif(isset($_GET['typeid'])){
        $typeid=$_GET['typeid'];
        $qry=mysql_query("SELECT * FROM file WHERE type_id='$typeid' && status='archive'");
        while($row=mysql_fetch_array($qry)){
                $file_id=$row['file_id'];
                $series_no=$row['series_no'];
                $title=$row['title'];
                $purpose=$row['purpose'];
                $file_date=$row['file_date'];
                $agency=$row['agency'];
                $amount=$row['amount'];

                $qryinsert=mysql_query("INSERT INTO archive(a_id, type_id, subtype_id, file_id, series_no, title, purpose, f_date, agency, amount) VALUES('', '$typeid', '', '$file_id', '$series_no', '$title', '$purpose', '$file_date', '$agency', '$amount')");
                if($qryinsert){
                      //  $qrydel=mysql_query("DELETE FROM file WHERE file_id='$file_id'");
                   //     if($qrydel){
                                echo "<script>swal('Added to Archives!', 'File was succesfully added to Archives!', 'success');</script>";
                                header("Refresh:1.5; url=rmsnotif.php");
                     //   }
                     //   else{
                     //           mysql_error();
                     //   }
                }
                
        }
}


    


?>

</body>
</html>
