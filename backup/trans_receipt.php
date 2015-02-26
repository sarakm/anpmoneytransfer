<?PHP
session_start();
include"lib/authenticate.php";	
include('lib/config.php');
include('lib/opendb.php');


$trans_id=$_REQUEST['trans_id'];
//$trans_id=22;
$q="select * from transactions where transactionid=$trans_id";
$result=mysql_query($q) or die(mysql_error());
if($result)
	{
		$num_rows = mysql_num_rows($result);
		if($num_rows >0)
		{
			$count=1;
			$total =0;
			while($rows = mysql_fetch_array($result))
			{/*
					$total = $count%2;
					if($total ==0)
						$style = "#900";
					else
						$style="#930";
				 echo "<tr align='center' style='color:#fff;background:".$style."'>";*/
				$s_name=$rows['sender'];
				list($s_fname,$s_mname,$s_lname)=split(" ",$s_name);
				$s_address=$rows['sender_address']; 
				$sender_id=$rows['userid'];
				$r_fname=$rows['receiver_firstname'];
				$r_mname=$rows['receiver_middlename'];
				$r_lname=$rows['receiver_lastname'];
				$r_address1=$rows['receiver_address1'];
				$r_city=$rows['receiver_city'];
				$r_province=$rows['receiver_province'];
				$r_country=$rows['receiver_country'];
				$r_postalcode=$rows['receiver_postalcode'];
				$r_phone=$rows['receiver_phone1'];
				$r_email=$rows['receiver_email'];
				$date=$rows['date_submitted'];
				$time=$rows['trans_time'];
				$amt=$rows['amount_sending'];
				$fee=$rows['fee'];
				$grt=$rows['apn_total'];
				$cvt=$rows['amount_to_receive'];
				$rate=$rows['rate'];
				$cur= $rows['currency'];
			}
		}
		else
		{
			echo "<tr align='center' style='background:#333336; color:#fff'><td colspan='15'>NO RECORD FOUND</td></tr>";
		}
	}

$sql="select postalcode,phone1 from users where userid=$sender_id";
$res=mysql_query($sql);
if($res)
	{
	  $row=mysql_fetch_array($res);
	   $s_phone=$row['phone1'];
	   $s_postalcode=$row['postalcode'];
	}
include('lib/closedb.php');

$trans_time= date("H:i:s"); 
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
<script language="JavaScript" type="text/javascript" src="js/checkSender.js"></script><style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
}
.style3 {font-size: 12px}
.style4 {font-size: 10px}
.style5 {font-size: 14px}
.style7 {font-size: 12px; font-weight: bold; }
-->
</style>
</head>

<body>
<TABLE WIDTH="609"  ALIGN="CENTER" BORDER="0" cellspacing="0" cellpadding="0" >
<TR><td><table><tr><td width="151" align="left"><img align="middle" src="/ANP/img/ANP-logo.jpg" height="71" width="87" border="0" alt="ANP Money Transfer Ltd."  onclick="javascript:window.print(this);"/></td>
<TD width="266" align="center">  <p><strong>ANP Money Transfer Ltd.</strong></p>
  <p class="style4">      2885 Lawrence Ave East,Scarborough,ON M1P2S8    </p>
  <p class="style4">Tel:416.266.9000  Fax:416.266.9005  Cell:647.273.2530 </p></TD><td width="182" align="right"><p align="center" valign="middle" class="style3">REFERENCE NO:&nbsp;&nbsp; <?php echo $trans_id;?>&nbsp;&nbsp;</p></TD></tr></table></td>
</TR>
<TR><TD>
<table width="609" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
  <tr>
    <th scope="col"><table width="340" border="1" cellpadding="0" cellspacing="0" bordercolor="#990000">
      <tr>
        <th colspan="2" bgcolor="#999999" scope="col"><span class="style1">BENEFICIARY</span></th>
      </tr>
      <tr>
        <td width="106" align="left"><span class="style3">FIRST NAME</span></td>
        <td width="228"><?PHP echo $r_fname;?><?PHP echo $r_mname; ?></td>
      </tr>
      <tr>
        <td align="left"><span class="style3">LAST NAME</span></td>
        <td><?PHP echo $r_lname; ?></td>
      </tr>
      <tr>
        <td align="left"><span class="style3">ADDRESS</span></td>
        <td><?PHP echo $r_address1; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><?PHP echo $r_city; ?>&nbsp;&nbsp;<?PHP echo $r_province; ?>&nbsp;&nbsp;<?PHP echo $r_country; ?>&nbsp;&nbsp;<?PHP echo $r_postalcode; ?></td>
      </tr>
      <tr>
        <td align="left"><span class="style3">TELEPHONE</span></td>
        <td><?PHP echo $r_phone; ?></td>
      </tr>
      <tr>
        <td align="left"><span class="style3">ID NO:</span></td>
        <td>&nbsp;</td>
      </tr>
    </table></th>
    <th scope="col"><table width="269" border="1" cellpadding="0" cellspacing="0" bordercolor="#0000FF">
      <tr>
        <th width="131" align="left" scope="col"><div align="left" class="style3">Date:</div></th>
        <th width="132" scope="col"><?php echo $date?></th>
      </tr>
      <tr>
        <td align="left" class="style3">Time:</td>
        <td align="center"><?php echo $time?></td>
      </tr>
      <tr>
        <td align="left" class="style3">Amount:($)</td>
        <td align="right"><?php echo $amt?></td>
      </tr>
      <tr>
        <td align="left"><span class="style3">Service Charge:($</span>)</td>
        <td align="right"><?php echo $fee?></td>
      </tr>
      <tr>
        <td align="left"><span class="style3">Total Charge:($</span>)</td>
        <td align="right"><?php echo $grt?></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <td><table width="340" border="1" cellpadding="0" cellspacing="0" bordercolor="#009900">
      <tr>
        <th colspan="2" bgcolor="#999999" scope="col"><span class="style1">ORDERING CUSTOMER</span></th>
      </tr>
      <tr>
        <td width="106" align="left"><span class="style3">FIRST NAME</span></td>
        <td width="228"><?PHP echo $s_fname; ?><?PHP echo $s_mname; ?></td>
      </tr>
      <tr>
        <td align="left"><span class="style3">LAST NAME</span></td>
        <td><?PHP echo $s_lname; ?></td>
      </tr>
      <tr>
        <td><span class="style3">ADDRESS</span></td>
        <td><?PHP echo $s_address;?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="24"><span class="style3">TELEPHONE</span></td>
        <td><?PHP echo $s_phone; ?></td>
      </tr>
      <tr>
        <td><span class="style3">ID NO:</span></td>
        <td>&nbsp;<?php echo $sender_id; ?></td>
      </tr>
    </table></td>
    <td><div align="left"><span class="style3">ANP Money Transfer Ltd as a money remittance company is committed to maintaining compilance with Canada's new <u>Proceeds of Crime(Money Laundering) and Terrorist Financing Act.</u> As such we are required under that legislation to maintain specific records, gather certain information, and report when required certain information as described in section 7 and 9 of the <u> Act</u> and various Regulations that support the <u> Act</u>.</span></div></td>
  </tr>
  <tr>
    <td><table width="340" border="1" cellpadding="0" cellspacing="0" bordercolor="#FF00CC">
      <tr>
        <th width="106" scope="col"><span class="style3">EXCHANGE RATE</span></th>
        <th width="72" scope="col"><?PHP echo $rate; ?></th>
        <th width="76" scope="col"><span class="style3">RECEIVABLE AMOUNT</span></th>
        <th width="76" scope="col"><?PHP echo $cvt; ?></th>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style3">Any discrepancy or shortfall in receipt by beneficial should be reported with in 30 days or the date of Invoice.ANP will not assume any responsibility for any shortfall or discrepancy after that date. </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="340" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <th width="104" scope="col"><div align="left" class="style3">CUSTOMER SIGNATURE</div></th>
        <th width="230" scope="col">&nbsp;</th>
      </tr>
    </table></td>
    <td><table width="269" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col"><span class="style3">ACCEPTED BY</span></th>
        <th width="180" scope="col">&nbsp;</th>
      </tr>
    </table></td>
  </tr>
</table>
</TD></TR></TABLE>

</body>
</html>
