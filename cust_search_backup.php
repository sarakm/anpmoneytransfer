<?php
$custid=htmlspecialchars($_REQUEST['custId']);
$firstname=htmlspecialchars($_REQUEST['firstname']);
$middlename=htmlspecialchars($_REQUEST['middlename']);
$lastname=htmlspecialchars($_REQUEST['lastname']);
$phone=htmlspecialchars($_REQUEST['phone']);
echo "custmer is ".$custid;

$con = mysql_connect("localhost","vijaya","alphaweb");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("ANP", $con);
if($custid !=NULL)
{
    $sql = "SELECT * FROM users where userid=$custid";
}
else if($phone !=NULL)
{
	$sql = "SELECT * FROM users where phone1=$phone|phone2=$phone";
}
else if($firstname !=NULL&& $lastname !=NULL)
{
	 $sql = "SELECT * FROM users where upper(firstname)=upper($firstname) && upper(lastname)=upper($lastname)";
}

     $result = mysql_query($sql) or die(mysql_error());
$numrows = mysql_num_rows($result);
 
if ($numrows != 0)
{
  while($row = mysql_fetch_array($result))
   {
   echo $row[0] . " " . $row[1];
//   echo "<br />";
   }
 }
 else
 echo "<h2>No records found</h2>"; 
 
mysql_close($con);
?>