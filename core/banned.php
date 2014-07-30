<?php

/**
 * @author Greedi
 * @copyright 2012
 */

$banlist = array("158.145.240.100");
$myip = $_SERVER['REMOTE_ADDR'];
if (in_array($myip, $banlist)) {
    exit("<center>You are banned.</center>");
}

/* Enter in to and from address to ban IP range
 * Example:
 * $bannedIPs = array(
 * array('120.173.0.0', '120.181.255.255'),
 * array('85.212.0.0', '85.212.127,255'),
 * ); */

$bannedIPs = array();
?>
