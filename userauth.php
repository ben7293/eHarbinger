<html>
<head>
<?php

include("dbconx.php");
include("classes.php");

// echo "$_POST['user']"."$_POST['pxwd']";

userAuth($_POST['user'], $_POST['pxwd']);
//If there is input
function userAuth($user = $_POST['user'], $pxwd = $_POST['pxwd']){

	if ($user and $pxwd){ //If both are not empty
		//Accepts return value from userAuth function in database
		//Uses PHP5+ password hashing function
		$db = new Database();
		$newUser = new user($user, $pxwd, $db);
		
		// if ($ret){
			// //Initiates session if authentication is successful
			// session_start();
			// //Stores session information
			// $_SESSION['user'] = user;
			// //Perhaps should integrate with user class
		// }

	}
}

?>
</head>
<body>
</body>
</html>