<?php
session_start();
/*This is customer registration page. This will insert user information in users table in 
ANB database. Upon successful insertion, this will lead to  trnsactionStart.html*/

include('lib/config.php');
include('lib/opendb.php');
$id=$_REQUEST['id'];
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

$sql="UPDATE USERS SET gender='$gender',firstname='$firstname',middlename='$middlename',lastname='$lastname', address1='$address1',address2='$address2',city='$city',province='$province',country='$country',postalcode='$postalcode',phone1='$phone1',phone2='$phone2',email='$email' where userid=$id";
         $result = mysql_query($sql) or die(mysql_error());
		 $_SESSION['update_User_message']="Modificatioon Successful";
		     include('lib/closedb.php');	
			 header("location:modify_clients.php");

?>