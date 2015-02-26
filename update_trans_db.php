<?php
session_start();
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');

//if(isset($_SESSION["custID"]))
	//header("Location:login.php");

$agent = $_REQUEST["agent"];
$tid=$_REQUEST["tid"];
$rfname = $_REQUEST["rfname"];
$rlname=$_REQUEST["rlname"];
$rmname=$_REQUEST["rmname"];
$gender = $_REQUEST["rgender"];
if($gender == "Female")
	$gender = "F";
else if($gender=="Male")
	$gender="M";


$status = $_REQUEST["status"];
$cname = $_REQUEST["cname"];
$ar = $_REQUEST["ar"];
$apnt=$_REQUEST["apn_total"];
$raddress=$_REQUEST["raddress"];
$raddress2=$_REQUEST["raddress2"];
$rcity = $_REQUEST["rcity"];
$rprovince = $_REQUEST["rprovince"];
$rstate=$_REQUEST["rstate"];
$rzip = $_REQUEST["rzip"];
$rphone1=$_REQUEST["rphone1"];
$rphone2=$_REQUEST["rphone2"];
$email=$_REQUEST["remail"];
$note=$_REQUEST["note"];


//echo "$agent,$rfname,$rlname,$rmname,$gender,$raddress,$rcity,$rprovince,$rstate,$rzip,$rphone1,$rphone2,$email,$note";

if($status =="completed")
{
	$query = "UPDATE transactions SET receiver_firstname ='$rfname', receiver_middlename='$rmname',receiver_lastname='$rlname',receiver_gender='$gender',receiver_address1='$raddress',receiver_address2 ='$raddress2',receiver_city='$rcity',receiver_province ='$rprovince',receiver_country='$rstate',receiver_postalcode ='$rzip',receiver_phone1='$rphone1',receiver_phone2 ='$rphone2',receiver_email='$email',date_completed =NOW(),amount_to_receive ='$ar',currency='$cname',apn_total ='$apnt',agent='$agent',status ='$status',notes='$note' WHERE  transactionid=$tid";
}
else
{
		$query = "UPDATE transactions SET receiver_firstname ='$rfname', receiver_middlename='$rmname',receiver_lastname='$rlname',receiver_gender='$gender',receiver_address1='$raddress',receiver_address2 ='$raddress2',receiver_city='$rcity',receiver_province ='$rprovince',receiver_country='$rstate',receiver_postalcode ='$rzip',receiver_phone1='$rphone1',receiver_phone2 ='$rphone2',receiver_email='$email',date_completed =NULL,amount_to_receive ='$ar',currency='$cname',apn_total ='$apnt',agent='$agent',status ='$status',notes='$note' WHERE  transactionid=$tid";
}

//echo $query;
$result= mysql_query($query) or die(mysql_error());
if($result)
{
	$_SESSION["transUpdateMessage"]="00";
	header("Location:update_trans.php");
}
else
{
$_SESSION["transUpdateMessage"]="01";
header("Location:update_trans.php");
}
include('lib/closedb.php');
?>