<html>
<head>
<?php

include_once("classes.php");

var_dump(!$_SESSION['user']->isLoggedIn());

// if (!$_SESSION['user']->isLoggedIn()){
	// //If there is no session information
	// echo "Session verification failed<br />";
	// var_dump(!$_SESSION['user']->isLoggedIn());
// }
// else{
	// echo "Session verification successful<br />";
	// var_dump(!$_SESSION['user']->isLoggedIn());
// }


?>
</head>
</html>