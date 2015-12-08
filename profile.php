<?php
	require_once('classes.php');
	$conn = new Database();

	//. $_SESSION pls
	$me = pg_escape_string($_GET['me']);

	$you = '';
	if( isset($_GET['user']) && trim($_GET['user']) ){
		$you = pg_escape_string($_GET['user']);
		if( $me != $you && !$conn->queryTrueFalse("select userExists('$you');") ){
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
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src = "design.js"></script>
	</head>
	<body>
		<header onload = "dayMessage()">Have a Mass Effect Monday! </header>
			<button class = "butt" onclick = "logout()"> Log Out </button>
		<div id = "col-1">
			<br>
			<a href = "forum.html" > Forum </a>
			<br>
			<br>
			<a href = "players.html" > Search For Players </a>
		</div>
		<div id = "col-2" style='width: 50%;'>
			<div id = "avatar"> 
				<img src = "avatar.jpg"> 
			</div>
			<div onload = "info()">
				<?php
					$prof = $conn->queryArray("select * from users_public where username='$you'");
					$date = date_create_from_format('Y-m-d H:i:s.u',$prof['logintimestamp']);
					$dateFmt = date_format($date, 'M d, Y \a\t h:i:sa');
					$rating = $conn->queryArray("select count(username1) as feedback from users_rate_users WHERE username2='$you'");
					$feedback = $rating['feedback'];
					// Need to add later
					$match = 'Baesan pls halp';
					echo "<table>";
					echo "<tr><td>Username:</td><td>".$prof['username']."</td></tr>";
					echo "<tr><td>Name:</td><td>".$prof['name']."</td></tr>";
					echo "<tr><td>Location:</td><td>".$prof['location']."</td></tr>";
					echo "<tr><td>Languages:</td><td>".$prof['languages']."</td></tr>";
					echo "<tr><td>Description:</td><td>".$prof['description']."</td></tr>";
					echo "<tr><td>Feedback:</td><td>".$feedback."</td></tr>";
					echo "<tr><td>Last Login:</td><td>".$dateFmt."</td></tr>";
					echo "<tr><td>Match</td><td>".$match."<td></tr>";
					echo "</table>";
				?>
			</div>
		
				<br>
				<a href = "editProfile.html">Edit Profile Here</a>
		</div>
		<p class = "footer"> <a href = "contactUs.html">Meet the Team!</a> </p>
	</body>
</html>
