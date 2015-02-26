<?PHP
session_start();
/*if (array_key_exists('transactionid', $_SESSION))
{
$_SESSION['transactionid'] = $_GET['transactionid'];
}*/
include('lib/config.php');
include('lib/opendb.php');
//echo "i am in receiversuggest";
$Ctransactionid=$_REQUEST['transactionid'];
//echo $Ctransactionid;

$s="SELECT receiver_gender,receiver_firstname,receiver_middlename,receiver_lastname,receiver_address1,receiver_address2,receiver_city,receiver_province,receiver_country,receiver_postalcode,receiver_phone1,receiver_phone2,receiver_email,receiver_PID_DLN FROM TRANSACTIONS where transactionid=$Ctransactionid";

     $result = mysql_query($s) or die(mysql_error());
     $numrows = mysql_num_rows($result);
if ($numrows != 0)
{
   while($row = mysql_fetch_array($result))
    {
         echo $row[0]."\n";
		 echo $row[1]."\n";
		 echo $row[2]."\n";
		 echo $row[3]."\n";
		 echo $row[4]."\n";
		 echo $row[5]."\n";
		 echo $row[6]."\n";
		 echo $row[7]."\n";
		 echo $row[8]."\n";
		 echo $row[9]."\n";
		 echo $row[10]."\n";
		 echo $row[11]."\n";
		 echo $row[12]."\n";
		 echo $row[13]."\n";
		 echo $row[14];
		// echo $row[18]."\n";
		 
		 
     }	
}
include('lib/closedb.php');
?>




