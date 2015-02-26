<?php
session_start();
include("lib/authenticate_br.php");
include('lib/config.php');
include('lib/opendb.php');
include ('lib/phpFunctions.php');
include_once("phpReportGen.php");
include_once("menu.html");
    $prg = new phpReportGenerator();
        $prg->width = "100%";
    $prg->cellpad = "0";
    $prg->cellspace = "0";
    $prg->border = "1";
    $prg->header_color = "#8080FF";
    $prg->header_textcolor="#FFFFFF";
    $prg->body_alignment = "left";
    $prg->body_color = "#FFFFCC";
	$prg->border_color = "#000000";
    $prg->body_textcolor = "#000000";
    $prg->surrounded = '1';
	$prg->heading="Transactions Report";
    

if(isset($_REQUEST['SUBMIT']))
{
//echo" in";
$agent=$_REQUEST['agent'];
$aname=$_REQUEST['agname'];

$timed=$_REQUEST['radio'];
$sdate=$_REQUEST['startDate'];
$edate=$_REQUEST['endDate'];
$today=date('Y-m-d');
$month= date('n');
$year=date('Y');
/*echo" agent= ".$agent;
echo" /n startdate= ".$sdate;
echo" /n startdate= ".$edate;
echo" /n timed= ".$timed;*/

$ag=$_SESSION['staffid'];
	if($_SESSION['rank']=='admin')
{
if(($timed=="timed")&&($sdate!="")&&($edate!=""))
{

$s="select transactions.*, staff.firstname as staff_firstname, staff.middlename as staff_middlename,staff.lastname as staff_lastname from transactions,staff where transactions.date_submitted between '".$sdate."' and '". $edate."' and agent='".$agent."' and  transactions.agent=staff.staffid order by transactions.date_submitted";

}
else if($timed=="daily")
{
$s="select transactions.*, staff.firstname as staff_firstname, staff.middlename as staff_middlename,staff.lastname as staff_lastname from transactions,staff where transactions.date_submitted = '".$today."' and transactions.agent='".$agent."' and  transactions.agent=staff.staffid order by transactions.date_submitted";
}

else if($timed=="monthly")
{

$s="select transactions.*, staff.firstname as staff_firstname, staff.middlename as staff_middlename,staff.lastname as staff_lastname from transactions,staff where year(transactions.date_submitted) = '".$year."' and month(transactions.date_submitted)= '".$month."' and transactions.agent='".$agent."' and transactions.agent=staff.staffid order by transactions.date_submitted";
}
else if($timed=="yearly")
{
$s="select transactions.*, staff.firstname as staff_firstname, staff.middlename as staff_middlename,staff.lastname as staff_lastname from transactions,staff where year(date_submitted)= '".$year."' and agent='".$agent."' and transactions.agent=staff.staffid order by transactions.date_submitted";
}
}
else if($_SESSION['rank']=='BRANCH MANAGER')
{
if(($timed=="timed")&&($sdate!="")&&($edate!=""))
{

$s="select transactions.*, staff.firstname as staff_firstname, staff.middlename as staff_middlename,staff.lastname as staff_lastname from transactions,staff where transactions.date_submitted between '".$sdate."' and '". $edate."' and agent='".$agent."'  and trans_booker=$ag and transactions.agent=staff.staffid order by transactions.date_submitted";

}
else if($timed=="daily")
{
$s="select transactions.*, staff.firstname as staff_firstname, staff.middlename as staff_middlename,staff.lastname as staff_lastname from transactions,staff where transactions.date_submitted = '".$today."' and transactions.agent='".$agent."'  and trans_booker=$ag and  transactions.agent=staff.staffid order by transactions.date_submitted";
}

else if($timed=="monthly")
{

$s="select transactions.*, staff.firstname as staff_firstname, staff.middlename as staff_middlename,staff.lastname as staff_lastname from transactions,staff where year(transactions.date_submitted) = '".$year."' and month(transactions.date_submitted)= '".$month."' and transactions.agent='".$agent."'  and trans_booker=$ag and transactions.agent=staff.staffid order by transactions.date_submitted";
}
else if($timed=="yearly")
{
$s="select transactions.*, staff.firstname as staff_firstname, staff.middlename as staff_middlename,staff.lastname as staff_lastname from transactions,staff where year(date_submitted)= '".$year."' and agent='".$agent."'  and trans_booker=$ag and transactions.agent=staff.staffid order by transactions.date_submitted";
}

}

//echo $s;
echo"<p>&nbsp;</p>";
$res=mysql_query($s);

    $prg->mysql_resource = $res;
	$prg->heading= $timed ."Transactions Report of  ".$aname."</br>  ". $sdate ."  ".$edate;
    $prg->generateReport();
	
	       




}

else
{
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ANP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="" />
<META HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta name="description" content="Money Transfer in toronto canada" />
<meta name="keywords" content=" toronto,canada" />
<link href='style/style.css' rel='stylesheet' type='text/css' />
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>
<script language="JavaScript" type="text/javascript" src="jsscript.js"></script>
<script language="JavaScript" type="text/javascript" src="/ANP/js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){

  $("p.test").click(function(){
     $("div:hidden").show("fast");
	 $("p.ss").hide("fast");
     
  
 
  });
});


 function checkForm()
 {
 //alert("HI");
 
 var sdate=document.form1.startDate.value;
 //alert(sdate);
 var edate=document.form1.endDate.value;
 var ct= document.form1.timed;
 //alert(ct);
 var agent=document.getElementById("agent").value;
 if( agent=="SEARCH"||agent=="")
 {
 alert("Please select an agent");
 return false;
 }
 
 else if(ct.checked==true &&(sdate==""||edate==""))
 {
 alert("Please enter the start date and end date");
 return false;
 }
 var w = document.form1.agent.selectedIndex;
 var selected_text = document.form1.agent.options[w].text;
 document.getElementById('agname').value=selected_text;
 //alert( document.getElementById('agname').value);
 return true; 
 }

</script>
</head>
<body>
<p>&nbsp;</p>
<table class="MYTABLE"  ALIGN="CENTER">
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit=" return checkForm();">

 <tr class="MYTABLE" >
 	<td class="MYTABLE" >
      <p class="ss"> 
      <label> Daily</label>
      </p>
    </td>
    <td class="MYTABLE" >
    <p class="ss">
         <input type="radio" name="radio" id="daily" value="daily" >
     </p>
    </td>
    <td class="MYTABLE" >&nbsp;
    </td>
    
    </tr>
  <tr class="MYTABLE" >
    <td class="MYTABLE" > 
    <p class="ss">
        <label > Monthly</label>
        </p>
    </td>
    <td class="MYTABLE" >
    <p class="ss">
        <input type="radio" name="radio" id="monthly" value="monthly">
        </p>
    </td>
    <td class="MYTABLE" colspan="2" >
   
      <p class="ag" style="float:right";>
      <fieldset><legend>Agent Locator</legend><table  cellpadding="0" cellspacing="0"><tr >
        	<td align="center">    <SELECT NAME ="agent" id="agent" STYLE = "width: 100" value="" >
  <option value="SEARCH" selected="selected">Select Agent</option>
       <?php 
	  $query = "select staffid,firstname,middlename,lastname FROM staff ORDER BY firstname";
			$result=mysql_query($query);
	        $numrows = mysql_num_rows($result);
			if($numrows !=0)
			{
			
	    while($row1=mysql_fetch_array($result))
		{   
		  $agentid= $row1[0];
		  $agent_name=$row1[1]." ".$row1[2]." ".$row1[3];		  
		  echo"<option id=$agent_name value=$agentid>$agent_name</option>";
		}
		}
	 
?>	  
  </SELECT>
   <input type="hidden" name="agname" id="agname" value=""/>   
			</td></tr></table></fieldset>
          
        </p>
    </td>
    </tr>
    <tr class="MYTABLE" >
    <td  class="MYTABLE" >
       <p class="ss">
        <label> Yearly</label>
        </p>
    </td>
    <td class="MYTABLE" >
     <p class="ss">    
        <input type="radio" name="radio" id="yearly" value="yearly">
     </p>
    </td>
    </tr>
    <tr class="MYTABLE" >
    <td class="MYTABLE" >
        <label > Timed</label> 
    </td> 
    <td class="MYTABLE" >   
       <p class="test" > <input type="radio" name="radio" id="timed" value="timed"></p>
     </td>
     </tr>
     <tr class="MYTABLE">
     <td class="MYTABLE" colspan="4"> <div align="center" style="display:none;"> 
        <p class="date" style="float:"right";>
       START DATE <input name="startDate" id="startDate" type="text" size="15" maxlength="15" AUTOCOMPLETE = "off"
>YYYY-MM-DD
      </p>
      <p class="date">
     &nbsp;&nbsp;&nbsp;  END DATE <input name="endDate" id="endDate" type="text" size="15" maxlength="15" AUTOCOMPLETE = "off"
 >YYYY-MM-DD
      </p>
      </td>
  </tr>
  <tr class="MYTABLE"><td>&nbsp;</td></tr>
  <tr class="MYTABLE"><td colspan="4" align="center" ><input type="submit" name="SUBMIT" id="SUBMIT" value="SUBMIT" autocomplete="off" /></td></tr>
   <tr class="MYTABLE"><td>&nbsp;</td></tr>
</form>
</body>
</html>
<?php
include('lib/closedb.php');
}
?>