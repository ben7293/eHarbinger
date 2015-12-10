<?php
	require_once('classes.php');
	include_once('session.php');
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
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src = "design.js"></script>
	</head>
	<body>
		<header onload = "dayMessage()">Have a Mass Effect Monday! </header>
<?php include_once("header.php");?>
		<div id = "col-2" style='width: 50%;'>
			<div id = "avatar"> 
				<img src = "avatar.jpg"> 
			</div>
			<div onload = "info()">
				<?php
					$prof = $_SESSION["user"]->query("select * from getProfile('$you')", "array");
					$date = date_create_from_format('Y-m-d H:i:s.u',$prof['logintimestamp']);
					$dateFmt = date_format($date, 'M d, Y \a\t h:i:sa');
					$rating = $_SESSION["user"]->query("select * from getRating('$you')", "table");
					$feedback = $rating['feedback'];
					if( !$feedback ){
						$feedback = 0;
					}
					// $match = $rating['feedback'];
					var_dump($rating);
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
