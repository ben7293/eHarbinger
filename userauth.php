<html>
<head>
<?php

include_once("dbconx.php");
include_once("classes.php");

// echo "$_POST['user']"."$_POST['pxwd']";

//If there is input
function userAuth($user, $pxwd){

	if ($user and $pxwd){ //If both are not empty
		//Accepts return value from userAuth function in database
		//Uses PHP5+ password hashing function
		$db = conn_db();
		if ($db){echo "db exists<br>";}
		$newUser = new User($user, $pxwd, $db);
		
		// if ($ret){
			// //Initiates session if authentication is successful
			// session_start();
			// //Stores session information
			// $_SESSION['user'] = user;
			// //Perhaps should integrate with user class
		// }

	}
}
if ($_POST['user'] && $_POST['pxwd']){
	userAuth($_POST['user'], $_POST['pxwd']);	
}
else{
	echo "Direct access to this page is not allowed.<br />";
}


?>
</head>
<body>
</body>
</html>