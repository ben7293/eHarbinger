<?php

	include_once("classes.php");
	function conn_db(){
		$db = new Database();
		if ($db){echo "db exists\n"};
		return $db;
	}
	function close_db($db){
		pg_close($db);
	}
?>
