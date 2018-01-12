<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form name="form1" action="" method="get">
enter name : <input type="text" name="tl" onKeyUp="as()">
<div id="d1"> </div>
</form>

<script type="text/javascript">
function as()
{
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","see.php?nm="+document.form1.tl.value,false);
	xmlhttp.send(null);
	
	document.getElementbyId["d1"].innerHTML=xmlhttp.responseText

} 
</script>



</body>
</html>