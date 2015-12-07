<?php
include_once("dbconx.php");
include_once("classes.php");

// $session_path = "/home/FALL2015/bt773/public_html/eHarbinger/sessions";
$index_path = "/~bt773/eHarbinger/index.php";

// session_save_path($session_path);
session_start();



if (isset($_SESSION["user"])){
	if ($_SESSION["user"]->isLoggedIn()){
		echo $_SERVER["REQUEST_URI"];
		echo $_SESSION["user"]->isLoggedIn();
		echo "Session verification successful<br />";
		echo session_save_path();
		if ($_SERVER["REQUEST_URI"] == $index_path){
			Header("Location: players.php");
			exit;
		}
	}

}
else{
	//If there is no session information
	echo "Session verification failed<br />";
	if ($_SERVER["REQUEST_URI"] != $index_path){
		Header("Location: index.php");
		exit;
	}

}


?>
