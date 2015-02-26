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
<body onLoad="">
<form name="FORM">
<input type="hidden" name="rank" id="rank" value="<?php echo $_SESSION['rank'] ?>"/>
<table width="1221" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr></tr>
  <tr>
    <td colspan="19" align="center"></td>
  </tr>
  <tr>
    <td colspan="19" align="center"><h2><b><font style='color:#920'> Client Info</font></b></h2></td>
  </tr>
  <tr>
    <td colspan="19" align="center"><font style='color:#900'><div id="message" name="message">
      <?php
			if(isset($_SESSION["delmessage"]))
			{
				echo getMessageDel($_SESSION["delmessage"]);
			//	echo $_SESSION["delmessage"];
				unset($_SESSION["delmessage"]);
			}
		    else if(isset($_SESSION['update_User_message']))
			{
				echo getMessageUpdate($_SESSION['update_User_message']);
		     // echo $_SESSION['update_User_message'];
				unset($_SESSION['update_User_message']);
			}
			
		?>
    </div></font></td>
  </tr>
  <tr>
    <td colspan="19"><table width="1221" border="0" cellspacing="0" cellpadding="0">
      <tr style="background:#C00; color:#FFF; font-weight:bold"> </tr>
    </table></td>
  </tr>
  <tr style="background:#963; color:#FFF">
    <th width="50">User Id</th>
    <th width="76">Client FirstName</th>
    <th width="76">Client MiddleName</th>
    <th width="80">Client LastName</th>
    <th width="65">Gender</th>
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
    <th width="40">&nbsp;&nbsp;&nbsp;</th>
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
						$style = "#900";
					else
						$style="#930";
				 echo "<tr align='center' height='20px' style='color:#fff;background:".$style."'>";
				 echo "<td>".$rows[0]."</td>";
				 echo "<td>".$rows[1]."</td>";
				 echo "<td>".$rows[2]."</td>";
				 echo "<td>".$rows[3]."</td>";
				 echo "<td>".$rows[4]."</td>";
				 echo "<td>".$rows[5]."</td>";
				 echo "<td>".$rows[6]."</td>";
				 echo "<td>".$rows[7]."</td>";
				 echo "<td>".$rows[8]."</td>";
				 echo "<td>".$rows[9]."</td>";
				 echo "<td>".$rows[10]."</td>";
				 echo "<td>".$rows[11]."</td>";
				 echo "<td>".$rows[12]."</td>";
				 echo "<td>".$rows[13]."</td>"; 
				 echo "<td>".$rows[14]."</td>"; 
				 echo "<td>".$rows[15]."</td>"; 
				 echo "<td>".$rows[16]."</td>";
				 echo "<td><input type='hidden' name='fname' id='fname' value='".$rows[1]."'/></td>";
				 echo " <td><div id='del".$rows[0]."' class='tt' ><a href='deleteUser.php?id=".$rows[0]."'onclick=\'confirmit(this.id);\'>delete?</a></div></td>";
				 echo "<td><div id='upd".$rows[0]."' class='tt' ><a href='updateUser.php?id=".$rows[0]."'>update?</a></div></td>";
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
</body>
</html>
<?php 
include "lib/closedb.php";

?>