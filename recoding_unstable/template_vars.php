<?php
// #######################################################################
// ########################## TEMPLATE VARS ##############################
// #######################################################################

if (!defined('IN_PANEL')) {
	exit();
}

$template->add_vars(array(
	'SITENAME'		=> $config['sitename'],
	'USERNAME'		=> (!isset($_SESSION['username']) || empty($_SESSION['username'])) ? '' : $_SESSION['username'],
	'USER_IP'		=> $_SERVER['REMOTE_ADDR'],
	'CURRENT_YEAR'	=> date('Y', time())
));

?>