<?php
include_once("dbconx.php");
include_once("classes.php");
session_start();



function login($user, $pxwd, $db){
	$newUser = new User($user, $pxwd, $db);
	if ($newUser->isLoggedIn()){
		// If authentication successful, start user session...
		$_SESSION["user"] = $user;
	}
	else{
		// If authentication failed, destroy new user container...
		unset($newUser);
		// And redirect to login page
		header("Location: index.php?err=1");
	}
}

function logout(){
	unset($_SESSION["user"]);
	$_SESSION["user"] == NULL;
	session_destroy();
}


//=============================================================

if (isset($_POST["type"])){
	if ($_POST["type"] == "logout"){
		logout();
		header("Location: index.php");
	}
	elseif ($_POST["type"] == "login"){
		// Hash the password
		// $pxwd = crypt($_POST["pxwd"]);
		$pxwd = $_POST["pxwd"];
		// Start database connection
		$db = conn_db();
		// Session admittance
		login($_POST["user"], $pxwd, $db);
		// And redirect to main page
		header("Location: players.php");
	}
}


?>
