<?php
include('lib/config.php');
include('lib/opendb.php');

//Send some headers to keep the user's browser from caching the response.
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

$search = trim($_GET['search']);
$province= trim($_GET['province']);
$country= trim($_GET['country']);

///Make sure that a value was sent.
if (isset($search) && $search != '')
{	
	

	/*$sql = "SELECT firstname AS fname, middlename AS mname, lastname AS lname FROM staff WHERE firstname LIKE ('" . $search . "%') OR middlename LIKE ('" . $search . "%') OR lastname LIKE ('" . $search . "%') ORDER BY firstname";*/
	$sql = "SELECT firstname AS fname, middlename AS mname, lastname AS lname FROM staff WHERE firstname LIKE ('" . $search . "%') OR middlename LIKE ('" . $search . "%') OR lastname LIKE ('" . $search . "%') and country LIKE ('". $country."%') and province LIKE('". $province."%') ORDER BY firstname";
	
	$query = mysql_query($sql) or die(mysql_error());

	while($suggest = mysql_fetch_array($query))
	{
		echo trim($suggest['fname']) . " ".$suggest['mname']." ".$suggest['lname']."\n";	
	}	
}

include('lib/closedb.php');

?>
