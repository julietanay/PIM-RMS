<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dbmrov = "localhost";
$database_dbmrov = "dbmrov_db";
$username_dbmrov = "root";
$password_dbmrov = "";
$dbmrov = mysql_pconnect($hostname_dbmrov, $username_dbmrov, $password_dbmrov) or trigger_error(mysql_error(),E_USER_ERROR); 
?>