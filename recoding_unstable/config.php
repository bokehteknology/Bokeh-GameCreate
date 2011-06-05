<?php
// #######################################################################
// ########################## CONFIG SCRIPT ##############################
// #######################################################################

if (!defined('IN_PANEL')) {
	exit();
}

// Database configuration
$dbhost = 'localhost';
$dbport = '';
$dbname = 'x';
$dbuser = 'x';
$dbpass = 'x';
$prefix = 'panel_';

define('ADMIN_USERNAME', 'x');

$config = array(
	// Site details
	'sitename'		=> 'x',
	'site_domain'	=> 'x',
	'site_path'		=> '/x/',
	'keywords'		=> '',
	'description'	=> '',
	
	// GameCreate.com details
	'domain_id'		=> 0,
	'domain_url'	=> 'x.eu.gamecreate.com',
);

$db = new mysql($dbhost, $dbport, $dbuser, $dbpass, $dbname);

?>
