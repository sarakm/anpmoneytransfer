<?php
if(isset($_REQUEST["submit1"]))
{
/*This is transaction creation page. This will insert transaction information in transaction table in 
ANP database. Upon successful insertion, this will lead to  */
session_start();
include("lib/authenticate.php");
include('lib/config.php');
include('lib/opendb.php');
$sender_id=htmlspecialchars($_REQUEST['custid']);
echo $sender_id;
$sender_firstname=htmlspecialchars($_REQUEST['firstname']);
$sender_middlename=htmlspecialchars($_REQUEST['middlename']);
$sender_lastname=htmlspecialchars($_REQUEST['lastname']);
$sender_address=htmlspecialchars($_REQUEST['address1'])." ".htmlspecialchars($_REQUEST['address2'])." ".htmlspecialchars($_REQUEST['city'])." ".htmlspecialchars($_REQUEST['province'])." ".htmlspecialchars($_REQUEST['country']);

$receiver_gender=htmlspecialchars($_REQUEST['receiver_gender']);
$receiver_firstname=htmlspecialchars($_REQUEST['receiver_firstname']);
$receiver_middlename=htmlspecialchars($_REQUEST['receiver_middlename']);
$receiver_lastname=htmlspecialchars($_REQUEST['receiver_lastname']);
$receiver_address1=htmlspecialchars($_REQUEST['receiver_address1']);
$receiver_address2=htmlspecialchars($_REQUEST['receiver_address2']);
$receiver_city=htmlspecialchars($_REQUEST['receiver_city']);
$receiver_province=htmlspecialchars($_REQUEST['receiver_province']);
$receiver_country=htmlspecialchars($_REQUEST['receiver_country']);
$receiver_postalcode=htmlspecialchars($_REQUEST['receiver_postalcode']);
$receiver_phone1=htmlspecialchars($_REQUEST['receiver_phone1']);
$receiver_phone2=htmlspecialchars($_REQUEST['receiver_phone2']);
$receiver_fax=htmlspecialchars($_REQUEST['receiver_fax']);
$receiver_email=htmlspecialchars($_REQUEST['receiver_email']);
$receiver_pid=htmlspecialchars($_REQUEST['receiver_pid']);
$receiver_photoid=htmlspecialchars($_REQUEST['receiver_photoid']);
$grt=htmlspecialchars($_REQUEST['grt']);
$cvt=htmlspecialchars($_REQUEST['cvt']);
$currency=htmlspecialchars($_REQUEST['currency']);
$agent=htmlspecialchars($_REQUEST['agent']);
$reason=htmlspecialchars($_REQUEST['reason']);
$exnote=htmlspecialchars($_REQUEST['exnote']);
$booker=htmlspecialchars($_REQUEST['trans_booker']);
$trans=htmlspecialchars($_REQUEST['trans']);
$sender=$sender_firstname." ".$sender_middlename." ".$sender_lastname;
if(isset($agent)&& $agent!="")
{
$status="assigned";
list($agent_fname,$agent_mname,$agent_lname)=split(" ",$agent);
//gets staffid to insert agentid into trans table(assigned agent)
//$q="select staffid from staff where firstname LIKE ('" . $agent_fname . "%') OR middlename LIKE ('" . $agent_mname  . "%') OR lastname LIKE ('" . $agent_lname  . "%')";
$q="select staffid from staff where firstname LIKE ('" . $agent_fname . "%') and middlename LIKE ('" . $agent_mname  . "%') and lastname LIKE ('" . $agent_lname  . "%')";

$res=mysql_query($q) or die(mysql_error());
$row=mysql_fetch_array($res);

if($row !=""||$row!=0)
$agentid=$row['staffid'];
}
else
$status="started";
//status of transaction is set.

if(!isset($receiver_firstname) || !isset($receiver_lastname) || !isset($sender_id)||!isset($receiver_address1)|| !isset($receiver_city)|| !isset($receiver_country) ||!isset($receiver_phone1)||!isset($sender_firstname)||!isset($sender_lastname)||!isset($grt)||!isset($cvt)||!isset($booker))
{
$_SESSION['msg']= " Required fields missing. Please enter fields with * mark";
include"sender.php";
exit;
}
else
{
    $sql="select userid from users where userid=$sender_id";
	
	$result = mysql_query($sql) or die(mysql_error());
      $numrows = mysql_num_rows($result);
      
      if($numrows=0||$numrows="")
	  {
	    echo" Please register before sending the money";
		include "register.php";
		exit;
	  }
	  else
	  {
       
      $s="INSERT INTO transactions(userid,sender,sender_address,receiver_firstname,receiver_middlename,receiver_lastname,receiver_gender,receiver_address1,receiver_address2,receiver_city,receiver_province,receiver_country,receiver_postalcode,receiver_phone1,receiver_phone2,receiver_email,receiver_PID_DLN,receiver_identification,date_submitted,apn_total,amount_to_receive,agent,reason,status,notes,currency,trans_booker,n_transc)VALUES('$sender_id','$sender','$sender_address','$receiver_firstname','$receiver_middlename','$receiver_lastname',
'$receiver_gender','$receiver_address1','$receiver_address2','$receiver_city','$receiver_province','$receiver_country','$receiver_postalcode','$receiver_phone1','receiver_phone2','$receiver_email','$receiver_pid','$staff_photoid',CURDATE(),'$grt','$cvt','$agentid','$reason','$status','$exnote','$currency','$booker','$trans')";
      $result = mysql_query($s) or die(mysql_error());
      //$numrows = mysql_num_rows($result);
      $insert_id = mysql_insert_id();
	
      if($insert_id != NULL)
	  {			 
            // $_SESSION['staffid']=$insert_id;
 			 $_SESSION['logged_staff']=$staff_username;
			 
			 
			 $_SESSION['msg']="<FONT COLOR='#960'><center><h1>Transaction Successfully Saved</h1></font></center>";
			
		     include("trans_list.php");
			 exit;
	  }
			 include('lib/closedb.php');
	  }
   }
 }
   else
 {
 header("location:error.php"); 
 exit;  
  } 
 ?>