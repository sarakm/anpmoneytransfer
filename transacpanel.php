<?php
session_start();
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
<table width="1221" border="0" align="center" cellpadding="0" cellspacing="0">
<tr></tr>
<tr>
  <td colspan="15" align="center">
   </td>
</tr>
<tr>
  <td colspan="15"><h2><b>Transaction Panel</b></h2></td>
</tr>
<tr>
  <td colspan="15" align="center">
  	<div id="message" name="message" style="color:#F00">
    	<?php
			if(isset($_SESSION["message"]))
			{
				echo getMessage($_SESSION["message"]);
				unset($_SESSION["message"]);
			}
		
			
		?>
    </div>  
  
  </td>
</tr>
<tr>
  <td colspan="15"><table width="1221" border="0" cellspacing="0" cellpadding="0">
    <tr style="background:#C00; color:#FFF; font-weight:bold">
      <td width="160">Add/Edit Clients</td>
      <td width="137">Add/Edit Staffs</td>
      <td width="159"><a href="financeSec.php">Finance - Edit Budget</a></td>
      <td width="708"><a href="">Exchange Rate - Edit Rates</a></td>
      <td width="57">&nbsp;</td>
    </tr>
  </table></td>
</tr>
<tr style="background:#096; color:#FFF">
  <td colspan="15" height="30px" align="center"><b>Transactions Avaliables</b></td>
</tr>
<tr style="background:#963; color:#FFF">
  <th width="85">Transaction ID</th>
  <th width="65">Agent Assigned</th>
  <th width="76">Sender Name</th>
  <th width="74">Receiver First Name</th>
  <th width="95">Receiver Middle Name</th>
  <th width="80">Receiver Last Name</th>
  <th width="65">Receiver Gender</th>
  <th width="70">Money To Receive</th>
  <th width="77">Place to Receive</th>
  <th width="68">APN Total</th>
  <th width="49">Status</th>
  <th width="86">Date Submitted</th>
  <th width="80">Date Completed</th>
  <th width="57">Delete</th>
  <th width="71">Update</th>
</tr>
<?php
  	$query ="SELECT transactions.transactionid as tid, transactions.currency as c_name,transactions.agent as agentid, staff.firstname as sfname, staff.lastname as slname, transactions.sender, users.firstname as ufname, transactions.notes,users.lastname as ulname, transactions.receiver_address1,receiver_firstname as rfname,status, receiver_middlename as rmname, receiver_lastname as rlname, transactions.receiver_gender, transactions.receiver_city, transactions.receiver_country, amount_to_receive as receive, apn_total, date_submitted as sdate, date_completed as cdate FROM transactions, staff, users WHERE transactions.agent = staff.staffid AND transactions.sender = users.userid ORDER BY date_submitted";
	
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
						$style = "#900";
					else
						$style="#930";
				 echo "<tr align='center' style='color:#fff;background:".$style."'>";
				 echo "<td>".$rows["tid"]."</td>";
				 echo "<td>".$rows["sfname"]." ".$rows["slname"]."</td>";
				 echo "<td>".$rows["ufname"]." ".$rows["ulname"]."</td>";
				 echo "<td>".$rows["rfname"]."</td>";
				 echo "<td>".$rows["rmname"]."</td>";
				 echo "<td>".$rows["rlname"]."</td>";
				 echo "<td>".$rows["gender"]."</td>";
				 echo "<td>".$rows["receive"]."".$rows["c_name"]."</td>";
				 echo "<td>".$rows["city"].", ".$rows["country"]."</td>";
				 echo "<td>".$rows["apn_total"]."CND </td>";
				 echo "<td>".$rows["status"]."</td>";
				 echo "<td>".$rows["sdate"]."</td>";
				 if($rows["cdate"]==NULL)
					echo "<td> N/A </td>";
				else
				 	echo "<td>".$rows["cdate"]."</td>";
				 echo "<td><a href='deleteTransaction.php?id=".$rows["tid"]."'>delete?</a></td>";
				 echo "<td><a href='updateTransaction.php?id=".$rows["tid"]."'>update?</a></td>";
				 echo "  </tr>";
				 
				 echo "<tr style='color:#fff;background:".$style."'>";
				 echo "<td colspan='15' align='center'><b>*********FULL ADDRESS*********</b></td>";
				 echo "</tr>";
				 echo "<tr style='color:#fff;background:".$style."'>";
				 echo "<td colspan='15' align='center'>".$rows["address1"]."</td>";
				 echo "</tr>";
				 
				 if(!empty($rows["notes"]))
				 {
					 echo "<tr style='color:#fff;background:".$style."'>";
					 echo "<td colspan='15' align='center'><b>*********COMPLETITION NOTE*********</b></td>";
					 echo "</tr>";
					 echo "<tr style='color:#fff;background:".$style."'>";
					 echo "<td colspan='15' align='center'>".$rows["notes"]."</td>";
					 echo "</tr>";
				 }
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
</body>
</html>
<?php 
include('lib/opendb.php');
?>