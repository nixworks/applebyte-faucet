<?php

/**
 * @author Greedi
 * @copyright 2012
 */
function clean_input($instr) {
    if(get_magic_quotes_gpc()) {
        $str = stripslashes($instr);
    }
    return mysql_real_escape_string(strip_tags(trim($instr)));
}
//error_reporting(E_ALL);
include ('core/banned.php');
include_once ("core/wallet.php");
include_once ('templates/header.php');
//include ('core/dnsbl.php');

$donaddress = $don_faucet;
$don = $btclient->getbalance();

?>
<div class="row">
  <div class="span10">
    <center>
      <br />
      <?php
      $ip = $_SERVER['REMOTE_ADDR'];
      $challengeValue = $_POST['adscaptcha_challenge_field'];
      $responseValue = $_POST['adscaptcha_response_field'];
      $remoteAddress = $_SERVER["REMOTE_ADDR"];
      function ordinal($a)
      {
	$b = abs($a);
	$c = $b % 10;
	$e = (($b % 100 < 21 && $b % 100 > 4) ? 'th' : (($c < 4) ? ($c < 3) ? ($c < 2) ?
								    ($c < 1) ? 'th' : 'st' : 'nd' : 'rd' : 'th'));
	return $a . $e;
      }
      if (strtolower(ValidateCaptcha($adscaptchaID, $adsprivkey, $challengeValue, $responseValue, $remoteAddress)) == "true") {
	$isvalid = $btclient->validateaddress($_POST['ABY']);
	if ($isvalid['isvalid'] != '1') {
            echo srserr("Invalid Address: " . $_POST['ABY'] . " <a href='/index.php'>Go back</a>");
            echo "</center></div>";
            include ('templates/sidebar.php');
            include ('templates/footer.php');
            die();
	} else {
	    $ltcaddress = clean_input($_POST['ABY']);
	    $command = "SELECT 1 FROM dailyltc WHERE ltcaddress='$ltcaddress' OR ip='$ip'";
	    $q = mysql_query($command);
	    $rows = mysql_num_rows($q);
	    if ($rows > 0) {
		echo srserr("There is already an entry for you in this 24 hour round, please come back tomorrow.");
                echo "</center></div>";
                include ('templates/sidebar.php');
                include ('templates/footer.php');
		die();
	    }
            mysql_query("INSERT INTO dailyltc (ltcaddress, ip) SELECT * FROM (SELECT '$ltcaddress', '$ip') AS tmp
                WHERE NOT EXISTS (SELECT ip FROM dailyltc WHERE ip = '$ip') LIMIT 1;") or die(mysql_error());
            mysql_query("INSERT INTO subtotal (ltcaddress, ip) VALUES('$ltcaddress', '$ip' ) ") or die(mysql_error());
	    $coins_in_account = $btclient->getbalance();
       	    if ($coins_in_account > $payout) {
	        $btclient->sendtoaddress($ltcaddress,$payout);
		echo srsnot("Congratulations, you have now been sent " . $payout . " ABY. Come back tomorrow for the next round.");
		echo "</center></div>";
                include ('templates/sidebar.php');
                include ('templates/footer.php');
		die(); 
	    } else {
	        echo srserr("Looks like we haven't got enough donations to pay out. The faucet will continue once the faucet has received more funds.");
                echo "</center></div>";
                include ('templates/sidebar.php');
                include ('templates/footer.php');
                die();
	    }
        }
      } else { // Wrong answer, you may display a new AdsCaptcha and add an error message
	echo srserr("Invalid CAPTCHA. <a href='/index.php'>Go back</a>");
      }
      ?>
    </center>
  </div>
  <?php
  include ('templates/sidebar.php');
  include ('templates/footer.php');
  ?>
