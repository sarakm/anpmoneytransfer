<?php
session_start(); 
include('lib/config.php');
include('lib/opendb.php');

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

function check()
{
var value=document.getElementById('money').value;
//alert(value);
if(isNaN(value) || value=="")
	{
		alert("got here");
		//document.getElementById("money").focus();
		document.getElementById("moneyalert").style.visibility="visible";
		document.getElementById("money").value="";
		

	}
	else
		document.getElementById("moneyalert").style.visibility="hidden";
		
	if(value>999)
	{
		document.getElementById("moneyEx").style.visibility="visible";
	}
	else
	{
		document.getElementById("moneyEx").style.visibility="hidden";
	}




}
function checkAmt()
{

var value=document.getElementById('money').value;
var place=document.getElementById('citi').value;
//alert(place);
if(place=="")
{alert("enter valid city,country where you want to send money");
}
else{
var arr=place.split(',');

//alert(arr.length);
if(arr.length!=2)
{
alert("Please enter valid  city,country seperated by comma");
document.getElementById('citi').focus;
}
}

if(!(isNaN(value) || value==""))
{
getValues();
}

else{
check();
}
}

function getValues()
{

	var amt = escape(document.getElementById('money').value);
	var city = document.getElementById('citi').value;
	//city = "New York,USA";
	
	var url = 'totalResult.php?amount=' + amt+'&city='+city;
	//alert(url);
	resultObj.open("GET", url, true);
	
	resultObj.onreadystatechange =function()
	{
			if (resultObj.readyState == 4) 
			{
    	//   		document.getElementById("result").innerHTML =resultObj.responseText;
		//   alert(resultObj.responseText);
		   if (resultObj.readyState==4)
			
			var val=resultObj.responseText.split("\n");
			if(val[0]<1||val[0]=="")
			{alert("Error converting the amount");
			document.getElementById('cvt').value=""; 
			  document.getElementById('amt').value=""; 
			   document.getElementById('fee').value=""; 
			    document.getElementById('grt').value=""; 
			 document.getElementById('citi').focus;
			}
			
			 
			 document.getElementById('cvt').value=val[0]; 
			  document.getElementById('amt').value=val[1]; 
			   document.getElementById('fee').value=val[2]; 
			    document.getElementById('grt').value=val[3];
				 document.getElementById('currency').value=val[4]; 

		   
		   
			}
	}	



	resultObj.send(null);
}





</script>
<!--<div align="CENTRE" style="margin-top:10px;">-->
<form name="test" method="post" action="test1.php" onsubmit=>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="MYTABLE">
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td width="" height="61" align="center">Amount to send:
      <input type="text" name="money" id="money" size="20"  onblur ="check();"/><br/><div id="moneyalert" style="visibility:hidden"><b><i>You must type a valid amount</i></b></div></td>
    <td><!--need to change city name -->
      Enter City,Country&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="citi" type="text"  id="citi" onkeyup="citySuggest()"  onblur="" autocomplete="off" />
        <input name="btn" id="btn" type="button" value="GO" onclick="checkAmt();" />
        <div id="citisuggest" style=" z-index:2; margin-left:95px; width:140px; background-color:#FFFFFF; display:none;border:solid 1px #333333;"></div></td>
  </tr>
  <tr class="MYTABLE">  </tr>
  <!--if agent send large amount must give reason --->
  <tr>
    <td align="CENTER" ><div  name="moneyEx" id="moneyEx" style="visibility:hidden" > <span style="color:#F00; font-weight:bold">Oops,If You are sendingmore than 999 dollars, please enter a reason of sending and type the client id</span><br/>
            <select name="reason" id="reason" >
              <option value="0">Choose A Reason</option>
              <?php
			$query = "Select reason FROM anp_reason ORDER BY reason";
			$result=mysql_query($query);
			if($result)
			{ 				
				while($rows=mysql_fetch_array($result))
				{
					echo "<option value='".$rows['reason']."'>".$rows['reason']."</option>";
				}
				
			}
		?>
            </select>
           
    </div></td>
    <td  ><!--MONEY RESULT -->
        <div id="result" name="result">
          <table width="369"  border="0"  cellpadding="0" cellspacing="0">
            <tr>
              <td > Amount Converted</td>
              <td  ><input type="text" name="cvt" id="cvt" value="" />
                  <input type="text" size="3" name="currency" id="currency" value="" /></td>
            </tr>
            <tr>
              <td  >Amount sending </td>
              <td ><input type="text" name="amt" id="amt" value="" /></td>
            </tr>
            <tr>
              <td>ANP Fees</td>
              <td ><input type="text" name="fee" id="fee" value="" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Grand Total </td>
              <td><input type="text" name="grt" id="grt" value="" /></td>
            </tr>
          </table>
        </div>
      <!--END OF MONEY RESULT -->    </td>
  </tr>
  <tr>
    <td ALIGN="center"> Note 
      <textarea name="exnote" rows="2" cols="40"></textarea></td>

  <!-- this allow the admin to select the agent -->

    <td ><?php
   if(isset($_SESSION['loggedin']))
   		$username = $_SESSION['loggedin'];
	 	
   	$query ="SELECT level FROM staff WHERE username='$username'";
	$result = mysql_query($query);
    
	if($result)
	{
		$fields = mysql_fetch_assoc($result);
		
		$rank = $fields["level"];
         echo "rank is ".$rank;
		if($rank =="admin")
		{
		?>
        
        <legend>Agent Locator</legend>
         
         <input name="agent" type="text" class="searchbox" id="agent" onkeyup="searchAgent()" autocomplete="off" />
        <div id="search_agent" style="z-index:2; width:200px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></td>
    <?php 
		}
		
	}
	?>
  </tr>
   
  <tr height="50">
   <td></td> <td><input type="submit" name="submit" id="submit"  value="SUBMIT"/></td>
  </tr>
</table>

</FORM>
</body>
</html>
<?php


?>