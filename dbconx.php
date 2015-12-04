<?php

	include_once("classes.php");
	function conn_db(){
		$db = new Database();
		return $db;
	}
	function close_db($db){
		pg_close($db);
	}
?>
