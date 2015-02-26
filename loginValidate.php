<?php
session_start();
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
	  $query= "select username, level from staff where ((UPPER(username)=UPPER('$username')) && (UPPER(password)=UPPER('$password')))"; 
	   $result=mysql_query($query) or die(mysql_error());
	    
		$numrows= mysql_num_rows($result);
	     
	   //echo "numrows= ". $numrows;
	     if($numrows != 0)		  
		   {    
		     while($row=mysql_fetch_array($result))
			 { 
				$_SESSION['loggedin'] = $row[0];
				$_SESSION['rank'] = $row[1];
				$sessionCookieExpireTime=1*60*60;
                 session_set_cookie_params($sessionCookieExpireTime);
                 session_start();
			    
			  }
				header("Location:home.php");
				exit;
    	   }
		   else
		   {
		     echo "Invalid Username or Password";
             include("login.html");
			 exit;
	        }
     }

	 else{ 
	      // echo"Please enter Username and Password");
		   header("Location: login.html");
		   exit;
		 }
 }
 ?>

