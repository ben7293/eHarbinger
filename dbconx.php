<?php
	function conn_db(){
		$db = pg_connect("host=localhost dbname=bt773 user=bt773 password=");
		return $db;
	}
	function close_db($db){
		pg_close($db);
	}
echo $db;
$db = pg_connect("dbname=bt773");
if (!$db){echo "Empty db\n";}
echo pg_last_error();
echo phpversion();
$result = pg_exec($db, "SELECT * FROM users;");
$num = pg_num_rows($result);
echo $num;
echo "1";
?>
