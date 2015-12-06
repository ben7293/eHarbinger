<?php
include_once("dbconx.php");
include_once("classes.php");

session_start();


function userAuth($user, $pxwd){

	if ($user && $pxwd){ //If both are not empty
		//Accepts return value from userAuth function in database
		//Uses PHP5+ password hashing function
		$db = conn_db();
		$newUser = new User($user, $pxwd, $db);
		//Stores session information
		$_SESSION["user"] = $newUser;
		echo "Success";
	}
}

if ($_POST["user"] && $_POST["pxwd"]){
	userAuth($_POST["user"], $_POST["pxwd"]);
}
else{
	echo "Direct access to this page is not allowed.<br />";
}



?>
