<?php
session_start();
include "config.php";

$mbudget = $_REQUEST["mbudget"];
$abudget = $_REQUEST["abudget"];
$agent = $_REQUEST["agent"];

$query = "UPDATE staff SET budget = mbudget WHERE rank='admin'";
$result =mysql_query($query);
if($result)
{
	$query = "UPDATE staff SET budget = abudget WHERE staffid=$agent";
	$result =mysql_query($query);
	if($result)
	{
		echo "Changed set";
	}
}

include "footer.php";
?>