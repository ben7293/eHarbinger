<?php
	function conn_db(){
		$db = pg_connect("host=localhost dbname=eHarbinger user=root password=admin")
			or die("Could not connect to database: " . pg_last_error());
		return $db;
	}
	function close_db($db){
		pg_close($db);
	}
?>