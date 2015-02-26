<?php
include('lib/config.php');
include('lib/opendb.php');
?>
<html>
<head>
<title>Money Info</title>
<script language="Javascript" src='js/jsscript.js'>
</script>
</head>
<body>
<table width="715" border="0" cellspacing="0" cellpadding="0">
<form name="f1">
  <tr>
    <td width="268">Amount to send: <input type="text" name="money" id="money" size="30" onKeyUp="doThis(this.value);" onBlur ="doThis(this.value);"/></td>
    <td width="352" rowspan="3"><table width="352" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><b>Please choose the country &amp; city to where you would like to send this amount</b></td>
      </tr>
      <tr>
        <td height="36">
        <select name="country" onChange="getCity(this.value)">
            <option value="0" selected>SELECT a Country</option>
            <?php
        $query = "SELECT DISTINCT country FROM staff";
        $result=mysql_query($query);
        if($result)
        {
            while($row=mysql_fetch_array($result))
            {
                echo "<option value=".$row['country'].">".$row['country']."</option>";
            }
        }
        ?>
          </select>
       </td>
        </tr>
      <tr>
        <td>
        <div name="cityDrop" id="cityDrop" style="visibility:hidden">
        	<select id="city" name="city"></select>
           </div>
        </td>
        </tr>

      <tr>
        <td height="111" valign="top">
        <!--MONEY RESULT -->
        	<div id="result" name="result">
            </div>
           <!--END OF MONEY RESULT -->
         </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="10" align="center">
    	<div id="moneyalert" style="visibility:hidden"><b><i>Your must type a valid amount</i></b></div>
     </td>
  </tr>
  <tr>
    <td align="center" valign="top">
    
    <div  name="moneyEx" id="moneyEx" style="visibility:hidden" >
    	<span style="color:#F00; font-weight:bold">Ops, You are about the send a large amount of money the exceeds the 999.99 dollars, please give us a reason of the money and type the clien id</span><br/>
        <textarea name="reason" rows="5" cols="40">
        </textarea>
    </div>
    
    </td>
  </tr>
  
  </form>
</table>
</body>

</html>
<?php
include ('lib/closedb.php');
?>