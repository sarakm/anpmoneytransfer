<?php

/****************************************FOR TRANSACTION UPDATION*****************************************************************/
function getMessageTransUpdate($code)
{
	switch($code)
	{
		case "00":
		{
			$string = "<span style='color:#00CC33'><b>Transaction Successfully Updated</b></span>";
			return $string;
		}
		break;
		case "01":
		{
			$string ="<span style='color:red'> Error: Transaction couldn't be Updated</span>";
			return $string;
		}
		break;
	}
}
/****************************************FOR TRANSACTION DELETION*****************************************************************/
function getMessage($code)
{
	switch($code)
	{
		case "00":
		{
			$string = "<span style='color:#00CC33'><b>Transaction Removed</b></span>";
			return $string;
		}
		break;
		case "01":
		{
			$string ="<span style='color:red'> Error: Transaction couldn't be removed</span>";
			return $string;
		}
		break;
	}
}
/****************************************FOR USER DELETION*****************************************************************/
function getMessageDel($code)
{
	switch($code)
	{
		case "00":
		{
			$string = "<span style='color:#00CC33'><b>User Removed</b></span>";
			return $string;
		}
		break;
		case "01":
		{
			$string ="<span style='color:red'> Error: User couldn't be removed</span>";
			return $string;
		}
		break;
	}
}
/****************************************FOR USER UPDATION*****************************************************************/
function getMessageUpdate($code)
{
	switch($code)
	{
		case "00":
		{
			$string = "<span style='color:#00CC33'><b>User Updated</b></span>";
			return $string;
		}
		break;
		case "01":
		{
			$string ="<span style='color:red'> Error: User couldn't be Updated</span>";
			return $string;
		}
		break;
	}
}
/****************************************FOR AGENT DELETION*****************************************************************/
function getMessageAgentDel($code)
{
	switch($code)
	{
		case "00":
		{
			$string = "<span style='color:#00CC33'><b>Agent Removed</b></span>";
			return $string;
		}
		break;
		case "01":
		{
			$string ="<span style='color:red'> Error: Agent couldn't be removed</span>";
			return $string;
		}
		break;
	}
}

/****************************************FOR AGENT UPDATION*****************************************************************/
function getMessageAgentUpdate($code)
{
	switch($code)
	{
		case "00":
		{
			$string = "<span style='color:#00CC33'><b>Agent Updated</b></span>";
			return $string;
		}
		break;
		case "01":
		{
			$string ="<span style='color:red'> Error: Agent couldn't be Updated</span>";
			return $string;
		}
		break;
	}
}

function setNULL($string)
{
	if(empty($string))
	{
		$value = NULL;
		return $value;
	}
}
?>