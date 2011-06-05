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
$sql = $db->sql_query("SELECT s.domain_id FROM {$prefix}servers s, {$prefix}users u WHERE s.server_id = {$_GET['server_id']} AND u.username = '{$_SESSION['username']}'" . $where);

if (mysql_num_rows($sql) == 0) {
	die("Non puoi riavviare il server n.{$_GET['server_id']}, in quanto non sei il proprietario.");
}

$row = $db->sql_fetch();

$restart = $gamecreate->http('Remote', 'RestartServer', (($_SESSION['domain_name'] == 'www') ? '' : $_SESSION['domain_name']), "actorUsername={$_SESSION['username']}&actorPassword={$_SESSION['password']}&domainid={$row['domain_id']}&serverid={$_GET['server_id']}", true);

if ($restart == 'true') {
	header("Location: http://{$config['site_domain']}{$config['site_path']}details.php?server_id={$_GET['server_id']}");
}else{
	die("Si e' verificato un errore durante il riavvio del server n.{$_GET['server_id']}.");
}
?>