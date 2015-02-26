<?php
session_start();
include('lib/config.php');
include('lib/opendb.php');
$amount=$_REQUEST["amount"];
$place = $_REQUEST["city"];
list($city, $country) =split(",",$place);

$query = "SELECT * FROM anp_sp";
$result = mysql_query($query);
if($result)
{
	$fields = mysql_fetch_assoc($result);
	$fee = $fields["anp_fee"];
	$cond = $fields['cond_for_disc'];
	$cond_total = $fields["anp_fee_disc"];
		
}

if(isset($_SESSION["custid"]))
{
	$clientid = $_SESSION["custid"];
}
else
	$clientid = 1;
$query = "SELECT n_transc FROM users WHERE userid = $clientid";
$result = mysql_query($query);
if($result)
{
	$fields = mysql_fetch_assoc($result);
	$user_trans = $fields["n_transc"];
	
}
$query = "SELECT currency AS cname, rates FROM anp_rates WHERE city ='$city' AND country ='$country'";
$result =mysql_query($query);
if($result)
{
	$fields =mysql_fetch_assoc($result);
	$rates = $fields["rates"];
	//$_SESSION['trans_rate']=$rates;
	$cname = $fields["cname"];
	
}
$cvt = $amount * $rates;

$currency=$cname;
if($user_trans ==$cond)
	$fee = abs(($fee * ($cond_total/100)) - $fee);
	
$grandTotal = $amount + $fee;
echo $cvt."\n";
echo $currency."\n";
echo $amount."\n";
echo "CND"."\n";
echo $fee."\n";
echo $grandTotal."\n";
echo $rates."\n";


?>

<?php
include ('lib/closedb.php');
?>