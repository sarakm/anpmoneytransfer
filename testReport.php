<?php
session_start();
	if(isset($_REQUEST['from'])&& isset($_REQUEST['to']))
	{
	include('lib/config.php');
	include('lib/opendb.php');
	include ('lib/phpFunctions.php');
    include_once("phpReportGen.php");
	$from=htmlspecialchars($_REQUEST['from']);
	$to=htmlspecialchars($_REQUEST['to']);
	$id=htmlspecialchars($_REQUEST['id']);

	
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
	$prg->heading="User Report";
        //$prg->font_name = "Boishakhi";
	$from="'".$from."'";
	$to="'".$to."'";
	echo"<p>&nbsp;</p>";
	if($_REQUEST['id']!="")
	{
		$res=mysql_query("select * from transactions where agent=$id and DATE_FORMAT(date_completed,'%d-%m-%Y') between ".$from." and ".$to);
		
	}
	else
	{
	$res =mysql_query("select * from transactions where DATE_FORMAT(date_completed,'%d-%m-%Y') between ".$from." and ".$to);
	}
	$prg->mysql_resource = $res;
	$prg->heading="Transactions Report";
    $prg->generateReport();
	
    include('lib/closedb.php');
	}
	else
	{
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PHP Report Generator</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href='style/style.css' rel='stylesheet' type='text/css' />
</head>
<body>    
<form name="form" method="post" action="<?php echo $PHP_SELF;?>">
<TABLE class="MYTABLE" >
<CAPTION CLASS="MYTABLE">TIMED REPORTS</CAPTION>
<tr><TD>&nbsp;</TD></tr>
<tr CLASS="MYCLASS">

<td width="176"></td>

<td width="98">From</td>
<td width="308"><input name="from" id="from" type="text" size="15" maxlength="20" /><label>dd-mm-yyyy</label></td>
</tr>
<tr CLASS="MYCLASS">
<td></td>
<td>To</td>
<td><input name="to" id="to" type="text" value="" size="15" maxlength="20" />dd-mm-yyyy</td></tr>
<tr CLASS="MYCLASS">
<td></td>
<td>Agent Id</td>
<td>
<input name="id" type="text" value="" size="10" maxlength="10" />&nbsp;&nbsp;&nbsp;</td></tr>
<tr><TD>&nbsp;</TD><TD>&nbsp;</TD><TD>&nbsp;</TD></tr>
<tr><td></td><TD>&nbsp;</TD><td><input name="submit" type="submit" value="submit" /></td></tr>
</TABLE>
</form>
</body>
</html>
<?php
}
?>
	