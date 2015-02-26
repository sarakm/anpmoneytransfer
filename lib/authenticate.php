<?php

if(!isset($_SESSION["loggedin"]))
{
header("location:login.php");
exit;
}
else if($_SESSION["rank"] !="admin")
{
header("location:access_denied.php");
exit;
}

?> 