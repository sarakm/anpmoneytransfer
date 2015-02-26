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
<table width="1221" border="0" align="center" cellpadding="2" cellspacing="0">
<tr></tr>
<tr>
  <td colspan="15" align="center">   </td>
</tr>
<tr>
  <td colspan="15" align='center'><h1><b><font style='color:#920'>Delete Transactions</font></b></h1></td>
</tr>
<tr>
  <td colspan="15" align="center">
  	<div id="message" name="message" style="color:#F00">
  	  <?php
			if(isset($_SESSION["delmessage"]))
			{
			echo getMessage($_SESSION["delmessage"]);
		    unset($_SESSION["delmessage"]);
		    }
	
			
		?>
  	</div>  </td>
</tr>
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
<tr style="background:#096; color:#FFF">
  <td colspan="15" height="30px" align="center"><b><h2>Transactions Avaliable</h2></b></td>
</tr>
<tr style="background:#963; color:#FFF">
  <th width="20">Transaction ID</th>
 <!-- <th width="65">Agent Assigned</th>-->
  <th width="100">Sender Name</th>
  <th width="74">Receiver First Name</th>
  <th width="20">Receiver Middle Name</th>
  <th width="80">Receiver Last Name</th>
  <th width="10">Receiver Gender</th>
  <th width="70">Money To Receive</th>
  <th width="100">Place to Receive</th>
  <th width="68">APN Total</th>
  <th width="20">Status</th>
  <th width="49">Agent Assigned</th>
  <th width="86">Date Submitted</th>
  <th width="80">Date Completed</th>
  
  <th width="57">Delete</th>
  <!--<th width="71">Update</th>-->
</tr>
<?php
  	$query1 ="SELECT transactions.transactionid as tid, transactions.currency as c_name,transactions.agent as agentid, staff.firstname as sfname, staff.lastname as slname, transactions.sender, users.firstname as ufname, transactions.notes,users.lastname as ulname, transactions.receiver_address1,receiver_firstname as rfname,status, receiver_middlename as rmname, receiver_lastname as rlname, transactions.receiver_gender, transactions.receiver_city, transactions.receiver_country, amount_to_receive as receive, apn_total, date_submitted as sdate, date_completed as cdate FROM transactions, staff, users WHERE transactions.agent = staff.staffid AND transactions.sender = users.userid ORDER BY date_submitted";
	
	$query ="SELECT * from transactions order by date_submitted";
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
				 echo "<td>".$rows["transactionid"]."</td>";
				/* echo "<td>".$rows["sfname"]." ".$rows["smname"]." ".$rows["slname"]."</td>";*/
				 echo "<td>".$rows["sender"]."</td>";
				 
				 echo "<td>".$rows["receiver_firstname"]."</td>";
				 echo "<td>".$rows["receiver_middlename"]."</td>";
				 echo "<td>".$rows["receiver_lastname"]."</td>";
				 echo "<td>".$rows["receiver_gender"]."</td>";
				 echo "<td>".$rows["amount_to_receive"]."".$rows["currency"]."</td>";
				 echo "<td>".$rows["receiver_city"].", ".$rows["receiver_country"]."</td>";
				 echo "<td>".$rows["apn_total"]."CND </td>";
				 echo "<td>".$rows["status"]."</td>";
				 echo "<td>".$rows["agent"]."</td>";
				 echo "<td>".$rows["date_submitted"]."</td>";
				 if($rows["date_completed"]==NULL)
					echo "<td> N/A </td>";
				else
				 	echo "<td>".$rows["date_completed"]."</td>";
				?>	
					<td><a href="deleteTransaction.php?id=<?php echo $rows['transactionid'];?>" onclick="return confirm('Are you sure you want to delete this transaction?');"><img src='img/delete-16x16.png' width='16' height='16' border='0'/></a></td>
                    <?php
			// echo "<td><a href='updateTransaction.php?id=".$rows["transactionid"]."'>update?</a></td>";
				 echo "  </tr>";
				 
				 echo "<tr style='color:#fff;background:".$style."'>";
				 echo "<td colspan='15' align='center'>&nbsp;</td>";
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
include('lib/closedb.php');
?>