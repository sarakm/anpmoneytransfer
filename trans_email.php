<?php
session_start();
include"lib/authenticate.php";
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');
include"menu.html";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
a:link {
	color: #FFF;
	text-decoration: none;
}
a:visited {
	color: #FFF;
	text-decoration: none;
}
a:hover {
	color: #666;
	text-decoration: none;
}
a:active {
	color: #FFF;
	text-decoration: none;
}
-->
</style></head>
<body>
<?php

if(isset($_GET['sendmail']))
{
$tr_id=$_GET['transactionid'];
echo $_GET['transactionid'];
$counter=sizeof($tr_id);
echo $counter;

  for($i=0;$i<$counter;$i++)
  {
	echo $tr_id[$i];
	$sql="select t.*, s.staffid,s.email,s.firstname,s.middlename,s.lastname from staff s,transactions t where t.transactionid='$tr_id[$i]' and s.staffid=t.agent order by s.staffid";
		
	echo"sql=".$sql;	
		$result=mysql_query($sql)or die(mysql_error());
		if($result)
		{
		$row=mysql_fetch_array($result);
		$query="select * from transactions where transactionid='$tr_id[$i]'";
		$res=mysql_query($query)or die(mysql_error());
?>


<table  border="0" align="center" cellpadding="0" cellspacing="2">
<tr></tr>
<tr>
  <td colspan="18" align="center">   </td>
</tr>
<tr>
  <td colspan="18" align='center'><h1><b><font style='color:#920'>Transactions for <?= $row['firstname']." ".$row['$middlename']." ".$row['lastname']; ?></font></b></h1></td><td><? echo $row['email']; ?></td>
</tr>


<tr style="background:#900; color:#FFF">
  <td colspan="18" height="30px" align="center"><b><h2>Transactions Avaliable</h2></b></td>
</tr>
<tr style="background:#860; color:#FFF">
  <th width="20">Transaction ID</th>
 <!-- <th width="65">Agent Assigned</th>-->
  <th width="100">Sender Name</th>
  <th width="100">Sender Address</th>
  <th width="74">Receiver First Name</th>
  <th width="20">Receiver Middle Name</th>
  <th width="80">Receiver Last Name</th>
  <th width="10">Receiver Gender</th>
  <th width="70">Money To Receive</th>
  <th width="100">Address of Receiver</th>
  <th width="100">City/Country of Receiver</th>
  <th width="100">Phone/Email of Receiver</th>
  <th width="20">Identification of Receiver</th>
  <th width="68">APN Total</th>
  <th width="20">Status</th>
  <th width="49">Agent Assigned</th>
  <th width="86">Date Submitted</th>
  <th width="80">Date Completed</th>
  <th width="57">Note</th>
  <!--<th width="71">Update</th>-->
</tr>
<?php
	
	if($res)
	{
		$num_rows = mysql_num_rows($res);
			$count=1;
			$total =0;
			while($rows = mysql_fetch_array($res))
			{
					$total = $count%2;
					if($total ==0)
						$style = "#ddd";
					else
						$style="#fff";
				 echo "<tr align='center' style='color:#000;background:".$style."'>";
				 echo "<td>".$rows["transactionid"]."</td>";
				// echo "<td>".$rows["sfname"]." ".$rows["smname"]." ".$rows["slname"]."</td>";
				 echo "<td>".$rows["sender"]."</td>";
				 echo "<td>".$rows["sender_Address"]."</td>";
				 echo "<td>".$rows["receiver_firstname"]."</td>";
				 echo "<td>".$rows["receiver_middlename"]."</td>";
				 echo "<td>".$rows["receiver_lastname"]."</td>";
				 echo "<td>".$rows["receiver_gender"]."</td>";
				 echo "<td>".$rows["amount_to_receive"]."".$rows["currency"]."</td>";
				 echo "<td>".$rows["receiver_address1"].",".$rows["receiver_address2"].", ".$rows["receiver_city"]."</td>";
				 echo "<td>".$rows["receiver_province"].",".$rows["receiver_country"].", ".$rows["receiver_postalcode"]."</td>";
				  echo "<td>".$rows["receiver_phone1"].",".$rows["receiver_phone2"].", ".$rows["receiver_email"]."</td>";
				 echo "<td>".$rows["receiver_PID_DLN"]."</td>";
				 echo "<td>".$rows["apn_total"]."CND </td>";
				 echo "<td>".$rows["status"]."</td>";
				 echo "<td>".$rows["agent"]."</td>";
				 echo "<td>".$rows["date_submitted"]."</td>";
				 if($rows["date_completed"]==NULL)
					echo "<td> N/A </td>";
				else
				 	echo "<td>".$rows["date_completed"]."</td>";
					 echo "<td>".$rows["notes"]."</td>";
					
				 //  echo "<td><a href='deleteTransaction.php?id=".$rows["transactionid"]."'>delete?</a></td>";
			    // echo "<td><a href='updateTransaction.php?id=".$rows["transactionid"]."'>update?</a></td>";
				 echo "  </tr>";
				 
				 $count++;
			
		}
		else
		{
			echo "<tr align='center' style='background:#333336; color:#fff'><td colspan='15'>No TRANSACTIONS </td></tr>";
		}
	}
	
	
	}
	
	}
	}

?>
</table>  
</body>
</html>
<?php 
include('lib/closedb.php');
?>