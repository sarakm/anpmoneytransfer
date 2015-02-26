<?php
session_start();
include "config.php";
include "phpFunctions.php";
//$id = $_REQUEST["id"];
$id =8;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" language="javascript">
function cancelT()
{
	//alert("got here");
	window.location.href="transacpanel.php";
}

function checkField()
{
	var status = document.getElementById("status").value;
	var notes = document.getElementById("note").value;
	if(notes.length<1 && status =="completed")
	{
		alert("got here");
		document.getElementById("message").innerHTML ="You must write a note if you completed the transaction";
		return false;
	}
	else
	{
		document.getElementById("message").innerHTML ="";
	}
	
	return true;
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Transaction</title>
</head>

<body>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
<form action="update.php" method="get" onsubmit="return checkField();">
<?php
$query = "SELECT * FROM transactions WHERE transactionid =$id";

$result = mysql_query($query);
if($result)
{

	$fields = mysql_fetch_assoc($result);
}

$query ="SELECT staff.firstname as sfname, staff.lastname as slname, users.firstname as ufname, users.lastname as ulname, users.City as ucity, users.Country as ustate FROM staff, users WHERE users.userid =".$fields["sender"]." AND staff.staffid =".$fields["agent"];
$result = mysql_query($query);
if($result)
	$fieldsb = mysql_fetch_assoc($result);

?>
  <tr>
  	
    <td colspan="5" align="center">Edit Transaction Info</td>
  </tr>
  <tr>
    <td colspan="5" align="center">
    <div id="message" name="message" style="color:#F00">
    	
    </div>
    </td>
  </tr>
  <?php 
    echo "<tr>";
	echo "  <td colspan='5'><b>Agent Name:</b>";
  	$query = "SELECT staffid, firstname, lastname FROM staff WHERE city='".$fields["city"]."' AND budget >=".$fields["amount_to_receive"];
	$result=mysql_query($query);
	if($result)
	{
		$num_rows = mysql_num_rows($result);
		if($num_rows>1)
		{
			echo "<select name='agent' id='agent'>";
			while($rowsagent=mysql_fetch_array($result))
			{
				if($rowsagent["staffid"] ==$fields["agent"])
					echo "<option value='".$rowsagent["staffid"]."' selected='true'>".$rowsagent["firstname"]." ".$rowsagent["lastname"]."</option>";
				else
					echo "<option value='".$rowsagent["staffid"]."'>".$rowsagent["firstname"]." ".$rowsagent["lastname"]."</option>";
			}
			
			echo "</select>";
		    echo "</td>";
		}
		else
		{
			echo $fieldsb["sfname"]." ".$fieldsb["slname"]."</td>";
			echo "<input type='hidden' name='agent' id='agent' value='".$fieldsb["sfname"]." ".$fieldsb["slname"]."'/>";
		}
	}
	  echo "</tr>";
  ?>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td width="169"><b>Sender Name:</b></td>
    <td width="168">
    <input type="hidden" name="tid" id="tid" value="<?php echo $fields["transactionid"]; ?>"/>
	
	<?php echo $fieldsb["ufname"]." ".$fieldsb["ulname"]; ?></td>
    <td width="155">&nbsp;</td>
    <td width="124" align="right"><b>Date Submitted:</b></td>
    <input type="hidden" name="date_submitted" id="date_submitted" value="<?php echo $fields["date_submitted"]; ?>"/>
    <td width="184"><?php echo $fields["date_submitted"]; ?></td>
  </tr>
  <tr>
    <td><b>Sender Address:</b></td>
     <input type="hidden" name="ucity" id="ucity" value="<?php echo $fields["ucity"]; ?>"/>
      <input type="hidden" name="ustate" id="ustate" value="<?php echo $fields["ustate"]; ?>"/>
      
    <td><?php echo $fieldsb["ucity"].",".$fieldsb["ustate"]; ?></td>
    <td>&nbsp;</td>
    <td align="right"><b>Status:</b></td>
    <td>
    
    <?php
	$query ="select name from anp_status";
	$result=mysql_query($query);
	if($result)
	{
		echo "<select name='status' id='status'>";
		while($rowstatus =mysql_fetch_array($result))
		{
			if($rowstatus["name"]==$fields["status"])
				echo "<option value='".$fields["status"]."' selected=true>".$rowstatus["name"]."</option>";
			else
				echo "<option value='".$rowstatus["name"]."'>".$rowstatus["name"]."</option>";
		}
		echo "</select>";
    
	}

    ?>
   
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b>Date Completed:</b></td>
    <td>
    <?php
		if($fields["date_completed"] ==NULL)
		{
			echo "N/A";
		}
		else
		{
			echo $fields["date_completed"];
		}
	?>
    </td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><h3>Receiver Info:</h3></td>
  </tr>
  <tr>
    <td colspan="5">
        <table width="800" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="108"><b>First Name:</b></td>
            <td colspan="2"><input type="text" size="30" name="rfname" id="rfname" value="<?php echo $fields["receiver_firstname"]; ?>"/></td>
            <td width="122" align="right"><b>Middle Name:</b></td>
            <td width="339"><input type="text" size="30" name="rmname" id="rmname" value="<?php echo $fields["receiver_middlename"]; ?>"/></td>
          </tr>
          <tr>
            <td height="27"><b>Last Name:</b></td>
            <td colspan="2"><input type="text" size="30" name="rlname" id="rlname" value="<?php echo $fields["receiver_lastname"]; ?>"/></td>
            <td align="right"><b>Gender:</b></td>
            <td><input type="text" size="30" name="rgender" id="rgender" value="
			
			<?php 
			
				if($fields["gender"]=="M")
					echo "Male";
				else if($fields["gender"]=="F")
					echo "Female";
			
			
			?>"/></td>
          </tr>

          <tr>
            <td><b>Address:</b></td>
            <td colspan="4"><input type="text" size="80" name="raddress" id="raddress" value="<?php echo $fields["address1"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>Address2:</b></td>
            <td colspan="4"><input type="text" size="80" name="raddress2" id="raddress2" value="<?php echo $fields["address2"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>City:</b></td>
            <td colspan="2"><input type="text" size="30" name="rcity" id="rcity" value="<?php echo $fields["city"]; ?>"/></td>
            <td align="right"><b>Province:</b></td>
            <td><input type="text" size="30" name="rprovince" id="rprovince" value="<?php echo $fields["province"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>State:</b></td>
            <td colspan="2"><input type="text" size="30" name="rstate" id="rstate" value="<?php echo $fields["country"]; ?>" /></td>
            <td align="right"><b>Zip Code:</b></td>
            <td><input type="text" size="30" name="rzip" id="rzip" value="<?php echo $fields["zip"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>Phone1:</b></td>
            <td colspan="2"><input type="text" size="30" name="rphone1" id="rphone1" value="<?php echo $fields["phone1"]; ?>"/></td>
            <td align="right"><b>Phone2:</b></td>
            <td><input type="text" size="30" name="rphone2" id="rphone2" value="<?php echo $fields["phone2"]; ?>"/></td>
          </tr>
          <tr>
            <td><b>Email:</b></td>
            <td colspan="4"><input type="text" size="30" name="remail" id="remail" value="<?php echo $fields["email"]; ?>"/></td>
          </tr>
          <tr>
            <td colspan="5">&nbsp;</td>
          </tr>
          <tr>
            <td><b>Amount to Get:</b></td>
            <td width="90"><input type="text" size="9" name="ar" id="ar" value="<?php echo $fields["amount_to_receive"];?>"/></td>
            <td width="141">
 
            <?php
			
            $query = "SELECT name FROM currency_name";
			$result = mysql_query($query);
			if($result)
			{
			?>
           	 <select name="cname" id="cname">
            	<?php 
					while($cname = mysql_fetch_array($result))
					{
						if($fields["c_name"]==$cname["name"])
							echo "<option value='".$fields["c_name"]."' selected=\"selected\">".$fields["c_name"]."</option>";
						else
							echo "<option value='".$cname["name"]."'>".$cname["name"]."</option>";
					}
				?>
           	 </select>
            <?php
			}
			?>
            </td>
            <td><b>ANP Total:</b></td>
            <td><input type="text" size="9" name="apn_total" id="apn_total" value="<?php echo $fields["apn_total"];?>"/>CND</td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td height="30" colspan="5" align="center" valign="bottom">Completition Note:</td>
  </tr>
  <tr>
    <td colspan="5" align="center"><textarea name="note" id="note" cols="80" rows="5" value="<?php echo $fields["notes"]; ?>"><?php echo $fields["notes"];?></textarea></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><table width="800" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="330" align="right"><input type="button" id="cancel" name="cancel" value="Return To Transaction" onclick="cancelT()"/></td>
        <td width="119">&nbsp;</td>
        <td width="351"><input type="submit" name="submit" id="submit" value="Update Transaction"/></td>
      </tr>
    </table></td>
  </tr>
</form>
</table>
</body>
</html>
<?php
include "footer.php";
?>