<?php
include_once("session.php");
session_start();
		
		
$me = $_SESSION["user"]->getName();

$you = '';
if( isset($_GET['user']) && trim($_GET['user']) ){
	$you = pg_escape_string($_GET['user']);
	if( $me != $you && !$_SESSION["user"]->query("select userExists('$you');", "boolean") ){
		header("Location: profile.php?user=$me");
	}
}
else{
	header("Location: profile.php?user=$me");
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script type="text/javascript" src = "design.js"></script>
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="main.css">
		<script src="js/vendor/modernizr-2.8.3.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- need connection to back end for messages -->
		<section id = 'banner'>
		<div class = 'inner split'>
			<section>
				<h2> User Profile </h2>
			</section>
			<section>
				<form action="userauth.php" method="post">
				<button type="submit"> Log Out </button>
				<input type="hidden" name="type" value="logout">
				</form>
			</section>
		</div>
		</section>
		<div class = 'wrapper'>
			<div class = 'inner split'>
				<section>
					<img src = 'images/plainPic.gif'>
				</section>
				<section>
				<?php
					$username = $_GET["user"];
					$profile = $_SESSION["user"]->query("select * from getprofile('$username');", "array");
					$description = $profile["description"];
					$display = $profile['name'];
					$location = $profile['location'];
					$languages = $profile['languages'];
					$rating = $_SESSION["user"]->query("select getrating('$username');", "array");
					if (!$rating) {$rating = '0';}
					echo "Username: $username<br>";
					echo "Display name: $display<br/>";
					echo "Location: $location<br/>";
					echo "Languages: $languages<br/>";
					echo "Feedback: " . $rating["getrating"] . "<br>";
					echo "About the gamer: " . $description . "<br>";
					if ($username != $me){
						echo "<form id='likeMatch' action='rateuser.php' method='post'>";
							echo "<input type='hidden' name='rateduser' value='$username'>";
							echo "<input type='hidden' name='rating' value='1'>";
							echo "<button>Good match</button>";
						echo "</form>";
						echo "<form id='unlikeMatch' action='rateuser.php' method='post'>";
							echo "<input type='hidden' name='rateduser' value='$username'>";
							echo "<input type='hidden' name='rating' value='-1'>";
							echo "<button>I didn't like my match</button>";
						echo "</form>";		
						echo "<a href = 'messages.php?user=$username'>Message</a>";
					}					
					else{
						echo "<a href = 'createprofile.php'>Edit Profile</a>";
					}
					echo "<br><br><br>";
					
				?>

			</section>
			</div>
		</div>
	</body>
<footer><?php include('footer.html');?></footer>
</html>
