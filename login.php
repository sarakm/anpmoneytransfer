<?php
session_start();
ob_start();
include('lib/config.php');
include('lib/opendb.php');
include('menu.html');

 if(isset($_POST['submit'])){
  
      $username=trim($_REQUEST['username']);
	  $password=trim($_REQUEST['password']);
	  session_destroy;
	  $_SESSION['loggedin'] = false;
	if(($username !="") && ($password!=""))
	{  
	
	 $username = mysql_real_escape_string($username);
     $password = mysql_real_escape_string($password);
	 // echo $username.",".$password;
	 $query= "select username, level,staffid from staff where ((UPPER(username)=UPPER('$username')) && (UPPER(password)=UPPER('$password')))"; 
	   $result=mysql_query($query) or die(mysql_error());
	    
		$numrows= mysql_num_rows($result);
	     
	   //echo "numrows= ". $numrows;
	     if($numrows != 0)		  
		   {    
		     while($row=mysql_fetch_array($result))
			 { 
				$_SESSION['loggedin'] = $row[0];
				$_SESSION['rank'] = $row[1];
				$_SESSION['staffid']=$row[2];
				$sessionCookieExpireTime=1*60*60;
                 session_set_cookie_params($sessionCookieExpireTime);
				 //echo $_SESSION['rank'] ;
                session_start();
				 if($_SESSION['rank']=='DELIVERY AGENT')	
				 header("Location:trans_List.php");
				 else
			    header("Location:sender.php");
			   /* echo "<blockquote><h1><font color='blue'><p align='center' valign='middle'>Login Successful</p></font></h1></blockquote>";*/
				exit;
			  }
				
				
				
    	   }
		   else
		   {
		     
           // include("login.php");
		   echo "<blockquote><h1><font color='blue'><p align='center' valign='middle'>Invalid Username or Password</p></font></h1></blockquote>";
		      exit;
	        }
     }

	 else{ 
	      echo "Please enter Username and Password";
		 //  header("Location: login.php");
		 echo "<blockquote><h1><font color='blue'><p align='center' valign='middle'>Please enter Username and Password</p></font></h1></blockquote>";
		   exit;
		 }
 }
 else{
 
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
<!--<link href='style/template.css' rel='stylesheet' type='text/css' />-->
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>
<script language="javascript" type="text/javascript">
function checkFields()
{

var username = document.getElementById('username').value;
var pwd = document.getElementById('password').value;
	if (username.length < 6)
	{   
		alert("invalid username ");
		document.getElementById('username').focus();
		return false;
	}
	if (pwd.length < 6)
	{
		alert("invalid password ");
		return false;
	}
return true;	
}
</script>
</head>
<body bgcolor="#e2e2e2">
<table align="center" width="997"  bgcolor="#FFFFFF" >
  <tr>  <td>
 
   <FORM  METHOD="POST" ACTION ="<?php echo $_SERVER['_PHPSELF'] ; ?>" >
  <h3 align="center"> Admin Login</h3><br />
  </td></tr>
  
 <tr><td> 

  <table CLASS="MYTABLE" align="center" >
        <tr class="MYTABLE" >
           <td width="161" height="77"></td>
          <td width="113"  align="right" valign="bottom" class="MYTABLE"><label class="MYTABLE">Username: &nbsp;</label></td>
        <td width="155" align="left" valign="bottom"><input type="text" name="username" id="username" autocomplete="off" value="" title="username should be atleast 6 characters"/></td>
          <td width="151"></td>
        </tr>
         <tr class="MYTABLE">
        <td height="79"></td>
        <td  align="right" class="MYTABLE"><label class="MYTABLE">Password: &nbsp;</label></td>
        <td align="left"><input type="password" name="password" id="password" autocomplete="off" value=""title="password should be atleast 6 characters"/>     </td>
        <td></td>
       </tr>
       <tr class="MYTABLE">
       <td height="66" align="right" class="MYTABLE">
       <td width="113" align="left">&nbsp;</td>
       <td align="center" valign="top"><input type="submit"  name="submit" id="submit" value="SUBMIT" onclick= "return checkFields();"/></td>
       <td></td>
      </tr>
  </table>

    </form>
    </td></tr></table>





<table align="center" class="footer"><tr><td><?PHP include "footer.html"; ?></td></tr></table>
</body>
</html>
<?php
include"lib/closedb.php";

}
?>
