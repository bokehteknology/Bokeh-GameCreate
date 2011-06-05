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
	die("Dettagli per il server n.{$_GET['server_id']} non disponibili.");
}

$row = $db->sql_fetch();

$request = $gamecreate->http('Remote', 'GetServerStatus', (($_SESSION['domain_name'] == 'www') ? '' : $_SESSION['domain_name']), "actorUsername={$_SESSION['username']}&actorPassword={$_SESSION['password']}&domainid={$row['domain_id']}&serverId={$_GET['server_id']}");
$info = $gamecreate->xml_server_status($request);
$info['status'] = isset($info['status']) ? $info['status'] : 0;

if ($info['status'] == 1) {
	$fp = @fsockopen('udp://' . $info['ip'], $info['port'], $errno, $errstr, 30);
	
	if ($fp) {
		$packet = 'SAMP';
		$packet .= chr(strtok($info['ip'], '.'));
		$packet .= chr(strtok('.'));
		$packet .= chr(strtok('.'));
		$packet .= chr(strtok('.'));
		$packet .= chr($info['port'] & 0xFF);
		$packet .= chr($info['port'] >> 8 & 0xFF);
		
		fwrite($fp, $packet . 'i');
		fread($fp, 11);
		$is_passworded = ord(fread($fp, 1));
		$plr_count = ord(fread($fp, 2));
		$max_plrs = ord(fread($fp, 2));
		$strlen = ord(fread($fp, 4));
		$hostname = fread($fp, $strlen);
		$strlen = ord(fread($fp, 4));
		$gamemode = fread($fp, $strlen);
		$strlen = ord(fread($fp, 4));
		$mapname = fread($fp, $strlen);
		fclose($fp);
	}
}

$template->add_vars(array(
	'SERVER_ID'		=> $_GET['server_id'],
	'S_NAME'		=> $info['name'],
	'S_PLAYER'		=> isset($plr_count) ? $plr_count : 0,
	'S_SLOTS'		=> $info['slots'],
	'S_RAM'			=> $info['ram'],
	'S_CPU'			=> $info['cpu'],
	'S_STATUS'		=> $info['status'],
	'S_IP'			=> $info['ip'],
	'S_PORT'		=> $info['port'],
	'S_PASSWORD'	=> isset($is_passworded) ? $is_passworded : 'N/D',
	'S_GAMEMODE'	=> isset($gamemode) ? utf8_encode($gamemode) : 'N/D',
	'S_MAPNAME'		=> isset($mapname) ? utf8_encode($mapname) : 'N/D'
));

// ###################### INCLUDE TEMPLATE VARIABLES #####################
include($root_path . 'template_vars.php');

// ######################## GENERATE TEMPLATES ###########################
$template->page_header('Informazioni sul server n.' . $_GET['server_id']);
$template->_template('details');
$template->page_footer();
?>