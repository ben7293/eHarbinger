<?php
include_once("dbconx.php");
include_once("classes.php");

session_start();

if (isset($_SESSION["user"])){
	if ($_SESSION["user"]->isLoggedIn()){
		echo "Session verification successful<br />";
	}
}
else{
	//If there is no session information
	echo "Session verification failed<br />";
	Header("Location: index.php");

}


?>
