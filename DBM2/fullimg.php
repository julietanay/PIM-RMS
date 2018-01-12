<?php require_once('../Connections/dbmrov.php'); ?>	
 
 <!DOCTYPE html>
 <html>
 <head>
 	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    	<link type="text/css" href="bootstrap/css/styleLink.css" rel="stylesheet" rel='stylesheet'>
    	<link type="text/css" href="css/styleLink.css" rel='stylesheet'>
    	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    	<script src="dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">

      
    </head>
 </head>
 <body>
 
 
<?php
if (isset($_GET['fileid']) && isset($_GET['img']) && isset($_GET['page'])){
    $file_id=$_GET['fileid'];
    $img=$_GET['img'];
    $page=$_GET['page'];
    $imgqry=mysql_query("SELECT * FROM file_image WHERE file_id='$file_id' AND f_image='$img'");
    $res=mysql_fetch_assoc($imgqry);
    $f_image=$res['f_image'];
    $fimage_id=$res['fimage_id'];

    echo "<br>";
    echo "<form method='POST' action=''>";
    echo "<div class='container'>
    <a href='file_img.php?fileid=$file_id' class='btn btn-standard btn-primary pull-left' name='back'>Go Back</a>
    <button class='btn btn-standard btn-danger pull-right' name='deleteimg'><i class='icon-remove'></i> Delete this Page</button>
    </div>";
    echo "<h3 align='center'>Page ".$page."</h3>";
    echo "<center>";
    echo "<img src='scanned/".$f_image."' width='90%'>";
    echo "</center><br><br>";
    echo "</form>";

  
	}

               if(isset($_POST['deleteimg'])){
                  echo "<script>
                  swal({
                        title: 'Are you sure?',
                        text: 'This page will be permanently deleted.',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, delete it.',
                        closeOnConfirm: false
                        },
                          function(){
                          window.location.href='del_img.php?fimage_id=$fimage_id';
                        });
                  </script>";
                }
                ?>


</body>
</html>
