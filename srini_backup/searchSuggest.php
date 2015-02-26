<?php

include('../lib/config.php');
include('../lib/opendb.php');

//Send some headers to keep the user's browser from caching the response.
header("Expires: Mon, 26 Jul 2010 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

$search = trim($_GET['search']);
$id=trim($_GET['id']);

//echo $search;

///Make sure that a value was sent.
if (isset($search) && $search != '')
{	
/*	switch ($id) {
    case 'firstname':
        $sql="select distinct(firstname) from users where firstname LIKE ('". $search . "%') ORDER BY firstname";
        break;
    case 'lastname':
        $sql="select distinct(lastname) from users where lastname LIKE ('". $search . "%') ORDER BY lastname";
        break;
    case 'city':
        $sql="select distinct(city) from users where city LIKE ('". $search . "%') ORDER BY city";
        break;
	case 'province':
        $sql="select distinct(province) from users where province LIKE ('". $search . "%') ORDER BY province";
        break;
	case 'country':
	    $sql="select distinct(country) from users where country LIKE ('". $search . "%') ORDER BY country";
        break;
}*/
   
//$sql="select distinct(firstname) from users where firstname LIKE ('". $search . "%') ORDER BY firstname";
if(isset($id)&& ($id !=NULL))
{
$sql="select distinct($id) from users where $id LIKE ('". $search . "%') ORDER BY $id";
}
	$query = mysql_query($sql) or die(mysql_error());

	while($suggest = mysql_fetch_array($query))
	{
		//echo "".trim($suggest['".$search.'"]) . "\n";	
		echo trim($suggest[0]). "\n";
	}	
}

include('../lib/closedb.php');

?>
