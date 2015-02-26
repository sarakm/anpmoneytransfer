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
</head>

<body>
<P>&nbsp;</P>
<form action="masterBudget.php" method="post"  name="form1" target="_self">
  <table width="491" align="center" class="MYTABLE" >
    <caption class="MYTABLE">
     MASTER BUDGET
    </caption>
    <tr class="MYTABLE">
      <td colspan="2" align="center"><h1><font color='blue'>
        <p align='center' valign='middle'>Edit Budget</p>
      </font></h1></td>
    </tr>
    <tr class="MYTABLE">
      <td colspan="2" align="center"><div id="bmessage" name="bmessage" style="color:#F00""></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      
    </tr>
    <tr>
      <td width="282" align="right"><font color='blue'> MASTER BUDGET:&nbsp;&nbsp;&nbsp;</font></td>
      <?php
	$query = "select budget from staff WHERE level ='admin'";
	$result=mysql_query($query);
	if($result)
		$mbudget=mysql_fetch_assoc($result);
		?>
      <td width="304"><input type="text" name="mbudget" id="mbudget" size="20" value="<?php echo $mbudget["budget"];?>"/>
      </td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr class="MYTABLE">
      <td  align="right"><input type="button" value="Cancel" onclick="getBack()"/></td>
      <td  align="left"><input type="button" value="Update" onclick="updateMBudget()"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>


</body>
</html>

<?php
include"lib/closedb.php";
?>
