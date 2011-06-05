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
if (isset($_GET['act']) && ($_GET['act'] == 'start' || $_GET['act'] == 'stop') && isset($_GET['server_id']) && is_numeric($_GET['server_id'])) {
	$sql = $db->sql_query("SELECT domain_id FROM {$prefix}servers WHERE server_id = {$_GET['server_id']}");
	
	if (mysql_num_rows($sql) == 1) {
		$s_info = $db->sql_fetch();
		$running_status = ($_GET['act'] == 'start') ? '1' : '0';
		$gamecreate->http('Remote', 'SetServerRunning', (($_SESSION['domain_name'] == 'www') ? '' : $_SESSION['domain_name']), "actorUsername={$_SESSION['username']}&actorPassword={$_SESSION['password']}&domainid={$s_info['domain_id']}&serverid={$_GET['server_id']}&running={$running_status}");
	}
}

$where = ($_SESSION['username'] == ADMIN_USERNAME) ? '' : " WHERE domain_id = {$_SESSION['domain_id']}";
$sql = $db->sql_query("SELECT * FROM {$prefix}servers" . $where);
$servers_lists = array();
$T_players = $T_slots = $T_ram = $T_cpu = $T_servers_on = $T_servers_off = 0;

while($row = $db->sql_fetch()) {
	$request = $gamecreate->http('Remote', 'GetServerStatus', (($_SESSION['domain_name'] == 'www') ? '' : $_SESSION['domain_name']), "actorUsername={$_SESSION['username']}&actorPassword={$_SESSION['password']}&domainid={$row['domain_id']}&serverId={$row['server_id']}");
	$info = $gamecreate->xml_server_status($request);
	
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
			
			$info['player'] = $plr_count;
		}
	}
	
	$T_players += $info['player'];
	$T_slots += $info['slots'];
	$T_ram += $info['ram'];
	$T_cpu += $info['cpu'];
	$T_servers_on += ($info['status'] == 1) ? 1 : 0;
	$T_servers_off += ($info['status'] == 0 || $info['status'] == 2 || $info['status'] == 3 || $info['status'] == 4) ? 1 : 0;
	
	$servers_list[] = array_merge($info, array('domain_id' => $row['domain_id']));
}

$template->add_vars(array(
	'SERVERS_LIST'		=> $servers_list,
	'T_PLAYERS'			=> $T_players,
	'T_SLOTS'			=> $T_slots,
	'T_RAM'				=> $T_ram,
	'T_CPU'				=> $T_cpu,
	'T_SERVERS_ON'		=> $T_servers_on,
	'T_SERVERS_OFF'		=> $T_servers_off
));

// ###################### INCLUDE TEMPLATE VARIABLES #####################
include($root_path . 'template_vars.php');

// ######################## GENERATE TEMPLATES ###########################
$template->page_header('I miei servers');
$template->_template('index');
$template->page_footer();
?>
