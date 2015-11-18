<?php
	function conn_db(){
		$db = pg_connect("host=localhost dbname=bt773 user=bt773 password=")
			or die("Could not connect to database: " . pg_last_error());
		return $db;
	}
	function close_db($db){
		pg_close($db);
	}

conn_db();
?>