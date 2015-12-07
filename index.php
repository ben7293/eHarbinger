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
		<header>
			<img src="resource/logo" height=100px></img>
			Welcome! Please Fill In Your Information:
			<br>
		</header>
		<div id = "col-1" class = "twoColumnContainer">
			<form id="login" action="userauth.php" method="post">
				<legend class = "heading"> Log In: </legend> <br>
				<label for = "user"> Username: </label>
				<br>
				<input type = "text" name = "user"> <br>
				<label for = "pxwd"> Password: </label>
				<br>
				<input type = "password" name = "pxwd"> <br>
				
				<?php
					if ($_GET["err"] == 1){
						echo "<font color=\"red\">Incorrect username and/or password.</font>";
					}
				?>				
				<br><br>
				<button> Submit </button>
			</form>
		</div>
		<div id = "col-2" class = "twoColumnContainer">
			<form id="signup" action="createacct.php" method="post">
				<legend class = "heading"> Sign Up: </legend>
				<br>
				<label for = "Name"> Name: </label>
				<br>
				<input type = "text" name = "name"> <br>
				<label for = "Email"> Email: </label>
				<br>
				<input type = "email" name = "email"> <br>
				<label for = "Password"> Password: </label>
				<br>
				<input type = "password" name = "password"> <br>
				<br>
				<?php
					if ($_GET["err"] == 2){
						echo "<font color=\"red\">Username already exists.</font>";
					}
				?>								
				<button onclick = "linkInfo()"> Submit </button>
			</form>
		</div>
	</body>
</html>
