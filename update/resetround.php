<?php
// Put full path to wallet.php in the include below
include ('/var/www/faucet/core/wallet.php');
$command = "SELECT * FROM dailyltc";
$q = mysql_query($command);
$rows = mysql_num_rows($q);
$command = "SELECT * FROM roundltc";
$q = mysql_query($command);
$res = mysql_fetch_array($q);
mysql_query("TRUNCATE dailyltc");
mysql_query("UPDATE round set round=round+1");
$totalc = $res['roundltc'] * $rows;
mysql_query("UPDATE dailytotal set total=total+{$totalc}");
?>
