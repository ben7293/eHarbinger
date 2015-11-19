<?php
	function conn_db(){
		return pg_connect("host=localhost dbname=bt773");	
	}
	function close_db($db){
		pg_close($db);
	}

?>
