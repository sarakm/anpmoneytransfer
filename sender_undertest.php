<?php 
session_start();
include('lib/config.php');
include('lib/opendb.php');
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
<meta name="author" content="" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta name="description" content="Money Transfer in toronto canada" />
<meta name="keywords" content=" toronto,canada" />
<link href='style/style.css' rel='stylesheet' type='text/css' />
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>
<script language="Javascript" src="jsscript.js"></

<SCRIPT language="JavaScript" type="text/javascript">

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
{   alert("i am in recSuggest");
	var searchReq1 = getXmlHttpRequestObject();
	alert("Hi" +document.getElementById(id).value);
	
	if (searchReq1.readyState == 4 || searchReq1.readyState == 0) 
	{
		var str = escape(document.getElementById(id).value);
		alert ( str );
		if (str!= 0)
		{   alert("I am in if");
			searchReq1.open("GET", 'receiverSuggest.php?transactionid=' + str, true);
			alert("I am after open");
			//searchReq.onreadystatechange = stateChanged;	
		
			searchReq1.send(null);
				alert("I am after send");
			if (searchReq1.readyState==4)
			{
			  //document.getElementById(id).innerHTML=searchReq.responseText;
			 // alert ("sender1"+searchReq1.responseText);
			 
			var str1=searchReq1.responseText.split("\n");
			alert("this is response"+str1);
			
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
			
			   //alert("checking gender");
//	             if (str1[0]=='M')
//				document.forms[1].getElementById('receiver_gender1').checked;
//				 else if (str1[0]=='F')
//				document.forms[1].getElementById('receiver_gender2').checked;
//			    
		 
			 		 
		 }
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



<table  align="center" width="980" border="0" cellspacing="0" cellpadding="0" id="main" onclick="autoHide()">
<TD>
<div align="CENTRE" style="margin-top:10px;">
<FORM METHOD="POST" enctype="multipart/form-data" ACTION="custsearch.php">
  <table align="center" class="MYTABLE">
    <caption class="MYTABLE">
      SEARCH CUSTOMER
      </caption>
    <tr class="MYTABLE">
      <td class="MYTABLE"><center>
        <label>CustId</label>
      </center></td>
      <td class="MYTABLE">&nbsp;&nbsp;</td>
      <td class="MYTABLE"><center>
        <label>First Name</label>
      </center></td>
      <td class="MYTABLE"><center>
        <label>Middle Name</label>
      </center></td>
      <td class="MYTABLE"><center>
        <label>Last Name</label>
      </center></td>
      <td class="MYTABLE">&nbsp;&nbsp; </td>
      <td class="MYTABLE"><center>
        <label>Phone</label>
      </center></td>
    </tr>
    <tr class="MYTABLE" valign="bottom">
      <td class="MYTABLE"><input type="text" name="custId" id="custId" value=""onkeyup="searchSuggest(this.id)" autocomplete="off" />
      </td>
      <td class="MYTABLE">&nbsp;&nbsp; </td>
      <td class="MYTABLE"><input type="text" name="firstname" id="firstname" value=""  onkeyup="searchSuggest(this.id)" autocomplete="off"/>
      </td>
      <td class="MYTABLE"><input type="text" name="middlename" id="middlename" value=""/></td>
      <td class="MYTABLE"><input type="text" name="lastname" id="lastname" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
      <td class="MYTABLE">&nbsp;&nbsp; </td>
      <td class="MYTABLE"><input type="text" name="phone" id="phone" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
      <td class="MYTABLE">&nbsp;&nbsp; </td>
      <td class="MYTABLE"><a href="register.html"><img alt="NEW USER" src="/ANP/img/button.png" border="none" onclick="register.html"/></a></td>
    </tr>
    <tr class="MYTABLE" valign="top">
      <td class="MYTABLE"><div id="custid_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></td>
      <td class="MYTABLE">&nbsp;&nbsp; </td>
      <td class="MYTABLE"><div id="firstname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></td>
      <td class="MYTABLE"></td>
      <td class="MYTABLE"><div id="lastname_suggest" style="position:absolute; z-index:2;  text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></td>
       <td class="MYTABLE">&nbsp;&nbsp; </td>
      <td class="MYTABLE"><div id="phone_suggest" style="position:absolute; z-index:2;  text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"><center>
      </center></td>
      <td class="MYTABLE"></td>
      <td class="MYTABLE"></td>
      <td class="MYTABLE"><center>
          <input type="SUBMIT" name="search" id="search" value="SEARCH"/>
      </center></td>
      <td class="MYTABLE"></td>
      <td class="MYTABLE"></td>
      <td class="MYTABLE"><center>
      </center></td>
    </tr>
    <tr class="MYTABLE"></tr>
  </table>
</FORM>
<!--*************************** END OF SEARCH**************************-->
<!--*************************** START SENDER INFO**************************-->

<TABLE WIDTH="80%" HEIGHT="80%" ALIGN= "CENTER" >
<TR>
<TD ALIGN="LEFT">
<FORM  NAME="f1" ACTION="transactions.php" METHOD="POST">
  <table width="400" class="MYTABLE">
    <caption class="MYTABLE">
     SENDER INFO
    </caption>
    <tr class="MYTABLE">
      <td width="112" class="MYTABLE"></td>
      <td width="143" align="right"  class="MYTABLE"><label class="MYTABLE">CustId</label></td>
      <td width="32"></td>
      <td width="291"><input type="text" name="custId" id="custId" value="<?php echo $custid;?>"  onFocus="this.disabled=true"/></td>
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
      <div id="firstname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
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
</FORM>
</TD>

<!--*************************** END OF SENDER**************************-->
<!--*************************** START RECEIVER**************************-->
<TD ALIGN="RIGHT">
<FORM  ACTION="" METHOD="POST">
  <table width="400" class="MYTABLE">
    <caption class="MYTABLE">
     RECEIVER INFO
    </caption>
    <tr class="MYTABLE">
      <td width="71" class="MYTABLE"></td>
      <td width="138" align="right"  class="MYTABLE"><label class="MYTABLE">RECEIVER</label></td>
   <!--   <td width="32"><input type="hidden" name="custid" id="custid" value="1"/></td>-->
      <td width="37">&nbsp;</td>
      <td width="332">
       <!-- <SELECT NAME ="receiver" id="receiver" STYLE = "width: 100" onchange="recSuggest(this.id)"> -->
       <select name ="receiver" id="receiver" style = "width: 100" value="" onchange="recSuggest(this.id)">
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
       </select>
       <div id="receiver_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div>	  </td>
      <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Gender*</label></td>
      <td></td>
      <!--<td align="left">M<input type="radio" name="gender" id="gender" value="M"/>
                      F<input type="radio" name="gender" id="gender" value="F"/></td>-->

      <td align="left">M<input type="radio" name="receiver_gender" id="receiver_gender1" value="M" />
                       F<input type="radio" name="receiver_gender" id="recceiver_gender2" value="F" />    </td>                   
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
      <div id="firstname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div>      </td>   
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
      <div id="lastname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div>      </td>   
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
      <div id="city_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div>      </td>   
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
      <div id="province_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div>      </td>   
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
      <div id="country_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div>      </td>   
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
      <td><label>&nbsp;&nbsp;&nbsp;&nbsp;</label> <input type="submit"  name="SUBMIT" id="SUBMIT" value="SUBMIT" onClick= "return checkFields();"/></td>
    </tr>
  </table>

</TD>
</TR>

<!--***********************************************************************ENDOF DETAILS***********************************************************************
*******************************************************************START OF MONEY MATTERS********************************************************************-->
<TR><TD>&nbsp;&nbsp;</TD></TR>
<TR class="MYTABLE">
<table class="MYTABLE" width="895" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr class="MYTABLE"> </tr>
  <tr class="MYTABLE">
    <td>&nbsp;&nbsp;</td>
  </tr>
  <td class="MYTABLE" width="">Amount to send:
    <input type="text" name="money" id="money" size="30" onkeyup="doThis(this.value);" onblur ="doThis(this.value);"/></td>
      <td class="MYTABLE" width="" rowspan="3"><table width="352" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="MYTABLE"><b>Please choose the country &amp; city to where you would like to send this amount</b></td>
          </tr>
          <tr class="MYTABLE">
            <td class="MYTABLE" height="36"><select name="country2" onchange="getCity(this.value)">
              <option value="0" selected>SELECT a Country</option>
              <?php
        $query = "SELECT DISTINCT country FROM staff";
        $result=mysql_query($query);
        if($result)
        {
            while($row=mysql_fetch_array($result))
            {
                echo "<option value=".$row['country'].">".$row['country']."</option>";
            }
        }
        ?>
            </select></td>
          </tr>
          <tr class="MYTABLE">
            <td class="MYTABLE"><div name="cityDrop" id="cityDrop" style="visibility:hidden">
              <select id="city2" name="city2">
              </select>
            </div></td>
          </tr>
          <tr class="MYTABLE">
            <td class="MYTABLE" height="111" valign="top"><!--MONEY RESULT -->
                <div id="result" name="result"> </div>
              <!--END OF MONEY RESULT -->            </td>
          </tr>
      </table></td>
  </tr>
  <tr class="MYTABLE">
    <td class="MYTABLE" height="10" align="center"><div id="moneyalert" style="visibility:hidden"><b><i>Your must type a valid amount</i></b></div></td>
  </tr>
  <tr class="MYTABLE">
    <td align="center" valign="top" class="MYTABLE"><div  name="moneyEx" id="moneyEx" style="visibility:hidden" > <span style="color:#F00; font-weight:bold">Ops, You are about the send a large amount of money the exceeds the 999.99 dollars, please give us a reason of the money and type the clien id</span><br/>
        <textarea name="reason" rows="5" cols="40">
        </textarea>
    </div></td>
  </tr>
</table>
</FORM>
<!--***************************************************************END OF ****************************************-->

</table>
</body>
</html>
