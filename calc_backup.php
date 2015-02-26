<?php
include('lib/config.php');
include('lib/opendb.php');
include('menu.html');
if(isset($_REQUEST['countryId']))
$countryId=stripslashes($_REQUEST['countryId']);
else
$countryId="SELECT COUNTRY" ;
//echo $countryId;
if(isset($_REQUEST['cityId']))
$cityId=stripslashes($_REQUEST['cityId']);
else
$cityId="SELECT CITY";

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
<!--<script language="JavaScript" type="text/javascript" src="js/jsscript.js"></script>
--><SCRIPT language="JavaScript" type="text/javascript">

function getcity() {
var c=document.f1.country.value;
alert(c);
}
function reload()
{
alert("Hai");
// Setting the variable with the value of selected country's ID
var val=escape(document.getElementById("countryList").value);
alert("Hai"+val);

// Sending the country id in the query string to retrieve the city list
//if(val!=""||val !="none")
self.location='calc.php?countryId=' + val ;
}

function getCurrency(val)
{
alert("hai");
// Setting the variable with the value of selected country's ID
//var val=escape(document.getElementById("countryList").value);
var val1=escape(document.getElementById("cityList").value);
alert("Hai"+val+"city="+val1);

// Sending the country id in the query string to retrieve the city list
//if(val1!=""||val1 !="none")
self.location="calc.php?countryId="+val+ "&cityId="+val1;
}
</SCRIPT>
</head>

<body>
<form name="f1" method="post" action="javascript:void(0)">
<P>&nbsp;</P>
<table class="MYTABLE" align="center" width="400" cellpadding="0" cellspacing="0">
<tr class="MYTABLE" height="100"> <td>
<div id="country">
Choose the Country<select name="countryList" id="countryList"  onchange='reload();'> <option value="none"><font color='blue'><?php echo $countryId;?></font></option>
<?php 
$q="select distinct(country) from anp_rates";
$result = mysql_query($q) or die(mysql_error());
      $numrows = mysql_num_rows($result);
	if($numrows >0)
	{
	while($row=mysql_fetch_array($result))
	{ // $selected_country=$row[0];
	   echo"<option value='$row[0]'>$row[0]</option>";
	 }
	 }
	 ?>
	 </select>
     </div></td>
     
<?php

if((isset($countryId)))
{

$q="select city from anp_rates where UPPER(country)= UPPER('". $countryId ."')order by city";

$result = mysql_query($q) or die(mysql_error());
      $numrows = mysql_num_rows($result);
	  
	 
	 
?>     
     <td>
     <div id="city">
     
    Choose the City<select name="cityList" id="cityList" onchange="getCurrency('<?php echo $countryId;?>');"> <option value="none"><font color='blue'>SELECT CITY</font></option>
    <?php
	if($numrows >0)
	{
	while($row=mysql_fetch_array($result))
	{ 
	   echo"<option value='$row[0]'>$row[0]</option>";
	}
   }
 }
	 ?>
	 </select>
     </div></td></tr><tr>
     
 <!--*******************************************************-->
 <?php
 

if((isset($cityId))&&$cityId!="SELECT CITY")
{

$q="select currency,rates from anp_rates where UPPER(city)= UPPER('". $cityId ."') order by city";

$result = mysql_query($q) or die(mysql_error());
      $numrows = mysql_num_rows($result);
	  
	 
	 
?>     
     
    <td > <div id="currency">
     
    Currency Value
    <?php
	if($numrows >0)
	{
	while($row=mysql_fetch_array($result))
	{ 
	   echo"<input type='text' name='curr' value='$row[0]'/></td>";
	   echo"<td><input type='text' name='rate' value='$row[1]'/></td></div>";
	}
   }
 }
	 ?>
	 
     </div></td></tr><tr>
         
     
     </table>
     
     









</form>
</body>
</html>
<?php
include('lib/closedb.php');
?>