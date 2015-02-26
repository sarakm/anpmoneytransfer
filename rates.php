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
<title>ANP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta name="description" content="Money Transfer in toronto canada" />
<meta name="keywords" content=" toronto,canada" />
<link href='style/style.css' rel='stylesheet' type='text/css' />
<script language="JavaScript" type="text/javascript" src="jquery.js"></script>
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>


<SCRIPT language="JavaScript" type="text/javascript">

function editClick(id)
{  alert("HI");
   alert(id);
var value=document.id.getElementById('rate').value;
	location.href = "edit_rates.php?id="+id+"&value="+value;
	
}
</script>
<body bgcolor="#e2e2e2" >
<table align="center" width="1005"  bgcolor="#FFFFFF" valign="top" >
<tr><td>
<?php

 if ($_SESSION['msg'])
{
echo "<center><h3><font color='#920'>". $_SESSION['msg']."</font></h3></center>";
$_SESSION['msg']="";
}
 
    $sql = "SELECT * FROM anp_rates order by id";
	$result = mysql_query($sql) or die(mysql_error());
    $count = mysql_num_rows($result);
?>
	
  
          <div style='padding-top: 30pt;'><FORM name='form1' method="post" action="edit_rates.php">
  	      <table   align='center' class='MYTABLE' valign='middle'>
          <TR CLASS='MYTABLE'><TD CLASS='MYTABLE'>&nbsp;</TD></TR>
          <caption class='MYTABLE'> ANP Transaction Rates</caption>
	      <TR CLASS='MYTABLE'><TD></TD>
         
          <TD CLASS='MYTABLE'><font size='4' color='#191970'>City</font></td>
          <TD CLASS='MYTABLE'><font size='4' color='#191970'>Country</font></td>
          <TD CLASS='MYTABLE'><font size='4' color='#191970'>Currency</font></td>
          <TD CLASS='MYTABLE'><font size='4' color='#191970'>Rate</font></td>
          <TD CLASS='MYTABLE'>&nbsp;</TD></TR>
           <TR CLASS='MYTABLE'><TD CLASS='MYTABLE'>&nbsp;</TD></TR>
     <?PHP     
     $sno=1;
       while($rows = mysql_fetch_array($result))
       {
	   ?>
      
         <tr onmouseover="this.style.backgroundColor='#E7E7E7'" onmouseout="this.style.backgroundColor='#FFFFFF'" onclick='javascript:void(0);'>
         
		
		<td>&nbsp;&nbsp;&nbsp;<? $id[$sno]=$rows['id']; ?><? echo $rows['id']; ?></td>
         <input type='hidden' id='id[<?php echo $sno;?>]' name='id[<?php echo $sno;?>]' value="<? echo $rows['id']; ?>"/>
		 <td><input type='text' id='city[<?php echo $sno;?>]' name='city[<?php echo $sno;?>]' value="<? echo $rows['city']; ?>"/></td>
		 <td><input type='text' id='country[<?php echo $sno;?>]' name='country[<?php echo $sno;?>]' value="<? echo $rows['country']; ?>"/></td>
		 <td><input type='text' id='currency[<?php echo $sno;?>]' name='currency[<?php echo $sno;?>]' value="<? echo $rows['currency']; ?>"/></td>
		 <td><input type='text' id='rate[<?php echo $sno;?>]' name='rate[<?php echo $sno;?>]' value="<? echo $rows['rates']; ?>"/></td>
	     
	    </tr>
		<tr CLASS="MYTABLE"><TD>&nbsp;</TD></tr>
       
<?php	
$sno++;	
}
?>          
             <tr CLASS="MYTABLE">
	         <td CLASS="MYTABLE" colspan="6"><input type="submit" name="Submit" value="Submit" title="Save changes to database"></td></tr>
	 		 <tr CLASS="MYTABLE"><TD>&nbsp;</TD></tr>
		     </table>
             </form></div>
             <p>&nbsp;</p>


</td></tr></table>

<table align="center" class="footer"><tr><td><?PHP include "footer.html"; ?></td></tr></table>
          <?php
include('lib/closedb.php');

?>
          