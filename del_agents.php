<?php
session_start();
include("lib/authenticate.php");
 
include('lib/config.php');
include('lib/opendb.php');
include('lib/phpFunctions.php');
include('menu.html');

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
<tr><td>
<form name="FORM" method="post" action="">
<input type="hidden" name="rank" id="rank" value="<?php echo $_SESSION['rank'] ?>"/>
<table width="900" border="0" align="center" cellpadding="2" cellspacing="1">
  <tr></tr>
  <tr>
    <td colspan="24" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="24" align="center"><div class="caption"> Delete Agent</div></td>
  </tr>
  <tr>
    <td colspan="24" align="center"><font style='color:#003366'><div id="message" name="message">
      <?php 
	         
			if(isset($_SESSION["del_Agent_Message"]))
			{
			//	echo getMessageAgentDel($_SESSION["del_Agent_Message"]);
			    echo $_SESSION["del_Agent_Message"];
				
				unset($_SESSION["del_Agent_Message"]);
			}
		    else if(isset($_SESSION['update_Agent_Message']))
			{
				echo getMessageAgentUpdate($_SESSION['update_Agent_Message']);
			//	echo $_SESSION['update_Agent_Message'];
				unset($_SESSION['update_Agent_Message']);
			}
			
		?>
    </div></font></td>
  </tr>
  <tr>
    <td colspan="24"><table width="900" border="0" cellspacing="0" cellpadding="0">
     <tr style="background:#666666; color:#ffffff; font-weight:bold;"> </tr>
    </table></td>
  </tr>
  <tr style="background:#666666; color:#ffffff; font-weight:bold;"> 
    <th width="15">Staff Id</th>
    <th width="30">FirstName</th>
    <th width="76">MiddleName</th>
    <th width="30">LastName</th>
    <!--<th width="65">Gender</th>
    <th width="70">Address1</th>
    <th width="77">Address2</th>-->
    <th width="30">City</th>
    <th width="20">Province</th>
    <th width="20">Country</th>
   <!-- <th width="80">Postal Code</th>-->
    <th width="20">Phone1</th>
    <th width="57">Email</th>
    <!--<th width="57">Phone2</th>
     <th width="57">Fax</th>
    <th width="25">PID</th>
    <th width="50">Image</th>-->
    <!--<th width="50">Date</th>
    <th width="50">Username</th>
    <th width="50">Password</th>-->
    <th width="50">Level</th>
    <th width="50">Budget</th>
    <th width="10">&nbsp;&nbsp;&nbsp;</th>
  </tr>
  <?php
  	$query ="SELECT * FROM staff ORDER BY staffid";
	
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
				 echo "<td>".$rows['staffid']."</td>";
				 echo "<td>".$rows['firstname']."</td>";
				 echo "<td>".$rows['middlename']."</td>";
				 echo "<td>".$rows['lastname']."</td>";
				 echo "<td>".$rows['city']."</td>";
				 echo "<td>".$rows['province']."</td>";
				 echo "<td>".$rows['country']."</td>";
				 echo "<td>".$rows['phone1']."</td>";
				 echo "<td>".$rows['email']."</td>";
				 echo "<td>".$rows['level']."</td>";
				 echo "<td>".$rows['budget']."";
				 /*echo "<td>".$rows['middlename']."</td>";
				 echo "<td>".$rows[10]."</td>";
				 echo "<td>".$rows[11]."</td>";
				 echo "<td>".$rows[12]."</td>";
				 echo "<td>".$rows[13]."</td>"; 
				 echo "<td>".$rows[14]."</td>"; 
				 echo "<td>".$rows[15]."</td>"; 
				 //echo "<td>".$rows[16]. "</td>";
				 echo "<td>".$rows[17]."</td>";
				 echo "<td>".$rows[18]."</td>";
				 echo "<td>".$rows[19]."</td>";
				 echo "<td>".$rows[20]."</td>";
				 echo "<td>".$rows[21]."</td>";
				 echo "<td>".$rows[22]."</td>";*/
				 echo "<input type='hidden' name='fname' id='fname' value='".$rows[1]."'/></td>";
				 ?>
				 <td><div id='del<?PHP echo $rows[0];?>' class='tt' ><a href="deleteAgent.php?id=<?PHP echo $rows[0];?>" onclick="return confirm('Are you sure you want to delete this Agent?');"><img src='img/delete-16x16.png' width='16' height='16' border='0'/></a></div></td>
                 <?PHP
				 echo "  </tr>";
				 $count++;
			}
		}
		else
		{
			echo "<tr align='center' style='background:#663333; color:#fff'><td colspan='24'>No Clients Found</td></tr>";
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