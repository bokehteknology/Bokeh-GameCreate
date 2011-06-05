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

/*
$ftp = @ftp_connect((($_SESSION['domain_name'] == 'www') ? $_SESSION['domain_name'] : ($config['domain_url'] . '.' . $_SESSION['domain_name'])), 2121);
$ftp_login = @ftp_login($ftp, $_SESSION['username'], $_SESSION['password']);

if (!$ftp) {
	die("Impossibile connettersi al server FTP.");
}

$ftp_chdir = @ftp_chdir($ftp, "/{$_SESSION['domain_name']}-gtasa/");

if (!$ftp_chdir) {
	die("Si e' verificato un errore F4T0P4. Se visualizzi questo errore, contattaci.");
}

@ftp_fget($conn_id, $output, ($file . '.' . $ext), FTP_ASCII, 0);
*/

$request = $gamecreate->http('Remote', 'GetServerStatus', (($_SESSION['domain_name'] == 'www') ? '' : $_SESSION['domain_name']), "actorUsername={$_SESSION['username']}&actorPassword={$_SESSION['password']}&domainid={$row['domain_id']}&serverId={$_GET['server_id']}");
$info = $gamecreate->xml_server_status($request);

$domain_name = ($row['domain_name'] == 'www') ? '' : "{$row['domain_name']}-";
$cfg = @file_get_contents("ftp://{$_SESSION['username']}:{$_SESSION['password']}@{$info['ip']}:2121/{$domain_name}gtasa/server.cfg");
//die("ftp://{$_SESSION['username']}:{$_SESSION['password']}@{$info['ip']}:2121/{$domain_name}gtasa/server.cfg");

if (!$cfg) {
	die("Impossibile recuperare il file server.cfg (errore: F4T0P4/HTTP).");
}

$template->add_vars(array(
	'SERVER_ID'		=> $_GET['server_id'],
	'S_NAME'		=> $info['name'],
	'CFG_CONTENT'	=> utf8_encode(htmlspecialchars($cfg))
));

// ###################### INCLUDE TEMPLATE VARIABLES #####################
include($root_path . 'template_vars.php');

// ######################## GENERATE TEMPLATES ###########################
$template->page_header('Server.cfg del server n.' . $_GET['server_id']);
$template->_template('cfg');
$template->page_footer();
?>