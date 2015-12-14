<?php
include_once("classes.php");
include_once("userauth.php");
session_start();

function addUser($user, $pxwd, $email){
	$db = new Database();
	if (!$db->queryTrueFalse("select userExists('$user')")){
		// If username does not exist
		if ($db->queryTrueFalse("select insertUser('$user', '$pxwd', '$email')")){
			// Add user information to database
			// Log the user in
			login($user, $pxwd, $db);
			// $_SESSION["completedPref"] = FALSE;
			// header("Location: signup.php");
		}
	}
	else{
		//Complain
		header("Location: index.php?err=2");
	}
	
}
if (!isset($_SESSION["user"])){
	// New user, create an account and log in
	// $pxwd = crypt($_POST["pxwd"]);
	if( isset($_POST['user']) && trim($_POST['user']) && isset($_POST['pxwd']) && trim($_POST['pxwd']) && isset($_POST['email']) && trim($_POST['email'])){
		// If all fields are satisfactory
		$user = pg_escape_string(trim($_POST['user']));
		$pxwd = pg_escape_string(trim($_POST['pxwd']));
		$email = pg_escape_string(trim($_POST['email']));
		
		addUser($user, $pxwd, $email);	
	}
	else{
		// Otherwise, complain
		header("Location: index.php?err=3");
	}
}

if (isset($_POST["pub_prof"])){
	
	//Send profile data to database
	$username = $_SESSION["user"]->getName();
	$name = pg_escape_string(trim($_POST["pub_prof"]["name"]));
	$location = pg_escape_string(trim($_POST["pub_prof"]["location"]));
	$language = pg_escape_string(trim($_POST["pub_prof"]["language"]));
	$description = pg_escape_string(trim($_POST["pub_prof"]["description"]));

	// Update profile
	// $status = $_SESSION["user"]->upProf($username, $name, $location, $lang, $prefCsv);
	$status = $_SESSION["user"]->upProf($username, $name, $location, $language, $description);
	header("Location: games.php");

}


?>

<DOCTYPE HTML!>

	<html>
		<head>
		<meta charset="utf-8"> 
        	<title>eHarbinger</title>
        	<link rel="stylesheet" type="text/css" href="css/main.css">
        	<script type="text/javascript" src = "design.js"></script>
		</head>
		<body>
		<header id = 'banner'>
			<h2>Welcome! Please Fill In Your Information:</h2>
			<br>
		</header>
            <!-- Information to be filled out by user -->
            <br>
            <br>
            <div class = 'wrapper' style="width:50%; margin-left:auto; margin-right:auto">
			<section>
				<label for="pub_profie" class="heading">Tell us a little more about yourself</label>
				This information will be visible to anyone viewing your profile.
				<form action="createprofile.php" method="POST">
					<label>Display Name</label>
					<input type="text" name="pub_prof[name]" size="10" autofocus="autofocus">
					<br>
					<label>Location</label>
					<input type="text" name="pub_prof[location]" size="10" placeholder="e.g. United States">
					<br>
					<label>Language</label>
					<input type="text" name="pub_prof[language]" size="10" placeholder="e.g. English">
					<br>
					<label>About you</label>
					<textarea rows="3" name="pub_prof[description]"></textarea>
					<br>
					<button class = 'button-center' type="submit">Finish Profile</button> 
				</form>
			</section>
            </div>
		</body>
	</html>