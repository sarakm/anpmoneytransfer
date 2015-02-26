<?php
session_start();
include("lib/authenticate_br.php");
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

// Setting the variable with the value of selected country's ID
var val=escape(document.getElementById("countryList").value);
//alert("Hai"+val);

// Sending the country id in the query string to retrieve the city list
//if(val!=""||val !="none")
self.location='calc.php?countryId=' + val ;
};

function getCurrency(val)
{

// Setting the variable with the value of selected country's ID
//var val=escape(document.getElementById("countryList").value);
var val1=escape(document.getElementById("cityList").value);


// Sending the country id in the query string to retrieve the city list
//if(val1!=""||val1 !="none")
self.location="calc.php?countryId="+val+ "&cityId="+val1;
};
function getSum()
{

var amt=document.getElementById("amt").value;
var rate=document.getElementById("rate").value;
var curr=document.getElementById("curr").value;
if(isNaN(amt))
{
alert("Please enter the amount");
document.getElementById("amt").value="";
document.getElementById("amt").focus();
return false;
}

if(!isNaN(amt) || amt!="")
{
var total=amt*rate;
var totalcur=total+" "+curr;
//alert(total);
document.getElementById("result").value =totalcur;
//document.f1.curr.value
}
};
function clearIt()
{
//alert("hai");
document.getElementById("amt").value="";
document.getElementById("curr").value="";
document.getElementById("rate").value="";
document.getElementById("result").value="";
//document.getElementById("countryList").value="SELECT COUNTRY";
//document.getElementById("cityList").selectedIndex[0].selected;

};
</SCRIPT>
</head>

<body bgcolor="#e2e2e2" >
<table align="center" width="1005"  bgcolor="#FFFFFF" valign="top" >
<tr><td>

<form name="f1" method="post" action="javascript:void(0)">
<br />

<table width="480" align="center" class="MYTABLE" cellpadding="3" cellspacing="0">
<TR CLASS='MYTABLE'><TD colspan="2" CLASS='MYTABLE'>&nbsp;</TD>
</TR>
          <caption class='MYTABLE'> ANP Transaction Rates</caption>
	      <TR CLASS='MYTABLE'><TD width="160"></TD>
  <tr class="MYTABLE" height="10"><td height="24" align="center">Choose the Country</td>
  <td align="center">Choose the City</td></tr>
  <tr class="MYTABLE" height="60">
    <td height="58"  valign="center"><div id="country" height="100" align="center">
      <select name="countryList" id="countryList"  autocomplete="off" onchange='reload();' title="Please select the country name where you want to send money">
        <option name='none' id='none' value="none"><font color='blue'><?php echo $countryId;?></font></option>
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

if((isset($countryId))&&$countryId!="none")
{

$q="select city from anp_rates where UPPER(country)= UPPER('". $countryId ."')order by city";

$result = mysql_query($q) or die(mysql_error());
      $numrows = mysql_num_rows($result);
	  
	 
	 
?>
    <td width="176"  align='center'><div id="city">  
            <select name="cityList" id="cityList" AUTOCOMPLETE="off" onchange="getCurrency('<?php echo $countryId;?>');" title="Please select the city name where you want to send money">
              <option name='none1' id='none1' value="none"><font color='blue'><?php echo $cityId;?></font></option>
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
    </div></td>
  </tr>
  <tr>
    <!--*******************************************************-->
    <?php
 

if((isset($cityId))&&$cityId!="SLECT CITY")
{

$q="select currency,rates from anp_rates where UPPER(city)= UPPER('". $cityId ."') order by city";

$result = mysql_query($q) or die(mysql_error());
      $numrows = mysql_num_rows($result);
	  
	 
	 
?>
    <td height="57"  align="center"><div id="currency"> 
      <?php
	if($numrows >0)
	{
	while($row=mysql_fetch_array($result))
	{  echo"<table align='center'><tr><td colspan='2' align='center'>Currency Value</td><tr>";
	   echo"<tr><td><input type='text' name='rate' id='rate' size='8' AUTOCOMPLETE='off' value='$row[1]'/>&nbsp;</td>";
	   echo"<td><input type='text' name='curr' id='curr' size='6' AUTOCOMPLETE='off' value='$row[0]'/></td></tr></table>";
	  
	}
   }
 }
	 ?>
    </div></td>
    <td align='left'><table align='center'><tr><td colspan='2' align='center'>Enter the Amount to send:</td></tr> 
      <tr><td><input type='text' name='amt' id='amt'size='8' value='' AUTOCOMPLETE="off"/> <label>CAD</label></td></tr></table>     </td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
 
  <TR class="MYTABLE" height="50px"><TD COLSPAN="2" align="center"><font color="#993366"><strong>RESULT<input type="text" name="result" id="result" value="" AUTOCOMPLETE="off"/></strong></font></TD></TR>
   <tr><td colspan="2">&nbsp;</td></tr>
   <tr><td colspan="2" align="center"> <input type='button' name='reset' id='reset' size='8' value='RESET'  onclick="clearIt();"/>&nbsp;&nbsp;&nbsp;<input type='button' name='sum' size='8' value='CALCULATE'  onclick="getSum();" title="Click here to calculate the converted amount"/></td>
  </tr>
  <tr><td colspan="2">&nbsp;</td> </tr>
</table>
</form>


<?php
//***********************************************************************************************



 if ($_SESSION['msg'])
{
echo "<h3><font color='#920'>". $_SESSION['msg']."</font></h3>";
$_SESSION['msg']="";
}
 
    $sql = "SELECT * FROM anp_rates order by id";
	$result = mysql_query($sql) or die(mysql_error());
    $count = mysql_num_rows($result);
?>
	
  
          <div style='padding-top: 30pt;'><FORM name='f2'>
  	      <table  width="700" align='center' class='MYTABLE' valign='middle'>
          <TR CLASS='MYTABLE'><TD CLASS='MYTABLE'>&nbsp;</TD></TR>
          <caption class='MYTABLE'> ANP Transaction Rates</caption>
	      <TR CLASS='MYTABLE'><TD></TD>
         
          <TD CLASS='MYTABLE'><font size='4' color='#191970'>City</font></td>
          <TD CLASS='MYTABLE'><font size='4' color='#191970'>Country</font></td>
          <TD CLASS='MYTABLE'><font size='4' color='#191970'>Currency</font></td>
          <TD CLASS='MYTABLE'><font size='4' color='#191970'>Rate</font></td>
          <TD CLASS='MYTABLE'>&nbsp;</TD></TR>
           <TR CLASS='MYTABLE'><TD CLASS='MYTABLE'>&nbsp;</TD></TR>
     <?PHP     
     $sno=1;
       while($rows = mysql_fetch_array($result))
       {
	   ?>
      
         <tr onmouseover="this.style.backgroundColor='#E7E7E7'" onmouseout="this.style.backgroundColor='#FFFFFF'" onclick='javascript:void(0);'>
         
		
		<td align="center" valign="middle">
          <label><?php echo $sno;?></label></td>
		 <td><input type='text' id='city[<?php echo $sno;?>]' name='city[<?php echo $sno;?>]' value="<? echo $rows['city']; ?>"/></td>
		 <td><input type='text' id='country[<?php echo $sno;?>]' name='country[<?php echo $sno;?>]' value="<? echo $rows['country']; ?>"/></td>
		 <td><input type='text' id='currency[<?php echo $sno;?>]' name='currency[<?php echo $sno;?>]' value="<? echo $rows['currency']; ?>"/></td>
		 <td><input type='text' id='rate[<?php echo $sno;?>]' name='rate[<?php echo $sno;?>]' value="<? echo $rows['rates']; ?>"/></td>
	     
	    </tr>
		<tr CLASS="MYTABLE"><TD>&nbsp;</TD></tr>
       
<?php	
$sno++;	
}
?>          
             <tr CLASS="MYTABLE">
	           <td CLASS="MYTABLE" colspan="6">&nbsp;</td>
             </tr>
	 		 <tr CLASS="MYTABLE"><TD>&nbsp;</TD></tr>
		     </table>
             </form></div>
 <p>&nbsp;</p>
</td></tr></table>
<table align="center" class="footer"><tr><td><?PHP include "footer.html"; ?></td></tr></table>            
</body>
</html>
<?php
include('lib/closedb.php');
?>
