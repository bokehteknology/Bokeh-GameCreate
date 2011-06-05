<?php
// #######################################################################
// ######################### TEMPLATE ENGINE #############################
// #######################################################################

if (!defined('IN_PANEL')) {
	exit();
}

class template {
	function template() {
		$this->tpl_var = $this->templates = array();
	}
	
	function add_vars($var) {
		if (!is_array($var)) return false;
		
		foreach($var as $key => $val) {
			$this->tpl_var[$key] = $val;
		}
		
		return true;
	}
	
	function _template($tpl = '') {
		global $root_path, $db;
		
		if ($tpl == '' || !isset($this->templates[$tpl])) $this->load_template($tpl);
		$new_tpl = $this->templates[$tpl];
		
		// Internal URL System with relative path (from $root_path)
		$new_tpl = preg_replace("#\{U_(.*?)\}#", $this->gen_link("$1"), $new_tpl);
		
		$new_tpl = preg_replace('#\$var\[(.*?)\]#', '$this->tpl_var[\'$1\']', $new_tpl);
		$new_tpl = preg_replace('#\$print\[(.*?)\]#', '<' . '?php echo $var[\'$1\']; ?' . '>', $new_tpl);
		
		$new_tpl = " ?>$new_tpl<?php ";
		
		// Template variables
		$var = $this->tpl_var;
		
		// eval() template
		$new_tpl = eval($new_tpl);
		
		if ($new_tpl === false) {
			die('Si e\' verificato un errore nella compilazione del template.');
		}
			
		echo $new_tpl;
	}
	
	function gen_link($url) {
		global $root_path;
		
		if (!defined('SID') || SID == '') {
			return $root_path . $url;
		}
		
		if (strpos($url, '?') === false) {
			$url .= '?';
		}else{
			$url .= '&';
		}
		
		return $root_path . $url . SID;
	}
	
	function load_template($tpl) {
		global $root_path, $config;
		
		$_tpl = $root_path . 'templates/' . $tpl . '.tpl';
		
		if (file_exists($_tpl) && is_file($_tpl) && filesize($_tpl) > 0) {
			$handle = fopen($_tpl, 'r');
			$this->templates[$tpl] = @fread($handle, filesize($_tpl));
			fclose($handle);
		}else{
			die('Il template \'' . $tpl . '\' non esiste o e\' vuoto');
		}
	}
	
	function page_header($title = false) {
		if ($title !== false) $this->add_vars(array('TITLE' => $title));
		$this->_template('header');
		return;
	}
	
	function page_footer() {
		$this->_template('footer');
		exit();
		return;
	}
}

?>