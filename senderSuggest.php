<?php
include('lib/config.php');
include('lib/opendb.php');


$custid=trim($_GET['userid']);


///Make sure that a value was sent.
if($custid!=NULL)
{

$_SESSION['userid']=$custid;
if($_SESSION['userid'])
echo "done";
else
echo"sorry";

}
?>