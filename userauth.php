<html>

<head>
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
		//Stores session information
		$_SESSION['user'] = $newUser;
	}
}

?>
</head>

<body>
<?php

// if ($argv[1] && $argv[2]){
	// userAuth($argv[1], $argv[2]);
	// header("Location: session.php");	
// }
if ($_POST['user'] && $_POST['pxwd']){
	userAuth($_POST['user'], $_POST['pxwd']);
	header("Location: session.php");	
}
else{
	echo "Direct access to this page is not allowed.<br />";
}



?>
</body>

</html>