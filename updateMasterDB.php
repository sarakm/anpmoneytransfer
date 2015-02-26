<?php
session_start();
//this file updates with the parameters for tablename, column name, value, where column, value for //where column
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');

$col =$_GET["col"];
$tid=$_GET["tid"];
$val=$_GET["val"];
$tbl=$_GET["tbl"];
$where=$_GET["where"];
/*echo "col=".$col."\n";
echo "val=".$val."\n";
echo "tid=".$tid."\n";
echo "tbl=".$tbl."\n";
echo "where=".$where."\n";
*//*$tbl='staff';
$val=1225;
$col='budget';
$tid='admin';
$where='level';*/
/*if($gender == "Female")
	$gender = "F";
else if($gender=="Male")
	$gender="M";*/
		$query = "UPDATE $tbl SET $col=$val WHERE  $where='$tid'";


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