<?php
//gives access to branch managers and admin only
if(!isset($_SESSION["loggedin"]))
{
header("location:login.php");
exit;
}
else if(($_SESSION['rank'] !='admin')&&($_SESSION['rank'] !='DELIVERY AGENT'))
{
header("location:access_denied.php");
exit;
}
?> 