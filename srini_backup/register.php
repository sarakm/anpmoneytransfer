<?php
session_start();
/*This is customer registration page. This will insert user information in users table in 
ANB database. Upon successful insertion, this will lead to  trnsactionStart.html*/

include('lib/config.php');
include('lib/opendb.php');
$gender=htmlspecialchars($_REQUEST['gender']);
$firstname=htmlspecialchars($_REQUEST['firstname']);
$middlename=htmlspecialchars($_REQUEST['middlename']);
$lastname=htmlspecialchars($_REQUEST['lastname']);
$address1=htmlspecialchars($_REQUEST['address1']);
$address2=htmlspecialchars($_REQUEST['address2']);
$city=htmlspecialchars($_REQUEST['city']);
$province=htmlspecialchars($_REQUEST['province']);
$country=htmlspecialchars($_REQUEST['country']);
$postalcode=htmlspecialchars($_REQUEST['postalcode']);
$phone1=htmlspecialchars($_REQUEST['phone1']);
$phone2=htmlspecialchars($_REQUEST['phone2']);
$email=htmlspecialchars($_REQUEST['email']);
$pid=htmlspecialchars($_REQUEST['pid']);
$photoid=htmlspecialchars($_REQUEST['photoid']);

if(!isset($firstname) || !isset($lastname) || !isset($gender)||!isset($address1)|| !isset($city)||!isset($province) || !isset($country) ||!isset($phone1) )
{ $msg= " Required fields missing. Please enter fields with * mark";
   echo $msg;
   include("register.html");
   exit;
 }
else
{   
$sql="INSERT INTO USERS(firstname,middlename,lastname,gender,address1,address2,city,province,country,postalcode,phone1,phone2,email,PID_DLN,identification,date)
      VALUES('$firstname','$middlename','$lastname','$gender','$address1','$address2','$city','$province','$country','$postalcode','$phone1','$phone2','$email','$pid','$photoid',CURDATE())";
     $result = mysql_query($sql) or die(mysql_error());
//$numrows = mysql_num_rows($result);
 $insert_id = mysql_insert_id();
			 echo $insert_id;
    if($insert_id != NULL)
	  {			 
             $_SESSION['custid']=$insert_id;
 			 $_SESSION['firstname']=$firstname;
			 $_SESSION['lastname']=$lastname;
			 
			 $msg="Registration Successful";
			 include("sender.php");
			 exit;
		}
			 include('lib/closedb.php');
			 
 }
/*if ($numrows != 0)
{
  while($row = mysql_fetch_array($result))
   {
   echo $row[0] . " " . $row[1];
//   echo "<br />";
   }
 }
 else
 {
//echo "<h2>No records found</h2>"; 
// mysql_close($con);
 header("Location:register.html");
 }*/

?>