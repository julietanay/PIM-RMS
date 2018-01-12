<?php require_once('../Connections/dbmrov.php'); ?>
<?php

		isset($_GET['fileid']);
        $fileid = $_GET['fileid'];
        $sql ="UPDATE file set archive=0 WHERE file_id = '$fileid'";
        if(mysql_query($sql)){
        	echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('File Retrieved!')
        window.location.href='archive.php'
        </SCRIPT>");

        }
        else {
        	echo mysql_error();
        }

    


?>