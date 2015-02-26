<?php
session_start();
//include('authenticate.php');
include('lib/config.php');
include('lib/opendb.php');
include('menu.html');
if(isset($_GET['id']) && isset($_GET['val']))
{
 $id=$_GET['id'];
 $val=$_GET['val'];
 $filter=$id; 
 //selects  only the records of selected agent, which are not yet emailed(0) and selected for sending email
 $sql= "SELECT * FROM `transactions` WHERE agent=$id and upper(status) = upper('assigned') and email_status='0' and selected=upper('yes') order by transactionid";
//  echo $sql;
 $_SESSION['sql']=$sql;
/* $_SESSION['agentname']=$id;*/
 header("location:excel_format.php?agentname=".$id);
}

//include"top.php";
        
       // $today=date('Y-m-d');
/*	    $today='2010-03-18';
		$search =(isset($_GET['search']))? $_GET['search']: "";
		//echo"SEARCH=". $search;
		
		$filter =(isset($_GET['filter']))? $_GET['filter']: ""; 
	  // echo "FILTER". $filter;
		if(($search!="") || ($filter!=0)||$filter!="")
	   {
		if($filter=="city")
		{
		list($receiver_city,$country)=explode(",",$search);
		$filter='receiver_city';
		$search=$receiver_city;
		$sql = "SELECT * FROM transactions WHERE UPPER($filter)=upper('$search') and UPPER(receiver_country)=UPPER('$country') order by transactionid desc";
		}
			
		else
		{
		$sql = "SELECT * FROM transactions WHERE $filter='$search' order by transactionid desc";
		}
	 }
	else
		//$sql = "SELECT * FROM `transactions` WHERE upper(status) in(upper('started'),upper('assigned'))";
		 $sql= "SELECT * FROM TRANSACTIONS WHERE date_submitted='$today' order by transactionid desc";*/

//echo "sql=".$sql;

else if(isset($_GET['filter']))
{
$filter=$_GET['filter'];
$sql = "SELECT * FROM `transactions` WHERE agent='$filter' and upper(status) in(upper('started'),upper('assigned')) and email_status='0' order by status";
}
else
$sql = "SELECT * FROM `transactions` WHERE upper(status) in(upper('started'),upper('assigned')) and email_status='0' order by agent";

$_SESSION['sql']=$sql;

$res1 = mysql_query($sql) or die(mysql_error());
$counter=0;
$totalrows=mysql_num_rows($res1);
/*$limit=10;
$page=(isset($_GET['page']))? $_GET['page']: 0;
//echo "page=".$page;
if(empty($page)){
$page = 1;
}

$limitvalue = ($page - 1) * $limit;

$str=" LIMIT $limitvalue, $limit"; 
$query=$sql.$str;*/
$res = mysql_query($sql) or die(mysql_error());



// echo"IN";
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
<script language="JavaScript" type="text/javascript" src="js/checkSender.js"></script>
</head>
<body>
<body  bgcolor="#e2e2e2" >
<table align="center" width="997"  bgcolor="#FFFFFF" >
<tr><td>
<div>
  <div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px; color:#FFFFFF; font-weight:bold; margin-bottom:20px;">ANP Transaction Panel</div>
</div>
<div class="menu"> 
         <!--<a href="trans_list.php" >View </a>-->   
<!--        <a href="update.php" >Update </a>-->
 <!--       <input type="submit" name="sendmail" id="sendmail" value="Email"/>        
            <a href="excel_format.php"><img src="../images/B.jpg" BORDER="0" ALT="EXPORT" /></a>   
        <a href="logout.php" id="last">Logout</a>--> 
          <!--<div align="right" width="10%" style="background-color:#FFFFFF; display: block; border-left:#003366; border-right:#003366;   border-color:#000066 " >-->
         <div align="right" style="width:120px; float:right; background="none"> <a href="javascript:window.print();"><img src="/ANP/img/B8.png" BORDER="0" ALT="PRINT" /></a></div>
          <div align="right" style="width:120px; float:right; background="none"> <a href="javascript:email();"><img src="/ANP/img/B.png" BORDER="0" ALT="EMAIL" /></a></div>
      </div>  

	  <form name="f1" id="f1" action="edit.php" method="get" style="margin-top:20px;">
          <div style="margin-left:20px;">
           <!-- <input type="text" name="search" id="search" style="margin-bottom:10px; width:145px;"/>
                <select name="filter" id="filter" style="margin-bottom:10px; width:145px;" onchange="getTransactions(this.value);">
                    <option value="0">SELECT ANY ONE</option>
                	<option value="1">transId#</option>
                    <option value="2">Agent#</option>
                    <option value="3">Location#</option>
                    <option value="4">Trans Status</option>
                    <option value="5">emailStatus</option>
                    <option value="6">SenderId</option>
                </select>-->
               <p align="center">
               <select name="selectagent" id="selectagent" style="margin-bottom:10px; width:145px;" onchange="agentTrans(this.value);">
               <option value='0'>Select Agent</option>
               <?php 
				include('lib/config.php');
                include('lib/opendb.php');
				
                
			   $s="select staffid,firstname,middlename,lastname from staff";
			   $s_res=mysql_query($s);
			   
			   while($row=mysql_fetch_array($s_res))
			   { $sid=$row['staffid'];
			    $sname=$row['firstname']." ".$row['middlename']." ".$row['lastname'];
				if($sid==$filter)
			    echo"<option value=".$sid." selected='TRUE'>".$sname."</option>";
			    else
				 echo"<option value=".$sid.">".$sname."</option>";
			   }
			  
			   ?>
                </select></td>
              
           <p></p>
            <hr style="background-color: #990000; height: 5px;" />
     </div>      
       </form> 
<form name="form1" id="form1" method="get" action="trans_email.php">



	<tr align="center">
	<div class="centerdiv"> <input type="button" name="totalRows" id="totalRows" value='<?= $totalrows; ?>' />&nbsp;&nbsp;TRANSACTIONS FOUND </div>	                    
	<table class="MYTABLE" align="center" border="1"  bgcolor="#FFFFFF" cellspacing="0" cellpadding="0">
    <caption><h1> Transactions to be sent </h1></caption>		   
<?php
                
                $color='#eeeecc';
				echo "<td width='10' height='25' bgcolor=$color>TR_ID</td>";
				echo "<td width='15' height='25' bgcolor=$color align='center'>AGENT</td>";
				echo "<td width='7'  height='25' bgcolor=$color>STATUS</td>";
               // echo "<td width='10' height='25' bgcolor=$color>SENDERID</td>";
				echo "<td width='20' height='25' bgcolor=$color>SENDER</td>";
				echo "<td width='20' height='25' bgcolor=$color>SENDER_ADDRESS</td>";
				echo "<td width='20' height='25' bgcolor=$color>RECEIVER_NAME</td>";
				echo "<td width='25' height='25' bgcolor=$color>ADDRESS</td>";
				echo "<td width='25' height='25' bgcolor=$color>ADDRESS</td>";
				echo "<td width='12' height='25' bgcolor=$color>PHONE</td>";
			//	echo "<td width='10' height='25' bgcolor=$color>SSN/DL</td>"; 
			//	echo "<td width='10' height='25' bgcolor=$color>DATE_SUBMITTED</td>";
				echo "<td width='10' height='10' bgcolor=$color>AMOUNT</td>";
			//	echo "<td width='6' height='25' bgcolor=$color>CURRENCY</td>";
				echo "<td width='25' height='25' bgcolor=$color>NOTES</td>";
			//	echo "<td width='5' height='25' bgcolor=$color>BOOKER</td>";
				echo "<td width='5' height='25' bgcolor=$color>SELECT</td></tr>"; 
	 
	    $sno=0;
		 while(list($transactionid, $userid, $sender,$sender_address, $receiver_fname, $receiver_mname, $receiver_lname,$gender, $address1,  $address2, $city, $province, $country, $postalcode, $phone1, $phone2, $email,$pid,$photo,$startdate,$enddate,$total,$cur,$amt,$agent,$status,$reason,$notes,$booker,$trans_num,$time,$send_amt,$fee,$rate,$estatus) = mysql_fetch_row($res))
             {
			 $color = ($counter % 2 == 0) ? "#F7F7F7":"#FFFFFF";
               if($gender=='M')
			    $gender='Mr.';
			   else if ($gender=='F')
			    $gender='Ms/Mrs.';
				/*echo "<td><input type='hidden' name='hid' id='hid' value=$hid>$hid</td>";
				echo "<td><input type='hidden' name='hagent' id='hagent' value=$hagent>$hagent</td>";
				echo "<td><input type='hidden' name='hstatus' id='hstatus' value=$hstatus>$hstatus</td>";*/
               echo "<tr align='center'><td height='25' bgcolor=$color>$transactionid</td>";
			?>
               
               <td height='25' bgcolor='#FFFFFF'><select name='agent' id='agent' value='' onchange='saveDB(this.id,this.value,<?= $transactionid ?>);'>
                 <option value='0'>Select Agent</option>
                 
         <?php   
			   $s="select staffid,firstname,middlename,lastname from staff";
			   $s_res=mysql_query($s);
			   
			   while($row=mysql_fetch_array($s_res))
			   {$sid=$row['staffid'];
			    $sname=$row['firstname']." ".$row['middlename']." ".$row['lastname'];
				if($sid==$agent)
			    echo"<option value=".$sid." selected='TRUE'>".$sname."</option>";
			    else
				 echo"<option value=".$sid.">".$sname."</option>";
			   }
			  
			?>
                </select></td>
                <td height='25' bgcolor='#FFFFFF'>
                 <select name='status' id='status' value='' onchange='saveDB(this.id,this.value,<?= $transactionid ?>);'>
                 <option value='none'>SELECT</option>
          <?PHP
			    $q="select id,name from anp_status";
                $q_res=mysql_query($q);
			   while($r=mysql_fetch_array($q_res))
			   {$qid=$r['id'];
			    $state=$r['name'];
				if($state==$status)
			    echo"<option value=".$state." selected='TRUE'>".$state."</option>";
			    else
				 echo"<option value=".$state.">".$state."</option>";
			   }
		  ?>
               </select>               </td>
         <?PHP
			//   echo "<td height='25' bgcolor=$color>$userid</td>";
               echo "<td height='25' bgcolor=$color>$sender</td>";
			   echo "<td height='25' bgcolor=$color>$sender_address</td>";
			   
			   echo "<td height='25' bgcolor=$color>$gender $receiver_fname&nbsp;$receiver_mname&nbsp;$receiver_lname</td>";
			   echo "<td height='25' bgcolor=$color>$address1<br/>$address2</td>";
               echo "<td height='25' bgcolor=$color>$city<br/>$province<br/>$country<br/>$postalcode</td>";
			   echo "<td height='25' bgcolor=$color>$phone1<br/>$email</td>";
			 //  echo "<td height='25' bgcolor=$color>$pid</td>";
			// echo "<td height='25' bgcolor=$color>$startdate</td>";
			   echo "<td height='25' bgcolor=$color>$amt</td>";
			// echo "<td height='25' bgcolor=$color>$cur</td>";
		       echo "<td height='25' bgcolor=$color>$notes</td>";
		   //  echo "<td height='25' bgcolor=$color>$booker</td>";
		  ?>
           <td height='25' bgcolor='#FFFFFF'><input type='checkbox' width='15px' height="15px" name='selected[<?php echo $sno;?>]' id='selected[<?php echo $sno;?>]' value='<?PHP echo $transactionid;?>' onclick='saveSelected(this.checked,this.value);' />   </td></tr>
          <?php /*?><!--<td height='25' bgcolor=$color><input type='checkbox' name='email_status' id='email_status' value=''  onclick='changeDBState(this.id,this.checked,<?= $transactionid ; ?>)'; '<? if($estatus==1)echo 'checked'; else if($estatus==0) echo 'false'; ?>'/>--><?php */ ?>
		  <?PHP
				$counter++;
				$sno++;  
              }
			 /*echo "<p align='center'>";
			  if($page > 1){
$pageprev = $page-1;
echo("<a href=\"edit.php?page=$pageprev\">PREV</a>&nbsp;");
}

$numofpages = ceil($totalrows / $limit);

for($i = 1; $i <= $numofpages; $i++){
if($page == $i){
echo($i."&nbsp;");
}else
echo("<a href=\"edit.php?page=$i\">$i</a>&nbsp;");
}

if($page < $numofpages){
$pagenext = ($page + 1);
echo ("<a href=\"edit.php?page=$pagenext\">NEXT</a>");
echo "</p>";
}*/
//include"lib/closedb.php"; 
// }
          
?>



</tr>

</table>
</td></tr></table>
 
</form>
<table align="center" class="footer"><tr><td><?PHP include "footer.html"; ?></td></tr></table>
</body>
</html>

<?php
include"lib/closedb.php";
?>