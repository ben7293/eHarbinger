<?php
	include_once('classes.php');
	$conn = new Database();

	if( ((isset($_POST['newconsole']) && trim($_POST['newconsole'])) || (isset($_POST['oldconsole']) && trim($_POST['oldconsole']))) && isset($_POST['newgame']) && trim($_POST['newgame']) ){
		$newconsole = pg_escape_string($_POST['newconsole']);
		if( !trim($newconsole) ){
			$newconsole = pg_escape_string($_POST['oldconsole']);
		}
		$newgame = pg_escape_string($_POST['newgame']);
		$newdesc = pg_escape_string($_POST['newdesc']);
		if( !$conn->queryTrueFalse("select insertGame( '$newgame', '$newconsole', '$newdesc' );" )){
			echo "Error: Game $newgame could not be added for console: $newconsole";
		}
	}

	if( isset($_POST['qtext']) && trim($_POST['qtext']) && isset($_POST['ans1']) && trim($_POST['ans1']) ){
		$console = pg_escape_string($_POST['console']);
		$game = pg_escape_string($_POST['game']);
		$qtext = pg_escape_string($_POST['qtext']);
		$ans1 = pg_escape_string($_POST['ans1']);
		$ans2 = pg_escape_string($_POST['ans2']);
		$ans3 = pg_escape_string($_POST['ans3']);
		$ans4 = pg_escape_string($_POST['ans4']);
		$ans5 = pg_escape_string($_POST['ans5']);

		if( !$conn->queryTrueFalse("select insertQuestion('$game','$console','$qtext','$ans1','$ans2','$ans3','$ans4','$ans5');")){
			echo "Error: Game $game does not exist for Console $console";
		}

	}


	$resultCon = $conn->queryTable('select DISTINCT gameConsole FROM games');
	$consoles = Array();
	foreach( $resultCon as $row ){
		array_push($consoles,$row['gameconsole']);
	}

	$games = Array();
	$resultGame = $conn->queryTable('select DISTINCT gamename FROM games');
	foreach( $resultGame as $row ){
		array_push($games, $row['gamename']);
	}
?>

<html>
<h1>Add a question</h1>
<form method='post'>
Select Console:
<select name='console'><option>--Select--</option><?php foreach( $consoles as $console){ echo "<option value='$console'>$console</option>";}?></select>
<br/>
Select Game:
<select name='game'><option>--Select--</option><?php foreach( $games as $game){ echo "<option value='$game'>$game</option>";} ?></select>
<br/>
Question text:
<input type='textbox' name='qtext'>
<br/>
Answer 1:
<input type='text' name='ans1'>
<br/>
Answer 2:
<input type='text' name='ans2'>
<br/>
Answer 3:
<input type='text' name='ans3'>
<br/>
Answer 4:
<input type='text' name='ans4'>
<br/>
Answer 5:
<input type='text' name='ans5'>
<br/>
<input type='submit'>
</form>

<br/>

<h1>Add a game</h1>
<form method='post'>
GameConsole:<br/>
Select an existing console or add a new one below!
<br/>
<select name='oldconsole'><option>--Select--</option><?php foreach( $consoles as $console){ echo "<option value='$console'>$console</option>";}?></select>
 or 
<input type='text' name='newconsole'>
<br/>
GameName
<br/>
<input type='text' name='newgame'>
<br/>
Game Description
<br/>
<input type='textbox' name='newdesc'>
<br/>
<input type='submit'>
</form>
</html>
