<?php

include_once("classes.php");
include_once("session.php");
session_start();

//=============================================================

if (isset($_SESSION["completedPref"])){
	if (!$_SESSION["completedPref"]){
		$_SESSION["user"]->conn->queryTrueFalse("select updateprofile()");
	}
	else{
		header("Location: player.php");
	}
}

	

?>