<?php
// #######################################################################
// ######################## START MAIN SCRIPT ############################
// #######################################################################

define('IN_PANEL', true);
define('LOGOUT', true);
$root_path = './';
include($root_path . 'mysql.php');
include($root_path . 'config.php');
include($root_path . 'gamecreate.php');
include($root_path . 'template.php');
include($root_path . 'session.php');

// ############################# LOGOUT ##################################
session_destroy();
header("Location: http://{$config['site_domain']}{$config['site_path']}index.php");
?>