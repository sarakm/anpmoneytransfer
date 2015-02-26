<?php
session_start();ob_start();

include"lib/authenticate.php";

include"menu.html";
/*This is customer registration page. This will insert user information in users table in 
ANB database. Upon successful insertion, this will lead to  trnsactionStart.html*/
if (isset($_POST['submit'])) 
{
include('lib/config.php');
include('lib/opendb.php');

$staff_gender=htmlspecialchars($_REQUEST['gender']);
$staff_firstname=htmlspecialchars($_REQUEST['firstname']);
$staff_middlename=htmlspecialchars($_REQUEST['middlename']);
$staff_lastname=htmlspecialchars($_REQUEST['lastname']);
$staff_address1=htmlspecialchars($_REQUEST['address1']);
$staff_address2=htmlspecialchars($_REQUEST['address2']);
$staff_city=htmlspecialchars($_REQUEST['city']);
$staff_province=htmlspecialchars($_REQUEST['province']);
$staff_country=htmlspecialchars($_REQUEST['country']);
$staff_postalcode=htmlspecialchars($_REQUEST['postalcode']);
$staff_phone1=htmlspecialchars($_REQUEST['phone1']);
$staff_phone2=htmlspecialchars($_REQUEST['phone2']);
$staff_fax=htmlspecialchars($_REQUEST['fax']);
$staff_email=htmlspecialchars($_REQUEST['email']);
$staff_pid=htmlspecialchars($_REQUEST['pid']);
$staff_photoid=htmlspecialchars($_REQUEST['photoid']);
$staff_username=htmlspecialchars($_REQUEST['username']);
$staff_password=htmlspecialchars($_REQUEST['password1']);
$staff_level=htmlspecialchars($_REQUEST['level']);

if(!isset($staff_firstname) || !isset($staff_lastname) || !isset($staff_gender)||!isset($staff_address1)|| !isset($staff_city)||!isset($staff_province) || !isset($staff_country) ||!isset($staff_phone1)||!isset($staff_fax) ||!isset($staff_username)||!isset($staff_password)||!isset($staff_level))
{
$msg= " Required fields missing. Please enter fields with * mark";
//echo"$msg=".$msg;
header("location:registerStaff.php?msg=".$msg);
exit;
}
else
{
     $s = "SELECT * FROM staff where ((UPPER(firstname)=UPPER('$staff_firstname')) && (UPPER(lastname)=UPPER('$staff_lastname')))";
     $res = mysql_query($s) or die(mysql_error());
     $n = mysql_num_rows($res);
	 $row=mysql_fetch_array($res);
	
     if ($n != 0)
      {      $msg="User already exists with this first and lastnames!";
	   
			 header("location:registerStaff.php?msg=".$msg);
			 exit;
      }
	  else
	  {   
	      $s1 = "SELECT * FROM staff where UPPER(username)=UPPER('$staff_username')";
		  $res1 = mysql_query($s1) or die(mysql_error());
          $n1 = mysql_num_rows($res1);
		   if($n1!=0)
		   {
		     		 $msg= "Username already exists! Please select another username";
					 header("location:registerStaff.php?msg=".$msg);
					 exit;
			}
			else
			{
				  $sql="INSERT INTO STAFF(firstname,middlename,lastname,gender,address1,address2,city,province,country,postalcode,phone1,phone2,
				  fax,email,PID_DLN,identification,date,username,password,level)VALUES('$staff_firstname','$staff_middlename','$staff_lastname',
				  '$staff_gender','$staff_address1','$staff_address2','$staff_city','$staff_province','$staff_country','$staff_postalcode','$staff_phone1',
				  '$staff_phone2','$staff_fax','$staff_email','$staff_pid','$staff_photoid',CURDATE(),'$staff_username','$staff_password','$staff_level')";
				  $result = mysql_query($sql) or die(mysql_error());
				  //$numrows = mysql_num_rows($result);
				  $insert_id = mysql_insert_id();
				  echo $insert_id;
				  if($insert_id != NULL)
				  {			 
						 $_SESSION['staffid']=$insert_id;
						// $_SESSION['loggedin']=$staff_username;
						 $msg="Registration Successful";
						 $_SESSION['msg']=$msg;
						 header("location:sender.php");
						 exit;
				  }
				  
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
<META HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta name="description" content="Money Transfer in toronto canada" />
<meta name="keywords" content=" toronto,canada" />
<link href='style/style.css' rel='stylesheet' type='text/css' />
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>

<script language="Javascript"  type="text/javascript">
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
var fax = document.getElementById('fax').value;
var email = document.getElementById('email').value;
var pid = document.getElementById('pid').value;
var photoid = document.getElementById('photoid').value;
var username = document.getElementById('username').value;
var password1 = document.getElementById('password1').value;
var password2 = document.getElementById('password2').value;

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
	
	if (phone1.length <10||phone1.length >12)
	{
		alert("Proper phone number1 required! 10 or 12 numbers only ");
		return false;
		document.getElementById(phone1).focus;
	}
	/*
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
  }*/
  
if (email.length == 0 || email.length < 8)
	{
		alert("Proper email address required! ");
		document.getElementById('email').focus()
		return false;
	}	
if (pid.length == 0 || pid.length < 6)
	{
		alert("Proper driver licence or SSN required! ");
		document.getElementById('pid').focus()
		return false;
	}	
if (username.length == 0 || username.length < 6)
	{
		alert("Username must be atleast 6 characters! ");
		document.getElementById('username').focus()
		return false;
	}
if (password1.length == 0 || password1.length < 6)
	{
		alert("Password must be atleast 6 characters! ");
		document.getElementById('password1').focus()
		return false;
	}	
	
	if (!(password1==password2))
	{
		alert("passwords should be the same");
	    return false;
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
<FORM  ACTION="<?php echo $_SERVER['PHP_SELF'] ?>" METHOD="POST">
  <table width="656" class="MYTABLE" ALIGN="CENTER">
    <caption class="MYTABLE">
      Register Staff
    </caption>
    <tr class="MYTABLE">
      <td width="16" height="32" class="MYTABLE">&nbsp;&nbsp;</td>
      <td width="88" align="right" class="MYTABLE"></td>
      <td width="10"></td>
      <td width="218"></td>
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
      <div id="firstname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div>      </td>   
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
      <div id="lastname_suggest" style="position:absolute; z-index:2; text-align:left; width:143px; background-color:#FFFFFF; display:none; border:solid 1px #333333;"></div>      </td>   
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
       <input type="text" name="city" id="city" value="" onkeyup="searchSuggest(this.id)" autocomplete="off" />      </td>
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
      <td align="left"><input type="text" name="province" id="province" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
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
      <td align="left"><input type="text" name="country" id="country" value="" onkeyup="searchSuggest(this.id)" autocomplete="off"/></td>
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
      <td align="right" class="MYTABLE"><label class="MYTABLE">Fax*</label></td>
       <td></td>
      <td align="left"><input type="text" name="fax" id="fax" value=""/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"> <label class="MYTABLE">Email*</label></td>
       <td></td>
      <td><input type="text" name="email" id="email" value=""/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE"> SSN/DL*</label></td>
       <td></td>
      <td><input type="text" name="pid" id="pid" title="Social Security Number OR Driver's Licence Number"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">PhotoId</label></td>
       <td></td>
      <td><input type="FILE" name="photoid" id="photoid" value="" title="Select the filename"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Username*</label></td>
       <td></td>
      <td align="left"><input type="text" name="username" id="username" value="" autocomplete="off" title="Minimum 6 characters and numbers only"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Password*</label></td>
       <td></td>
      <td align="left"><input type="password" name="password1" id="password1" value="" title="Minimum 6 characters and numbers only"/></td>
    </tr>
    <tr class="MYTABLE">
      <td class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Re-Enter Password*</label></td>
       <td></td>
      <td align="left"><input type="password" name="password2" id="password2" value="" autocomplete="off" title="Should match with the other password"/></td>
    </tr>
    <tr class="MYTABLE" height="30px">
      <td height="18" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"><label class="MYTABLE">Level</label></td>
      <td></td>
      <td>
	  <select name="level" id="level" value="">
      	  <?php 
				include('lib/config.php');
                include('lib/opendb.php');
                
			   $s="select distinct(level) from staff where level!='admin'";
			   $s_res=mysql_query($s);
			   
			   while($rows=mysql_fetch_array($s_res))
			   { $rank=$rows['level'];
			   // $proid=$row['pro_id'];
				 echo"<option value='$rank'><font color='#0033cc'>$rank</font></option>";
			   }
			  
			   ?>
         </select>
      
      
      
       </td>
    </tr>
    <tr class="MYTABLE" height="30px">
      <td height="18" class="MYTABLE"></td>
      <td align="right" class="MYTABLE"></td>
      <td></td>  
      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr class="MYTABLE" >
      <td height="40" class="MYTABLE">&nbsp;</td>
      <td align="right" class="MYTABLE"></td>
      <td></td>  
      <td valign="top"><label>&nbsp;&nbsp;&nbsp;&nbsp;</label> <input type="submit"  name="submit" id="submit" value="Submit" onClick= "return checkFields();"/>
                 &nbsp;&nbsp;&nbsp;&nbsp;         <input type="reset"  name="reset" id="reset" value="Reset" /></td>
    </tr>
  </table>
</FORM>

</body>
</html>


<?php
}
?>