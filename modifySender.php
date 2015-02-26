<?php
session_start();
//include"lib/authenticate.php";
/*This is customer registration page. This will insert user information in users table in 
ANB database. Upon successful insertion, this will lead to  trnsactionStart.html*/

include('lib/config.php');
include('lib/opendb.php');
$custid=$_REQUEST['custid'];
//echo $custid;
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
   include("register.php");
   exit;
 }
else
{	 $s = "SELECT * FROM users where userid=$custid";
//	echo $s;
	 $res = mysql_query($s) or die(mysql_error());
     $n = mysql_num_rows($res);
	 
if ($n == 0)
{            $_SESSION['msg']="User does not exists!";
			 include("sender.php");
			 exit;
}		
else
{
$sql="UPDATE USERS SET gender='$gender',firstname='$firstname',middlename='$middlename',lastname='$lastname', address1='$address1',address2='$address2',city='$city',province='$province',country='$country',postalcode='$postalcode',phone1='$phone1',phone2='$phone2',email='$email',PID_DLN='$pid',identification='$photoid' where userid=$custid";

//,gender,address1,address2,city,province,country,postalcode,phone1,phone2,email,PID_DLN,identification,date)
//  VALUES('$firstname','$middlename','$lastname','$gender',,'$city','$province','$country','$postalcode',
//'$phone1','$phone2','$email','$pid','$photoid',CURDATE())"

     $result = mysql_query($sql) or die(mysql_error());
	
//$numrows = mysql_num_rows($result);
// $insert_id = mysql_insert_id();
			
//    if($insert_id != NULL)
//	  {			 
            // $_SESSION['custid']=$custid;
// 			 $_SESSION['firstname']=$firstname;
//		     $_SESSION['lastname']=$lastname;
			 
			 $_SESSION['msg']="Modificatioon Successful";
			// echo $msg;
			 //include("sender.php");
			 header("location:sender.php?userid=".$custid);
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