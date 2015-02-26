<?php

$send = $_POST['submit'];
$to = $_POST['to'];
$from = $_POST['from'];
$message = $_POST['message'];

$header  = "From: ".$from."\r\n";


	echo "<html>\n";
	echo "<body>\n";
	echo "<form method=\"post\">\n";
	echo "To:&nbsp;<input type=\"text\" name=\"to\"><br>\n";
	echo "From:&nbsp;<input type=\"text\" name=\"from\"><br>\n";
	echo "Message: <textarea name=\"message\"></textarea><br>\n";
	echo "<input type=\"submit\" name=\"submit\" value=\"Send\">&nbsp;<input type=\"reset\" value=\"Clear\">\n";
	echo "</form>\n";

	if ($send == "Send")
	{
		$success = mail($to, "From localhost", $message, $header);
	
		if ($success)
		{
		echo "An E-mail was sent to: ".$to;
		}
	}

	echo "</body>\n";
	echo "</html>\n";

?>