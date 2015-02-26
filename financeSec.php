<?php
session_start();
include"lib/authenticate.php";

include('lib/config.php');
include('lib/opendb.php');
include('menu.html');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta name="description" content="Money Transfer in toronto canada" />
<meta name="keywords" content=" toronto,canada" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BUDGET</title>
<link href='style/style.css' rel='stylesheet' type='text/css' />
<script type="text/javascript" language="javascript" src="js/budget.js"></script>
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>
<script language="JavaScript" type="text/javascript">

</script>
</head>

<body bgcolor="#e2e2e2" >
<table align="center" width="1005"  bgcolor="#FFFFFF" valign="top" >
<tr><td><P>&nbsp;</P>
<form action="#" method="get">
  <table  align="center" class="MYTABLE" >
    <caption class="MYTABLE">
      BUDGET
    </caption>
    <tr class="MYTABLE">
      <td colspan="2" align="center"><h1><font color='blue'>
        <p align='center' valign='middle'>Edit Budget</p>
      </font></h1></td>
    </tr>
    <tr class="MYTABLE">
      <td colspan="2" align="center"><div id="bmessage" name="bmessage" style="color:#F00""></div></td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td align='right' valign="top"><a href="masterBudget.php"><font color='blue'>Edit Master Budget</font></a></td>
    </tr>
    <tr>
      <td width="282" align="right"><font color='blue'> MASTER BUDGET:&nbsp;&nbsp;&nbsp;</font></td>
      <?php
	$query = "select budget from staff WHERE level ='admin'";
	$result=mysql_query($query);
	if($result)
		$mbudget=mysql_fetch_assoc($result);
		?>
      <td width="304"><input type="text" name="mbudget" id="mbudget" size="20" value="<?php echo $mbudget["budget"];?>" onblur="checkMB(this.value,<?php echo $mbudget["budget"]; ?>)" title="Balance in Master's Account"/>
          <input type="hidden" id="cbudget" name="cbudget" value="<?php echo $mbudget["budget"];?>"/></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td><td>&nbsp;</td>
    </tr>
        
    <tr class="MYTABLE">
      <td align="right"><font color='blue'>Select Agent:&nbsp;&nbsp;&nbsp;</font></td>
      <td><select name="agent"  id="agent" onchange="getBudget(this.value)"/>
      
      <option value="none"><font color='blue' style="font-family:Arial;">Select Agent</font></option>
          <?php
		$query = "Select staffid,firstname, lastname, budget from staff WHERE level != 'admin'";
		$result =mysql_query($query);
		if(result)
		{
			while($rows=mysql_fetch_array($result))
			{
				echo "<option value='".$rows["staffid"]."'>".$rows["firstname"]." ".$rows["lastname"]."</option>";
			}
		}
	?>      </td>
    </tr>
    
    <tr>
      <td>&nbsp;</td><td>&nbsp;</td>
    </tr>
    
    
    <tr class="MYTABLE">
      <td align="right"><font color='blue'>Agent's Current&nbsp;&nbsp;&nbsp;<br/> Balance:&nbsp;&nbsp;&nbsp;</font></td>
      <td><div id="result" name="result">
        <input type="text" size="20" name="curbudget" id="curbudget" title="Current Balance in Agent's Account"/>
      </div></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="MYTABLE">
      <td align="right"><font color='blue'>Add Amount&nbsp;&nbsp;&nbsp;<br/> to Agent:&nbsp;&nbsp;&nbsp;</font></td>
      <td><div id="add" name="add">
        <input type="text" size="20" name="addbudget" id="addbudget" title="The Amount You want to add to Selected Agent's Account"/>
      </div></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr class="MYTABLE">
      <td  align="right"><input type="button" value="Cancel" onclick="getBack()"/></td>
      <td  align="left"><input type="button" value="Update" onclick="checkBudget()"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>


</td></tr></table>

<table align="center" class="footer"><tr><td><?PHP include "footer.html"; ?></td></tr></table>
</body>
</html>

<?php
include"lib/closedb.php";
?>