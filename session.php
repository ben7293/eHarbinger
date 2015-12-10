<?php
include_once("classes.php");

$index_path = "eHarbinger/index.php";

session_start();



if (isset($_SESSION["user"])){
	if ($_SESSION["user"]->isLoggedIn()){
		// echo $_SERVER["REQUEST_URI"];
		// echo $_SESSION["user"]->isLoggedIn();
		// echo "Session verification successful<br />";
		// echo $index_path;
		if ( substr($_SERVER["REQUEST_URI"], -10, 10) == $index_path || $_SERVER["REQUEST_URI"] == $root_path){
			echo "yes";
			Header("Location: players.php");
			exit;
		}
	}

}
else{
	//If there is no session information
	// echo "Session verification failed<br />";
	if ($_SERVER["REQUEST_URI"] != $index_path){
		Header("Location: index.php");
		exit;
	}

}


?>
