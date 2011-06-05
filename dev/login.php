<?php
// #######################################################################
// ######################## START MAIN SCRIPT ############################
// #######################################################################

define('IN_PANEL', true);
define('LOGIN', true);
$root_path = './';
include($root_path . 'mysql.php');
include($root_path . 'config.php');
include($root_path . 'gamecreate.php');
include($root_path . 'template.php');

$gamecreate = new gamecreate();
$template = new template();

include($root_path . 'session.php');

// ############################ POST DATA ################################
$_POST['username'] = isset($_POST['username']) ? addslashes($_POST['username']) : '';
$_POST['password'] = isset($_POST['password']) ? addslashes($_POST['password']) : '';

// ####################### LOGIN TO GAMECREATE ###########################
if (isset($_POST['submit'])) {	
	$result = $db->sql_query("SELECT u.domain_id, d.domain_name FROM {$prefix}users u, {$prefix}domains d WHERE username = '{$_POST['username']}'");
	
	if (mysql_num_rows($result) == 0) {
		header("Location: http://{$config['site_domain']}{$config['site_path']}login.php");
	}
	
	$domain_info = $db->sql_fetch();
	$domain_info['domain_name_url'] = ($domain_info['domain_name'] == 'www') ? '' : $domain_info['domain_name'];
	
	if ($gamecreate->http('User', 'Login', $domain_info['domain_name_url'], "username={$_POST['username']}&password={$_POST['password']}", true) == 0) {
		header("Location: http://{$config['site_domain']}{$config['site_path']}login.php");
	}else{
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		$_SESSION['domain_id'] = $domain_info['domain_id'];
		$_SESSION['domain_name'] = $domain_info['domain_name'];
		
		header("Location: http://{$config['site_domain']}{$config['site_path']}index.php");
	}
}elseif (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['domain_id']) && isset($_SESSION['domain_name']) && $gamecreate->http('User', 'Login', (($_SESSION['domain_name'] == 'www') ? '' : $_SESSION['domain_name']), "username={$_SESSION['username']}&password={$_SESSION['password']}", true) != 0) {
	header("Location: http://{$config['site_domain']}{$config['site_path']}index.php");
}

// ###################### INCLUDE TEMPLATE VARIABLES #####################
include($root_path . 'template_vars.php');

// ######################## GENERATE TEMPLATES ###########################
$template->add_vars(array('TITLE' => 'Login'));
$template->_template('login');
?>