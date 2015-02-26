<?php
session_start();
ob_start();
include"lib/authenticate.php";
include('lib/config.php');
include('lib/opendb.php');

$id = $_REQUEST["id"];
$query = "DELETE FROM transactions WHERE transactionid = $id";
$result = mysql_query($query);
if($result)
{
	$_SESSION["delmessage"] = "00";
	header("Location:del_trans.php");
}
else
{
	$_SESSION["delmessage"] = "01";
	header("Location:del_trans.php");
}

include "lib/closedb.php";
?>