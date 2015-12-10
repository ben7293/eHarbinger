<?php
	require_once('classes.php');
	$conn = new Database();

	$me = 'brian';
	$result = '';
	$game = '';
	$console = '';
	if( isset($_GET['game']) && trim($_GET['game']) && isset($_GET['console']) && trim($_GET['console']) ){
		$game = pg_escape_string($_GET['game']);	
		$console = pg_escape_string($_GET['console']);
		$result = $conn->queryTable("select * from getQuestion('$game','$console');");
	}

	$i = 1;
	while( isset($_POST["qid$i"]) && trim($_POST["qid$i"]) && isset($_POST["ansSelf$i"]) && trim($_POST["ansSelf$i"]) ){
		$qid = pg_escape_string($_POST["qid$i"]);
		$ansSelf = pg_escape_string($_POST["ansSelf$i"]);
		$imp = pg_escape_string($_POST["imp$i"]);

		$ansOthTmp = "";
		
		for( $j=1; $j <=5; $j++ ){
			if( isset($_POST["ans$j"."Oth$i"]) ){
				$ansOthTmp .= "1";
			}
			else{
				$ansOthTmp .= "0";
			}
		}

		$ansOth = pg_escape_string($ansOthTmp);
		if( $conn->queryTrueFalse( "select answerQuestion('$me',$qid,$ansSelf,'$ansOth',$imp );" )){
			echo "u good";
		}
		echo "$qid | $ansSelf | $ansOth | $imp<br/>";
		$i++;
	}
?>

<html>
<?php
	echo "<h1>You're Answering Questions About $game For $console</h1>";
	$i = 1;

	echo "<form method='post'>";
	foreach( $result as $row ){
		$id = $row['questionid'];
		$text = $row['questiontext'];
		$ans1 = $row['answer1'];
                $ans2 = $row['answer2'];
                $ans3 = $row['answer3'];
                $ans4 = $row['answer4'];
                $ans5 = $row['answer5'];

		echo "<h3>Question #$i</h3>";
		echo "<h5>$text</h5>";
		echo "What would you say about yourself?<font color='red'>*</font><br/>";
		echo "<input type='hidden' name='qid$i' value='$id'>";
		if( $ans1 ){ echo "<input type='radio' name='ansSelf$i' value='1'>$ans1</input><br/>"; }
                if( $ans2 ){ echo "<input type='radio' name='ansSelf$i' value='2'>$ans2</input><br/>"; }
                if( $ans3 ){ echo "<input type='radio' name='ansSelf$i' value='3'>$ans3</input><br/>"; }
                if( $ans4 ){ echo "<input type='radio' name='ansSelf$i' value='4'>$ans4</input><br/>"; }
                if( $ans5 ){ echo "<input type='radio' name='ansSelf$i' value='5'>$ans5</input><br/>"; }

		echo "<br/>What answers will you accept from others?<br/>";
		if( $ans1 ){ echo "<input type='checkbox' name='ans1Oth$i' value='$ans1'>$ans1</input><br/>"; }
                if( $ans2 ){ echo "<input type='checkbox' name='ans2Oth$i' value='$ans2'>$ans2</input><br/>"; }
                if( $ans3 ){ echo "<input type='checkbox' name='ans3Oth$i' value='$ans3'>$ans3</input><br/>"; }
                if( $ans4 ){ echo "<input type='checkbox' name='ans4Oth$i' value='$ans4'>$ans4</input><br/>"; }
                if( $ans5 ){ echo "<input type='checkbox' name='ans5Oth$i' value='$ans5'>$ans5</input><br/>"; }

		echo "<br/>How important is this to you?<font color='red'>*</font><br/><select name='imp$i'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select><br/>";

		$i++;


	}
?>
<br/><input type='submit'>

</html>
