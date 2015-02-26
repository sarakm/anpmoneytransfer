<?php 
session_start();
include('lib/config.php');
include('lib/opendb.php');
 if (array_key_exists('custid', $_SESSION))
{
$custid=$_SESSION['custid'];
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

<SCRIPT language=JavaScript>

//function stateChanged()
//{
//if (xmlhttp.readyState==4)
//{
//var trn =  xmlhttp.responseText;
//
////alert (trn);
//
////document.getElementById('transactionid').innerHTML=xmlhttp.responseText;
//
//}
//}
//
//
//function getXmlHttpRequestObject() {
//	//alert("hi");
//	if (window.XMLHttpRequest) {
//		return new XMLHttpRequest();
//	} else if(window.ActiveXObject) {
//		return new ActiveXObject("Microsoft.XMLHTTP");
//	} else {
//		alert("Your browser doesn't support AJAX technology!");
//	}
//}
//
//function recSuggest(id) 
//{
//	var searchReq1 = getXmlHttpRequestObject();
//	//alert(document.getElementById(id).value);
//	
//	if (searchReq1.readyState == 4 || searchReq1.readyState == 0) 
//	{
//		var str = escape(document.getElementById(id).value);
//		//alert ( str );
//		if (str.length > 0)
//		{ //  alert("I am in if");
//			searchReq1.open("GET", 'receiverSuggest.php?transactionid=' + str, true);
//			alert("I am after open");
//			//searchReq.onreadystatechange = stateChanged;	
//		
//			searchReq1.send(null);
//				alert("I am after send");
//			if (searchReq1.readyState==4)
//			{
//			  //document.getElementById(id).innerHTML=searchReq.responseText;
//			  alert ("sender1"+searchReq1.responseText);
//			 // alert ("sender2"+document.getElementById(id).value);
//			  var str = searchReq1.responseText;
//			  alert (str);
//				
//		 		 }
//			}
//				
//				  
//				 }
//		}
//	
function goto(tid) 
{
			  alert ("i am in goto");
	var tcust = getXmlHttpRequestObject();
	
	if (tcust.readyState == 4 || tcust.readyState == 0) 
	{ 
	var sid= document.getElementById(tid).value;
	tcust.open("GET", 'receiverSuggest.php?transactionid=' + sid, true);
	alert ("before custsearch tid= "+sid);
	alert ("before custsearch send");
	tcust.send(sid);
	var str1=tcust.responseText;
	alert ("this is gotoresponse"+str1);
	}
}

</script>


</head>
<body>



<table  align="center" width="980" border="0" cellspacing="0" cellpadding="0" id="main" onclick="autoHide()">
<TD>
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
    <input type="text" name="custId" id="custId" value=""/>    </TD> 
    <TD CLASS="MYTABLE">&nbsp;&nbsp;  </TD>
    <TD CLASS="MYTABLE">
    <input type="text" name="firstname" id="firstname" value=""  onkeyup="searchSuggest(this.id)" autocomplete="off"/> </TD>
    <TD CLASS="MYTABLE">
    <input type="text" name="middlename" id="middlename" value=""/></TD>
    <TD CLASS="MYTABLE">
    <input type="text" name="lastname" id="lastname" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></TD>
    <TD CLASS="MYTABLE">&nbsp;&nbsp;  </TD>
    <TD CLASS="MYTABLE">
    <input type="text" name="phone" id="phone" value=""/></TD>
    <TD CLASS="MYTABLE">&nbsp;&nbsp; </TD>
    <TD CLASS="MYTABLE"><a href="register.html"><IMG ALT="NEW USER" src="/ANP/img/button.png" border="none" onclick="register.html"/></a></TD>
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
  <TR CLASS="MYTABLE"></TR>
</TABLE>
  </FORM>
<!--*************************** END OF SEARCH**************************-->
<!--*************************** START SENDER INFO**************************-->

<TABLE WIDTH="80%" HEIGHT="80%" ALIGN= "CENTER" >
<TR>
<TD ALIGN="LEFT">
<FORM  ACTION="transactions.php" METHOD="POST">
  <table width="400" class="MYTABLE">
    <caption class="MYTABLE">
     SENDER INFO
    </caption>
    <tr class="MYTABLE">
      <td width="112" class="MYTABLE"></td>
      <td width="143" align="right"  class="MYTABLE"><label class="MYTABLE">CustId</label></td>
      <td width="32"></td>
      <td width="291"><input type="text" name="custId" id="custId" value="<?php echo $_SESSION['custid'];?>"  onFocus="this.disabled=true"/></td>
    </tr>
      <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Gender*</label></td>
      <td></td>
      <td align="left">M<input type="radio" name="gender" id="gender" value="M"  <?php if ($gender == "M") echo "checked";?> />
                       F<input type="radio" name="gender" id="gender" value="F"  <?php if ($gender == "F") echo "checked";?> />
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
      <td><label>&nbsp;&nbsp;&nbsp;&nbsp;</label> <input type="submit"  name="SUBMIT" id="SUBMIT" value="SUBMIT" onClick= "return checkFields();"/></td>
    </tr>
  </table>
</FORM>
</TD>

<!--*************************** END OF SENDER**************************-->
<!--*************************** START RECEIVER**************************-->
<TD ALIGN="RIGHT">
<FORM  ACTION="custsearch.php" METHOD="POST">
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
        
 <SELECT NAME ="receiver" id="receiver" STYLE = "width: 100" value="<?php echo $_SESSION['transactionid'];?>" onChange=\"reload(this.form)\">
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
	  //echo "zzzzzzzz=".$Ztransactionid;
 //if(isset($Ztransactionid)&& ($Ztransactionid)!="")
 //if(isset($_SESSION['transactionid'])&& $_SESSION['transactionid']!="")
//{
	//$x=$Ztransactionid;
	$x=$_SESSION['transactionid'];
	$sql2 = "SELECT 
receiver_firstname,
receiver_middlename,
receiver_lastname,
receiver_gender,
receiver_address1,
receiver_address2,
receiver_city,
receiver_province,
receiver_country,
receiver_postalcode,
receiver_phone1,
receiver_phone2,
receiver_email
 FROM transactions where transactionid = $row1[1]";
 //.$_SESSION['transactionid'];
	  //receiver_PID_DLN
		
$result2 = mysql_query($sql2) or die(mysql_error());
$numrows2 = mysql_num_rows($result2);
if ($numrows2 != 0)
  {
   while($row2 = mysql_fetch_array($result2))
      {
           $receiver_firstname= $row2[0];
		   $receiver_middlename=$row2[1];
		   $receiver_lastname = $row2[2];
		   $receiver_gender   = $row2[3];
		   $receiver_address1= $row2[4];
		   $receiver_address2= $row2[5];
		   $receiver_city= $row2[6];
		   $receiver_province= $row2[7];
		   $receiver_country= $row2[8];
		   $receiver_postalcode= $row2[9];
		   $receiver_phone1= $row2[10];
		   $receiver_phone2= $row2[11]; 
		   $receiver_email= $row2[12];
		   //$receiver_pid= $row2[13];
		  // $receiver_photoid= $row2[15];
//		   $date= $row[16];
       }	
  }
	//	session_destroy();

//}
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

      <td align="left">M<input type="radio" name="gender" id="gender" value="M"  <?php if ($receiver_gender == "M") echo "checked";?> />
                       F<input type="radio" name="gender" id="gender" value="F"  <?php if ($receiver_gender == "F") echo "checked";?> />                 
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
      <div id="firstname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
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
      <div id="lastname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
      </td>   
     </tr>
 
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">AddressLine1*</label></td>
       <td></td>
      <td align="left"><input type="text" name="receiver_address1" id="address1" value="<?php echo $receiver_address1?>"/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">address2</label></td>
       <td></td>
            <td align="left"><input type="text" name="receiver_address2" id="address2" value="<?php echo $receiver_address2?>"/></td>
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
      <div id="city_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
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
      <div id="province_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
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
      <div id="country_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div> 
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
      <td><label>&nbsp;&nbsp;&nbsp;&nbsp;</label> <input type="submit"  name="SUBMIT" id="SUBMIT" value="SUBMIT" onClick= "return checkFields();"/></td>
    </tr>
  </table>
</FORM>
</TD>
</TR>
</TABLE>
</TABLE>
<!--***************************************************************END OF RECEIVER****************************************-->
</body>
</html>
