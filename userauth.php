<?php
include_once("dbconx.php");
include_once("classes.php");
session_start();



function userAuth($user, $pxwd){
	$db = conn_db();
	$newUser = new User($user, $pxwd, $db);
	//Stores session information
	if ($newUser->isLoggedIn()){
		$_SESSION["user"] = $newUser;
		header("Location: players.php");
	}
	else{
		unset($newUser);
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
		// $pxwd = crypt($_POST["pxwd"]);
		$pxwd = $_POST["pxwd"];
		userAuth($_POST["user"], $pxwd);
	}
}


?>
