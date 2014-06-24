AppleByte Faucet
------------------------------------------
Copyright (c) 2012 Greedi
Copyright (c) 2012 Bushstar

This faucet has been modified to payout everytime someone puts their address in but will not payout again to the same address or IP until resetround.php has been run.

INSTALL:
Setup local coin daemon for the faucet and MySQL database, import faucet.sql into the newly created database.
Put files in webserver directory dir, edit core/config.php with values for the database and coin daemon.

Enable .htaccess override in Apache configuration and configure .htpasswd file in /var/www/htpasswd/.htpasswd or change path to file in update/.htaccess

Set full path to core/wallet.php in update/resetround.php then add resetround.php to a cronjob. This resets the round how ever often you set it to. If you have not secured the update folder with .htaccess then please move the resetround.php file outside of the webserver files as by browsing to it the round can be reset.

Donate: 
BTC: 1GGWFSFYXydhPi8ZaxhsbgtVdquMeAjT4j
