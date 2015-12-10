<?php
	require_once('classes.php');
	$conn = new Database();

	$me = 'brian';
	$result = '';
	$game = '';
	$console = FALSE;
	if( isset($_GET['game']) && trim($_GET['game']) && isset($_GET['console']) && trim($_GET['console']) ){
		$game = pg_escape_string($_GET['game']);	
		$console = pg_escape_string($_GET['console']);
		$result = $conn->queryTable("select * from getQuestion('$game','$console');");
	}

	if( !$result ){
                $result = $conn->queryTable("select * from getQuestion('General','General');");
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
		if( !$conn->queryTrueFalse( "select answerQuestion('$me',$qid,$ansSelf,'$ansOth',$imp );" )){
			echo "Error posting answer to one of your questions, please contact Benson";
		}
		$i++;
	}
?>

<html>
<?php
	if( $result ){

		if( $game == 'General' && $console == 'General' ){
			echo "<h1>You're Answering General Gaming Questions</h1>";
			echo "<h2> Answering these questions helps us find the best matches for you. Please be honest to find a compatible gamer.</h2>";
			echo "<div style ='font:11px/21px Arial,tahoma,sans-serif;color:#ff0000'> Priyam hates git pulls</div>";
		}
		else{
			echo "<h1>You're Answering Questions About $game For $console</h1>";
		}
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
			echo "$text<font color='red'>*</font></br>";
			echo "<input type='hidden' name='qid$i' value='$id'>";
			if( $ans1 ){ echo "<input type='radio' name='ansSelf$i' value='1' checked>$ans1</input><br/>"; }
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
	
			echo "<br/>How important is this to you on a scale of 1-5?<font color='red'>*</font><br/><select name='imp$i'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select><br/>";
	
			$i++;
		}
		echo "<br/><input type='submit'>";
	}
	?>
</html>
