<?php
session_start();
include('lib/config.php');
include('lib/opendb.php');

$id = $_REQUEST["id"];
$query = "DELETE FROM users WHERE userid = $id";
$result = mysql_query($query);
if($result)
{
	$_SESSION["delmessage"] = "00";
	header("Location:del_clients.php");
}
else
{
	$_SESSION["delmessage"] = "01";
	header("Location:del_clients.php");
}

include "lib/closedb.php";
?>