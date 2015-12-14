<!DOCTYPE HTML>
<?php
	include_once("session.php");
	session_start();
	// First, fetch matches...
	$myUserName = $_SESSION["user"]->getName();
	$matchList = $_SESSION["user"]->query("select * from getMatches('$myUserName', 5)", "table");
	$numMatches = count($matchList);
	if( !$matchList ){ $numMatches = 0; }
	if ($numMatches == 0){
		// If no matches, find some for the poor user
		echo "running match";
		// system("./matchusers.exe");
		exec("./matchusers.o $myUserName", $s);
		var_dump($s);
		header("Refresh:0");
	}
?>		

<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
        <link rel="stylesheet" type="text/css" href="css/meg.css">
        <script type="text/javascript" src = "design.js"></script>

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
			<section><h2>Talk to your matches</h2></section>
			<section>
				<form action="userauth.php" method="post">
					<button> Log Out </button>
					<input type="hidden" name="type" value="logout">
				</form>
			</section>
		</div>
	</section>
		<div class = "wrapper">
		<!-- Need to be able to upload matches of different players -->
			<?php 

			echo "<h3>You have ($numMatches) matches!</h3>";
			// Then parse the matches
			foreach ($matchList as $matchInfo) {
				// Fetch info of the other user
				$yourUserName = $matchInfo['username'];
				$yourProfile = $_SESSION["user"]->query("select * from getprofile('$yourUserName');", "array");
				$description = trim($yourProfile["description"], ", ");
				$rating = $_SESSION["user"]->query("select getrating('$yourUserName');", "array");
				if (!$rating) {$rating = '0';}
				echo "<div class = 'inner split'  onload = 'playerInfo()'>";
					echo "<section>";
						echo "<img src = 'images/plainPic.gif'>";
					echo "</section>";
					echo "<section>";
				echo "<section>";
					echo "Username: <a href='profile.php?user=$yourUserName'>$yourUserName</a><br>";
					echo "Feedback: " . $rating["getrating"] . "<br>";
					echo "About the gamer: " . $description . "<br>";
					//echo "<a href='#' class='btn btn-default'><span class='glyphicon glyphicon-heart'></span> Good Match</a>";
					echo "<form id='likeMatch' action='rateuser.php' method='post'>";
						echo "<input type='hidden' name='rateduser' value='$yourUserName'>";
						echo "<input type='hidden' name='rating' value='1'>";
						echo "<button>Good match</button>";
					echo "</form>";
					echo "<form id='unlikeMatch' action='rateuser.php' method='post'>";
						echo "<input type='hidden' name='rateduser' value='$yourUserName'>";
						echo "<input type='hidden' name='rating' value='-1'>";
						echo "<button>I didn't like my match</button>";
					echo "</form>";
					echo "<br>";
					//echo "<a href='#' class='btn btn-default'><span class='glyphicon glyphicon-trash'></span> I didn't like my match</a>";
					echo "<form id='message' action='messages.php' method='get'>";
						echo "<input type='hidden' name='rateduser' value='$yourUserName'>";
						echo "<button onclick = 'send()'> Message </button>";
						echo "<input type='hidden' name='user' value='$yourUserName'>";
					echo "</form>";
				echo "</section>";
				echo "</div>";
				
				echo "<br>";

			}

			
			?>
	<footer><?php include('footer.html');?></footer>
	</body>
</html>
