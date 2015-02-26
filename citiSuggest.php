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

///Make sure that a value was sent.
if (isset($search) && $search != '')
{	
	

	$sql = "SELECT distinct(city) AS city, country AS country FROM anp_rates WHERE city LIKE ('" . $search . "%') ORDER BY city";
	$query = mysql_query($sql) or die(mysql_error());

	while($suggest = mysql_fetch_array($query))
	{
		echo trim($suggest['city']) . ",".$suggest['country']."\n";	
	}	
}

include('lib/closedb.php');


?>
