<?php
    session_start();
	include("lib/authenticate_br.php");
	?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<META HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<html>
<head>
<title>PHP Report Generator</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
    <?php
	
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
        //$prg->font_name = "Boishakhi";

    
  
    /*//$res = mysql_query("select name, age, area from table1 where age>20");
	$res = mysql_query("select * from users order by userid");
    $prg->mysql_resource = $res;
    $prg->generateReport();
	
	echo"<p>&nbsp;</p>";
	$res = mysql_query("select * from staff order by staffid");
    $prg->mysql_resource = $res;
	$prg->heading="Staff Report";
    $prg->generateReport();*/
	$today=date('Y-m-d');
	
	echo"<p>&nbsp;</p>";
	$ag=$_SESSION['staffid'];
	if($_SESSION['rank']=='admin')
	$sql = "select * from transactions where date_submitted='".$today."' order by transactionid";
	else if($_SESSION['rank']=='BRANCH MANAGER')
	$sql = "select * from transactions where date_submitted='".$today."' and trans_booker=$ag order by transactionid";
	
	$res = mysql_query($sql);
	
	
    $prg->mysql_resource = $res;
	$prg->heading="Daily Transactions Report";
    $prg->generateReport();
	
	
    include('lib/closedb.php');
	
    ?>
</body>
</html>