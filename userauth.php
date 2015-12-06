<?php
include_once("dbconx.php");
include_once("classes.php");

session_start();

function userAuth($user, $pxwd){
	//Uses PHP5+ password hashing function
	$db = conn_db();
	$newUser = new User($user, $pxwd, $db);
	//Stores session information
	if ($newUser->isLoggedIn()){
		$_SESSION["user"] = $newUser;
		echo "Success";
	}
	else{
		unset($newUser);
		header("Location: index.php?err=1");
	}
}

userAuth($_POST["user"], $_POST["pxwd"]);


?>
