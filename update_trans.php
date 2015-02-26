<?php
session_start();
include"lib/authenticate_ad_del.php";
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');
include"menu.html";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ANP</title>
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
<table align="center" width="1005"  bgcolor="#FFFFFF" valign="top" >
  <tr>  <td>

  	<div align="center" id="message" name="message" style="color:#F00">
  	  <?php
			if(isset($_SESSION["transUpdateMessage"]))
			{
			echo getMessageTransUpdate($_SESSION["transUpdateMessage"]);
		    unset($_SESSION["transUpdateMessage"]);
		    }
	
			
		?>
  	</div>  
<table class="MYTABLE" width="600" border="0" align="center" cellpadding="3" cellspacing="1">
   <div align="center" class="caption" style="padding-bottom:10px;">Update Transactions</div>
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

<!--  <caption class="MYTABLE">Transactions Avaliable</caption>-->

<tr style="background:#666666; color:#ffffff">
  <th width="25">Tr_Id</th>
  <!--<th width="65">Agent Assigned</th>-->
  <th width="90">Sender Name</th>
  <th width="74">Receiver First Name</th>
  <!--<th width="25">Receiver Middle Name</th>-->
  <th width="80">Receiver Last Name</th>
 <!-- <th width="15">Receiver Gender</th>-->
  <th width="70">Money To Receive</th>
  <th width="80">Address Of Receiver</th>
  <th width="80">Place Of Receiver</th>
  <th width="68">APN Total</th>
  <th width="49">Status</th>
  <th width="49">Agent Assigned</th>
  <!--<th width="86">Date Submitted</th>
  <th width="80">Date Completed</th>
  <th width="57">Note</th>-->
  <!--<th width="57">Delete</th>-->
  <th width="30">Update</th>
</tr>
<?php
  	$query1 ="SELECT transactions.transactionid as tid, transactions.currency as c_name,transactions.agent as agentid, staff.firstname as sfname, staff.lastname as slname, transactions.sender, users.firstname as ufname, transactions.notes,users.lastname as ulname, transactions.receiver_address1,receiver_firstname as rfname,status, receiver_middlename as rmname, receiver_lastname as rlname, transactions.receiver_gender, transactions.receiver_city, transactions.receiver_country, amount_to_receive as receive, apn_total, date_submitted as sdate, date_completed as cdate FROM transactions, staff, users WHERE transactions.agent = staff.staffid AND transactions.sender = users.userid ORDER BY date_submitted";
	
	$ag=$_SESSION['staffid'];
	$rank=$_SESSION['rank'];
	if($rank=='admin')
	$query ="SELECT * from transactions order by date_submitted";
	else if($rank=='DELIVERY AGENT')
	$query ="SELECT * from transactions where((status!='completed' or status!='incompleted')and agent=$ag) order by date_submitted";
	
	//$query ="SELECT * FROM `transactions` order by date_submitted";
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
				 echo "<td>".$rows["sender"]."</td>";
				 echo "<td>".$rows["receiver_firstname"]."</td>";
				// echo "<td>".$rows["receiver_middlename"]."</td>";
				 echo "<td>".$rows["receiver_lastname"]."</td>";
				// echo "<td>".$rows["receiver_gender"]."</td>";
				 echo "<td>".$rows["amount_to_receive"]."".$rows["currency"]."</td>";
				 echo "<td>".$rows["receiver_address1"].", ".$rows["receiver_address2"]."</td>";
				 echo "<td>".$rows["receiver_city"].", ".$rows["receiver_country"]."</td>";
				 echo "<td>".$rows["apn_total"]."CND </td>";
				 echo "<td>".$rows["status"]."</td>";
				  echo "<td>".$rows["agent"]."</td>";
				 /*echo "<td>".$rows["date_submitted"]."</td>";
				 if($rows["date_completed"]==NULL)
					echo "<td> N/A </td>";
				else
				 	echo "<td>".$rows["date_completed"]."</td>";
				echo "<td>".$rows["notes"]."</td>";	*/
				 //  echo "<td><a href='deleteTransaction.php?id=".$rows["transactionid"]."'>delete?</a></td>";
			 echo "<td><a href='updateTransaction.php?id=".$rows["transactionid"]."'>update?</a></td>";
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
</td></tr></table>
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