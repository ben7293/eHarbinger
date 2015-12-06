<?php
include_once("dbconx.php");
include_once("classes.php");

session_start();

var_dump($_SESSION["user"]);

$newUser = new User("ben7293", "baby", conn_db());

var_dump($_SESSION["user"]);

if ($_SESSION["user"]->isLoggedIn()){
	echo "Session verification successful<br />";
	var_dump(!$_SESSION["user"]->isLoggedIn());
}
else{
	//If there is no session information
	echo "Session verification failed<br />";
	var_dump(!$_SESSION["user"]->isLoggedIn());

}


?>
