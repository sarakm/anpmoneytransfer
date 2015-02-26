<?php
session_start();
include "config.php";

$agentid = $_REQUEST["agent_id"];

$query = "SELECT budget FROM staff WHERE staffid=$agentid";
$result =mysql_query($query);
if($result)
{
	$budget=mysql_fetch_assoc($result);
	echo "<input type='text' name='budget' id='budget' value='".$budget["budget"]."' onblur='changeAmount(this.value)'/>";
}

include "footer.php";
?>