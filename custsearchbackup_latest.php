<?php
session_start();
 if (!array_key_exists('req_num', $_SESSION))
{
$_SESSION['req_num'] = 0;
}
 if (array_key_exists('custid', $_SESSION))
{
$_SESSION['custid'] = "";
}
include('lib/config.php');
include('lib/opendb.php');
$custid=htmlspecialchars($_REQUEST['custId']);
$firstname=stripslashes(htmlspecialchars($_REQUEST['firstname']));
$middlename=htmlspecialchars($_REQUEST['middlename']);
$lastname=htmlspecialchars($_REQUEST['lastname']);
$phone=htmlspecialchars($_REQUEST['phone']);


//if($custid!=NULL ||$phone!=NULL ||( $lastname!=NULL&&$firstname!=NULL)) 
if($custid!=NULL)
{
    $sql = "SELECT * FROM users where userid=$custid";
}
else if($phone !=NULL)
{ 
	$sql = "SELECT * FROM users where phone1=$phone||phone2=$phone";
	
}
else if(($custid==NULL && $phone==NULL && $lastname==NULL)&&($firstname!=NULL))
{
 echo("Please enter firstname and lastname");
 include("search.html");
 exit;
}
else if(($custid==NULL && $phone==NULL && $lastname==NULL&&$firstname==NULL))
{
 echo("Please enter more information to process");
 include("search.html");
 exit;
}
else if(($custid==NULL && $phone==NULL && $firstname==NULL)&&($lastname!=NULL))
{
 echo("Please enter firstname and lastname");
 include("search.html");
 exit;
}
else if($firstname !=NULL && $lastname!=NULL)
{   
	 $sql = "SELECT * FROM users where (UPPER(firstname)=UPPER('$firstname')&& UPPER(lastname)=UPPER('$lastname'))";
}

     $result = mysql_query($sql) or die(mysql_error());
     $numrows = mysql_num_rows($result);
     $_SESSION['req_num']++;
//echo $_SESSION['req_num'];
//session_destroy();
	
 
if ($numrows != 0)
{
   while($row = mysql_fetch_array($result))
    {
         //    echo "Welcome". " " . $row[1];
     }			 
             $_SESSION['custid']=$custid;
			 include("sender.php");
			 exit;
}		
else if($_SESSION[req_num]>4)
  {
   include("register.html");
   exit;
   }
 
 else
 {
  echo" Customer not found. Please Enter more information to search";
// header("Location: sender.php");
include("sender.php");
  exit;
 }
 
include('lib/closedb.php');
?>