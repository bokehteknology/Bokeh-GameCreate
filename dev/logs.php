<?php
// #######################################################################
// ######################## START MAIN SCRIPT ############################
// #######################################################################

define('IN_PANEL', true);
$root_path = './';
include($root_path . 'mysql.php');
include($root_path . 'config.php');
include($root_path . 'gamecreate.php');
include($root_path . 'template.php');

$gamecreate = new gamecreate();
$template = new template();

include($root_path . 'session.php');

// #######################################################################
$_GET['server_id'] = (isset($_GET['server_id']) && is_numeric($_GET['server_id'])) ? $_GET['server_id'] : 0;

$where = ($_SESSION['username'] == ADMIN_USERNAME) ? '' : " AND u.domain_id = {$_SESSION['domain_id']} AND s.domain_id = {$_SESSION['domain_id']}";
$sql = $db->sql_query("SELECT s.domain_id, d.domain_name FROM {$prefix}domains d, {$prefix}servers s, {$prefix}users u WHERE s.server_id = {$_GET['server_id']} AND u.username = '{$_SESSION['username']}' AND d.domain_id = s.domain_id" . $where);

if (mysql_num_rows($sql) == 0) {
	die("Dettagli per il server n.{$_GET['server_id']} non disponibili.");
}

$row = $db->sql_fetch();

$request = $gamecreate->http('Remote', 'GetServerStatus', (($_SESSION['domain_name'] == 'www') ? '' : $_SESSION['domain_name']), "actorUsername={$_SESSION['username']}&actorPassword={$_SESSION['password']}&domainid={$row['domain_id']}&serverId={$_GET['server_id']}");
$info = $gamecreate->xml_server_status($request);

$domain_name = ($row['domain_name'] == 'www') ? '' : "{$row['domain_name']}-";
$logs = @file_get_contents("ftp://{$_SESSION['username']}:{$_SESSION['password']}@{$info['ip']}:2121/{$domain_name}gtasa/server_log.txt");

if (!$logs) {
	die("Impossibile recuperare il file server_log.txt (errore: F4T0P4/HTTP).");
}

$template->add_vars(array(
	'SERVER_ID'		=> $_GET['server_id'],
	'S_NAME'		=> $info['name'],
	'LOGS_CONTENT'	=> utf8_encode(htmlspecialchars($logs))
));

// ###################### INCLUDE TEMPLATE VARIABLES #####################
include($root_path . 'template_vars.php');

// ######################## GENERATE TEMPLATES ###########################
$template->page_header('Logs del server n.' . $_GET['server_id']);
$template->_template('logs');
$template->page_footer();
?>