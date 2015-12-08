<?php

include_once("dbconx.php");
include_once("classes.php");
session_start();



function addUser($user, $pxwd){
	$db = conn_db();
	if ($db->queryTrueFalse("select insertUser($user, $pxwd)")){
		//Log the user in
		userAuth($user, $pxwd);
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
}

	

?>