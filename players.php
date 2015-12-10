<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src = "design.js"></script>
		<?php
			include_once("session.php");
		?>
	</head>
	<body>
			
		<header> You Have This Many Matches: (2) </header>
		<?php include_once("header.php"); ?>
		<div id = "col-2"  onload = "playerInfo()">
			<?php 
			// First, fetch matches...
			$myUserName = $_SESSION["user"]->getName();
			$matchList = $_SESSION["user"]->query("select * from getMatches('$myUserName', 5)", "table");
			// Then parse the matches
			foreach ($matchList as $matchInfo) {
				// Fetch info of the other user
				$yourUserName = $matchInfo['username'];
				$yourProfile = $_SESSION["user"]->query("select * from getprofile('$yourUserName');", "array");
				$likeList = trim($yourProfile, ", ");
				$rating = $_SESSION["user"]->query("select getrating('$yourUserName');", "array");
				echo "<div id = 'avatar'>";
				echo "</div>";
					// echo "<img src = 'resource/avatar/$yourUserName' height='50px'>";
					echo "<img src = 'resource/avatar/avatar' height='50px'>";
				echo "<div>";
					echo "Username: <a href='profile.php?user=$yourUserName'>$yourUserName</a><br>";
					echo "Level: Expert<br>";
					echo "Likes: " . $likeList["description"] . "<br>";
					echo "Feedback: " . $rating["getrating"];
					echo "<form id='message' action='messages.php' method='get'>";
						echo "<button onclick = 'send()'> Message </button>";
						echo "<input type='hidden' name='user' value='$yourUserName'>";
					echo "</form>";
				echo "</div>";
				
				echo "<br>";

			}

			
			?>
		</div>
	</body>
</html>