<?php require_once('../Connections/dbmrov.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<input type='checkbox' id='details' name="form_details" <?php if ($form_details) echo ' checked'; ?> onchange='enableOption()';>

<select name='summarize_by' id='summarize_by'>
<?php
    echo " <option value='0'>Orange</option>\n";
    echo " <option value='1' " . (!$form_details ? "disabled":"" ) . " >Pear</option>";
?>

<script type="text/javascript">
   function enableOption(){
    if(document.getElementById('details').checked == true)
    {

     document.getElementById('summarize_by').options[1].disabled=false;

    }
    else
    {
     document.getElementById('summarize_by').options[1].disabled=true;
    }
 }
</script>
</body>
</html>