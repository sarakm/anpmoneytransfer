<?PHP 
include('lib/config.php');
include('lib/opendb.php');
$Stransactionid = $_GET['transactionid'];
$sql2="select receiver_gender,
receiver_firstname,
receiver_middlename,
receiver_lastname,
receiver_address1,
receiver_address2,
receiver_city,
receiver_province,
receiver_country,
receiver_postalcode,
receiver_phone1,
receiver_phone2,
receiver_email,
receiver_PID_DLN, null from transactions where transactionid = $Stransactionid";
$result2 = mysql_query($sql2) or die(mysql_error());
     $numrows2 = mysql_num_rows($result2);
	  if($numrows2!=0)	  
	  {
		  while($row2=mysql_fetch_array($result2))
		{   
           $transactionid= $row2[0];
		   echo $transactionid;
		   $userid=$row2[1];
		   echo $userid;
		   $receiver_firstname= $row2[4];
		   echo $receiver_firstname;
		   $receiver_middlename=$row2[5];
		   echo $receiver_middlename;
		   $receiver_lastname = $row2[6];
		   echo $receiver_lastname;
		   $receiver_gender   = $row2[7];
		   echo $receiver_gender;
		   $receiver_address1= $row2[8];
		   echo $receiver_address1;
		   $receiver_address2= $row2[9];
		   echo $receiver_address2;
		   $receiver_city= $row2[10];
		   echo $receiver_city;
		   $receiver_province= $row2[11];
		   echo $receiver_province;
		   $receiver_country= $row2[12];
		   echo $receiver_country;
		   $receiver_postalcode= $row2[13];
		   echo $receiver_postalcode;
		   $receiver_phone1= $row2[14];
		   echo $receiver_phone1;
		   $receiver_phone2= $row2[15]; 
		   echo $receiver_phone2;
		   $receiver_email= $row2[16];
		   echo $receiver_email;
		   $receiver_pid= $row2[17];
		   echo $receiver_pid;
		   $receiver_photoid= $row2[18];
		   echo $receiver_photoid;
	}
	  }
	  else 
	     echo " I am empty";
?>

