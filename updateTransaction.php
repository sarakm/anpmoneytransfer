<?php
session_start();
include"lib/authenticate_ad_del.php";
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');
include"menu.html";
$id = $_REQUEST["id"];
//$id =2;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<!-- TemplateBeginEditable name="doctitle" -->
<title>ANP</title>
<!-- TemplateEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta name="description" content="Money Transfer in toronto canada" />
<meta name="keywords" content=" toronto,canada" />
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="menu/menu_style.css" />
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>
<script language="JavaScript" type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
function cancelT()
{
	//alert("got here");
	window.location.href="update_trans.php";
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

<body onload="">

<table class='MYTABLE' width="800" border="0" align="center" cellpadding="0" cellspacing="0">
 <td class='MYTABLE' colspan="5" align="center"><h1><font style='color:#920'>Update Transaction</font></h1></td>
  </tr>

<form action="update_trans_db.php" method="get" onsubmit="return checkField();">
<input type="hidden" name='logged' id='logged' value='<?php echo $_SESSION['rank']; ?>' />
<?php
$query = "SELECT * FROM transactions WHERE transactionid =$id";

$result = mysql_query($query);
if($result)
{

	$fields = mysql_fetch_assoc($result);
}

$query ="SELECT staff.staffid, staff.firstname as sfname, staff.lastname as slname, users.firstname as ufname, users.lastname as ulname, users.city as ucity, users.country as ustate FROM staff, users WHERE users.userid =".$fields["userid"]." AND staff.staffid =".$fields["agent"];
$result = mysql_query($query);
if($result)
	$fieldsb = mysql_fetch_assoc($result);

?>
  	
   
  <tr class='MYTABLE'>
    <td colspan="5" align="center" class='MYTABLE'>
    <div id="message" name="message" style="color:#F00">    </div>    </td>
  </tr>
 <tr class='MYTABLE'><td>&nbsp;</td></tr>
  <?php 
    echo "<tr class='MYTABLE'>";
	echo "  <td colspan='5' class='MYTABLE'><b>Agent Name:</b>";
	
	if($_SESSION['rank']=='DELIVERY AGENT')
	    $access ='disabled';
	else if($_SESSION['rank']=='admin')
	   $access="";
	
		 
  	$query = "SELECT staffid, firstname, lastname FROM staff WHERE city='".$fields["city"]."' AND budget >=".$fields["amount_to_receive"];
	$result=mysql_query($query);
	if($result)
	{
		$num_rows = mysql_num_rows($result);
		if($num_rows>1)
		{
			echo "<select name='agent' id='agent' disabled=$access>";
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
			echo "<input type='hidden' name='agent' id='agent' value='".$fieldsb["staffid"]."'/>";
		}
	}
	  echo "</tr>";
  ?>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr class='MYTABLE'>
    <td width="169" height="24" class='MYTABLE' ><b>Sender Name:</b></td>
    <td width="168">
    <input type="hidden" name="tid" id="tid" value="<?php echo $fields["transactionid"]; ?>"/>
    <?php echo $fieldsb["ufname"]." ".$fieldsb["ulname"]; ?></td>
    <td width="155">&nbsp;</td>
    <td width="124" align="right"><b>Date Submitted:</b></td>
    <input type="hidden" name="date_submitted" id="date_submitted" value="<?php echo $fields["date_submitted"]; ?>"/>
    <td width="184"><?php echo $fields["date_submitted"]; ?></td>
  </tr>
  <tr class='MYTABLE'>
    <td height="26" class='MYTABLE'><b>Sender Address:</b></td>
     <input type="hidden" name="ucity" id="ucity" value="<?php echo $fields["ucity"]; ?>" />
      <input type="hidden" name="ustate" id="ustate" value="<?php echo $fields["ustate"]; ?>"/>
      
    <td><?php echo $fieldsb["ucity"].",".$fieldsb["ustate"]; ?></td>
    <td>&nbsp;</td>
    <td align="right" ><b>Status:</b></td>
    <td>
    
    <?php
	if($_SESSION['rank']=="DELIVERY AGENT")
	$query ="select name from anp_status where name !='started'";
	else if($_SESSION['rank']=="admin")
	$query ="select name from anp_status";
	$result=mysql_query($query);
	if($result)
	{
		echo "<select name='status' id='status' title='please change to completed once you successfully finish the delivery'>";
		while($rowstatus =mysql_fetch_array($result))
		{
			if($rowstatus["name"]==$fields["status"])
				echo "<option value='".$fields["status"]."' selected=true>".$rowstatus["name"]."</option>";
			else
				echo "<option value='".$rowstatus["name"]."'>".$rowstatus["name"]."</option>";
		}
		echo "</select>";
    
	}

    ?>    </td>
  </tr>
  <tr class='MYTABLE'>
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b>Date Completed:</b></td>
    <td>
    <?php
		if($fields["date_completed"] =='0000-00-00')
		{
			echo "N/A";
		}
		else
		{
			echo $fields["date_completed"];
		}
	?>    </td>
  </tr>
  <tr class='MYTABLE'>
    <td colspan="5">&nbsp;</td>
  </tr>
  
  <tr class='MYTABLE'>
    <td colspan="5" class='MYTABLE'><h3>Receiver Info:</h3></td>
  </tr>
  <tr class='MYTABLE'>
    <td colspan="5" class='MYTABLE' align='center'><table class='MYTABLE' align='center' width="800" border="0" cellspacing="0" cellpadding="0">
      <tr class='MYTABLE'>
        <td width="108" class='MYTABLE'><b>First Name:</b></td>
        <td colspan="2" class='MYTABLE'><input type="text" size="30" name="rfname" id="rfname" value="<?php echo $fields["receiver_firstname"]; ?>" <?php echo $access; ?>/></td>
        <td width="122" align="right" class='MYTABLE'><b>Middle Name:</b></td>
        <td width="339" class='MYTABLE'><input type="text" size="30" name="rmname" id="rmname" value="<?php echo $fields["receiver_middlename"]; ?>"  <?php echo $access; ?>/></td>
      </tr>
      <tr class='MYTABLE'>
        <td height="27" class='MYTABLE'><b>Last Name:</b></td>
        <td colspan="2" class='MYTABLE'><input type="text" size="30" name="rlname" id="rlname" value="<?php echo $fields["receiver_lastname"]; ?>"  <?php echo $access; ?>/></td>
        <td align="right" class='MYTABLE'><b>Gender:</b></td>
        <td>&nbsp;&nbsp;
            <input type="text" size="30" name="rgender" id="rgender" value="
			
			<?php 
			
				if($fields["receiver_gender"]=="M")
					echo "Male";
				else if($fields["receiver_gender"]=="F")
					echo "Female";
			
			
			?>"  <?php echo $access; ?>/></td>
      </tr>
      <tr class='MYTABLE'>
        <td class='MYTABLE'><b>Address1:</b></td>
        <td class='MYTABLE'> <input type="text"  size="43" name="raddress" id="raddress" value="<?php echo $fields["receiver_address1"]; ?>"  <?php echo $access; ?>/></td>
        <td>&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr class='MYTABLE' >
        <td  class='MYTABLE' align='right'><b>Address2:</b></td>
        <td class='MYTABLE'><input type="text" size="43"  name="raddress2" id="raddress2" value="<?php echo $fields["receiver_address2"]; ?>"  <?php echo $access; ?>/></td> 
               <td>&nbsp;</td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr class='MYTABLE'>
        <td class='MYTABLE'><b>City:</b></td>
        <td colspan="2" class='MYTABLE'><input type="text" size="30" name="rcity" id="rcity" value="<?php echo $fields["receiver_city"]; ?>"  <?php echo $access; ?>/></td>
        <td align="right" class='MYTABLE'><b>Province:</b></td>
        <td class='MYTABLE'><input type="text" size="30" name="rprovince" id="rprovince" value="<?php echo $fields["receiver_province"]; ?>"  <?php echo $access; ?>/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr class='MYTABLE'>
        <td class='MYTABLE'><b>State:</b></td>
        <td colspan="2" class='MYTABLE'><input type="text" size="30" name="rstate" id="rstate" value="<?php echo $fields["receiver_country"]; ?>"  <?php echo $access; ?>/></td>
        <td align="right" class='MYTABLE'><b>Zip Code:</b></td>
        <td class='MYTABLE'><input type="text" size="30" name="rzip" id="rzip" value="<?php echo $fields["receiver_postalcode"]; ?>"  <?php echo $access; ?>/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr class='MYTABLE'>
        <td class='MYTABLE'><b>Phone1:</b></td>
        <td colspan="2" class='MYTABLE'><input type="text" size="30" name="rphone1" id="rphone1" value="<?php echo $fields["receiver_phone1"]; ?>"  <?php echo $access; ?>/></td>
        <td align="right" class='MYTABLE'><b>Phone2:</b></td>
        <td class='MYTABLE'><input type="text" size="30" name="rphone2" id="rphone2" value="<?php echo $fields["receiver_phone2"]; ?>"  <?php echo $access; ?>/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr class='MYTABLE'>
        <td class='MYTABLE'><b>Email:</b></td>
        <td colspan="2" class='MYTABLE'><input type="text" size="30" name="remail" id="remail" value="<?php echo $fields["receiver_email"]; ?>"  <?php echo $access; ?>/></td>
      </tr>
      <tr class='MYTABLE'>
        <td colspan="5" class='MYTABLE'>&nbsp;</td>
      </tr>
      <tr class='MYTABLE' >
        <td class='MYTABLE'><b>Amount to Get:</b></td>
        <td width="90" > &nbsp;
          <input type="text" size="10" align='center' name="ar" id="ar" value="<?php echo $fields["amount_to_receive"];?>"  <?php echo $access; ?>/>
          <?php
			
            $query = "SELECT distinct name FROM currency_name";
			$result = mysql_query($query);
			if($result)
			{
			?>
            <select name="cname" id="cname"  <?php echo $access; ?>>
              <?php 
					while($cname = mysql_fetch_array($result))
					{
						if($fields["currency"]==$cname["name"])
							echo "<option value='".$fields["currency"]."' selected=\"selected\">".$fields["currency"]."</option>";
						else
							echo "<option value='".$cname["name"]."'>".$cname["name"]."</option>";
					}
				?>
            </select>
            <?php
			}
			?>        </td>
         <td class='MYTABLE'>&nbsp;&nbsp;</td>   
        <td class='MYTABLE'><b>ANP Total:</b></td>
        <td >
          <input type="text" size="9" name="apn_total" id="apn_total" value="<?php echo $fields["apn_total"];?>"  <?php echo $access; ?>/>          
          CND</td>
      </tr>
      <tr><td>&nbsp;</td></tr>
    </table></td>
  </tr>
  <tr class='MYTABLE'>
    <td height="30" colspan="5" align="center" valign="bottom">Completion Note:</td>
  </tr>
  <tr>
    <td class='MYTABLE' colspan="5" align="center"><textarea name="note" id="note" cols="60" rows="5" value="<?php echo $fields["notes"]; ?>" title="please write completion note once you finish the delivery"><?php echo $fields["notes"];?></textarea></td>
  </tr>
  <tr class='MYTABLE'>
    <td colspan="5" class='MYTABLE'>&nbsp;</td>
  </tr>
  <tr class='MYTABLE'>
    <td colspan="5" class='MYTABLE'><table width="800" border="0" cellspacing="0" cellpadding="0">
      <tr class="MYTABLE">
        <td width="330" align="right" ><input type="button" id="cancel" name="cancel" value="Return To Transaction" onclick="cancelT()"/></td>
        <td width="119" class='MYTABLE'>&nbsp;</td>
        <td width="351"  align="left"><input type="submit" name="submit" id="submit" value="Update Transaction"/></td>
      </tr>
      <tr><td>&nbsp;</td></tr>
    </table></td>
  </tr>
</form>
</table>
</body>
</html>
<?php
include('lib/closedb.php');
?>