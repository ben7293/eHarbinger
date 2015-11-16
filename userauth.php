<?php

include("dbconx.php")
include("user.php")

//If there is input
function userAuth(user = $_POST['user'], pxwd = $_POST['pxwd']){

	if (user and pxwd){ //If both are not empty
		//Accepts return value from userAuth function in database
		//Uses PHP5+ password hashing function
		$db = 
		$ret = pg_query($db, "select userAuth(user, PASSWORD_BCRYPT(pxwd)")
		//Future improvement: change so password is hashed on clicking submit
		
		if ($ret){
			//Initiates session if authentication is successful
			session_start();
			//Stores session information
			$_SESSION['user'] = user;
			//Perhaps could integrate with user class
		}

	}
}

?>