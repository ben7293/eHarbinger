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
			// Should be using a getMatches(), Brian pls
			$myUserName = $_SESSION["user"]->getName();
			$matchList = $_SESSION["user"]->query("SELECT * FROM users_match_users WHERE username1='$username';", "table");
			// Then parse the matches
			foreach ($matchList as $matchInfo) {
				// Fetch info of the other user
				$yourUserName = $matchInfo['username2'];
				$likeList = $_SESSION["user"]->query("SELECT * FROM users_public WHERE username='$yourUserName';", "array");
				echo "<div id = 'avatar'>";
					echo "<img src = 'resource/avatar/$yourUserName.jpg'>";
				echo "</div>";
				echo "<div>";
					echo "Username: $yourUserName<br>";
					echo "Level: Expert<br>";
					echo "Played With: 7 Players<br>";
					echo "Likes: $likeList['description'] <br>";
					echo "Feedback: +10";
					echo "<form id='message' action='messages.php' method='get'>";
						echo "<button onclick = 'send()'> Message </button>";
						echo "<input type='hidden' name='user' value='$yourUserName'>";
					echo "</form>";
				echo "</div>";
				
				echo "<br>";

			}

			
			?>
			<div id = "avatar"> 
				<img src = "avatar.jpg"> 
			</div>
			<div>
				Username: champion<br>
				Level: Expert<br>
				Played With: 7 Players<br>
				Likes: PC, MMO <br>
				Feedback: +10
				<form id="message" action="messages.php" method="get">
					<button onclick = "send()"> Message </button> 
					<input type="hidden" name="user" value="brian">
				</form>
			</div>
			
			<br>
			<div id = "avatar"> 
				<img src = "avatar.jpg"> 
			</div>
			<div>
				Username: n00b<br>
				Level: Newbie<br>
				Played With: 2 Players<br>
				Likes: Xbox, RPG <br>
				Feedback: +1
				<button onclick = "send()"> Message </button>
			</div>
		</div>
	</body>
</html>