<?php
	function conn_db(){
		$db = pg_connect("host=localhost dbname=bt773");
		return $db;
	}
	function close_db($db){
		pg_close($db);
	}
$db = conn_db();
$result = pg_query($db, "SELECT * FROM users;");
$num = pg_num_rows($result);
?>
