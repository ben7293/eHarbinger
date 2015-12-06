<html>

<head>
</head>

<body>
<?php

include_once("dbconx.php");
include_once("classes.php");

function userAuth($user, $pxwd){

	if ($user && $pxwd){ //If both are not empty
		//Accepts return value from userAuth function in database
		//Uses PHP5+ password hashing function
		$db = conn_db();
		// if ($db){echo "db exists<br>";}
		$newUser = new User($user, $pxwd, $db);
		
		if ($newUser){
			//Initiates session if authentication is successful
			session_save_path("/home/FALL2015/bt773/public_html/eHarbinger");
			session_start();
			//Stores session information
			$_SESSION['user'] = $newUser;
		}

	}
}


userAuth("ben7293", "baby");

// if ($_POST['user'] && $_POST['pxwd']){
	// userAuth($_POST['user'], $_POST['pxwd']);
// }
// else{
	// echo "Direct access to this page is not allowed.<br />";
// }

header("Location: session.php");

?>
</body>

</html>