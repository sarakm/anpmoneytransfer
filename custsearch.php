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
$Scustid=htmlspecialchars($_REQUEST['custId']);
//$Ccustid=$_GET['custId'];
$Sfirstname=stripslashes(htmlspecialchars($_REQUEST['firstname']));
$Smiddlename=htmlspecialchars($_REQUEST['middlename']);
//$Slastname=tmlspecialchars($_REQUEST['lastname']);
$Slastname=stripslashes(htmlspecialchars($_REQUEST['lastname']));
//$Sphone=stripslashes(htmlspecialchars($_REQUEST['phone']));
$Sphone=htmlspecialchars($_REQUEST['phone1']);


$arr=array();
//if($custid!=NULL ||$phone!=NULL ||( $lastname!=NULL&&$firstname!=NULL)) 
/*if($Scustid==NULL)
{
    $sql = "SELECT userid FROM users where userid=$Scustid";
}*/

if($Scustid!=NULL)
{
    $sql = "SELECT userid,firstname,lastname FROM users where userid=$Scustid";
}
else if($Sphone !=NULL)
{   
	//$sql = "SELECT userid FROM users where phone1=$Sphone||phone2=$Sphone";	
      $sql="SELECT userid,firstname,lastname FROM users where phone1 LIKE ('" . $Sphone . "%') or phone2 LIKE ('" . $Sphone . "%')"; 
}
else if(($Scustid==NULL && $Sphone==NULL && $Slastname==NULL)&&($Sfirstname!=NULL))
{
 $_SESSION['msg']="Please enter firstname and lastname";
 header("location:sender.php");
 exit;
}
else if(($Scustid==NULL && $Sphone==NULL && $Slastname==NULL&&$Sfirstname==NULL))
{
 $_SESSION['msg']="Please enter more information to process";
header("location:sender.php");
 exit;
}
else if(($Scustid==NULL && $Sphone==NULL && $Sfirstname==NULL)&&($Slastname!=NULL))
{
 $_SESSION['msg']="Please enter firstname and lastname";
 header("location:sender.php");
 exit;
}
else if($Sfirstname !=NULL && $Slastname!=NULL)
{   
	 $sql = "SELECT userid,firstname,lastname FROM users where ((UPPER(firstname)=UPPER('$Sfirstname')) && (UPPER(lastname)=UPPER('$Slastname')))";
}

     $result = mysql_query($sql) or die(mysql_error());
     $numrows = mysql_num_rows($result);
     $_SESSION['req_num']++;
//echo $_SESSION['req_num'];
//session_destroy();


	
 
/*if ($numrows != 0)
{
   while($row = mysql_fetch_array($result))
    {
         $Scustid= $row[0];
		 $_SESSION[req_num]=0;
		 
     }			 
             $_SESSION['custid']=$Scustid;
			// include("sender.php");
			header("location:sender.php");
			 exit;
}*/	
$i=0;

if ($numrows > 0)
{
   while($row = mysql_fetch_array($result))
    {
	    for ($j = 0; $j <2; $j++)
         {
         $arr[$i][$j]= $row[$j];
		
		 }
		 
		 $i++;
		 $_SESSION[req_num]=0;
		 
     }			 
           //  $_SESSION['custid']=$Scustid;
			   $_SESSION['custid']=$arr;
			   
			header("location:sender.php");
			 exit;
}	
else if($_SESSION[req_num]>4)
  {
   header("location:register.php");
   exit;
   }
 
 else
 {
  $_SESSION['msg']=" Customer not found. Please Enter more information to search";
// header("Location: sender.php");
header("location:sender.php");
  exit;
 }
 
include('lib/closedb.php');
?>