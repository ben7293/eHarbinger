<?php
include_once("dbconx.php");
include_once("classes.php");

session_start();

if (isset($_SESSION["user"])){
	if ($_SESSION["user"]->isLoggedIn()){
		echo $_SERVER["REQUEST_URI"];
		echo $_SESSION["user"]->isLoggedIn();
		// if ($_SERVER["REQUEST_URI"] == "/~bt773/eHarbinger/index.php"){
			// Header("Location: players.php");
		// }
		echo "Session verification successful<br />";
	}

}
else{
	//If there is no session information
	echo "Session verification failed<br />";
	Header("Location: index.php");

}


?>
