<?php
session_start();
include"lib/authenticate.php";
include('lib/config.php');
include('lib/opendb.php');
include('menu.html');
$id = $_REQUEST["id"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit User</title>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>
<script type="text/javascript" language="javascript">
function cancelT()
{
	
	window.location.href="modify_clients.php";
}

   
    


/*function checkField()
{
	var status = document.getElementById("status").value;
	var notes = document.getElementById("note").value;
	

	if(notes.length<1 && status =="completed")
	{
		document.getElementById("message").innerHTML ="You must write a note if you completed the transaction";
		return false;
	}
	else
		document.getElementById("message").innerHTML ="";
	
	return true;
}*/
</script>

</head>

<body>
<p>&nbsp; </p>
<table class="MYTABLE" width="800" border="0" align="center" cellpadding="0" cellspacing="0" >
<form action="updateUser1.php" method="get" onsubmit="return confirmChoice();">
<?php
$query = "SELECT * FROM users WHERE userid =$id";

$result = mysql_query($query);
if($result)
{

	$fields = mysql_fetch_assoc($result);
}

?>
  <tr>
    <td align="center"><CAPTION CLASS="MYTABLE">Edit User Info</CAPTION></td>
  </tr>
  <tr>
    <td align="center">
    <div id="message" name="message" style="color:#F00"> <?php $_SESSION['update_User_message'] ?>   </div>    </td>
  </tr>
  <tr>
    <td>
        <table width="800" border="0" cellspacing="10" cellpadding="10">
          <tr>
            <input type="hidden"  name="id" id="id" value="<?php echo $fields["userid"]; ?>"/></td>
            <td width="94"><b>First Name:</b></td>
            <td width="245"><input type="text" size="30" name="firstname" id="firstname" value="<?php echo $fields["firstname"]; ?>"/></td>
            <td width="122" align="right"><b>Middle Name:</b></td>
            <td width="339"><input type="text" size="30" name="middlename" id="middlename" value="<?php echo $fields["middlename"]; ?>"/></td>
          </tr>
          <tr>
            <td height="27"><b>Last Name:</b></td>
            <td><input type="text" size="30" name="lastname" id="lastname" value="<?php echo $fields["lastname"]; ?>"/></td>
            <td align="right"><b>Gender:</b></td>
            <td><input type="text" size="30" name="gender" id="gender" value="<?php echo $fields["gender"]; ?>"/></td>
          </tr>

          <tr>
            <td><b>Address1:</b></td>
            <td width="500"><input type="text" size="30" name="address1" id="address1" value="<?php echo $fields["address1"]; ?>"/></td>
          
            <td width="500" align="right"><b>Address2:</b></td>
            <td><input type="text" size="30" name="address2" id="address2" value="<?php echo $fields["address2"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>City:</b></td>
            <td><input type="text" size="30" name="city" id="city" value="<?php echo $fields["city"]; ?>"/></td>
            <td align="right"><b>Province:</b></td>
            <td><input type="text" size="30" name="province" id="province" value="<?php echo $fields["province"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>Country:</b></td>
            <td><input type="text" size="30" name="country" id="country" value="<?php echo $fields["country"]; ?>" /></td>
            <td align="right"><b>Postal Code:</b></td>
            <td><input type="text" size="30" name="postalcode" id="postalcode" value="<?php echo $fields["postalcode"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>Phone1:</b></td>
            <td><input type="text" size="30" name="phone1" id="phone1" value="<?php echo $fields["phone1"]; ?>"/></td>
            <td align="right"><b>Phone2:</b></td>
            <td><input type="text" size="30" name="phone2" id="phone2" value="<?php echo $fields["phone2"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>Email:</b></td>
            <td colspan="3"><input type="text" size="30" name="email" id="email" value="<?php echo $fields["email"]; ?>"/></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>    </td>
  </tr>
  
  <tr>
    <td><table width="800" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="330" align="right"><input type="button" id="cancel" name="cancel" value="Return To Users" onclick="cancelT()"/></td>
        <td width="119">&nbsp;</td>
        <td width="351"><input type="submit" name="submit" id="submit" value="Update User"/></td>
      </tr>
    </table></td>
  </tr>
</form>
<TR height="30px"><TD></TD></TR>
</table>
</body>
</html>
<?php
include('lib/closedb.php');
?>