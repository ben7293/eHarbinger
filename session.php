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
		$current_path = $_SERVER["REQUEST_URI"];

		if ( substr($_SERVER["REQUEST_URI"], -10, 10) == $index_path || substr($_SERVER["REQUEST_URI"], -10, 10) == $root_path){
			echo "yes";
			Header("Location: players.php");
			exit;
		}
	}

}
else{
	//If there is no session information
	// echo "Session verification failed<br />";
	if (substr($_SERVER["REQUEST_URI"], -10, 10) != $index_path){
		die(var_dump($_SERVER["REQUEST_URI"]));
		Header("Location: index.php");
		exit;
	}

}


?>
