<?php
include_once("dbconx.php");
include_once("classes.php");

session_start();

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
