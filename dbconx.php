<?php
	function conn_db(){
		$db = pg_connect("dbname=bt773 user=bt773 password=bt773");
		return $db;
	}
	function close_db($db){
		pg_close($db);
	}
$db = conn_db();
$result = pg_query($db, "SELECT * FROM users;") or die('Query failed: ' . pg_last_error());
$fetch = pg_fetch_all($result);
echo $fetch;
?>
