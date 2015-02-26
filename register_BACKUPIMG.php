<?php
session_start();
/*This is customer registration page. This will insert user information in users table in 
ANB database. Upon successful insertion, this will lead to  trnsactionStart.html*/

include('lib/config.php');
include('lib/opendb.php');
include('menu.html');
 if(isset($_POST['SUBMIT'])){

$gender=htmlspecialchars($_REQUEST['gender']);
$firstname=htmlspecialchars($_REQUEST['firstname']);
$middlename=htmlspecialchars($_REQUEST['middlename']);
$lastname=htmlspecialchars($_REQUEST['lastname']);
$address1=htmlspecialchars($_REQUEST['address1']);
$address2=htmlspecialchars($_REQUEST['address2']);
$city=htmlspecialchars($_REQUEST['city']);
$province=htmlspecialchars($_REQUEST['province']);
$country=htmlspecialchars($_REQUEST['country']);
$postalcode=htmlspecialchars($_REQUEST['postalcode']);
$phone1=htmlspecialchars($_REQUEST['phone1']);
$phone2=htmlspecialchars($_REQUEST['phone2']);
$email=htmlspecialchars($_REQUEST['email']);
$pid=htmlspecialchars($_REQUEST['pid']);
$photoid=htmlspecialchars($_REQUEST['photoid']);

if(!isset($firstname) || !isset($lastname) || !isset($gender)||!isset($address1)|| !isset($city)||!isset($province) || !isset($country) ||!isset($phone1) )
{ $msg= " Required fields missing. Please enter fields with * mark";
   echo $msg;
   include("register.html");
   exit;
 }
else
{
   
	 $s = "SELECT * FROM users where ((UPPER(firstname)=UPPER('$firstname')) && (UPPER(lastname)=UPPER('$lastname')))";


     $res = mysql_query($s) or die(mysql_error());
     $n = mysql_num_rows($res);
if ($n != 0)
{            echo"User already exists!";
			 include("register.html");
			 exit;
}		
else
{

$sql="INSERT INTO USERS(firstname,middlename,lastname,gender,address1,address2,city,province,country,postalcode,phone1,phone2,email,PID_DLN,identification,date)
      VALUES('$firstname','$middlename','$lastname','$gender','$address1','$address2','$city','$province','$country','$postalcode','$phone1','$phone2','$email','$pid','$photoid',CURDATE())";
     $result = mysql_query($sql) or die(mysql_error());
//$numrows = mysql_num_rows($result);
 $insert_id = mysql_insert_id();
			// echo $insert_id;
    if($insert_id != NULL)
	  {			 
             $_SESSION['custid']=$insert_id;
 			 $_SESSION['firstname']=$firstname;
			 $_SESSION['lastname']=$lastname;
			 
			 $_SESSION['msg']="Registration Successful";
			// echo $msg;
			 //include("sender.php");
			 header("location:sender.php");
			 exit;
		}
			 include('lib/closedb.php');
			 
}
}
}
else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ANP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="" />
<meta name="description" content="Money Transfer in toronto canada" />
<meta name="keywords" content=" toronto,canada" />
<link href='style/style.css' rel='stylesheet' type='text/css' />
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>

<script language="javascript">
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function trim(s)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ") returnString += c;
    }
    return returnString;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
var bracket=3;
strPhone=trim(strPhone);
if(strPhone.indexOf("+")>1) return false
if(strPhone.indexOf("-")!=-1)bracket=bracket+1
if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false
var brchr=strPhone.indexOf("(")
if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false
if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false
s=stripCharsInBag(strPhone,validWorldPhoneChars);
return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}

function ValidateForm(){
	var phone = document.getElementById('phone1').value;

  if (checkInternationalPhone(phone)==false){
		alert("Please Enter a Valid Phone Number")
		phone.value=""
		document.getElementById('phone1').focus()
		return false
	}
	else
	return true
 }


function echeck(str)
{
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		
		if (str.indexOf(at)==-1){
		   //alert("Invalid E-mail ID")
		   return false;
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   //alert("Invalid E-mail ID")
		   return false;
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    //alert("Invalid E-mail ID")
		    return false;
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    //alert("Invalid E-mail ID")
		    return false;
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    //alert("Invalid E-mail ID")
		    return false;
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    //alert("Invalid E-mail ID")
		    return false;
		 }
	 
		 if (!( str.substring(ldot+1).length > 1)){
		    //alert("Invalid E-mail ID")
		    return false;
		 }
		
		 if (str.indexOf(" ")!=-1){
		    //alert("Invalid E-mail ID")
		    return false;
		 }

 		 return true;					
}

function load_image()
{
var imgpath = document.getElementById('photoid').value;

if(imgpath != "")
{
// code to get File Extension..
var arr1 = new Array;
arr1 = imgpath.split("\\");
alert(arr1);
var len = arr1.length;
var img1 = arr1[len-1];
var filext = img1.substring(img1.lastIndexOf(".")+1);
// Checking Extension
if(filext == "jpg" || filext == "jpeg" || filext == "gif" || filext == "bmp")
{document.getElementById('photoid').value = imgpath;
return true;
}
else
{
alert("Invalid File Format Selected");
document.getElementById('photoid').value = "";
return false;
}

}

}


function checkFields()
{
////	alert("msg");
//var pass = document.getElementById('password').value;
var firstname = document.getElementById('firstname').value;
var lastname = document.getElementById('lastname').value;
var address1 = document.getElementById('address1').value;
var city = document.getElementById('city').value;
var email = document.getElementById('email').value;
var postalcode = document.getElementById('postalcode').value;
var province = document.getElementById('province').value;
var Country = document.getElementById('country').value;
var phone1 = document.getElementById('phone1').value;
var email = document.getElementById('email').value;
//var photoid = document.getElementById('photoid').value;
////var captcha = document.getElementById('captcha').value;
alert("I am in");

    if(!(document.forms[0].gender[0].checked||document.forms[0].gender[1].checked))
	{
        alert("Please select gender");
		return false;
    }
	if (firstname.length < 3)
	{
		alert("Firstname must be 3 or more characters ");
		return false;
	}
	if (lastname.length < 2)
	{
		alert("Lastname must be 2 or more characters ");
		return false;
	}
	if (firstname==lastname)
	{
		alert("firstname cannot be same as lastname");
	    return false;
	}
	   if (address1.length < 5)
	{
		alert("Proper address required! ");
		return false;
	}
   if (city.length == 0||city.length<3)
	{
		alert("Proper city name required! ");
		return false;
	}
	if (province.length == 0||province.length<2 )
	{
		alert("Proper province name required! ");
		return false;
	}
	if(Country.length == 0 || Country.length<2)
		{
		alert("Proper country name required! ");
		return false;
	}
	
if (postalcode.length == 0 || postalcode.length < 6)
	{
		alert("Proper postal code number required! ");
		return false;
	}

if ( ValidateForm(phone1)) 
  {
	  if (phone1.length ==10 || phone1.length ==12) 
	  {
		return true;			
	  }
		else 
		{
		return false;	
		alert("Proper phone number required! ");
		}
	  
  }
  else
  {
  return false;
  document.getElementById(phone1).focus;
  alert("Proper phone number required! ");
  }
  
if (email.length>=1 && (!echeck(email)))
	{
		alert("email not valid");
	    return false;
	}	
	if(file !="")
	{var image_result=load_image();
	alert(image_result);
	}	
}


</script>
</head>
<body>
<FORM  ACTION="register.php" METHOD="POST">
  <table width="656" class="MYTABLE" ALIGN="CENTER">
    <caption class="MYTABLE">
      REGISTER USER
    </caption>
    <tr class="MYTABLE">
      <td width="112" class="MYTABLE"></td>
      <td width="143" align="right"  class="MYTABLE"><label class="MYTABLE">CustId</label></td>
      <td width="32"></td>
      <td width="291"><input type="text" name="custId" id="custId" value=""  onFocus="this.disabled=true"/></td>
    </tr>
      <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Gender*</label></td>
      <td></td>
      <td align="left">M<input type="radio" name="gender" id="gender" value="M"/>
                       F<input type="radio" name="gender" id="gender" value="F"/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">First Name*</label></td>
       <td></td>
      <td align="left"><input type="text" name="firstname" id="firstname" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
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
      <td align="left"><input type="text" name="middlename" id="middlename" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Last Name*</label></td>
       <td></td>
      <td align="left"><input type="text" name="lastname" id="lastname" value=""/></td>
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
      <td align="left"><input type="text" name="address1" id="address1" value=""/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">address2</label></td>
       <td></td>
      <td align="left"><input type="text" name="address2" id="address2" value=""/></td>
    </tr>
    <tr class="MYTABLE" valign="bottom">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">City*</label></td>
       <td></td>
      <td align="left">
       <input type="text" name="city" id="city" value="" onkeyup="searchSuggest(this.id)" autocomplete="off" />
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
      <td align="left"><input type="text" name="province" id="province" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
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
      <td align="left"><input type="text" name="country" id="country" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
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
      <td align="left"><input type="text" name="postalcode" id="postalcode" value=""/></td>
    </tr>
    <tr class="MYTABLE">
      <td align="right" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Phone1*</label></td>
       <td></td>
      <td align="left"><input type="text" name="phone1" id="phone1" value=""/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Phone2</label></td>
       <td></td>
      <td align="left"><input type="text" name="phone2" id="phone2" value=""/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"> <label class="MYTABLE">Email</label></td>
       <td></td>
      <td><input type="text" name="email" id="email" value=""/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE"> SSN/DL</label></td>
       <td></td>
      <td><input type="text" name="pid" id="pid"/></td>
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

</body>
</html>



<?php
}
?>