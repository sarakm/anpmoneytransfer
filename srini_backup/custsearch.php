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
include('../lib/config.php');
include('../lib/opendb.php');
$Scustid=htmlspecialchars($_REQUEST['custId']);
$Sfirstname=stripslashes(htmlspecialchars($_REQUEST['firstname']));
$Smiddlename=htmlspecialchars($_REQUEST['middlename']);
//$Slastname=tmlspecialchars($_REQUEST['lastname']);
$Slastname=stripslashes(htmlspecialchars($_REQUEST['lastname']));
$Sphone=htmlspecialchars($_REQUEST['phone']);


//if($custid!=NULL ||$phone!=NULL ||( $lastname!=NULL&&$firstname!=NULL)) 
if($Scustid!=NULL)
{
    $sql = "SELECT * FROM users where userid=$Scustid";
}
else if($Sphone !=NULL)
{ 
	$sql = "SELECT * FROM users where phone1=$Sphone||phone2=$Sphone";	
}
else if(($Scustid==NULL && $Sphone==NULL && $Slastname==NULL)&&($Sfirstname!=NULL))
{
 echo("Please enter firstname and lastname");
 include("../sender.php");
 exit;
}
else if(($Scustid==NULL && $Sphone==NULL && $Slastname==NULL&&$Sfirstname==NULL))
{
 echo("Please enter more information to process");
 include("../sender.php");
 exit;
}
else if(($Scustid==NULL && $Sphone==NULL && $Sfirstname==NULL)&&($Slastname!=NULL))
{
 echo("Please enter firstname and lastname");
 include("../sender.php");
 exit;
}
else if($Sfirstname !=NULL && $Slastname!=NULL)
{   
	 $sql = "SELECT * FROM users where ((UPPER(firstname)=UPPER('$Sfirstname')) && (UPPER(lastname)=UPPER('$Slastname')))";
}

     $result = mysql_query($sql) or die(mysql_error());
     $numrows = mysql_num_rows($result);
     $_SESSION['req_num']++;
//echo $_SESSION['req_num'];
//session_destroy();

//echo $numrows;
	
 
if ($numrows != 0)
{
   while($row = mysql_fetch_array($result))
    {
         $Scustid= $row[0];
		 $_SESSION[req_num]=0;
		 
     }			 
             $_SESSION['custid']=$Scustid;
			 include("../sender.php");
			 exit;
}		
else if($_SESSION[req_num]>4)
  {
   include("../register.html");
   exit;
   }
 
 else
 {
  echo" Customer not found. Please Enter more information to search";
// header("Location: sender.php");
include("../sender.php");
  exit;
 }
 
include('../lib/closedb.php');
?>