<!DOCTYPE HTML>
<!--
	Prism by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title> eHarbginer</title>
		<meta charset="utf-8" />
		<link rel= "stylesheet" href="css/main.css" />
	</head>
	<body>
		<section id="banner">
			<div class="inner split">
				<section>
					<h2>Welcome to eHarbinger!!</h2>
				</section>
				<section>
					<p>Log In or Sign up for our wonderful "matchmaking" company!</p>
				</section>
			</div>
		</section>
		<section id="one" class="wrapper">
			<div class="inner split">
				<section>
					<h2>Why should you join us?</h2>
					<p>eHarbinger was created with the gamer in mind. We've developed a safe environment for gamers to be able to find others to play with. Our algorithm uses each person's game preferences and personality to match them with other gamers with the same qualities.</p>
				</section>
				<section>
					<img class = "image-left" src = "images/logo.jpg" />
				</section>
			</div>
		</section>
			<section class="wrapper">
				<section class="errorMsg">
					<!-- Megham pls-->
					<?php
						if ($_GET["err"] == 1){
							echo "Incorrect username and/or password.";
						}
						elseif ($_GET["err"] == 2){
							echo "Username already exists.";
						}
						elseif ($_GET["err"] == 3){
							echo "Your username and/or password is invalid.";
						}						
					?>						
				</section>			
				<div class="inner split">

					<section>
						<h2>Log In</h2>
						<form action="userauth.php" method="POST">
							<div>
								<input type = "text" name="username" placeholder = "Username">
								<br>
								<input type = "text" name="password" placeholder = "Password">
								<br>
 							</div>
							<input type="hidden" name="type" value="login">
							<input value="Log In" type = "submit">
 						</form>
					</section>
					<section>
						<h2>Sign Up</h2>
						<form action = "createacct.php" method="POST">
							<div>
								<input type = "text" name = "name" placeholder = "Full Name">
								<br>
								<input type = "email" name = "email" placeholder = "Email">
								<br>
								<input type = "text" name = "password" placeholder = "Password">
								<br>
							</div>
							<!-- Need to put with back end -->
							<input value = "Sign Up" type = "submit">
						</form>
					</section>
				</div>
			</section>
	</body>
</html>