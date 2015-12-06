<?php
include_once("dbconx.php");
include_once("classes.php");
session_save_path("/home/FALL2015/bt773/public_html/eHarbinger/sessions");
session_start();

function userAuth($user, $pxwd){
	//Uses PHP5+ password hashing function
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
	header("Location: index.php");
}


if (isset($_GET['logout'])){
	if ($_GET['logout'] == 1) logout();
}
else{
	userAuth($_POST["user"], $_POST["pxwd"]);
}


?>
