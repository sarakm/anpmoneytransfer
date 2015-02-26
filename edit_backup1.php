<?php
session_start();
//include('authenticate.php');
include('lib/config.php');
include('lib/opendb.php');
include"top.php";
        
       // $today=date('Y-m-d');
	    $today='2010-03-18';
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
		 $sql= "SELECT * FROM TRANSACTIONS WHERE date_submitted='$today' order by transactionid desc";

//echo "sql=".$sql;

$_SESSION['sql']=$sql;
$res1 = mysql_query($sql) or die(mysql_error());
$counter=0;
$totalrows=mysql_num_rows($res1);
$limit=10;
$page=(isset($_GET['page']))? $_GET['page']: 0;
//echo "page=".$page;
if(empty($page)){
$page = 1;
}

$limitvalue = ($page - 1) * $limit;

$str=" LIMIT $limitvalue, $limit"; 
$query=$sql.$str;
$res = mysql_query($query) or die(mysql_error());



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
<form name="form1" id="form1" method="post" action="<? echo $_SERVER['PHPSELF'];?>">
<p><input type="button" name="totalRows" id="totalRows" value='<?= $totalrows; ?>' />&nbsp;&nbsp;TRANSACTIONS FOUND </p>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr>
		                    
			
<?php
        
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
               echo "<td height='25' bgcolor=$color>$transactionid</td>";
			   echo "<td height='25' bgcolor=$color>$userid</td>";
               echo "<td height='25' bgcolor=$color>$sender</td>";
			   echo "<td height='25' bgcolor=$color>$sender_address</td>";
			   
			   echo "<td height='25' bgcolor=$color>$gender $receiver_fname&nbsp;$receiver_mname&nbsp;$receiver_lname</td>";
			   echo "<td height='25' bgcolor=$color>$address1<br/>$address2</td>";
               echo "<td height='25' bgcolor=$color>$city<br/>$province<br/>$country<br/>$postalcode</td>";
			   echo "<td height='25' bgcolor=$color>$phone1<br/>$email</td>";
			   echo "<td height='25' bgcolor=$color>$pid</td></tr>";
			   echo "<tr><td height='25' bgcolor=$color>$startdate</td>";
			   echo "<td height='25' bgcolor=$color>$amt</td>";
			   
			   echo "<td height='25' bgcolor=$color>$cur</td>";
			   ?>
               <td height='25' bgcolor=$color><select name='agent' id='agent' value='' onchange='saveDB(this.id,this.value,<?= $transactionid ?>);'>
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
			  
			   ?>s
                </select></td>
                 <td height='25' bgcolor=$color>
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
			   echo "<td height='25' bgcolor=$color>$notes</td>";
			   echo "<td height='25' bgcolor=$color>$booker</td>";
			   ?>
			    
			   <?php /*?><!--<td height='25' bgcolor=$color><input type='checkbox' name='email_status' id='email_status' value=''  onclick='changeDBState(this.id,this.checked,<?= $transactionid ; ?>)'; '<? if($estatus==1)echo 'checked'; else if($estatus==0) echo 'false'; ?>'/>--><?php */ ?>
			  
               <td height='25' bgcolor=$color>Status:<?PHP if($estatus==1) $estatus="Sent"; else $estatus="Not Sent"; echo $estatus?></td>
               <td height='25' bgcolor=$color><input type='checkbox' name='email_status' id='email_status' value=''  onclick='changeDBState(this.id,this.checked,<?= $transactionid ; ?>
               
               
               </td></tr>
			   <?PHP
				$counter++;  
              }
			 echo "<p align='center'>";
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
}
//include"lib/closedb.php"; 
// }
          
?>



</tr>
</table>
</form>
</body>
</html>
<?php /*?>this.id,this.value,'.$transactionid.'<?php */?>