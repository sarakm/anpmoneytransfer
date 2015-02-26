	<?php /*?>$filename = end(explode("/", $_SERVER["SCRIPT_NAME"]));
	if($filename==="list.php"){<?php */
	include('lib/config.php');
    include('lib/opendb.php');
		$sql = "SELECT * FROM transactions ORDER BY transactionid DESC LIMIT 0,1";
		$res = mysql_query($sql) or die(mysql_error());	
		
		$row = mysql_fetch_array($res);	
	?>	
<div name='latest' id='latest' style="position:absolute; top:48px; right:0px; width: 350px;display:none;">
	<center><b>The last transaction entered</b></center>
	<div id="last_trans" style="background-color: #FDBBBB;border:1px solid black;">
		<table border="0" width="90%" style="font-size: 14px;">
		<tr>
			<td height="" colspan="6" align="center">
				<b>Trans_Id:<?=$row['transactionid']; ?></b>			</td>
		</tr>
		<tr>
			<td height="" colspan="1"><b>SenderId:</b></td><td colspan="1"> <?=$row['userid'];?></td>
             <td width="17" colspan="4">
				 <?=$row['sender'];?>			</td>
		</tr>
		<tr>
			<td width="59">
				<b>Receiver</b></td><td width="17"><? echo $row['receiver_firstname']; ?></td>
			
	  <td width="77">
				<? echo $row['receiver_middlename']; ?>	</td>
	  <td width="20">
				<? echo $row['receiver_lastname'] ."<br>"; ?></td>
		  </tr>
				  <tr>
				    <td >
					<b>Address:</b></td>
                    <td><? echo $row['receiver_address1']; ?></td>
				    <td><? echo $row['receiver_city'] ;?></td>
				    <td><? echo $row['receiver_province'] ;?>				    </td>
				    <td width="34"><? echo $row['receiver_country'] ."<br>"; ?>				    </td>
				  </tr>
				  <tr>
				    <td><b>Status:</b></td><td><? echo $row['status'] ."<br>"; ?></b></td>
				    <td><b>Amt Receivable:</b></td><td><? echo $row['amount_to_receive'] ."<br>"; ?></td>
				  </tr>
				  <tr>
				    <td>
					<b>Agent:</b></td><td><? echo $row['agent'] ."<br>"; ?></b></td>
				    <td>
					<b>Date:</b></td><td><? echo $row['date_sibmitted'] ."<br>"; ?></td>
                    <td><b>Rate:</b></td><td width="24"><? echo $row['rate'] ."<br>"; ?></td>
                   </tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25" colspan="2" >&nbsp;
				
			</td>
		</tr>
		</table>
  </div>

</div>
	<?php 
//include('lib/closedb.php');?>
