<?php 
session_start();
if(!isset($_SESSION["loggedin"]))
{
header("location:login.php");
exit;
} 
else
{  		
		
include('lib/config.php');
include('lib/opendb.php');
include('menu.html');
 if (array_key_exists('custid', $_SESSION))
{
$custid=$_SESSION['custid'];
$_SESSION['custid']="";
}
 if (array_key_exists('msg', $_SESSION))
{
echo $_SESSION['msg'];
$_SESSION['msg']="";
}
   if (array_key_exists('transactionid', $_SESSION))
 {
 //echo"transactionid=".$_SESSION['transactionid'];
 $Stransactionid=$_SESSION['transactionid']; 
 echo "SESSION transactionid=".$Stransactionid;
 }
if($custid!=NULL)
{
    $sql = "SELECT * FROM users where userid=$custid";
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
WHERE userid =$custid
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
<!--<script language="JavaScript" type="text/javascript" src="js/jsscript.js"></script>
--><SCRIPT language="JavaScript" type="text/javascript">

function getXmlHttpRequestObject() {
	//alert("hi");
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
//	alert("HI"+document.getElementById(id).value);
	
	if (searchReq1.readyState == 4 || searchReq1.readyState == 0) 
	{
		var str = escape(document.getElementById(id).value);
			searchReq1.open("GET", 'receiverSuggest.php?transactionid=' + str, true);
		//	alert("I am after open");

			searchReq1.send(null);
				alert("Searching receiver details");
			if (searchReq1.readyState==4)
			{
			  //document.getElementById(id).innerHTML=searchReq.responseText;
			 // alert ("sender1"+searchReq1.responseText);
			 
			var str1=searchReq1.responseText.split("\n");
		//	alert(str1);
			
		//	else if(str1[0]=='F')
		//	 document.forms[1].getElementById(gender[1]).checked;

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
			
			 //  alert("found details");
			  // alert("gender is  "+str1[0]); 
	             if (str1[0]=='M')
				 document.f1.receiver_gender[0].checked=true;
	//			document.forms[1].getElementById('receiver_gender1').checked;
		
				 else if (str1[0]=='F')
				document.f1.receiver_gender[1].checked=true;
			   
		 
			 		 
		
	}
				
		  
 }
}

function changeSenderInfo()
{
alert("in the modify");
//"return checkFields();
document.f1.action="modifySender.php";
document.f1.submit();
//alert("sent");
}

</script>


</head>
<body>





<!--<table  align="center" width="980" border="0" cellspacing="0" cellpadding="0" id="main" onclick="autoHide()">

<TD CLASS="MYTABLE">-->
<div align="CENTRE" style="margin-top:10px;">
    <FORM METHOD="POST" enctype="multipart/form-data" ACTION="custsearch.php">
    <TABLE align="center" CLASS="MYTABLE">
    
    <CAPTION CLASS="MYTABLE">SEARCH CUSTOMER</CAPTION>
    
       <TR CLASS="MYTABLE">
                
        <TD CLASS="MYTABLE"><center><label>CustId</label></center></TD>
        <TD CLASS="MYTABLE">&nbsp;&nbsp;</TD>
        <TD CLASS="MYTABLE">
            <center><label>First Name</label></center></TD>
        <TD CLASS="MYTABLE">
            <center><label>Middle Name</label></center></TD>
        <TD CLASS="MYTABLE">
            <center><label>Last Name</label></center></TD>
        <TD CLASS="MYTABLE">
             &nbsp;&nbsp;  </TD>
        <TD CLASS="MYTABLE">
            <center><label>Phone</label></center></TD>    
      </TR>
      <TR CLASS="MYTABLE" valign="bottom">
        <TD CLASS="MYTABLE">
        <input type="text" name="custId" id="custId" value="" AUTOCOMPLETE="off"/>    </TD> 
        <TD CLASS="MYTABLE">&nbsp;&nbsp;  </TD>
        <TD CLASS="MYTABLE">
        <input type="text" name="firstname" id="firstname" value=""  onkeyup="searchSuggest(this.id)" autocomplete="off"/> </TD>
        <TD CLASS="MYTABLE">
        <input type="text" name="middlename" id="middlename" value=""/></TD>
        <TD CLASS="MYTABLE">
        <input type="text" name="lastname" id="lastname" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></TD>
        <TD CLASS="MYTABLE">&nbsp;&nbsp;  </TD>
        <TD CLASS="MYTABLE">
        <input type="text" name="phone" id="phone" value="" AUTOCOMPLETE="off"/></TD>
        <TD CLASS="MYTABLE">&nbsp;&nbsp; </TD>
        <TD CLASS="MYTABLE"><a href="register.html"><IMG ALT="NEW USER" src="/ANP/img/button.png" border="none" onclick="register.php"/></a></TD>
      </TR>
     <TR CLASS="MYTABLE" VALIGN="top">
      <TD CLASS="MYTABLE"></TD> 
        <TD CLASS="MYTABLE">&nbsp;&nbsp;  </TD>
      <TD CLASS="MYTABLE"><div id="firstname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></TD>
      <TD CLASS="MYTABLE"></TD> 
      <TD CLASS="MYTABLE"><div id="lastname_suggest" style="position:absolute; z-index:2;  text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></TD>
      </TR>
      
      
      <TR CLASS="MYTABLE">
        <TD CLASS="MYTABLE"><center></center></TD>
        <TD CLASS="MYTABLE"></TD>
        <TD CLASS="MYTABLE"></TD>
        <TD CLASS="MYTABLE"><center>
          <input type="SUBMIT" name="search" id="search" value="SEARCH"/>
        </center></TD>
        <TD CLASS="MYTABLE"></TD>
        <TD CLASS="MYTABLE"></TD>
        <TD CLASS="MYTABLE"><center></center></TD>
      </TR>
     
    </TABLE>
      </FORM>
</div>
  
<!--*************************** END OF SEARCH**************************-->
<!--*************************** START SENDER INFO**************************-->
<div align="CENTRE" style="margin-top:10px;">
<FORM  NAME="f1" ACTION="transactions.php" METHOD="POST">
<TABLE WIDTH="80%" HEIGHT="80%" ALIGN= "CENTER" >
<TR>
<TD ALIGN="LEFT">
  <table width="400" class="MYTABLE">
    <CAPTION class="MYTABLE">
     SENDER INFO
    </CAPTION>
    <tr class="MYTABLE">
      <td width="112" class="MYTABLE"></td>
      <td width="143" align="right"  class="MYTABLE"><label class="MYTABLE">CustId</label></td>
      <td width="32"></td>
      <td width="291"><input type="text" name="custId" id="custId" value="<?php echo $custid;?>"  onFocus="this.disabled=true" AUTOCOMPLETE="off"/></td>
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
      <td align="left"><input type="text" name="firstname" id="firstname" value="<?php echo $firstname;?> " onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
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
      <td align="right" class="MYTABLE"><label class="MYTABLE"> SSN/DL</label></td>
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
      <td><label>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="button"  name="modify" id="modify" value="MODIFY" onClick="Javascript:changeSenderInfo(); "/></td>
    </tr>
  </table>
  </TD>

  <TD ALIGN="RIGHT">

  <table width="400" class="MYTABLE">
    <CAPTION class="MYTABLE">
     RECEIVER INFO
    </CAPTION>
    <tr class="MYTABLE">
      <td width="71" class="MYTABLE"></td>
      <td width="138" align="right"  class="MYTABLE"><label class="MYTABLE">RECEIVER</label></td>
      <td width="37">&nbsp;</td>
      <td width="332">
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
      <div id="receiver_province_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
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
<td><input type="text" name="receiver_email" id="receiver_email" value="<?php echo $receiver_email;?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE"> SSN/DL</label></td>
       <td></td>
      <td><input type="text" name="receiver_pid" id="receiver_pid" value="<?php echo $receiver_pid;?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
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
<table class="MYTABLE" width="895" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr class="MYTABLE"> </tr>
  <tr class="MYTABLE">
    <td>&nbsp;&nbsp;</td>
  </tr>
  <TR><td class="MYTABLE" width="">Amount to send:
    <input type="text" name="money" id="money" size="30"  onblur ="checkAmount();"/></td>
      <td class="MYTABLE" width="" rowspan="3"><table width="352" border="0" cellspacing="0" cellpadding="0">
          <tr>
            
          </tr>
          <tr class="MYTABLE">
            <td class="MYTABLE" height="36">	
            <!--need to change city name -->
            <input name="citi" type="text"  id="citi" onKeyUp="citySuggest()" onchange="checkAmount();" onblur="checkAmount();" autocomplete="off" />
         <div id="citisuggest" style=" z-index:2; margin-left:95px; width:140px; background-color:#FFFFFF; display:none;border:solid 1px #333333;"></div>        </td>
          <tr class="MYTABLE">
            <td class="MYTABLE" height="111" valign="top">
            
            <!--MONEY RESULT -->
                <div id="result" name="result"> </div>
              <!--END OF MONEY RESULT -->            </td>
          </tr>
      </table>      </td>
  </tr>
  <tr class="MYTABLE">
    <td class="MYTABLE" height="10" align="center"><div id="moneyalert" style="visibility:hidden"><b><i>Your must type a valid amount</i></b></div></td>
  </tr>
  
  <!--if agent send large amount must give reason --->
   <tr>
    <td align="center" valign="top">
    
    <div  name="moneyEx" id="moneyEx" style="visibility:hidden" >
    	<span style="color:#F00; font-weight:bold">Ops, You are about the send a large amount of money the exceeds the 999.99 dollars, please give us a reason of the money and type the clien id</span><br/>
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
        <textarea name="exnote" rows="2" cols="40">
        </textarea>
    </div>    </td>
  </tr>
 <!-- this allow the admin to select the agent -->
    <tr>
    <td colspan="2" align="center" valign="top">
   <?php
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
			echo " <fieldset><legend>Agent Locator</legend><table width=\"620\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			echo "<td align=\"center\"><input name=\"agent\" type=\"text\" class=\"searchbox\" id=\"agent\" onKeyUp=\"searchAgent()\" autocomplete=\"off\" />";
			echo "<div id=\"search_agent\" style=\"z-index:2; width:200px; background-color:#FFFFFF; display:none; border:solid 1px #333333;\"></div> ";
			echo " </td></tr></table></fieldset>";
		}
		
	}
    ?></td>
    </tr>
    <tr class="MYTABLE" ><td></td>
    <td ><input type="submit" name="submit" id="submit" align="left" value="SUBMIT"/></td></tr>
</table>
</TR>
</FORM>

</div>
<!--***************************************************************END OF ****************************************-->

</body>
</html>
<?php 
}
?>
