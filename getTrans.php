<?php
session_start();
//include('authenticate.php');
include('lib/config.php');
include('lib/opendb.php');
       if(isset($_GET['search'])){
		$search = $_GET['search'];
		echo $search;
    	$filter = $_GET['filter'];
		if($filter=="city")
		{
		list($receiver_city,$country)=explode(",",$search);
		$filter='receiver_city';
		$search=$receiver_city;
		$sql = "SELECT * FROM transactions WHERE UPPER($filter)=upper('$search') and UPPER(receiver_country)=UPPER('$country')";
		}
		else
		{
		$sql = "SELECT * FROM transactions WHERE $filter='$search'";
		}

echo "sql=".$sql;
$res = mysql_query($sql) or die(mysql_error());

//echo"hai2";
$_SESSION['sql']=$sql;
 $numrows=mysql_num_rows($res);
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr>
		                    
			
<?php
$counter=0;

		   
		 while(list($transactionid, $userid, $sender,$sender_address, $receiver_fname, $receiver_mname, $receiver_lname,$gender, $address1,  $address2, $city, $province, $country, $postalcode, $phone1, $phone2, $email,$pid,$photo,$startdate,$enddate,$total,$cur,$amt,$agent,$status,$reason,$notes,$booker,$trans_num,$time,$send_amt,$fee,$rate) = mysql_fetch_row($res))
             {
			 $color = ($counter % 2 == 0) ? "#F7F7F7":"#FFFFFF";
               if($gender=='M')
			    $gender='Mr.';
			   else if ($gender=='F')
			    $gender='Ms/Mrs.';
               echo "<td height='25' bgcolor=$color>$transactionid</td>";
			   echo "<td height='25' bgcolor=$color>$userid</td>";
               echo "<td height='25' bgcolor=$color>$sender</td>";
			   echo "<td height='25' bgcolor=$color>$sender_address</td>";
			   
			   echo "<td height='25' bgcolor=$color>$gender $receiver_fname&nbsp;$receiver_mname&nbsp;$receiver_lname</td>";
			   echo "<td height='25' bgcolor=$color>$address1<br/>$address2</td>";
               echo "<td height='25' bgcolor=$color>$city<br/>$province<br/>$country<br/>$postalcode</td>";
			   echo "<td height='25' bgcolor=$color>$phone1<br/>$email</td>";
			   echo "<td height='25' bgcolor=$color>$pid</td></tr>";
			   echo "<tr><td height='25' bgcolor=$color>$startdate</td>";
			   echo "<td height='25' bgcolor=$color>$amt</td>";
			   echo "<td height='25' bgcolor=$color>$cur</td>";
			   echo "<td height='25' bgcolor=$color>$agent</td>";
			   echo "<td height='25' bgcolor=$color>$status</td>";
			   echo "<td height='25' bgcolor=$color>$notes</td>";
			   echo "<td height='25' bgcolor=$color>$booker</td>";
			   echo "<td height='25' bgcolor=$color><input type='checkbox' id='email_status' name='email_status'/></td></tr>";
				$counter++;  
              }
 }
            
?>
</td>
