<?php
session_start();
include"lib/authenticate.php";
include('lib/config.php');
include('lib/opendb.php');

$mbudget = $_REQUEST["mbudget"];
$abudget = $_REQUEST["abudget"];
$agent = $_REQUEST["agent"];
$old_abudget=0;
$new_abudget=0;
/*echo "m= ".$mbudget."\n";
echo "a= ".$abudget."\n";
echo "id= ".$agent."\n";*/
//checks if all fields are filled out and gets old balance of agent account into old_abudget
if($mbudget !=0 && $abudget !=0 && $agent !=0)
{
$q = "SELECT budget FROM staff WHERE staffid=$agent";
$res =mysql_query($q);
if($res)
{
	$row=mysql_fetch_array($res);
	$old_abudget=$row[0];
	//echo $old_abudget;
	
}
//deducts money from master account
$query = "UPDATE staff SET budget ='".$mbudget."'WHERE level='admin'";
$result =mysql_query($query);
//checks if successfully deducted, then adds it to new variable new_abudget,then updates agent account
if($result)
{  
 $new_abudget= ($old_abudget + $abudget);
	$query = "UPDATE staff SET budget ='".$new_abudget."' WHERE staffid=$agent";
	$result1 =mysql_query($query);
	if($result1)
	{
		echo "<H2> AGENT BUDGET CHANGED</H2>";
	}
	
}
}
else
{
echo" <H2>Required fields missing</H2>";
}

include('lib/closedb.php');
?>