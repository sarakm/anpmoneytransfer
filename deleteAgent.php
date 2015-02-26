<?php
session_start();
include('lib/config.php');
include('lib/opendb.php');

$id = $_REQUEST["id"];
$query = "DELETE FROM staff WHERE staffid = $id";
$result = mysql_query($query);
if($result)
{
	$_SESSION["del_Agent_Message"] = "Agent Successfully removed";
	header("Location:del_agents.php");
}
else
{
	$_SESSION["del_Agent_Message"] = "Error! Agent could not be removed! ";
	header("Location:del_agents.php");
}

include "lib/closedb.php";
?>