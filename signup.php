<DOCTYPE HTML!>
<html>
<head>
	<meta charset="utf-8"> 
	<title>eHarbinger</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="design.js"></script>
</head>
<body>
	<header>
		<img src="resource/logo" height=100px></img>
		Welcome! Please Fill In Your Information:
		<br>
	</header>
	<form id="pref" action="createprofile.php" method="post">
		<div id="col-1" class="twoColumnContainer">
			<label for="Roles" class="heading"> Roles Played </label>
			<br>
			<input type="checkbox" name="Roles[]" value="Warrior">Warrior
			<br>
			<input type="checkbox" name="Roles[]" value="Mage">Mage
			<br>
			<input type="checkbox" name="Roles[]" value="Rogue">Rogue
			<br>
			<input type="checkbox" name="Roles[]" value="Healer">Healer
			<br>
			<br>
			<label for="Roles" class="heading"> Additional Information </label>
			<br>
			Name&nbsp;<input type="text" name="name">
			<br>
			Location&nbsp;<input type="text" name="location" placeholder="United States">
			<br>
			Languages$nbsp;<input type="text" name="lang" placeholder="English">
			<!--<label for = "Avatar" class = "heading"> Pick Your Avatar: </label>-->
			<br>
		</div>
		<div id="col-2" class="twoColumnContainer">
			<label for="Preferences" class="heading">Preferences</label><br>
			<br>
			<label class = "subheading">Systems: </label> <br>
			<br>
			<input type="checkbox" name="Preferences[]" value="Xbox">Xbox
			<input type="checkbox" name="Preferences[]" value="Playstation">Playstation
			<input type="checkbox" name="Preferences[]" value="PC"> PC
			<input type="checkbox" name="Preferences[]" value="Moblie"> Moblie<br>
			<br>
			<label class = "subheading">Games: </label> <br>
			<br>
			<input type="checkbox" name="Preferences[]" value="Racing">Racing
			<input type="checkbox" name="Preferences[]" value="MMO">MMO
			<input type="checkbox" name="Preferences[]" value="Shooting">Shooting
			<input type="checkbox" name="Preferences[]" value="Action">Action<br />
			<input type="checkbox" name="Preferences[]" value="Adventure">Adventure
			<input type="checkbox" name="Preferences[]" value="RPG">RPG
			<input type="checkbox" name="Preferences[]" value="Strategy">Strategy
			<input type="checkbox" name="Preferences[]" value="Sports">Sports<br />
			<input type="checkbox" name="Preferences[]" value="Casual">Casual
			<input type="checkbox" name="Preferences[]" value="Trivia">Trivia
			<input type="checkbox" name="Preferences[]" value="Indie">Indie
			<br>
			<br>
			<button class="button1" onclick="newUser()">Complete Profile</button> 
		</div>
	</form>
</body>
</html>


