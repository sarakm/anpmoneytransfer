<?php
session_start();
include"lib/authenticate_del.php";//gives access to all three levels of staff
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');
include"menu.html";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> ANP Transactions List</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta name="description" content="Money Transfer in toronto canada" />
<meta name="keywords" content=" toronto,canada" />
<link href='style/style.css' rel='stylesheet' type='text/css' />
<script language="JavaScript" type="text/javascript" src="jquery.js"></script>
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>
<script language="JavaScript" type="text/javascript" src="js/checkSender.js"></script>

<style type="text/css">
<!--

-->
</style></head>

<body bgcolor="#e2e2e2" >
<h3 class="centerdiv">Transaction Panel</h3>
<table>
<tr>
  <td colspan="18" align="center">
  	<div id="message" name="message" style="color:#F00">
  	  <?php
			if(isset($_SESSION["message"]))
			{
				echo getMessage($_SESSION["message"]);
				unset($_SESSION["message"]);
			}
		   elseif(isset($_SESSION["msg"]))
			{
				echo $_SESSION["msg"];
				unset($_SESSION["msg"]);
			}
		
			
		?>
  	</div>  </td>
</tr>
</table>
<table class="MYTABLE" align="center" cellpadding="3" cellspacing="1">

<tr>
  <!--<td colspan="15"><table width="1221" border="0" cellspacing="0" cellpadding="0">
    <tr style="background:#C00; color:#FFF; font-weight:bold">
      <td width="160">Add/Edit Clients</td>
      <td width="137">Add/Edit Staffs</td>
      <td width="159"><a href="financeSec.php">Finance - Edit Budget</a></td>
      <td width="708"><a href="">Exchange Rate - Edit Rates</a></td>
      <td width="57">&nbsp;</td>
    </tr>
  </table></td>-->
</tr>
<!--<tr style="background:#096; color:#FFF">
  <td colspan="18" height="30px" align="center"><b><h2>Transactions Avaliable</h2></b></td>
</tr>-->
<!--<tr style="background:#963; color:#FFF">
  <th width="20">Transaction ID</th>
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
  <th width="57">Note</th>-->
  
  <tr style="background:#666666; color:#ffffff">
  <th width="20">Tr_Id</th>
 <!-- <th width="65">Agent Assigned</th>-->
  <th width="100">Sender Name</th>
  <th width="100">Sender Address</th>
  <th width="74">Receiver FirstName</th>
  <!--<th width="20">Receiver MiddleName</th>-->
  <th width="80">Receiver LastName</th>
  <!--<th width="10">Receiver Gender</th>-->
  <th width="70">Money To Receive</th>
  <th width="100">Address</th>
  <th width="100">City/Country</th>
 <!-- <th width="100">Phone/Email</th>
  <th width="20">Id_Receiver</th>-->
  <th width="68">APN Total</th>
  <th width="25">Status</th>
  <th width="49">Agent Assigned</th>
  <!--<th width="86">Date Submitted</th>
  <th width="80">Date Completed</th>-->
  <!--<th width="57">Note</th>-->
</tr>
<?php
	$ag=$_SESSION['staffid'];
	$rank=$_SESSION['rank'];
	if($rank=='admin')
	$query ="SELECT * from transactions order by date_submitted";
	else if($rank=='BRANCH AGENT')
	$query ="SELECT * from transactions where ((status='started' or status='assigned') and agent=$ag or trans_booker=$ag) order by date_submitted";
	else if($rank=='DELIVERY AGENT')
	$query ="SELECT * from transactions where((status!='completed' or status!='incompleted')and agent=$ag) order by date_submitted";
	$result = mysql_query($query);
	if($result)
	{
		$num_rows = mysql_num_rows($result);
		if($num_rows >0)
		{
			$count=1;
			$total =0;
			while($rows = mysql_fetch_array($result))
			{
					$total = $count%2;
					if($total ==0)
						$style = "#cccccc";
					else
						$style="#999999";
				 echo "<tr align='center' style='color:#fff;background:".$style."'>";
				 echo "<td>".$rows["transactionid"]."</td>";
				// echo "<td>".$rows["sfname"]." ".$rows["smname"]." ".$rows["slname"]."</td>";
				 echo "<td>".$rows["sender"]."</td>";
				 echo "<td>".$rows["sender_Address"]."</td>";
				 echo "<td>".$rows["receiver_firstname"]."</td>";
				// echo "<td>".$rows["receiver_middlename"]."</td>";
				 echo "<td>".$rows["receiver_lastname"]."</td>";
				// echo "<td>".$rows["receiver_gender"]."</td>";
				 echo "<td>".$rows["amount_to_receive"]."".$rows["currency"]."</td>";
				 echo "<td>".$rows["receiver_address1"].",".$rows["receiver_address2"].", ".$rows["receiver_city"]."</td>";
				 echo "<td>".$rows["receiver_province"].",".$rows["receiver_country"].", ".$rows["receiver_postalcode"]."</td>";
				 // echo "<td>".$rows["receiver_phone1"].",".$rows["receiver_phone2"].", ".$rows["receiver_email"]."</td>";
				// echo "<td>".$rows["receiver_PID_DLN"]."</td>";
				 echo "<td>".$rows["apn_total"]."CND </td>";
				 echo "<td>".$rows["status"]."</td>";
				 echo "<td>".$rows["agent"]."</td>";
				 /*echo "<td>".$rows["date_submitted"]."</td>";
				 if($rows["date_completed"]==NULL)
					echo "<td> N/A </td>";
				else
				 	echo "<td>".$rows["date_completed"]."</td>";
					 echo "<td>".$rows["notes"]."</td>";*/
					
				 //  echo "<td><a href='deleteTransaction.php?id=".$rows["transactionid"]."'>delete?</a></td>";
			    // echo "<td><a href='updateTransaction.php?id=".$rows["transactionid"]."'>update?</a></td>";
				 echo "  </tr>";
				 
				 $count++;
			}
		}
		else
		{
			echo "<tr align='center' style='background:#333336; color:#fff'><td colspan='15'>No TRANSACTIONS MADE</td></tr>";
		}
	}

  ?>
</table>
<table align="center" class="footer"><tr><td><?PHP include "footer.html"; ?></td></tr></table>
</body>
</html>
<?php 
include('lib/closedb.php');
/*
code for links goes inline style in head
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
}*/
?>