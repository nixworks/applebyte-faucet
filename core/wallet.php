<?php
// ABY WALLET
session_start();
include("/var/www/faucet/core/functions.php");
$start = timer();

include("/var/www/faucet/core/config.php");
include_once ("/var/www/faucet/core/includes/jsonRPCClient.php");
include("/var/www/faucet/core/address.inc");
include("/var/www/faucet/core/recaptchalib.inc");
include ("/var/www/faucet/core/adscaptchalib.inc");

//captha
$publickey = "6LffhPUSAAAAAGTZ_L4aju_mxXDa6hJcV6-M_k2a";
$privatekey = "6LffhPUSAAAAAH4Msa5u8ieP4QcEYC2nlnWtHZws";

// init

$btclient = new jsonRPCClient("http://". $btclogin["username"] . ':' . $btclogin["password"] . '@' .$btclogin["host"] . ':' . $btclogin["port"]);$addr = new Address($btclient,$sqlogin);
$derp = $btclient->getinfo();

//$this->PDO_Conn = new PDO("mysql:host={$sqllogin['host']};dbname={$sqllogin['dbname']}", $sqllogin['username'], $sqllogin['password']);
$dbconn = mysql_connect($sqlogin['host'],$sqlogin['username'],$sqlogin['password']);
mysql_select_db($sqlogin['dbname'], $dbconn);

?>
