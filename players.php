<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src = "design.js"></script>
		<?php include("header.php"); ?>
	</head>
	<body>
		<header> You Have This Many Matches: (2) </header>
		<div id = "col-1">
			<button onclick = "logout()"> Log Out </button>
			<br>
			<br>
			<a href = "messages.html" > Messages </a>
			<br>
			<br>
			<a href = "players.html" > Search For Players </a>
			<br>
			<br>
			<a href = "contactUs.html"> Meet the Team! </a>
			<br>
			<br>
		</div>
		<div id = "col-2"  onload = "playerInfo()">
			<div id = "avatar"> 
				<img src = "avatar.jpg"> 
			</div>
			<div>
				Username: champion<br>
				Level: Expert<br>
				Played With: 7 Players<br>
				Likes: PC, MMO <br>
				Feedback: +10
				<button onclick = "send()"> Message </button> 
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