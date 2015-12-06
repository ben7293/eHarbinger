<?php
session_start();
include_once("classes.php");
echo $_SESSION["user"]->isLoggedIn();

// if ($_SESSION["user"]->isLoggedIn()){
	// echo "Session verification successful<br />";
	// var_dump(!$_SESSION["user"]->isLoggedIn());
// }
// else{
	// //If there is no session information
	// echo "Session verification failed<br />";
	// var_dump(!$_SESSION["user"]->isLoggedIn());

// }


?>
