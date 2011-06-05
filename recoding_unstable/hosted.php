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

$hosted = file_get_contents('http://server.sa-mp.com/0.3.0/hosted');
$hosted = explode("\n", $hosted);
$servers_lists = array();
$T_players = $T_slots = $T_ram = $T_cpu = $T_servers_on = $T_servers_off = 0;

for($i = 0; $i <= 2; $i++) {
	$srv = $hosted[$i];
	list($info['ip'], $info['port']) = explode(':', $srv);
	
	$fp = @fsockopen('udp://' . $info['ip'], $info['port'], $errno, $errstr, 2);
	
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
		$info['player'] = ord(fread($fp, 2));
		$info['slots'] = ord(fread($fp, 2));
		$strlen = ord(fread($fp, 4));
		$info['name'] = utf8_encode(fread($fp, $strlen));
		$strlen = ord(fread($fp, 4));
		$gamemode = fread($fp, $strlen);
		$strlen = ord(fread($fp, 4));
		$mapname = fread($fp, $strlen);
		fclose($fp);
		
		$info['status'] = 1;
	}else{
		$info['status'] = 0;
	}
	
	$info['ram'] = $info['cpu'] = 0;
	
	$T_players += $info['player'];
	$T_slots += $info['slots'];
	$T_ram += $info['ram'];
	$T_cpu += $info['cpu'];
	$T_servers_on += ($info['status'] == 1) ? 1 : 0;
	$T_servers_off += ($info['status'] == 0 || $info['status'] == 2 || $info['status'] == 3 || $info['status'] == 4) ? 1 : 0;
	
	$servers_list[] = array_merge($info);
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