<html>
<head>
<?php

include_once("classes.php");


if (!$_SESSION['user']->loggedIn){
	//If there is no session information
	echo "Session verification failed<br />";
	var_dump(!$_SESSION['user']->isLoggedIn());
	header("Location: index.html");

}
else{
	echo "Session verification successful<br />";
}

?>
</head>
</html>