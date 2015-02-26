<?php 
session_start();
include"lib/authenticate_br.php";	
		
include('lib/config.php');
include('lib/opendb.php');
include "menu.html";
if(isset($_REQUEST['userid']))
{

$userid = trim($_GET['userid']);
$_GET['userid']="";
//echo $userid;
//unset($_SESSION['userid']);
}
 if (array_key_exists('msg', $_SESSION))
{
echo $_SESSION['msg'];
unset($_SESSION['msg']);
}
   if (array_key_exists('transactionid', $_SESSION))
 {
 //echo"transactionid=".$_SESSION['transactionid'];
 $Stransactionid=$_SESSION['transactionid']; 
 echo "SESSION transactionid=".$Stransactionid;
 }
if($userid!=NULL)
{
    $sql = "SELECT * FROM users where userid=$userid";
	$result = mysql_query($sql) or die(mysql_error());
    $numrows = mysql_num_rows($result);
  
  if ($numrows != 0)
  {
   while($row = mysql_fetch_array($result))
      {
           $firstname= $row[1];
		   $middlename=$row[2];
		   $lastname = $row[3];
		   $gender   = $row[4];
		   $address1= $row[5];
		   $address2= $row[6];
		   $city= $row[7];
		   $province= $row[8];
		   $country= $row[9];
		   $postalcode= $row[10];
		   $phone1= $row[11];
		   $phone2= $row[12]; 
		   $email= $row[13];
		   $pid= $row[14];
		   $photoid= $row[15];
//		   $date= $row[16];
       }
	$sql1="SELECT DISTINCT (
receiver_firstname
), max( transactionid )
FROM transactions
WHERE userid =$userid
GROUP BY receiver_firstname
";
	$result1 = mysql_query($sql1) or die(mysql_error());
    $numrows1 = mysql_num_rows($result1);
	
  
  
  
}
}

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
<!--<script language="JavaScript" type="text/javascript" src="js/jsscript.js"></script>
--><SCRIPT language="JavaScript" type="text/javascript">

function getXmlHttpRequestObject() {

	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your browser doesn't support AJAX technology!");
	}
}

function recSuggest(id) 
{
	var searchReq1 = getXmlHttpRequestObject();

	
	if (searchReq1.readyState == 4 || searchReq1.readyState == 0) 
	{
		var str = escape(document.getElementById(id).value);
			searchReq1.open("GET", 'receiverSuggest.php?transactionid=' + str, true);
	

			searchReq1.send(null);
			/*DO NOT REMOVE THIS ALERT. CODE NEEDS IT*/
			alert("Searching receiver details");
			if (searchReq1.readyState==4)
			{
			 
			 
			var str1=searchReq1.responseText.split("\n");
		
			 document.getElementById('receiver_firstname').value=str1[1];
	 
			 
			 document.getElementById('receiver_middlename').value=str1[2]; 
			 document.getElementById('receiver_lastname').value=str1[3]; 
			 document.getElementById('receiver_address1').value=str1[4]; 
			 document.getElementById('receiver_address2').value=str1[5]; 
			 document.getElementById('receiver_city').value=str1[6]; 
			 document.getElementById('receiver_province').value=str1[7]; 
			 document.getElementById('receiver_country').value=str1[8];
			 document.getElementById('receiver_postalcode').value=str1[9]; 
			 document.getElementById('receiver_phone1').value=str1[10]; 
			 document.getElementById('receiver_phone2').value=str1[11]; 
			 document.getElementById('receiver_email').value=str1[12]; 
		     document.getElementById('receiver_pid').value=str1[13]; 
			
			 
	             if (str1[0]=='M')
				 document.f1.receiver_gender[0].checked=true;
	
				 else if (str1[0]=='F')
				document.f1.receiver_gender[1].checked=true;
			   
		 
			 		 
		
	}
				
		  
 }
}

function changeSenderInfo(f1)
{
//alert("in the modify");

f1.action="modifySender.php";
//alert(document.f1.action);
f1.submit();

};

function recalculate()
{

var f=eval(document.getElementById("fee").value);

var gt=eval(document.getElementById("grt").value);

var at=eval(document.getElementById("amt").value);

var m=eval(document.getElementById("money").value);
/*if(isNaN(m))
{
alert("Please enter Numbers only in 'Amount to send' box");
document.getElementById("money").focus;
return false;
}*/

gt=parseFloat(at+f);

document.getElementById("grt").value=gt;


};


function getSender()
{

var selectedid=escape(document.getElementById("selected_sender").value);
//alert(selectedid);
window.location.href="sender.php?userid="+selectedid;


}
function displayTrans()
{
document.getElementById("trans_display").style.visibility="visible";
}

</script>


</head>
<body >






<!--<table  align="center" width="980" border="0" cellspacing="0" cellpadding="0" id="main" onclick="autoHide()">

<TD CLASS="MYTABLE">-->
<div align="CENTRE" style="margin-top:10px;">
    <FORM name="form0" id="form0" METHOD="POST" enctype="multipart/form-data" ACTION="custsearch.php">
      <table width="700"  align="center" class="MYTABLE">
<caption class="MYTABLE">
          Search Customer
        </caption>
        <tr class="MYTABLE"><td colspan="9">&nbsp;</td>
        </tr>
        <tr class="MYTABLE">
          <td width="20" height="20" class="MYTABLE"><center>
            <label>CustId</label>
          </center></td>
          <td width="26" class="MYTABLE">&nbsp;&nbsp;</td>
          <td width="158" class="MYTABLE"><center>
            <label>First Name</label>
          </center></td>
          <!--<TD CLASS="MYTABLE">
            <center><label>Middle Name</label></center></TD>-->
          <td width="158" class="MYTABLE"><center>
            <label>Last Name</label>
          </center></td>
          <td width="26" class="MYTABLE">&nbsp;&nbsp; </td>
          <td width="158" class="MYTABLE"><center>
            <label>Phone</label>
          </center></td>
          <td class="MYTABLE" ><center>
            <label>Select Sender</label>
          </center></td>
           <td class="MYTABLE" >&nbsp;         </td>
        </tr>
        <tr class="MYTABLE" valign="bottom">
          <td class="MYTABLE" align="middle"><input type="text" size="20" name="custId" id="custId" value="" autocomplete="off" title="Enter customer id and click search button"/>          </td>
          <td class="MYTABLE">&nbsp;&nbsp; </td>
          <td class="MYTABLE" align="middle"><input type="text" name="firstname" id="firstname" value=""  onkeyup="searchSuggest(this.id)" autocomplete="off" title="Enter customer firstname to search"/>          </td>
          <!--<TD CLASS="MYTABLE">
        <input type="text" name="middlename" id="middlename" value=""/></TD>-->
          <td class="MYTABLE" align="middle"><input type="text" name="lastname" id="lastname" value="" onkeyup="searchSuggest(this.id)" autocomplete="off" title="Enter customer lasttname and click search button"/></td>
          <td class="MYTABLE">&nbsp;&nbsp; </td>
          <td class="MYTABLE" align="middle"><input type="text" name="phone1" id="phone1" value="" onkeyup="searchSuggest(this.id)" autocomplete="off" title="Enter customer phone number and click search button" align="middle"/></td>
          <td class="MYTABLE" width="100" align="middle" ><select id="selected_sender" name="selected_sender" value="" title="select the customer and click go button" >
          <option value="0" >Select Sender</option>
              <?php
				 if (array_key_exists('custid', $_SESSION))
					{
					$count=sizeof($_SESSION['custid']);
					//echo "count=".$count;
					 
					for($i=0;$i<$count;$i++)
						{   
						  $senderid= $_SESSION['custid'][$i][0];
						  $sendername=$_SESSION['custid'][$i][1];
						  
						//  echo"<option value= '$Sreceiver_firstname'> $Sreceiver_firstname</option>";
						  echo"<option value= $senderid> $sendername</option>";
						}
									
					unset($_SESSION['custid']);
					}
		            
		 ?>
            </select>            </td>
            <td class="MYTABLE" colspan="2" align="middle"><center>
            <input type="button" size="4" name="go_btn" id="go_btn" value="Go" onclick="getSender();" />
          </center></td>
          <td width="167" class="MYTABLE" align="middle"><a href="register.php"><a href="register.php"><img alt="NEW USER" src="/ANP/img/button.jpg" height="20px" border="none" onclick="register.php" title="click here to register new user"/></a></td>
        </tr>
        <tr class="MYTABLE" valign="top">
          <td class="MYTABLE"></td>
          <td class="MYTABLE">&nbsp;&nbsp; </td>
          <td class="MYTABLE"><div id="firstname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></td>
          <td class="MYTABLE"><div id="lastname_suggest" style="position:absolute; z-index:2;  text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></td>
          <td class="MYTABLE"></td>
          <td class="MYTABLE"><div id="phone1_suggest" style="position:absolute; z-index:2;  text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></td>
          <td class="MYTABLE"></td>
        </tr>
        <tr class="MYTABLE">
          <td class="MYTABLE"><center>
          </center></td>
          <td class="MYTABLE"></td>
          <td class="MYTABLE"></td>
          <td class="MYTABLE"><center>
              <input type="SUBMIT" name="search" id="search" value="Search"/>
          </center></td>
          <td class="MYTABLE"></td>
          <td class="MYTABLE"></td>
          <td class="MYTABLE"><center>
          </center></td>
        </tr>
      </table>
  </FORM>
</div>
  
<!--*************************** END OF SEARCH**************************-->
<!--*************************** START SENDER INFO**************************-->

<div align="CENTRE" style="margin-top:10px;">
<TABLE WIDTH="60%" HEIGHT="60%" ALIGN="CENTER">
<FORM  NAME="f1" id="f1" ACTION="transactions.php" METHOD="POST">
<TR>
<TD ALIGN="LEFT">
  <table width="50%" class="MYTABLE">
    <CAPTION class="MYTABLE">
     Sender Info
    </CAPTION>
    <tr class="MYTABLE">
    <td colspan="4">&nbsp;</td>
        </tr>
        <tr class="MYTABLE">
    <tr class="MYTABLE">
      <td width="112" class="MYTABLE"></td>
      <td width="143" align="right"  class="MYTABLE"><label class="MYTABLE">CustId</label></td>
      <td width="32"></td>
      <td width="291"><input type="text" name="custid" id="custid" value="<?php echo $userid;?>"  onFocus="this.disabled=true" AUTOCOMPLETE="off" title="Not editable"/></td>
    </tr>
      <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Gender*</label></td>
      <td></td>
      <td align="left">M<input type="radio" name="gender" id="gender" value="M" <?php if ($gender == 'M') {echo 'checked';}?> />
                       F<input type="radio" name="gender" id="gender" value="F" <?php if ($gender == 'F'){ echo 'checked';}?> />
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">First Name*</label></td>
       <td></td>
      <td align="left"><input type="text" name="firstname" id="firstname" value="<?php echo $firstname;?> " onkeyup="searchSuggest(this.id)" autocomplete="off" /></td>
    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
     
      <div id="firstname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"</div> 
      </td>   
     </tr>
    
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Middle Name</label></td>
       <td></td>
      <td align="left"><input type="text" name="middlename" id="middlename" value="<?php echo $middlename;?>" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Last Name*</label></td>
       <td></td>
      <td align="left"><input type="text" name="lastname" id="lastname" value="<?php echo $lastname;?>"/></td>
    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
      <div id="lastname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
 
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">AddressLine1*</label></td>
       <td></td>
      <td align="left"><input type="text" name="address1" id="address1" value="<?php echo $address1?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">address2</label></td>
       <td></td>
      <td align="left"><input type="text" name="address2" id="address2" value="<?php echo $address2;?>"/></td>
    </tr>
    <tr class="MYTABLE" valign="bottom">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">City*</label></td>
       <td></td>
      <td align="left">
       <input type="text" name="city" id="city" value="<?php echo $city;?>" onkeyup="searchSuggest(this.id)" autocomplete="off" />
      </td>
      <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
      <div id="city_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
    
    <tr class="MYTABLE" valign="bottom">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Province*</label></td>
       <td></td>
      <td align="left"><input type="text" name="province" id="province" value="<?php echo $province;?>" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
    </tr>
    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
      <div id="province_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Country*</label></td>
       <td></td>
      <td align="left"><input type="text" name="country" id="country" value="<?php echo $country;?>" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
    </tr>

    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
      <div id="country_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">PostalCode*</label></td>
       <td></td>
      <td align="left"><input type="text" name="postalcode" id="postalcode" value="<?php echo $postalcode;?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Phone1*</label></td>
       <td></td>
      <td align="left"><input type="text" name="phone1" id="phone1" value="<?php echo $phone1;?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Phone2</label></td>
       <td></td>
      <td align="left"><input type="text" name="phone2" id="phone2" value="<?php echo $phone2;?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"> <label class="MYTABLE">Email</label></td>
       <td></td>
      <td><input type="text" name="email" id="email" value="<?php echo $email;?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE"> SSN/DL*</label></td>
       <td></td>
      <td><input type="text" name="pid" id="pid" value="<?php echo $pid;?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">PhotoId</label></td>
       <td></td>
      <td><input type="FILE" name="photoid" id="photoid" value=""/></td>
    </tr>
    <tr class="MYTABLE" height="40px">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"></td>
      <td></td>  
      <td><label>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="button"  name="modify" id="modify" value="Modify" onClick="changeSenderInfo(this.form); " title="Do not click unless you want to change the information in the database"/></td>
    </tr>
  </table>
  </TD>

  <TD ALIGN="RIGHT">
<!--***********************************************Receiver Info*********************************************-->
  <table width="300" class="MYTABLE">
    <CAPTION class="MYTABLE">
     Receiver Info
    </CAPTION>
    <tr class="MYTABLE"><td colspan="4">&nbsp;</td>
        </tr>
        <tr class="MYTABLE">
    <tr class="MYTABLE">
      <td width="71" class="MYTABLE"></td>
      <td width="138" align="right"  class="MYTABLE"><label class="MYTABLE">Receiver</label></td>
      <td width="37">&nbsp;</td>
      <td width="332" align="left">
       <!-- <SELECT NAME ="receiver" id="receiver" STYLE = "width: 100" onchange="recSuggest(this.id)"> -->
        
 <SELECT NAME ="receiver" id="receiver" STYLE = "width: 100" value="" onChange="recSuggest(this.id)">
  <option value="SEARCH">Select Receiver</option>
 
 <?PHP	
 	 if($numrows1!=0)
	  {
	    while($row1=mysql_fetch_array($result1))
		{   
		  $Zreceiver_firstname= $row1[0];
		  $Ztransactionid=$row1[1];
		  
		//  echo"<option value= '$Sreceiver_firstname'> $Sreceiver_firstname</option>";
		  echo"<option value= $row1[1]> $Zreceiver_firstname</option>";
		}
	  }
?>	  
  </SELECT>
      
    
                
      <div id="receiver_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
	  </td>
      
      <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Gender*</label></td>
      <td></td>
      <!--<td align="left">M<input type="radio" name="gender" id="gender" value="M"/>
                      F<input type="radio" name="gender" id="gender" value="F"/></td>-->

      <td align="left">M<input type="radio" name="receiver_gender" id="receiver_gender1" value="M" />
                       F<input type="radio" name="receiver_gender" id="recceiver_gender2" value="F" />                 
    </td>                   
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">First Name*</label></td>
       <td></td>
      <td align="left"><input type="text" name="receiver_firstname" id="receiver_firstname" value="<?php echo $receiver_firstname;?> " onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>      
    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
      <div id="receiver_firstname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
    
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Middle Name</label></td>
       <td></td>
       <td align="left"><input type="text" name="receiver_middlename" id="receiver_middlename" value="<?php echo $receiver_middlename;?>" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Last Name*</label></td>
       <td></td>
       <td align="left"><input type="text" name="receiver_lastname" id="receiver_lastname" value="<?php echo $receiver_lastname;?>" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
      <div id="receiver_lastname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
 
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">AddressLine1*</label></td>
       <td></td>
      <td align="left"><input type="text" name="receiver_address1" id="receiver_address1" value="<?php echo $receiver_address1?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">address2</label></td>
       <td></td>
            <td align="left"><input type="text" name="receiver_address2" id="receiver_address2" value="<?php echo $receiver_address2?>"/></td>
    </tr>
    <tr class="MYTABLE" valign="bottom">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">City*</label></td>
       <td></td>
      <td align="left">
     <input type="text" name="receiver_city" id="receiver_city" value="<?php echo $receiver_city;?>" onkeyup="searchSuggest(this.id)" autocomplete="off" />      </td>
      <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
      <div id="receiver_city_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
    
    <tr class="MYTABLE" valign="bottom">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Province*</label></td>
       <td></td>
      <td align="left"><input type="text" name="receiver_province" id="receiver_province" value="<?php echo $receiver_province;?>" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
    </tr>
    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
      <div id="receiver_province_suggest" style="position:absolute;left:auto; z-index:2; width:100%; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Country*</label></td>
       <td></td>
   <td align="left"><input type="text" name="receiver_country" id="receiver_country" value="<?php echo $receiver_country;?>" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
    </tr>
    <tr class="MYTABLE" valign="top">
      <td align="right" class="MYTABLE"></td>
      <td></td>
      <td></td>
     <td align="left">
      <div id="receiver_country_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">PostalCode*</label></td>
       <td></td>
   <td align="left"><input type="text" name="receiver_postalcode" id="receiver_postalcode" value="<?php echo $receiver_postalcode;?>" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>

    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Phone1*</label></td>
       <td></td>
      
   <td align="left"><input type="text" name="receiver_phone1" id="receiver_phone1" value="<?php echo $receiver_phone1;?>" /></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Phone2</label></td>
       <td></td>
   <td align="left"><input type="text" name="receiver_phone2" id="receiver_phone2" value="<?php echo $receiver_phone2;?>" /></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"> <label class="MYTABLE">Email</label></td>
       <td></td>
<td align="left"><input type="text" name="receiver_email" id="receiver_email" value="<?php echo $receiver_email;?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE" align="left"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE"> SSN/DL</label></td>
       <td></td>
      <td align="left"><input type="text" name="receiver_pid" id="receiver_pid" value="<?php echo $receiver_pid;?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE" align="left"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">PhotoId</label></td>
       <td></td>
            <td><input type="FILE" name="receiver_photoid" id="receiver_photoid" value="<?php echo $receiver_photoid;?>"/></td>
    </tr>
    <tr class="MYTABLE" height="40px">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"></td>
      <td></td>  
      <td><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
    </tr>
  </table>
</TD>
</TR>
</TABLE>
</div>

<!--***********************************************************************ENDOF RECEIVER DETAILS*****************************************************************
*******************************************************************START OF MONEY MATTERS********************************************************************-->
<!--<head>
<script language="JavaScript" type="text/javascript" src="ajax_suggestb.js"></script>
</head>-->
<div align="CENTRE" style="margin-top:10px;">
<table class="MYTABLE" width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr class="MYTABLE"> </tr>
  <tr class="MYTABLE">
    <td>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td class="MYTABLE" width="">Amount to send:
      <input type="text" name="money" id="money" size="30"  onblur ="check();" title="enter the amount you want to send"/></td>
    <td class="MYTABLE" width="" rowspan="3"><table width="352" border="0" cellspacing="0" cellpadding="0">
      <tr><td><div name="trans_display" id="trans_display" style="visibility:hidden" ><?php
	  if($userid !=0||$userid !="")
	  {
	       $q="select max(n_transc) from transactions where userid=$userid";
		  
		   $res=mysql_query($q);
		    $n_rows = mysql_num_rows($result);
			if($n_rows >0)
			{
				
				while($rows=mysql_fetch_array($res))
				{
					$trans_num=$rows[0]+1;
					
				}
				
			}
			else
			$trans_num=1;
			 echo "<input type='hidden' name='trans' id='trans' value=$trans_num/>";
             echo "<FONT COLOR='GREEN'>User Transaction Number: <label for='trans'>$trans_num</label></FONT>";
			
		}
		?>
        </div>
         </td> </tr>
		 
      <tr class="MYTABLE" height="60">
        <td class="MYTABLE" align="left" valign="bottom">Select  City: &nbsp;
          <input name="citi" type="text"  id="citi" onkeyup="citySuggest()" onchange="" onblur="displayTrans();" autocomplete="off"  title="select the place you want to send the money and click on GO button"/>
         
              
            &nbsp;&nbsp; <input type="button" size="4" name="btn" id="btn" value="Go"  onclick="getAmount()"/>        </td>
      </tr>
      <tr>
        <td align="left" valign="top"><div id="citisuggest" style=" z-index:2; margin-left:125px; width:140px; overflow: auto; text-align:center;background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></td><td></td>
        <p></p>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr class="MYTABLE">
        <td class="MYTABLE" height="111" valign="top"><!--MONEY RESULT -->
              <div id="result" name="result">
                <table width="" valign="middle">
                  <tr>
                    <td width="" align="right"> Amount Converted:</td>
                          
                    <td width="" align="center"><input type="text" name="cvt" id="cvt" value="" />
                      &nbsp;
                      <input type="text" size="6" name="currency" id="currency" value="" />
                      &nbsp;&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp; Amount  Sending:</td>
                    <td align="center"><input type="text" name="amt" id="amt" value="" />
                      &nbsp;
                      <input type="text" size="6" name="sender_currency" id="sender_currency" value="" />
                      &nbsp;&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      ANP Fees:</td>
                    <td align="left">&nbsp;<input type="text" name="fee" id="fee" value="" onblur="recalculate();"/>                </td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Grand Total:</td>
                    <td align="left"> &nbsp;<input type="text" name="grt" id="grt" value="" onblur="recalculate();"/>                    </td>
                  </tr>
                  <tr><td><input type="hidden" name="rate" id="rate" value="" /></td></tr>
                </table>
              </div>
          <!--END OF MONEY RESULT -->        </td>
      </tr>
    </table></td>
  </tr>
  <tr class="MYTABLE">
    <td class="MYTABLE" height="10" align="center"><div id="moneyalert" style="visibility:hidden" ><b><i>Your must type a valid amount</i></b></div></td>
  </tr>
  <!--if agent send large amount must give reason --->
  <tr>
    <td align="center" valign="top"><div  name="moneyEx" id="moneyEx" style="z-index:-3;visibility:hidden" > <span style="color:#F00; font-weight:bold">Amount exceeds $999.99.<br /> Please select a reason for sending money<br /> and type the client Id</span><br/>
            <?php
			$query = "Select reason FROM anp_reason ORDER BY reason";
			$result=mysql_query($query);
			if($result)
			{
				echo "<select name=\"reason\" id=\"reason\" >";
        		echo "<option value=\"0\">Choose A Reason</option>";
				while($rows=mysql_fetch_array($result))
				{
					echo "<option value='".$rows['reason']."'>".$rows['reason']."</option>";
				}
				echo "</select><br/><br/>";
			}
		?>
      Note<br/>
      <textarea name="exnote" rows="2" cols="40" title="Enter the message for receiver or delivery agent">
        </textarea>
    </div></td>
  </tr>
  <!-- this allow the admin to select the agent -->
  <tr>
    <td colspan="2" align="center" valign="top"><?php
   if(isset($_SESSION['loggedin']))
   		$username = $_SESSION['loggedin'];
	 	
   	$query ="SELECT staffid,level FROM staff WHERE username='$username'";
	$result = mysql_query($query);
    
	if($result)
	{
		$fields = mysql_fetch_assoc($result);
		$trans_booker=$fields["staffid"];
		$rank = $fields["level"];
		echo "<input type='hidden' name='trans_booker' id='trans_booker' value='".$trans_booker."'>";
        echo "rank is ".$rank;
		if($rank =="admin")
		{
			echo " <fieldset><legend>Agent Locator</legend><table width=\"620\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			echo "<td align=\"center\"><input name=\"agent\" type=\"text\" class=\"searchbox\" id=\"agent\" onKeyUp=\"searchAgent()\" autocomplete=\"off\" />";
			echo "<div id=\"search_agent\" style=\"z-index:2; width:200px; background-color:#FFFFFF; display:none; border:solid 1px #333333;\"></div> ";
			echo " </td></tr></table></fieldset>";
		}
		
	}
    ?></td>
  </tr>
  <tr class="MYTABLE" >
    <td  colspan="2" align="center"><input type="submit" name="submit1" id="submit1" align="left" value="Submit" onclick="return sender_check(this.form);" title="Please check the mandatory information of sender and receiver before you submit"/></td>
  </tr>
</table>
</TR>
</FORM>

</div>
</table>
<!--***************************************************************END OF ****************************************-->
<table align="center" class="footer"><tr><td><?PHP include "footer.html"; ?></td></tr></table>
</body>
</html>
<?php 
include('lib/closedb.php');
?>
