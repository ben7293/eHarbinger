<DOCTYPE HTML!>
	<html>
		<head>
		<meta charset="utf-8"> 
        	<title>eHarbinger</title>
        	<link rel="stylesheet" type="text/css" href="style.css">
        	<script type="text/javascript" src = "design.js"></script>
		</head>
		<body>
		<header>
			Welcome! Please Fill In Your Information:
			<br>
		</header>
		<div id = "col-1" class = "twoColumnContainer">
			<label for="Roles" class = "heading"> Roles Played: </label>
            <br>
            Warrior <input type = checkbox name = Roles value = Warrior>
            <br>
            Mage <input type = checkbox name = Roles value = Mage>
            <br>
            Rogue <input type = checkbox name = Roles value = Rogue>
            <br>
            Healer <input type = checkbox name = Roles value = Healer>
            <br>
            <br>
            <label for = "Avatar" class = "heading"> Pick Your Avatar: </label>
            <br>
		</div>
		<div id = "col-2" class = "twoColumnContainer">
			<label for="Preferences" class = "heading"> Preferences: </label><br>
			<br>
			<label class = "subheading">Systems: </label> <br>
			<br>
            Xbox <input type = checkbox name = Preferences value = Xbox>
            Playstation <input type = checkbox name = Preferences value = Playstation>
            PC <input type = checkbox name = Preferences value = PC> 
            Moblie <input type = checkbox name = Preferences value = Moblie> <br>
            <br>
            <label class = "subheading">Games: </label> <br>
            <br>
            Racing <input type = checkbox name = Preferences value = Racing>
            MMO <input type = checkbox name = Preferences value = MMO>
            Shooting <input type = checkbox name = Preferences value = Shooting>
            Action <input type = checkbox name = Preferences value = Action>
            Adventure <input type = checkbox name = Preferences value = Adventure>
            RPG <input type = checkbox name = Preferences value = RPG>
            Strategy <input type = checkbox name = Preferences value = Strategy>
            Sports <input type = checkbox name = Preferences value = Sports>
            Casual <input type = checkbox name = Preferences value = Casual>
            Trivia <input type = checkbox name = Preferences value = Trivia>
            Indie <input type = checkbox name = Preferences value = Indie>
            <br>
            <br>
            <button class = "button1" onclick = "newUser()"> Finish Profile </button> 
		</div>
		</body>
	</html>


