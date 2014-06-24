<?php
/**
 * @author Greedi
 * @copyright 2012
 * 
 */
include ('core/banned.php');
include('core/wallet.php');
include ('templates/header.php');
//include ('core/dnsbl.php');

?>
<div class="row">
  <div class="span10">
    <?php
    echo "<center>
		<br /><br />
		<h2>Pick some free AppleBytes from the Orchard!</h2>
		<br />
		To get 100 free AppleBytes, just enter your wallet address, adjust picture & click submit.
		<br /><br />
		You can pick free AppleBytes once a day.<br />
		More than once a day from the same address will not be paid.<br /><br />
		Payout takes just a few minutes after you click the submit button.
</center>";
    ?>
    
    <style>
     .tdr{text-align:right;}
    </style>
	<center>
      <form action="submitted.php" method="post">
	<td class="tdr"><font color="green">Enter your AppleByte address here:</font></td>
	<td><input type="text" name="ABY" style="margin-bottom:22px;margin-top:22px;"></td>
	<br />
	<b>Adjust picture to prove that you are a human and not a bot</b>
	<br /><br />
	<?php
	echo GetCaptcha($adscaptchaID, $adspubkey);
	?>
	<td colspan="3" align="center"><input type="submit" value="Submit"></td>
	</center>
  </div>
  <?php
  include ('templates/sidebar.php');
  include ('templates/footer.php');
  ?>

