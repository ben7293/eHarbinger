<?php

	include_once("classes.php");
	function conn_db(){
		$db = new Database();
		echo var_dump($db);
		if ($db){echo "db exists\n";}
		return $db;
	}
	function close_db($db){
		pg_close($db);
	}
?>
