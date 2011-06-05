<?php
// #######################################################################
// ######################## START MAIN SCRIPT ############################
// #######################################################################

define('IN_PANEL', true);
define('LOGIN', true);
$root_path = './';
include($root_path . 'mysql.php');
include($root_path . 'config.php');
include($root_path . 'template.php');
include($root_path . 'session.php');

$template = new template();

// ########################## SETTING HEADER #############################
header("Content-Type: text/css");

// ######################## GENERATE TEMPLATES ###########################
if (isset($_GET['login_box'])) {
	$template->_template('stylesheet_login');
}else{
	$template->_template('stylesheet');
}
?>