<?php
include_once("classes.php");

$index_path = "index.php";
$current_path = explode('/', $_SERVER["REQUEST_URI"]);
session_start();


if (isset($_SESSION["user"])){
	if ($_SESSION["user"]->isLoggedIn()){
		// echo $_SERVER["REQUEST_URI"];
		// echo $_SESSION["user"]->isLoggedIn();
		// echo "Session verification successful<br />";
		// echo $index_path;
		if ( $current_path[3] == $index_path || $current_path[3] == ""){
			echo "yes";
			Header("Location: players.php");
			exit;
		}
	}

}
else{
	//If there is no session information
	// echo "Session verification failed<br />";
	if ($current_path[3] != $index_path){
		Header("Location: index.php");
		exit;
	}

}


?>
