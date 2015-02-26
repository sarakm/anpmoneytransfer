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
<title>Edit Agent</title>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>
<script type="text/javascript" language="javascript">
function cancelT()
{
	//alert("got here");
	window.location.href="modify_agent.php";
}

   
    


/*function checkField()
{
	var status = document.getElementById("status").value;
	var notes = document.getElementById("note").value;
	//alert(status =="completed");

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
<p>&nbsp;</p>
<table CLASS="MYTABLE" width="800" border="0" align="center" cellpadding="0" cellspacing="0">
<form action="updateAgent1.php" method="get" onsubmit="return confirmChoice();">
<?php
$query = "SELECT * FROM staff WHERE staffid =$id";

$result = mysql_query($query);
if($result)
{

	$fields = mysql_fetch_assoc($result);
}

?>
  <tr>
    <td align="center"><caption class="MYTABLE">Edit Staff Info</caption></td>
  </tr>
  <tr>
    <td align="center">
    <div id="message" name="message" style="color:#F00"> <?php echo $_SESSION['update_Agent_Message']; ?>   </div>    </td>
  </tr>
 
  <tr>
    <td>
        <table width="800" border="0" cellspacing="10" cellpadding="10">
          <tr>
            <input type="hidden"  name="id" id="id" value="<?php echo $fields["staffid"]; ?>"/></td>
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
            <td><input type="text" size="30" name="email" id="email" value="<?php echo $fields["email"]; ?>"/></td>
            <td align="right"><b>Fax:</b></td>
            <td ><input type="text" size="30" name="fax" id="fax" value="<?php echo $fields["fax"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>PID_DLN:</b></td>
            <td ><input type="text" size="30" name="pid" id="pid" value="<?php echo $fields["PID_DLN"]; ?>"/></td>
            <td align="right"><b>Reg_Date:</b></td>
            <td ><input type="text" size="30" name="date" id="date" value="<?php echo $fields["date"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>Username:</b></td>
           <td><input type="text" size="30" name="username" id="username" value="<?php echo $fields["username"]; ?>"/></td>
            <td align="right"><b>Password:</b></td>
           <td><input type="text" size="30" name="password" id="password" value="<?php echo $fields["password"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>Level:</b></td>
            <td><input type="text" size="30" name="level" id="level" value="<?php echo $fields["level"]; ?>"/></td>
            <td align="right"><b>Budget:</b></td>
            <td><input type="text" size="30" name="budget" id="budget" value="<?php echo $fields["budget"]; ?>"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
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
  <TR height="30px"><TD></TD></TR>
</form>
</table>
</body>
</html>
<?php
include('lib/closedb.php');
?>