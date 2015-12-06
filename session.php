<html>
<head>
<?php

include_once("classes.php");

include_once("dbconx.php");
$db = conn_db();
// if ($db){echo "db exists<br>";}
$newUser = new User("ben7293", "baby", $db);
	
if ($newUser){
	//Initiates session if authentication is successful
	session_start();
	//Stores session information
	$_SESSION['user'] = user;
	//Perhaps should integrate with user class
}

if (!$_SESSION['user']->loggedIn){
	//If there is no session information
	echo "Session verification failed<br />";
	var_dump(!$_SESSION['user']->isLoggedIn());

}
else{
	echo "Session verification successful<br />";
}

?>
</head>
</html>