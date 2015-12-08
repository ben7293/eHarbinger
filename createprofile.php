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
		
		echo "select updateprofile(
			'$_SESSION["user"]->getName()',
			'$_POST["name"]', 
			'$_POST["location"]', 
			'$_POST["lang"]', 
			'$prefCsv' 
		)";
		
		// $_SESSION["user"]->conn->queryTrueFalse("select updateprofile(
			// '$_SESSION["user"]->getName()',
			// '$_POST["name"]', 
			// '$_POST["location"]', 
			// '$_POST["lang"]', 
			// '$prefCsv' 
		// )");
	// }
	// else{
		// header("Location: player.php");
	// }
// }

	

?>