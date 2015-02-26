<?php
session_start();
ob_start();
include"lib/authenticate.php";
include"lib/config.php";
include"lib/opendb.php";
include"menu.html";
if(isset($_REQUEST['submit'])&&isset($_REQUEST['country'])&&isset($_REQUEST['currency'])&&isset($_REQUEST['rate']))
{

$city=$_REQUEST['city'];
$country=$_REQUEST['country'];
$currency=$_REQUEST['currency'];
$rate=$_REQUEST['rate'];
/*echo"rate=".$rate;
echo"city=".$city;
echo"country=".$country;
echo"currency=".$currency;*/
$s="select * from anp_rates where UPPER(country) LIKE UPPER('$country') and UPPER(city) LIKE UPPER('$city')";
echo $s;
$result = mysql_query($s) or die(mysql_error());
$numrows=mysql_num_rows($result);
	if($numrows !=0)
	{
	   $msg=" Record exists with same city name in the database!";
	   header("location:add_rates.php?msg=".$msg);
	   exit;
    }
	else
	{
	 $sql="insert into anp_rates(city,country,currency,rates) values('$city','$country','$currency','$rate')";
	} 
 
$city=strtoupper($city);
$country=strtoupper($country);
$currency=strtoupper($currency);

 
 
	 $result = mysql_query($sql) or die(mysql_error());
	
	 $insert_id = mysql_insert_id();
			// echo $insert_id;
		if($insert_id != NULL)
		  {	
		   $msg="Record Successfully inserted into the database!";
		  }
			 else
			 {
			  $msg=" Error inserting the record! Please try again!"; 
			 }
			 
			header("location:add_rates.php?msg=".$msg);
			exit; 

}
else
{

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
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>

</head>

<body>
<?PHP if(isset($_REQUEST['msg'])) {echo $_REQUEST['msg'];}?>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHPSELF'];?>">
<P>&nbsp;</P>
<table class="MYTABLE" width="200" border="0" ALIGN="CENTER">
<caption class="MYTABLE">ADD RATES</caption>
  
  <tr class="MYTABLE"><td colspan="4">&nbsp;</td></tr>
  <tr class="MYTABLE">
    <td width="129" align="right" class="MYTABLE"></td>
    <td width="107"  align="right" class="MYTABLE">
      <label>CITY</label>
   </td>
    <td width="213" class="MYTABLE"><input type="text" name="city" id="city" AUTOCOMPLETE-"off" /></td>
    <td width="129" align="right" class="MYTABLE">&nbsp;</td>
  </tr>
  <tr class="MYTABLE">
    <td >&nbsp;</td>
    <td align="right" class="MYTABLE"> <label>COUNTRY</label></td>
    <td class="MYTABLE"><input type="text" name="country" id="country" AUTOCOMPLETE-"off" /></td>
    <td >&nbsp;</td>
  </tr>
  <tr class="MYTABLE">
  <td >&nbsp;</td>
    <td align="right" class="MYTABLE"> <label>CURRENCY</label></td>
    <td class="MYTABLE"><input type="text" name="currency" id="currency" AUTOCOMPLETE-"off" /></td>
    <td >&nbsp;</td>
  </tr>
  <tr class="MYTABLE">
  <td >&nbsp;</td>
    <td align="right" class="MYTABLE"> <label>RATE</label></td>
    <td class="MYTABLE"><input type="text" name="rate" id="rate" AUTOCOMPLETE-"off" title="transaction rate"/></td>
    <td >&nbsp;</td>
  </tr>
  <tr class="MYTABLE"><td colspan="4">&nbsp;</td></tr>
  <tr class="MYTABLE">
   
    <td colspan="4" align="center"><input type="submit" name="submit" id="submit" value="ADD RECORD"/></td>
    
  </tr>
  <tr class="MYTABLE"><td colspan="4">&nbsp;</td></tr>
</table>
</form>
</body>
</html>
<?php
}
//include"lib/closedb.php";

?>