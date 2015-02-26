<?php
session_start();
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');

//if(isset($_SESSION["custID"]))
	//header("Location:login.php");

$col =$_GET["col"];
$tid=$_GET["tid"];
$val=$_GET["val"];
/*$val=6;
$col='agent';
$tid=66;*/
/*if($gender == "Female")
	$gender = "F";
else if($gender=="Male")
	$gender="M";*/
		$query = "UPDATE transactions SET $col='$val' WHERE  transactionid=$tid";


echo $query;
$result= mysql_query($query) or die(mysql_error());
$rows=mysql_affected_rows();
if($rows==1)
{
	echo "success"."\n";
}
else
{
echo "sorry"."\n";
}
include('lib/closedb.php');
?>