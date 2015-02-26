<?php
session_start(); 
include('lib/config.php');
include('lib/opendb.php');
if(isset($_REQUEST['submit'])&&isset($_REQUEST['cvt'])&&isset($_REQUEST['currency'])&&isset($_REQUEST['grt'])&&isset($_REQUEST['citi']))
{
$cvt1=$_REQUEST['cvt'];

$grt=$_REQUEST['grt'];
$currency=$_REQUEST['currency'];
$place=$_REQUEST['citi'];
list($citi,$country) =split(",",$place);
$note=$_REQUEST['exnote'];
$reason=$_REQUEST['reason'];
$agent=$_REQUEST['agent'];
$agentid="";

echo"\ncvt=".$cvt;
echo"\ngrt=".$grt;
echo"\ncurrency=".$currency;
echo"\nplace=".$place;
echo"\nagent=".$agent;
echo"\nreason=".$reason;
echo"\nnote=".$note;

list($afname,$amname,$alname) =split(" ",$agent);
$q="select staffid from staff WHERE firstname LIKE ('" . $afname . "%') OR middlename LIKE ('" . $amname . "%') OR lastname LIKE ('" . $alname . "%') and country LIKE ('". $country."%') and city LIKE('". $citi."%') ORDER BY staffid";
$result = mysql_query($q) or die(mysql_error());
if($result)
{
while($row = mysql_fetch_array($result))
	{
	$agentid=$row['agentid'];
	echo"agent =".$agentid;
	}
}
else
{
   $_SESSION['msg']="Problem with agent assignment";
}



}
else
{
$_SESSION['msg']="Required fields missing. Please try again";
header("location:sender.php");
exit;
}