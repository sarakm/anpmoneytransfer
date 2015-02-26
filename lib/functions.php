<?php

function getBanner($section)
{
$sql = "SELECT imgURL, linkURL FROM bannerTbl WHERE locID=$section";
$result = mysql_query($sql);

	$banners = array();
	while ($row = mysql_fetch_row($result))
	{
		$banners[] = $row;
	}
	$num_ads = count($banners);
	
    	list($usec, $sec) = explode(' ', microtime());
    	srand((float) $sec + ((float) $usec * 100000));

	$index = rand(0, $num_ads-1);
	$img = $banners[$index][0];
	$link = $banners[$index][1];

return $link.":".$img;
}

function getEvents($limit)
{
	if ($limit == 0 || !isset($limit))
	{
		$sql = "SELECT `eventsDisplay` FROM eventsDisplayTbl";
		$result = mysql_query($sql);
		$limit = mysql_result($result, 0) or die (mysql_error());
	}
	if ($limit)
	{
		$sql = "SELECT eventTitle, eventWhere, eventMonth, eventDay, eventYear, eventURL FROM eventsTbl ORDER BY eventID DESC LIMIT $limit";
		$result = mysql_query($sql) or die(mysql_error());
		
		while(list($title, $where, $month, $day, $year, $link) = mysql_fetch_row($result))
		{
			$events .= "<a href=\"http://$link\" style=\"text-decoration: none; color: #ffffff\"><strong>$title</strong> @ $where ($months[$month] $day, $year)</a><br><br>\n";
		}
	}

return $events;
}

function getState($month, $day, $year)
{
$state;
$color;

$currentYear = date('Y');
$currentMonth = date('n');
$currentDay = date('j');

if ($year > $currentYear)
{
	$state = "Good";
	$color = "green";
}
elseif ($year == $currentYear)
{
	if ($month > $currentMonth)
	{
		$state = "Good";
		$color = "green";
	}
	elseif ($month == $currentMonth)
	{
		if ($day > $currentDay)
		{
			$state = "Good";
			$color = "green";
		}
		elseif ($day == $currentDay)
		{
			$state = "Good";
			$color = "green";
		}
		elseif ($day < $currentDay)
		{
			$state = "Expired";
			$color = "red";
		}
	}
	elseif ($month < $currentMonth)
	{
		$state = "Expired";
		$color = "red";
	}
}
elseif ($year < $currentYear)
{
	$state = "Expired";
	$color = "red";
}

return "<font color=\"$color\"><strong>$state</strong></font>";
}

?>