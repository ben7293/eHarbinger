<?php

include_once("dbconx.php");
include_once("classes.php");
include_once("userauth.php"); //I wanted to redirect to userauth.php instead, still figuring this out...
session_start();



function addUser($user, $pxwd){
	$db = conn_db();
	var_dump(!$db->queryTrueFalse("select userExists('$user')"));
	if (!$db->queryTrueFalse("select userExists('$user')")){
		if ($db->queryTrueFalse("select insertUser('$user', '$pxwd')")){
			//Log the user in
			// userAuth($user, $pxwd);
			// $_POST["user"] = $user;
			// $_POST["pxwd"] = $pxwd;
		}
	}
	else{
		//Complain
		header("Location: index.php?err=2");
	}
	
}



//=============================================================

if (isset($_SESSION["user"])){
	header("Location: players.php");
}
else{
	// $pxwd = crypt($_POST["pxwd"]);
	$pxwd = $_POST["pxwd"];
	addUser($_POST["user"], $pxwd);	
	// addUser($argv[1], $argv[2]);	
}

	

?>