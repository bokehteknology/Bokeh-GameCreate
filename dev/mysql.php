<?php
// #######################################################################
// ############################## DATABASE ###############################
// #######################################################################

if (!defined('IN_PANEL')) {
	exit();
}

class mysql {
	function mysql($dbhost, $dbport, $dbuser, $dbpass, $dbname) {
		if ($dbhost == '') $dbhost = 'localhost';
		if ($dbport != '') $dbhost .= ':' . $dbport;
		if ($dbuser == '') $dbuser = 'root';
		
		if (($this->db_connect_id = @mysql_connect($dbhost, $dbuser, $dbpass)) === false) {
			//die('Impossibile connettersi al server \'' . $dbhost . '\'.');
		}else{
			if (!@mysql_select_db($dbname, $this->db_connect_id)) {
				//die('Impossibile selezionare il database \'' . $dbname . '\'.');
			}else{
				return $this->db_connect_id;
			}
		}
	}
	
	function sql_close() {
		return @mysql_close($this->db_connect_id);
	}
	
	function sql_query($query = '') {		
		if ($query != '') {
			if (($this->query_result = @mysql_query($query, $this->db_connect_id)) === false) {
				die('Impossibile eseguire la query:<br />' . $query);
			}
			
			return $this->query_result;
		}else{
			die('Nessuna query da eseguire.');
		}
		
		return false;
	}
	
	function sql_fetch() {
		if (!isset($this->query_result)) die('Nessuna query pr il fetching.');
		
		$result = $this->query_result;
		$array = @mysql_fetch_assoc($result);
		return $array;
	}
}

?>