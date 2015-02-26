<?php
session_start(); 
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');
/*$rec_id=array();
$city=array();
$country=array();
$currency=array();
$rate=array();*/

if(isset($_POST['Submit']))
{
$rec_id=$_POST['id'];
//echo "ZZZZ".$rec_id[1];

$city=$_POST['city'];
$country=$_REQUEST['country'];
$currency=$_REQUEST['currency'];
$rate=$_REQUEST['rate'];

$msg="";


$count=sizeof($rec_id);

  for($i=1;$i<$count+1;$i++)
  {
	$sql = "UPDATE anp_rates SET city='$city[$i]',country='$country[$i]',currency='$currency[$i]',rates='$rate[$i]' WHERE  id=$rec_id[$i]";
	//	echo $sql;
		
		
		$result=mysql_query($sql)or die(mysql_error());
		if($result)
		{
		 
		// $msg.= $city[$i]." successfully updated   ";
		$_SESSION['msg']=" Record successfully updated   ";
		 header("Location:rates.php");
		 }
		

    }
	 
}
else
{
echo "Not authorized. Please click EXCHANE RATES in navigation bar";
}
include('lib/closedb.php');



?>