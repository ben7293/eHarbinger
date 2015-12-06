<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src = "design.js"></script>
		<?php	include_once("session.php"); ?>
	</head>
	<body>
		<header onload = "messages()"> Messages: (1) </header>
		<?php include_once("header.php"); ?>
		<div id = "col-2">
			<div id = "avatar"> 
				<img src = "avatar.jpg"> 
			</div>
			<div onclick = "open()">
				You have a Message from TheRealSlimShady
			</div>
		</div>
	</body>
</html>