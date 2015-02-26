<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_c1 = "localhost";
$database_c1 = "anp";
$username_c1 = "vijaya";
$password_c1 = "alphaweb";
$c1 = mysql_pconnect($hostname_c1, $username_c1, $password_c1) or trigger_error(mysql_error(),E_USER_ERROR); 
?>