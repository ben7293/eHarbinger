<?php

// include_once("classes.php");
// include_once("session.php");
// session_start();

//=============================================================

// if (isset($_SESSION["completedPref"])){
	// if (!$_SESSION["completedPref"]){
		// Create csv formatted description
		$prefCsv = "";
		if (isset($_POST["Preferences"])){
			foreach ($_POST["Preferences"] as $pref){
				if ($prefCsv == ""){
					// First item
					$prefCsv = $pref;
				}
				else{
					// Following item
					$prefCsv = $prefCsv . "," . $pref;
				}
			}
		}
		// Send profile data to database
		// $_SESSION["user"]->conn->queryTrueFalse(
		include_once("dbconx.php");
		$db = db_conn();
		$db->queryTrueFalse(
			"select updateprofile
			(
			
			
			'bm1069',
			'$_POST["name"]', 
			'$_POST["location"]', 
			'$_POST["lang"]', 
			'$prefCsv' 
			
			)"
		);
	// }
	// else{
		// header("Location: player.php");
	// }
// }

	

?>