<?php
// #######################################################################
// ######################### GAMECREATE HTTP #############################
// #######################################################################

class gamecreate {
	var $info = array();
	var $xml = '';
	
	function gamecreate() {
		return;
	}
	
	function http($mode, $method, $subdomain = '', $params, $xml_value_parse = false) {
		global $config;
		
		$fp = @fsockopen($config['domain_url'], 80, $errno, $errstr, 30);
		if (!$fp) return false;
		
		$subdomain = (!empty($subdomain) ? ".{$subdomain}" : '');
		
		$headers = $xml = '';
		$headers .= "POST /admin/{$mode}.asmx/{$method} HTTP/1.0\r\n";
		$headers .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$headers .= "Content-Length: " . strlen($params) . "\r\n";
		$headers .= "Host: {$subdomain}{$config['domain_url']}\r\n\r\n";
		$headers .= $params;
		
		fputs($fp, $headers);
		while(!feof($fp)) $xml .= fgets($fp, 2048);
		fclose($fp);
		
		if ($xml_value_parse) $xml = $this->xml_value_parse($xml);
		$this->xml = $xml;
		
		return $xml;
	}
	
	function network_status() {
		global $config;
		
		$fp = @fsockopen($config['domain_url'], 80, $errno, $errstr, 30);
		if (!$fp) return false;
		fclose($fp);
		
		return true;
	}
	
	function xml_value_parse($xml) {
		preg_match_all("|<[^>]+>(.*)</[^>]+>|U", $xml, $out, PREG_SET_ORDER);
		return $out[0][1];
	}
	
	function xml_server_status($xml) {
		preg_match_all("|<[^>]+>(.*)</[^>]+>|U", $xml, $out);
		
		$server = array(
			'id'		=> $out[1][0],
			'name'		=> $out[1][1],
			'player'	=> $out[1][2],
			'slots'		=> $out[1][3],
			'ram'		=> $out[1][4],
			'cpu'		=> $out[1][5]
		);
		
		switch($out[1][6]) {
			case 'Stopped':
				$server['status'] = 0;
				break;
			case 'Running':
				$server['status'] = 1;
				break;
			case 'Starting':
				$server['status'] = 2;
				break;
			case 'Stopping':
				$server['status'] = 3;
				break;
			case 'Restarting':
				$server['status'] = 4;
		}
		
		list($server['ip'], $server['port']) = explode(':', $out[1][7]);
		
		return $server;
	}
}

?>