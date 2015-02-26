<?php
include('lib/config.php');
include('lib/opendb.php');

//Send some headers to keep the user's browser from caching the response.
/*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");*/

$search = trim($_REQUEST['search']);

///Make sure that a value was sent.
if (isset($search) && $search != '')
{	
	//echo $search;

	$sql = "SELECT distinct(city) AS city FROM currency_name WHERE country LIKE ('" . $search . "%') ORDER BY city LIMIT 0, 10";
	$query = mysql_query($sql) or die(mysql_error());

	while($suggest = mysql_fetch_array($query))
	{
		echo trim($suggest['city']) . "\n";	
	}	
}

include('lib/closedb.php');

?>
