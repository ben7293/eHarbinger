<?php
	function conn_db(){
		$db = pg_connect("dbname=bt773 user=bt773 password=bt773");
		return $db;
	}
	function close_db($db){
		pg_close($db);
	}
$db = pg_connect("dbname=bt773 user=bt773 password=bt773");
$result = pg_query($db, "SELECT * FROM users;") or die('Query failed: ' . pg_last_error());
echo $result;
$fetch = pg_fetch_all($result);
echo $fetch;
?>
