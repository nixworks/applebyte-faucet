<?
/**
 * @author Greedi
 * @copyright 2012
 */
ini_set("display_errors", 1);
include('../core/wallet.php');
$roundltc = $_POST['roundltc'];
$result = mysql_query("UPDATE roundltc SET roundltc = $roundltc") 
or die(mysql_error());

header( 'Location: index.php' );
?>


