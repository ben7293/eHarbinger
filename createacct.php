<?php

include_once("dbconx.php");
include_once("classes.php");
include_once("userauth.php"); //I wanted to redirect to userauth.php instead, still figuring this out...
session_start();



function addUser($user, $pxwd, $email){
	$db = conn_db();
	if (!$db->queryTrueFalse("select userExists('$user')")){
		// If username does not exist
		if ($db->queryTrueFalse("select insertUser('$user', '$pxwd', '$email')")){
			// Add user information to database
			// Log the user in
			login($user, $pxwd, $db);
			$_SESSION["completedPref"] = FALSE;
			header("Location: signup.php");
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
	if( isset($_POST['user']) && trim($_POST['user']) && isset($_POST['pxwd']) && trim($_POST['pxwd']) && isset($_POST['email']) && trim($_POST['email'])){
		$user = pg_escape_string(trim($_POST['user']));
		$pwxd = pg_escape_string(trim($_POST['pxwd']));
		$email = pg_escape_string(trim($_POST['email']));
		echo "Password is $pxwd";
		// addUser($user, $pxwd, $email);	
	}
	else{
		// Complain
		header("Location: index.php?err=3");
	}
	// addUser($argv[1], $argv[2]);	
}

	

?>