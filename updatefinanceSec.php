<?php
session_start();
include('lib/config.php');
include('lib/opendb.php');

$agentid = $_REQUEST["agent_id"];

$query = "SELECT budget FROM staff WHERE staffid=$agentid";
$result =mysql_query($query);
if($result)
{
	$budget=mysql_fetch_assoc($result);
	echo "<input type='text' name='curbudget' id='curbudget' value='".$budget["budget"]."' onblur='changeAmount(this.value)'/>";
}

include"lib/closedb.php";
?>