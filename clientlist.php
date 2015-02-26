<?php
session_start();
include("lib/authenticate.php");
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');
include"menu.html";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
$(document).ready(function(){

jQuery(window).load(function() {

	if((document.getElementById("rank").value=="admin")||(document.getElementById("rank").value=="Admin"))
	{ 
	  $(".tt").css("visibility:hidden");
	}
	else
	 $(".tt").css("visibility:visible");
		
   });

 
  });

</script>
</head>
<body bgcolor="#e2e2e2" >
<table align="center" width="1005"  bgcolor="#FFFFFF" valign="top" >
<tr height="70px"><td colspan="4"><div align="center"><a href="/ANP/modify_clients.php" align="left"><img src="/ANP/img/modify_user.jpg" /> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/ANP/del_clients.php" align="right"><img src="/ANP/img/delete_user.jpg" /></a></div></td></tr>
<tr><td>
<form name="FORM">
<input type="hidden" name="rank" id="rank" value="<?php echo $_SESSION['rank'] ?>"/>
<table width="400" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr></tr>
  <tr>
    <td colspan="4" align="center"></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><div class="caption"> Client List</div></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><font style='color:#900'><div id="message" name="message">
      <?php
			/*if(isset($_SESSION["delmessage"]))
			{
				echo getMessageDel($_SESSION["delmessage"]);
			//	echo $_SESSION["delmessage"];
				unset($_SESSION["delmessage"]);
			}*/
		    if(isset($_SESSION['update_User_message']))
			{
				echo getMessageUpdate($_SESSION['update_User_message']);
		     // echo $_SESSION['update_User_message'];
				unset($_SESSION['update_User_message']);
			}
			
		?>
    </div></font></td>
  </tr>
  <tr>
    <td colspan=""><table width="" border="0" cellspacing="0" cellpadding="0">
      <tr style="background:#666666; color:#ffffff"> </tr>
    </table></td>
  </tr>
  <tr style="background:#666666; color:#ffffff; font-weight:bold;">
    <th width="">User Id</th>
    <th width="">Client FirstName</th>
    <th width="">Client MiddleName</th>
    <th width="">Client LastName</th>
    <!--<th width="65">Gender</th>
    <th width="70">Address1</th>
    <th width="77">Address2</th>
    <th width="30">City</th>
    <th width="69">Province</th>
    <th width="65">Country</th>
    <th width="80">Postal Code</th>
    <th width="57">Phone1</th>
    <th width="57">Phone2</th>
    <th width="57">Email</th>
    <th width="25">PID</th>
    <th width="50">Image</th>
    <th width="50">Reg_Date</th>
    <th width="40">&nbsp;&nbsp;&nbsp;</th>
    <th width="40">&nbsp;&nbsp;&nbsp;</th>
    <th width="40">&nbsp;&nbsp;&nbsp;</th>-->
  </tr>
  <?php
  	$query ="SELECT * FROM USERS ORDER BY userid";
	
	$result = mysql_query($query);
	if($result)
	{
		$num_rows = mysql_num_rows($result);
		if($num_rows >0)
		{
			$count=1;
			$total =0;
			while($rows = mysql_fetch_array($result))
			{
					$total = $count%2;
				    if($total ==0)
						$style = "#cccccc";
					else
						$style="#999999";
				 echo "<tr align='center' height='20px' style='color:#fff;background:".$style."'>";
				 echo "<td>".$rows[0]."</td>";
				 echo "<td>".$rows[1]."</td>";
				 echo "<td>".$rows[2]."</td>";
				 echo "<td>".$rows[3]."</td>";
				 echo "  </tr>";
				 $count++;
			}
		}
		else
		{
			echo "<tr align='center' style='background:#663333; color:#fff'><td colspan='17'>No Clients Found</td></tr>";
		}
	}

  ?>
</table>
</form>

<p>&nbsp;</p>


</td></tr></table>

<table align="center" class="footer"><tr><td><?PHP include "footer.html"; ?></td></tr></table>

</body>
</html>
<?php 
include "lib/closedb.php";

?>