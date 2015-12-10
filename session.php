<?php
include_once("classes.php");

$session_path = "/home/FALL2015/bt773/public_html/eHarbinger/sessions";
// $root_path = "/~bt773/eHarbinger/";
$root_path = "eHarbinger/";
$index_path = $root_path . "index.php";


// if (session_save_path() != $session_path) {session_save_path($session_path);}
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
