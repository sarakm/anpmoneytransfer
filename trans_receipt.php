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
.style3 {font-size: 12px; border:thin;}
.style10 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	text-decoration: none;
}
.style13 {
	font-size: 20px;
	font-weight: bold;
}

-->
</style>
</head>

<body>
<table width="800"  align="CENTER" border="0" cellspacing="0" cellpadding="1" >
  <tr>
    <td><table width="798">
      <tr>
        <td width="186" height="71" align="left" valign="bottom"><img align="middle" src="/ANP/img/ANP-logo.jpg" height="73" width="79" border="0" alt="ANP Money Transfer Ltd."  onclick="javascript:window.print(this);" title="please click here to print the receipt"/></td>
        <td width="382" align="center" valign="bottom"><span class="style13">ANP Money Transfer Ltd.</span><br/>
              <span class="style3"> 2885 Lawrence Ave East ,Scarborough, ON M1P2S8 </span> <span class="style10">Tel:416.266.9000  Fax:416.266.9005  Cell:647.273.2530 </span></td>
        <td width="210" align="right" valign="bottom"><p align="center" valign="bottom" class="style3">REFERENCE NO:&nbsp;&nbsp; <?php echo $trans_id;?>&nbsp;&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="796" border="0" cellpadding="1" cellspacing="0" bordercolor="#666666">
      <tr>
        <th width="438" scope="col"><table width="436" border="1" cellpadding="1" cellspacing="0" bordercolor="#990000">
          <tr>
            <th colspan="2" bgcolor="#999999" scope="col"><span class="style1">BENEFICIARY</span></th>
          </tr>
          <tr>
            <td width="107" align="left"><span class="style10">FIRST NAME</span></td>
            <td width="314" align="left" class="style10"><?PHP echo $r_fname;?><?PHP echo $r_mname; ?></td>
          </tr>
          <tr>
            <td align="left" class="style10">LAST NAME</td>
            <td align="left" ><span class="style10"><?PHP echo $r_lname; ?></span></td>
          </tr>
          <tr>
            <td align="left"><span class="style10">ADDRESS</span></td>
            <td align="left" class="style10"><span class="style10"><?PHP echo $r_address1; ?><?PHP echo $r_city; ?>&nbsp;&nbsp;<?PHP echo $r_province; ?>&nbsp;&nbsp;<?PHP echo $r_country; ?>&nbsp;&nbsp;<?PHP echo $r_postalcode; ?></span></td>
          </tr>
          <tr>
            <td align="left"><span class="style10">TELEPHONE</span></td>
            <td align="left" class="style10"><span class="style10"><?PHP echo $r_phone; ?></span></td>
          </tr>
          
          <tr>
            <td height="21" align="left"><span class="style10">ID NO:</span></td>
            <td align="left" class="style10">&nbsp;</td>
          </tr>
        </table></th>
        <th width="348" scope="col"><table width="355" height="121" border="1" cellpadding="1" cellspacing="0" bordercolor="#0000FF">
          <tr>
            <th width="129" align="left" scope="col"><div align="left" class="style10">Date:</div></th>
            <th width="198" class="style10" scope="col"><?php echo $date?></th>
          </tr>
          <tr>
            <td align="left" class="style10">Time:</td>
            <td align="center" class="style10"><?php echo $time?></td>
          </tr>
          <tr>
            <td align="left" class="style10">Amount:($)</td>
            <td align="right" class="style10"><?php echo $amt?></td>
          </tr>
          <tr>
            <td align="left" class="style10"><span class="style3">Service Charge:($</span>)</td>
            <td align="right" class="style10"><?php echo $fee?></td>
          </tr>
          <tr>
            <td align="left" class="style10"><span class="style3">Total Charge:($</span>)</td>
            <td align="right" class="style10"><?php echo $grt?></td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <td><table width="438" border="1" cellpadding="1" cellspacing="0" bordercolor="#009900">
          <tr>
            <th colspan="2" bgcolor="#999999" scope="col"><span class="style1">ORDERING CUSTOMER</span></th>
          </tr>
          <tr>
            <td width="105" align="left" class="style10">FIRST NAME</td>
            <td width="306" align="left" class="style10"><?PHP echo $s_fname; ?><?PHP echo $s_mname; ?></td>
          </tr>
          <tr>
            <td align="left" class="style10">LAST NAME</td>
            <td align="left" class="style10"><?PHP echo $s_lname; ?></td>
          </tr>
          <tr>
            <td class="style10">ADDRESS</td>
            <td align="left" class="style10"><?PHP echo $s_address;?></td>
          </tr>
          <tr>
            <td height="24" class="style10">TELEPHONE</td>
            <td align="left" class="style10"><?PHP echo $s_phone; ?></td>
          </tr>
          <tr>
            <td class="style10">ID NO:</td>
            <td align="left" class="style10">&nbsp;<?php echo $sender_id; ?></td>
          </tr>
        </table></td>
        <td bordercolor="#000000" ><div align="left" style="border-style:none"><span class="style3">ANP Money Transfer Ltd as a money remittance company is committed to maintaining compilance with Canada's new <u>Proceeds of Crime(Money Laundering) and Terrorist Financing Act.</u> As such we are required under that legislation to maintain specific records, gather certain information, and report when required certain information as described in section 7 and 9 of the <u> Act</u> and various Regulations that support the <u> Act</u>.</span></div></td>
      </tr>
      <tr>
        <td><table width="439" border="1" cellpadding="2" cellspacing="0" bordercolor="#FF00CC">
          <tr>
            <th width="103" scope="col"><span class="style10">EXCHANGE RATE</span></th>
            <th width="67" align="left" class="style10" scope="col"><?PHP echo $rate; ?></th>
            <th width="78" align="left" scope="col"><span class="style10">RECEIVABLE AMOUNT</span></th>
            <th width="165" align="left" scope="col"><span class="style10"><?PHP echo $cvt; ?></span></th>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td border="1" bordercolor="#000000"><div align="left" style="border-style:none"><span class="style3">Any discrepancy or shortfall in receipt by beneficial should be reported with in 30 days or the date of Invoice.ANP will not assume any responsibility for any shortfall or discrepancy after that date.</span> </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="438" border="1" cellspacing="0" cellpadding="1">
          <tr>
            <th width="160" scope="col"><div align="left" class="style10">CUSTOMER SIGNATURE :</div></th>
            <th width="264" scope="col">&nbsp;</th>
          </tr>
        </table></td>
        <td><table width="353" border="1" cellspacing="0" cellpadding="1">
          <tr>
            <td width="93" align="center" scope="col"><span class="style10">ACCEPTED BY :</span></td>
            <td width="198" scope="col">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<br/>
<table width="800"  align="CENTER" border="0" cellspacing="0" cellpadding="1" >
  <tr>
    <td><table>
      <tr>
        <td width="186" height="71" align="left" valign="bottom"><img align="middle" src="/ANP/img/ANP-logo.jpg" height="73" width="79" border="0" alt="ANP Money Transfer Ltd."  onclick="javascript:window.print(this);" title="please click here to print the receipt"/></td>
        <td width="382" align="center" valign="bottom"><span class="style13">ANP Money Transfer Ltd.</span><br/>
              <span class="style3"> 2885 Lawrence Ave East ,Scarborough, ON M1P2S8 </span> <span class="style10">Tel:416.266.9000  Fax:416.266.9005  Cell:647.273.2530 </span></td>
        <td width="210" align="right" valign="bottom"><p align="center" valign="bottom" class="style3">REFERENCE NO:&nbsp;&nbsp; <?php echo $trans_id;?>&nbsp;&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="796" border="0" cellpadding="1" cellspacing="0" bordercolor="#666666">
      <tr>
        <th width="438" scope="col"><table width="436" border="1" cellpadding="1" cellspacing="0" bordercolor="#990000">
          <tr>
            <th colspan="2" bgcolor="#999999" scope="col"><span class="style1">BENEFICIARY</span></th>
          </tr>
          <tr>
            <td width="107" align="left"><span class="style10">FIRST NAME</span></td>
            <td width="314" align="left" class="style10"><?PHP echo $r_fname;?><?PHP echo $r_mname; ?></td>
          </tr>
          <tr>
            <td align="left" class="style10">LAST NAME</td>
            <td align="left" ><span class="style10"><?PHP echo $r_lname; ?></span></td>
          </tr>
          <tr>
            <td align="left"><span class="style10">ADDRESS</span></td>
            <td align="left" class="style10"><span class="style10"><?PHP echo $r_address1; ?><?PHP echo $r_city; ?>&nbsp;&nbsp;<?PHP echo $r_province; ?>&nbsp;&nbsp;<?PHP echo $r_country; ?>&nbsp;&nbsp;<?PHP echo $r_postalcode; ?></span></td>
          </tr>
          <tr>
            <td align="left"><span class="style10">TELEPHONE</span></td>
            <td align="left" class="style10"><span class="style10"><?PHP echo $r_phone; ?></span></td>
          </tr>
          
          <tr>
            <td height="21" align="left"><span class="style10">ID NO:</span></td>
            <td align="left" class="style10">&nbsp;</td>
          </tr>
        </table></th>
        <th width="348" scope="col"><table width="355" height="121" border="1" cellpadding="1" cellspacing="0" bordercolor="#0000FF">
          <tr>
            <th width="129" align="left" scope="col"><div align="left" class="style10">Date:</div></th>
            <th width="198" class="style10" scope="col"><?php echo $date?></th>
          </tr>
          <tr>
            <td align="left" class="style10">Time:</td>
            <td align="center" class="style10"><?php echo $time?></td>
          </tr>
          <tr>
            <td align="left" class="style10">Amount:($)</td>
            <td align="right" class="style10"><?php echo $amt?></td>
          </tr>
          <tr>
            <td align="left" class="style10"><span class="style3">Service Charge:($</span>)</td>
            <td align="right" class="style10"><?php echo $fee?></td>
          </tr>
          <tr>
            <td align="left" class="style10"><span class="style3">Total Charge:($</span>)</td>
            <td align="right" class="style10"><?php echo $grt?></td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <td><table width="438" border="1" cellpadding="1" cellspacing="0" bordercolor="#009900">
          <tr>
            <th colspan="2" bgcolor="#999999" scope="col"><span class="style1">ORDERING CUSTOMER</span></th>
          </tr>
          <tr>
            <td width="105" align="left" class="style10">FIRST NAME</td>
            <td width="306" align="left" class="style10"><?PHP echo $s_fname; ?><?PHP echo $s_mname; ?></td>
          </tr>
          <tr>
            <td align="left" class="style10">LAST NAME</td>
            <td align="left" class="style10"><?PHP echo $s_lname; ?></td>
          </tr>
          <tr>
            <td class="style10">ADDRESS</td>
            <td align="left" class="style10"><?PHP echo $s_address;?></td>
          </tr>
          <tr>
            <td height="24" class="style10">TELEPHONE</td>
            <td align="left" class="style10"><?PHP echo $s_phone; ?></td>
          </tr>
          <tr>
            <td class="style10">ID NO:</td>
            <td align="left" class="style10">&nbsp;<?php echo $sender_id; ?></td>
          </tr>
        </table></td>
        <td bordercolor="#000000" ><div align="left" style="border-style:none"><span class="style3">ANP Money Transfer Ltd as a money remittance company is committed to maintaining compilance with Canada's new <u>Proceeds of Crime(Money Laundering) and Terrorist Financing Act.</u> As such we are required under that legislation to maintain specific records, gather certain information, and report when required certain information as described in section 7 and 9 of the <u> Act</u> and various Regulations that support the <u> Act</u>.</span></div></td>
      </tr>
      <tr>
        <td><table width="439" border="1" cellpadding="2" cellspacing="0" bordercolor="#FF00CC">
          <tr>
            <th width="103" scope="col"><span class="style10">EXCHANGE RATE</span></th>
            <th width="67" align="left" class="style10" scope="col"><?PHP echo $rate; ?></th>
            <th width="78" align="left" scope="col"><span class="style10">RECEIVABLE AMOUNT</span></th>
            <th width="165" align="left" scope="col"><span class="style10"><?PHP echo $cvt; ?></span></th>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td border="1" bordercolor="#000000"><div align="left" style="border-style:none"><span class="style3">Any discrepancy or shortfall in receipt by beneficial should be reported with in 30 days or the date of Invoice.ANP will not assume any responsibility for any shortfall or discrepancy after that date.</span> </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="438" border="1" cellspacing="0" cellpadding="1">
          <tr>
            <th width="160" scope="col"><div align="left" class="style10">CUSTOMER SIGNATURE :</div></th>
            <th width="264" scope="col">&nbsp;</th>
          </tr>
        </table></td>
        <td><table width="353" border="1" cellspacing="0" cellpadding="1">
          <tr>
            <td width="93" align="center" scope="col"><span class="style10">ACCEPTED BY :</span></td>
            <td width="198" scope="col">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
