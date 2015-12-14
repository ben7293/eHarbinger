<?php
include_once("classes.php");
include_once("session.php");
session_start();

if (isset($_POST["rating"])){
	$me = $_SESSION["user"]->getName();
	$you = $_POST["rateduser"];
	$rating = $_POST['rating'];
	$_SESSION["user"]->query("select rateuser('$me', '$you', '$rating')","boolean");
}
header("Location: players.php");

?>