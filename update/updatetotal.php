<?php
/**
 * @author Greedi
 * @copyright 2012
 */
include('../core/wallet.php');

$dailytotal = $_POST['dailytotal'];

    mysql_query("UPDATE dailytotal SET dailytotal = $dailytotal") 
    or die(mysql_error());
    
  header( 'Location: index.php' ) ; 
?>


