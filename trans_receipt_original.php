<?PHP
session_start();
include"lib/authenticate.php";	
include('lib/config.php');
include('lib/opendb.php');


//$trans_id=$_REQUEST['trans_id'];
$trans_id=6;
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
<script language="JavaScript" type="text/javascript" src="js/checkSender.js"></script>
<style>

</style>
</head>
<body>


<form action="#" name="receipt" class="receipt">
<div align="right" style="margin-right:60px;"><a href="#" onclick="javascript:window.print(this);"><img src="/ANP/img/Printer-icon.png" /></a></div>

                 ANP Money Transfer Ltd.
       2885 Lawrence Ave East,Scarborough,ON M1P2S8
      Tel:416.266.9000  Fax:416.266.9005  Cell:647.273.2530
      
<table width="680px"  height="198px" class="MYTABLE" ><td height="140"><tr><td>
    <td height="344"><td><table border="2" align="left" cellpadding="0" cellspacing="0">
              
      <span>BENEFICIERY</span>
      <div>
        <table border="2" align="left" cellpadding="0" cellspacing="0">
          <tr width="400">
            <td width="97"><label for='rf_name'>FIRST NAME</label></td>
            <td width="230"><?PHP echo $r_fname;?></td>
            <td width="112"><label for='rm_name'>MIDDLE NAME</label></td>
            <td width="249"><?PHP echo $r_mname; ?></td>
          </tr>
          <tr>
            <td><label for='rl_name'>LAST NAME</label></td>
            <td><?PHP echo $r_lname; ?></td>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td colspan="1"><label for='address'>ADDRESS</label></td>
            <td colspan="3" align="left"><?PHP echo $r_address1; ?></td>
          </tr>
          <tr>
            <td colspan="1"></td>
            <td colspan="3" align="left"><?PHP echo $r_city; ?>&nbsp;&nbsp;<?PHP echo $r_province; ?>&nbsp;&nbsp;<?PHP echo $r_country; ?>&nbsp;&nbsp;<?PHP echo $r_postalcode; ?></td>
          </tr>
          <tr>
            <td><label for='phone'>TELEPHONE</label></td>
            <td ><?PHP echo $r_phone; ?></td>
            <td><label for='id'>ID NO:</label></td>
            <td ></td>
          </tr>
        </table>
        <table border="2" align="left"  cellpadding="0" cellspacing="0">
          <tr>
            <td width="445">&nbsp;</td>
            <td></td>
          </tr>
          <tr class="h4" width="600">
            <td >ORDERING CUSTOMER</td>
            <td >&nbsp;</td>
          </tr>
        </table>
      </div>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div class="h4">
        <table width="500" height="200" border="2" align="left" top-padding="20px" cellpadding="0" cellspacing="0">
          <tr width="500">
            <td width="97"><label for='s_fname'>FIRST NAME</label></td>
            <td width="230" align="center"><?PHP echo $s_fname; ?></td>
            <td width="112"><label for='s_fname'>MIDDLE NAME</label></td>
            <td width="249" align="center"><?PHP echo $s_mname; ?></td>
          </tr>
          <tr>
            <td><label for='s_lname'>LAST NAME</label></td>
            <td colspan="3" align="center"><?PHP echo $s_lname; ?></td>
          </tr>
          <tr height="30">
            <td><label for='address'>ADDRESS</label>            </td>
            <td colspan="3"><?PHP echo $s_address;?>&nbsp;<?PHP echo $s_postalcode;?></td>
          </tr>
          <tr>
            <td><label for='phone'>TELEPHONE</label></td>
            <td align="center"><?PHP echo $s_phone; ?></td>
            <td><label for='id'>ID NO:</label></td>
            <td ><?php echo $sender_id; ?></td>
          </tr>
        </table>
      </div>
      <div >
        <table width="500" height="48" border="2" align="left"  cellpadding="0" cellspacing="0">
          <tr>
            <td width="158"><label for='rate'>EXCHANGE RATE</label></td>
            <td align="center"><?PHP echo $rate; ?></td>
            <td width="158"><label for='receivableAmt'>RECEIVABLE AMOUNT</label></td>
            <td  align="center" ><?PHP echo $cur; ?><?PHP echo $cvt; ?></td>
          </tr>
        </table>
      </div>
      <div>
        <table width="500"  border="2" align="left"  cellpadding="0" cellspacing="0">
          <tr>
            <td width="330"> Any discrepancy or shortfall in receipt by beneficial should be reported with in 30 days or the date of Invoice.ANP will not assume any responsibility for any shortfall or discrepancy after that date. </td>
            <td width="361"><label align="bottom" class="h4">Customer Signature:</label></td>
          </tr>
        </table>
      </div>
<table CLASS="H4" width="310"  border="2" align="top" cellpadding="0" cellspacing="0">
<tr><td width="150">REFERENCE NUMBER:</td><TD width="100"><?php echo $trans_id;?></TD>
<tr><td colspan="2">
<table CLASS="H4" width="300"  border="2" align="center" cellpadding="0" cellspacing="0" >
<tr><td>Date:</td><td><?php echo $date?></td></tr>
<tr><td>Time:</td><td><?php echo $time?></td></tr>
<tr><td>Amount:($)</td><td align="right"><?php echo $amt?></td></tr> 
<tr><td>Service Charge:($)</td><td align="right"><?php echo $fee?></td></tr> 
<tr><td>Total Charge:($)</td><td align="right"><?php echo $grt?></td></tr></table></td></tr>
<tr><td colspan="2"><div> ANP Money Transfer Ltd as a money remittance company is committed to maintaining compilance with Canada's new <u>Proceeds of Crime(Money Laundering) and Terrorist Financing Act.</u> As such we are required under that legislation to maintain specific records, gather certain information, and report when required certain information as described in section 7 and 9 of the <u> Act</u> and various Regulations that support the <u> Act</u>.</div></td></tr>
</table>

<table width="300" align="left" style="font-weight:bold;"><tr><td><lable>Accepted By</label></td><td>&nbsp;</td></tr></table></td></tr></table>
</table>
</form>
</body>
<html>





