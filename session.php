<?php

if (empty($_SESSION['user'])){
	//If there is no session information
	header("Location: index.html")
}

?>