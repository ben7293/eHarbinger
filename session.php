<?php

if (!$_SESSION['user']->loggedIn){
	//If there is no session information
	header("Location: index.html");

}
else{
	echo "Session verification successful<br />";
}

?>