<?php
session_start();
/*This is customer registration page. This will insert user information in users table in 
ANB database. Upon successful insertion, this will lead to  trnsactionStart.html*/

include('lib/config.php');
include('lib/opendb.php');
include"menu.html";
$staff_gender=htmlspecialchars($_REQUEST['gender']);
$staff_firstname=htmlspecialchars($_REQUEST['firstname']);
$staff_middlename=htmlspecialchars($_REQUEST['middlename']);
$staff_lastname=htmlspecialchars($_REQUEST['lastname']);
$staff_address1=htmlspecialchars($_REQUEST['address1']);
$staff_address2=htmlspecialchars($_REQUEST['address2']);
$staff_city=htmlspecialchars($_REQUEST['city']);
$staff_province=htmlspecialchars($_REQUEST['province']);
$staff_country=htmlspecialchars($_REQUEST['country']);
$staff_postalcode=htmlspecialchars($_REQUEST['postalcode']);
$staff_phone1=htmlspecialchars($_REQUEST['phone1']);
$staff_phone2=htmlspecialchars($_REQUEST['phone2']);
$staff_fax=htmlspecialchars($_REQUEST['fax']);
$staff_email=htmlspecialchars($_REQUEST['email']);
$staff_pid=htmlspecialchars($_REQUEST['pid']);
$staff_photoid=htmlspecialchars($_REQUEST['photoid']);
$staff_username=htmlspecialchars($_REQUEST['username']);
$staff_password=htmlspecialchars($_REQUEST['password1']);
$staff_level=htmlspecialchars($_REQUEST['level']);
if (isset($_POST['submit'])) 
{
if(!isset($staff_firstname) || !isset($staff_lastname) || !isset($staff_gender)||!isset($staff_address1)|| !isset($staff_city)||!isset($staff_province) || !isset($staff_country) ||!isset($staff_phone1)||!isset($staff_fax) ||!isset($staff_username)||!isset($staff_password)||!isset($staff_level))
{
$msg= " Required fields missing. Please enter fields with * mark";
echo"$msg=".$msg;
include("registerStaff.html");
exit;
}
else
{
     $s = "SELECT * FROM staff where ((UPPER(firstname)=UPPER('$staff_firstname')) && (UPPER(lastname)=UPPER('$staff_lastname')))";
     $res = mysql_query($s) or die(mysql_error());
     $n = mysql_num_rows($res);
	 $row=mysql_fetch_array($res);
	
     if ($n != 0)
      {      echo"User already exists with this first and lastnames!";
	   
			 include("registerStaff.html");
			 exit;
      }
	  else
	  {   
	      $s1 = "SELECT * FROM staff where UPPER(username)=UPPER('$staff_username')";
		  $res1 = mysql_query($s1) or die(mysql_error());
          $n1 = mysql_num_rows($res1);
		   if($n1!=0)
		   {
		     		 echo "Username already exists! Please select another username";
					 include("registerStaff.html");
					 exit;
			}
			else
			{
				  $sql="INSERT INTO STAFF(firstname,middlename,lastname,gender,address1,address2,city,province,country,postalcode,phone1,phone2,
				  fax,email,PID_DLN,identification,date,username,password,level)VALUES('$staff_firstname','$staff_middlename','$staff_lastname',
				  '$staff_gender','$staff_address1','$staff_address2','$staff_city','$staff_province','$staff_country','$staff_postalcode','$staff_phone1',
				  '$staff_phone2','$staff_fax','$staff_email','$staff_pid','$staff_photoid',CURDATE(),'$staff_username','$staff_password','$staff_level')";
				  $result = mysql_query($sql) or die(mysql_error());
				  //$numrows = mysql_num_rows($result);
				  $insert_id = mysql_insert_id();
				  echo $insert_id;
				  if($insert_id != NULL)
				  {			 
						 $_SESSION['staffid']=$insert_id;
						 $_SESSION['loggedin']=$staff_username;
						 $msg="Registration Successful";
						 echo"$msg=".$msg;
						 include("sender.php");
						 exit;
				  }
				  
			  }
			   
			   
				 include('lib/closedb.php');
		  }
		} 
		
 }
?>