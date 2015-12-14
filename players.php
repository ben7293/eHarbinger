<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
        <link rel="stylesheet" type="text/css" href="css/meg.css">
        <script type="text/javascript" src = "design.js"></script>
		<?php
			include_once("session.php");
			session_start();
		?>		
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
	<section id = 'banner'>
		<!-- Benson, need to change number of messages given -->
		<div class = 'inner split'>
			<section><h2> You Have This Many Matches: (2) </h2></section>
			<section><button onclick = "logout()"> Log Out </button></section>
		</div>
	</section>
		<div class = "wrapper">
		<!-- Need to be able to upload matches of different players -->
			<?php 
			// First, fetch matches...
			$myUserName = $_SESSION["user"]->getName();
			$matchList = $_SESSION["user"]->query("select * from getMatches('$myUserName', 5)", "table");
			$numMatches = count($matchList);
			if( !$matchList ){ $numMatches = 0; }
			echo "<h3>You have ($numMatches) matches!</h3>";
			// Then parse the matches
			foreach ($matchList as $matchInfo) {
				// Fetch info of the other user
				$yourUserName = $matchInfo['username'];
				$yourProfile = $_SESSION["user"]->query("select * from getprofile('$yourUserName');", "array");
				$description = trim($yourProfile["description"], ", ");
				$rating = $_SESSION["user"]->query("select getrating('$yourUserName');", "array");
				echo "<div class = 'inner split'  onload = 'playerInfo()'>";
					echo "<section>";
						echo "<img src = 'images/plainPic.gif'>";
					echo "</section>";
					echo "<section>";
				echo "<section>";
					echo "Username: <a href='profile.php?user=$yourUserName'>$yourUserName</a><br>";
					echo "Level: Expert<br>";
					echo "About the gamer: " . $description . "<br>";
					echo "Feedback: " . $rating["getrating"];
					//echo "<a href='#' class='btn btn-default'><span class='glyphicon glyphicon-heart'></span> Good Match</a>";
					echo "<form id='likeMatch' action='rateuser.php' method='post'>";
						echo "<input type='hidden' name='rating' value='1'>";
						echo "<button>Good match</button>";
					echo "</form>";
					echo "<form id='unlikeMatch' action='rateuser.php' method='post'>";
						echo "<input type='hidden' name='rateduser' value='$yourUserName'>";
						echo "<input type='hidden' name='rating' value='-1'>";
						echo "<button>I didn\'t like my match</button>";
					echo "</form>";
					echo "<br>";
					//echo "<a href='#' class='btn btn-default'><span class='glyphicon glyphicon-trash'></span> I didn't like my match</a>";
					echo "<form id='message' action='messages.php' method='get'>";
						echo "<input type='hidden' name='rateduser' value='$yourUserName'>";
						echo "<button onclick = 'send()'> Message </button>";
						echo "<input type='hidden' name='user' value='$yourUserName'>";
					echo "</form>";
				echo "</section>";
				echo "/div";
				
				echo "<br>";

			}

			
			?>				
		<div class = 'inner split'  onload = "playerInfo()">
			<section> 
				<img src = "images/plainPic.gif"> 
			</section>
			<section>
				Username: champion<br>
				Level: Expert<br>
				Played With: 7 Players<br>
				Likes: PC, MMO <br>
				Feedback level
				<br>

				<a href="#" class="btn btn-default"><span class="glyphicon glyphicon-heart"></span> Good Match</a>
				<br>
				<a href="#" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span> I didn't like my match</a>
				<br>
				<br>
				<button onclick = "send()"> Message </button> 
			</section>
			<br>
		</div>
		</div>
		<footer> <a href = "forum.html"> General Forum | </a> <a href = "messages.php"> Messages | </a> <a href = "contactUs.html"> Meet the Team! </a> </footer>
	</body>
</html>