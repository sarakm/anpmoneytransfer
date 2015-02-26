<?php
session_start(); ob_start();

include('lib/config.php');
include('lib/opendb.php');
require_once 'Spreadsheet/Excel/Writer.php';
$workbook = new Spreadsheet_Excel_Writer();
if(isset($_GET['agentname']))
{$agentname=$_GET['agentname'];}
else{$agentname="";}
if(isset($_SESSION['sql']))
{$sql=$_SESSION['sql'] ;
unset($_SESSION['sql']);
}
else{ $sql="";}
if(agentname!=0 && agentname !="")
{
$ss="select firstname,middlename,lastname from staff where staffid=$id";
$result = mysql_query($ss) or die(mysql_error());
$a_row=mysql_fetch_array($result);
$agentname=$a_row['firstname']." ".$a_row['middlename']." ".$a_row['lastname'];
}


//$sql=$_SESSION['sql'];
//echo $sql;
$old="SELECT * ";
$new="select transactionid,userid,sender,sender_address,receiver_gender,receiver_firstname,receiver_middlename,receiver_lastname,receiver_address1,receiver_city,receiver_province,receiver_country,receiver_phone1,receiver_email,receiver_PID_DLN,currency,amount_to_receive,agent,date_submitted,trans_time,notes,trans_booker ";
$s = str_replace($old,$new,$sql);
//echo $s;
$result = mysql_query($s) or die(mysql_error());	
	//first of all unset these variables
	unset($_SESSION['report_header']);
	unset($_SESSION['report_values']);
	//note that the header contain the three columns and its a array
$_SESSION['report_header']=array("Trans_Id", "SenderId","Sender","Sender Address","Gender","Receiver Firstname","Receiver Middlename","Receiver Lastname", "Receiver Address","City","State","Country","ZipCode","Phone","Email","Identification","Currency","Amount","Agent","Date","Time","Notes","Booker" );
	
// now the excel data field should be two dimentational array with all column
 //loop through the needed cycle
$filename="Transactions".$agentname.date('dS M Y')."."."xls";

$worksheet =$workbook->addWorksheet();
$titleText = 'TRANSACTION LIST FOR '. $agentname  . date('dS M Y');
$titleFormat =$workbook->addFormat();
 $dateFormat =$workbook->addFormat();
$titleFormat->setFontFamily('Helvetica'); 
$titleFormat->setBold();
$titleFormat->setColor('Black');
$titleFormat->setPattern(1);
$titleFormat->setFgColor("navy");
$titleFormat->setSize('20');


$worksheet->write(0,3,$titleText,$titleFormat);
$worksheet->write(0,4,'',$titleFormat);
$worksheet->write(0,5,'',$titleFormat);
$worksheet->write(0,6,'',$titleFormat);
$titleFormat->setSize('14');
$titleFormat->setFgColor('grey');
$titleFormat->setColor('white');
$worksheet->setColumn(0,0,10,0);
$worksheet->setColumn(1,1,10,0);
$worksheet->setColumn(2,2,20,0);
$worksheet->setColumn(3,3,40,0);
$worksheet->setColumn(6,6,15,0);
$worksheet->setColumn(7,7,35,0);
$worksheet->setColumn(8,8,15,0);
$worksheet->setColumn(9,9,12,0);

 
 $worksheet->writeRow (2,0,array("Trans_Id", "SenderId","Sender","Sender Address","Gender","Receiver Firstname","Receiver Middlename","Receiver Lastname", "Receiver Address","City","State","Country","ZipCode","Phone","Email","Identification","Currency","Amount","Agent","Date","Time","Notes","Booker" ),$titleFormat);

$i=4;
 while ($row = mysql_fetch_assoc($result))
 {    
      $worksheet->write($i,0, $row["transactionid"]);
      $worksheet->write($i,1, $row["userid"]);
      $worksheet->write($i,2, $row["sender"]); 
      $worksheet->write($i,3, $row["sender_address"]);
      $worksheet->write($i,4, $row["receiver_gender"]);
      $worksheet->write($i,5, $row["receiver_firstname"]);
      //$worksheet->write($i,6,  $row["img"]);
      $worksheet->write($i,6, $row["receiver_middlename"]);
      $worksheet->write($i,7, $row["receiver_lastname"]);
      $worksheet->write($i,8, $row["receiver_address1"]);
	  $worksheet->writeString($i,9, $row["receiver_city"]);
	  $worksheet->writeString($i,10, $row["receiver_province"]);
	  $worksheet->writeString($i,11, $row["receiver_country"]);
	  $worksheet->writeString($i,12, $row["receiver_postalcode"]);
	  $worksheet->writeString($i,13, $row["receiver_phone1"]);
	  $worksheet->writeString($i,14, $row["receiver_email"]);
	  $worksheet->writeString($i,15, $row["receiver_PID_DLN"]);
	  $worksheet->writeString($i,16, $row["currency"]);
	  $worksheet->writeString($i,17, $row["amount_to_receive"]);
	  $worksheet->writeString($i,18, $row["agent"]);
	  $worksheet->writeString($i,19, $row["date_submitted"]);
	  $worksheet->writeString($i,20, $row["trans_time"]);
	  $worksheet->writeString($i,21, $row["notes"]);
	  $worksheet->writeString($i,22, $row["trans_booker"]);
	  $i++;
}
$titleFormat->setAlign("right");


/*$worksheet->write(0, 0, "Quarterly Profits for Dotcom.Com", $format_title);
// While we are at it, why not throw some more numbers around
$worksheet->write(1, 0, "Quarter", $format_bold);
$worksheet->write(1, 1, "Profit", $format_bold);
$worksheet->write(2, 0, "Q1");
$worksheet->write(2, 1, 0);
$worksheet->write(3, 0, "Q2");
$worksheet->write(3, 1, 0);
*/

$workbook->send($filename);

//print_file($filename);
$workbook->close();

$s="UPDATE transactions SET email_status=1,selected='NO' where selected='YES'";
$res=mysql_query($s)or die(mysql_error());
include('lib/opendb.php');
?> 