<?php
if (!defined('IN_PANEL')) {
	exit();
}

session_start();

if ((!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['domain_id']) || !isset($_SESSION['domain_name'])) && !defined('LOGIN')) {
	header("Location: http://{$config['site_domain']}{$config['site_path']}login.php");
}

if ((isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['domain_id']) && isset($_SESSION['domain_name'])) && !defined('LOGIN') && !defined('LOGOUT')) {
	
	// ####################### LOGIN TO GAMECREATE ###########################
	if ($gamecreate->http('User', 'Login', (($_SESSION['domain_name'] == 'www') ? '' : $_SESSION['domain_name']), "username={$_SESSION['username']}&password={$_SESSION['password']}", true) == 0) {
		header("Location: http://{$config['site_domain']}{$config['site_path']}login.php");
	}
	
	$where = ($_SESSION['username'] == ADMIN_USERNAME) ? '' : " WHERE domain_id = {$_SESSION['domain_id']}";
	$sql = $db->sql_query("SELECT COUNT(server_id) as total_servers FROM {$prefix}servers" . $where);
	$total_servers = $db->sql_fetch($sql);
	$total_servers = $total_servers['total_servers'];
	
	$template->add_vars(array(
		'SERVERS_NUMBER'	=> $total_servers
	));
	
}

?>