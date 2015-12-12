<?
	require_once('session.php');
	session_start();

	$conn = new Database();

        $me = $_SESSION['user']->getName();
        if( !$_SESSION['user']->isLoggedIn() ){
                header('location: index.php');
        }


	$result = '';
	$game = '';
	$console = '';
	if( isset($_GET['game']) && trim($_GET['game']) && isset($_GET['console']) && trim($_GET['console']) ){
		$game = pg_escape_string($_GET['game']);	
		$console = pg_escape_string($_GET['console']);
		$result = $conn->queryTable("select * from getQuestion('$game','$console');");
	}

	if( !$result ){
                $game = 'General';
		$console = 'General';
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
		if( !$conn->queryTrueFalse( "select answerQuestion('$me',$qid,$ansSelf,'$ansOth',$imp );" )){
			echo "Error posting answer to one of your questions, please contact Benson";
		}
		$i++;
	}
?>

<!DOCTYPE>
<!-- Used Question 4 as example for static info -->
<html>
<head>
	<meta charset="utf-8"> 
    <title>eHarbinger</title>
    <link rel="stylesheet" type="text/css" href="meg.css">
</head>
<body>
<section id = 'banner'>
<section>
	<h2>Profile Information</h2>
	<br>
	</section>
	<div class = 'inner split'>
		<section>
		<!-- Need to be able to change with question numbers -->
			<?php
			if( $game == 'General' && $console == 'General' ){
				echo '<p font = "Arial" font-size = "7" style="color:#ffd9b3;">You are answering general gaming questions</p>';
			} else{
				echo '<p font = "Arial" font-size = "7" style="color:#ffd9b3;">You are answering questions About '.$game.' for '.$console.'</p>';
			}
			echo '<p font = "Arial" font-size = "7"style="color:#ffd9b3;">Please answer honestly for accurate matches</p>';
			?>
			</section>
		<section>
			<p font = "Arial" font-size = "7" style="color:#ffd9b3;"> Choose the response</p>
		</section>
	</div>
</section>

<form>

<?php
	if( $result ){

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
	
			echo "<section class='wrapper'>";
			echo "<div class='inner split'>";

			echo "<section>";
			echo "<h2 style='color:#cc0052;'>Question $i</h2>";
			echo "<h2 style='color:#3333cc;'>$text</h2>";
			echo "<input type='hidden' name='qid$i' value='$id'>";
			echo "</section>";

			echo "<section>";
			if( $ans1 ){ echo "<input type='radio' name='ansSelf$i' value='1' checked>$ans1</input><br/>"; }
			if( $ans2 ){ echo "<input type='radio' name='ansSelf$i' value='2'>$ans2</input><br/>"; }
			if( $ans3 ){ echo "<input type='radio' name='ansSelf$i' value='3'>$ans3</input><br/>"; }
			if( $ans4 ){ echo "<input type='radio' name='ansSelf$i' value='4'>$ans4</input><br/>"; }
			if( $ans5 ){ echo "<input type='radio' name='ansSelf$i' value='5'>$ans5</input><br/>"; }
			echo "</section>";
			echo "</div>";
			
			echo "<div class='inner split'>";
			echo "<section>";
			echo "<h2 style='color:#3333cc;'>What response would you accept from others?</h2>";
			echo "</section>";
			
			echo "<section>";
			if( $ans1 ){ echo "<input type='checkbox' name='ans1Oth$i' value='$ans1'>$ans1</input><br/>"; }
			if( $ans2 ){ echo "<input type='checkbox' name='ans2Oth$i' value='$ans2'>$ans2</input><br/>"; }
			if( $ans3 ){ echo "<input type='checkbox' name='ans3Oth$i' value='$ans3'>$ans3</input><br/>"; }
			if( $ans4 ){ echo "<input type='checkbox' name='ans4Oth$i' value='$ans4'>$ans4</input><br/>"; }
			if( $ans5 ){ echo "<input type='checkbox' name='ans5Oth$i' value='$ans5'>$ans5</input><br/>"; }
			echo "</section>";
			echo "</div>";
			echo "<div class = 'inner split'>
			<section>
			<h2 style='color:#3333cc;'> How important would you rate this in a potential match with the following scale? </h2>
				<p padding-left = '10px;'> 1: Very Important </p>
				<p padding-left = '10px;'> 2: Somewhat Important</p>
				<p padding = '0px;'> 3: Neutral</p>
				<p padding = '0px;'> 4: A little important</p>
				<p padding = '0px;'> 5: Not important</p>
			</section>
			<section>";
			
			echo "<select name='imp$i'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
			echo "</section>";
			echo "</div>";
		
			$i++;
		}
		echo "<br/><input type='submit'>";
		echo "</form>";
		
		?>
		</select>
		</section>
		</form>
		</div>
		
		</section>		


			<?php			
			
			
			
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
		echo "</form>";
	}

?>

<section class = 'wrapper'>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;">Question 1</h2>
		<h2 style="color:#3333cc;">How long have you played multiplayer games?</h2>
	</section>
	<section>
	<!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques1' value = 'oneYear' id = '1'><label for ='1'> About 1 year </label>
		<br>
		<input type = 'radio' name = 'ques1' value = 'coupleYears' id = '2'><label for = '2'> 2 - 4 years </label>
		<br>
		<input type = 'radio' name = 'ques1' value = 'lotAYears' id = '3'><label for = '3'> 5 - 8 years </label>
		<br>
		<input type = 'radio' name = 'ques1' value = 'longTime' id = '4'> <label for = '4'> 9 - 12 </label>
		<br>
		<input type = 'radio' name = 'ques1' value = 'forever' id = '5'> <label for = '5'> More than 12 years </label>
		<br>
		<!-- Need back end of saving answers and go to next html -->
	</section>
</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<!-- Need to load answer choices -->
		<input type = 'checkbox' name = 'ques1' value = 'oneYear' id = '6'><label for ='6'> About 1 year </label>
		<br>
		<input type = 'checkbox' name = 'ques1' value = 'coupleYears' id = '7'><label for = '7'> 2 - 4 years </label>
		<br>
		<input type = 'checkbox' name = 'ques1' value = 'lotAYears' id = '8'><label for = '8'> 5 - 8 years </label>
		<br>
		<input type = 'checkbox' name = 'ques1' value = 'longTime' id = '9'> <label for = '9'> 9 - 12 </label>
		<br>
		<input type = 'checkbox' name = 'ques1' value = 'forever' id = '10'> <label for = '10'> More than 12 years </label>
		<br>
		<!-- Need back end of saving answers and go to next html -->
	</section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</div>
</section>

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 2 </h2>
		<h2 style="color:#3333cc;">What is your age?</h2>
	</section>
	<section>
	<!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques2' value = 'age1' id = '11'><label for ='11'> 13-18 years</label>
		<br>
		<input type = 'radio' name = 'ques2' value = 'age2' id = '12'><label for = '12'> 19-24 years</label>
		<br>
		<input type = 'radio' name = 'ques2' value = 'age3' id = '13'><label for = '13'>  25-30 years</label>
		<br>
		<input type = 'radio' name = 'ques2' value = 'age4' id = '14'> <label for = '14'> 30-40 years </label>
		<br>
		<input type = 'radio' name = 'ques2' value = 'age5' id = '15'> <label for = '15'> Above 40 years </label>
		<br>
		</section>
</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<!-- Need to load answer choices -->
		<input type = 'checkbox' name = 'ques2' value = 'age1' id = '16'><label for ='16'> 13-18 years</label>
		<br>
		<input type = 'checkbox' name = 'ques2' value = 'age2' id = '17'><label for = '17'> 19-24 years</label>
		<br>
		<input type = 'checkbox' name = 'ques2' value = 'age3' id = '18'><label for = '18'> 25-30 years</label>
		<br>
		<input type = 'checkbox' name = 'ques2' value = 'age4' id = '19'> <label for = '19'> 30-40 years </label>
		<br>
		<input type = 'checkbox' name = 'ques2' value = 'age5' id = '20'> <label for = '20'> More than 12 years </label>
		<br>
		<!-- Need back end of saving answers and go to next html -->
	</section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
			</section>
			</form>
			</div>
</section>
					
					
<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 3 </h2>
		<h2 style="color:#3333cc;">How would you rate your competitiveness during a game?</h2>
	</section>
	<section>
	<!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques3' value = 'c1' id = '21'><label for ='21'> Very Competitive</label>
		<br>
		<input type = 'radio' name = 'ques3' value = 'c2' id = '22'><label for = '22'> Moderately competitive</label>
		<br>
		<input type = 'radio' name = 'ques3' value = 'c3' id = '23'><label for = '23'> I play for fun, not to win</label>
		<br>
		<input type = 'radio' name = 'ques3' value = 'c4' id = '24'> <label for = '24'> Not competitive at all</label>
		<br>
		</section>
</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<!-- Need to load answer choices -->
		<input type = 'checkbox' name = 'ques3' value = 'c1' id = '25'><label for ='25'> Very Competitive</label>
		<br>
		<input type = 'checkbox' name = 'ques3' value = 'c2' id = '26'><label for = '26'> Moderately competitive</label>
		<br>
		<input type = 'checkbox' name = 'ques3' value = 'c3' id = '27'><label for = '27'> I play for fun, not to win</label>
		<br>
		<input type = 'checkbox' name = 'ques3' value = 'c4' id = '28'> <label for = '28'> Not competitive at all</label>
		<br>
		
		<!-- Need back end of saving answers and go to next html -->
         </section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance' > 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>		

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 4 </h2>
		<h2 style="color:#3333cc;">When do you usually play games?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques4' value = 'morn' id = '29'><label for ='29'> Morning</label>
		<br>
		<input type = 'radio' name = 'ques4' value = 'day' id = '30'><label for = '30'> Afternoon</label>
		<br>
		<input type = 'radio' name = 'ques4' value = 'eve' id = '31'><label for = '31'> Evening</label>
		<br>
		<input type = 'radio' name = 'ques4' value = 'night' id = '32'> <label for = '32'> Past midnight</label>
		<br>
		<input type = 'radio' name = 'ques4' value = 'nighty' id = '33'> <label for = '33'> Anytime</label>
		<br>
		</section>	
		</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'checkbox' name = 'ques4' value = 'morn' id = '34'><label for ='34'> Morning</label>
		<br>
		<input type = 'checkbox' name = 'ques4' value = 'day' id = '35'><label for = '35'> Afternoon</label>
		<br>
		<input type = 'checkbox' name = 'ques4' value = 'eve' id = '36'><label for = '36'> Evening</label>
		<br>
		<input type = 'checkbox' name = 'ques4' value = 'night' id = '37'> <label for = '37'> Past midnight</label>
		<br>
		<input type = 'checkbox' name = 'ques4' value = 'nighty' id = '38'> <label for = '38'> Anytime</label>
		<br>
		  </section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>		

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 5 </h2>
		<h2 style="color:#3333cc;">Are you a loud gamer?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques5' value = 'yes' id = '39'><label for ='39'> Yes, I like to express myself.</label>
		<br>
		<input type = 'radio' name = 'ques5' value = 'no' id = '40'><label for = '40'> Not really</label>
		<br>
		</section>	
		</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#3333cc;">What response will you accept from others?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques5' value = 'yes' id = '41'><label for ='41'> Yes, I like to express myself.</label>
		<br>
		<input type = 'radio' name = 'ques5' value = 'no' id = '42'><label for = '42'> Not really</label>
		<br>
		</section>	
</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>		

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 6 </h2>
		<h2 style="color:#3333cc;">Share some gaming genres that interest you</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'checkbox' name = 'ques6' value = 'g1' id = '43'><label for ='43'>RPG</label>
		<br>
		<input type = 'checkbox' name = 'ques6' value = 'g2' id = '44'><label for = '44'>MMO</label>
		<br>
		<input type = 'checkbox' name = 'ques6' value = 'g3' id = '45'><label for = '45'>Strategy</label>
		<br>
		<input type = 'checkbox' name = 'ques6' value = 'g4' id = '46'> <label for = '46'>Sports</label>
		<br>
		<input type = 'checkbox' name = 'ques6' value = 'g5' id = '47'> <label for = '47'>Casual</label>
		<br>
		</section>	
	   </div>	
	      
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'checkbox' name = 'ques6' value = 'g1' id = '48'><label for ='48'>RPG</label>
		<br>
		<input type = 'checkbox' name = 'ques6' value = 'g2' id = '49'><label for = '49'>MMO</label>
		<br>
		<input type = 'checkbox' name = 'ques6' value = 'g3' id = '50'><label for = '50'>Strategy</label>
		<br>
		<input type = 'checkbox' name = 'ques6' value = 'g4' id = '51'> <label for = '51'>Sports</label>
		<br>
		<input type = 'checkbox' name = 'ques6' value = 'g5' id = '52'> <label for = '52'>Casual</label>
		<br>
		 </section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>		

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 7 </h2>
		<h2 style="color:#3333cc;">Do you like games heavy on the violence quotient?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques7' value = 'yes' id = '53'><label for ='53'> Yes.</label>
		<br>
		<input type = 'radio' name = 'ques7' value = 'no' id = '54'><label for = '54'> Not really</label>
		<br>
		</section>	
		</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#3333cc;">What response will you accept from others?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques7' value = 'yes' id = '55'><label for ='55'> Yes.</label>
		<br>
		<input type = 'radio' name = 'ques7' value = 'no' id = '56'><label for = '56'> Not really</label>
		<br>
		</section>	
</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>	
		
<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 8 </h2>
		<h2 style="color:#3333cc;">Do you multi task when playing games?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques8' value = 'yes' id = '57'><label for ='57'> Of course, I can handle it.</label>
		<br>
		<input type = 'radio' name = 'ques8' value = 'no' id = '58'><label for = '58'> Nope, I like to focus my attention.</label>
		<br>
		</section>	
		</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#3333cc;">What response will you accept from others?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques8' value = 'yes' id = '59'><label for ='59'> Of course, I can handle it.</label>
		<br>
		<input type = 'radio' name = 'ques8' value = 'no' id = '60'><label for = '60'> Nope, I like to focus my attention.</label>
		<br>
		</section>	
</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 9 </h2>
		<h2 style="color:#3333cc;">How many hours per day are spent in online gaming for you?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques9' value = 'one' id = '61'><label for ='61'>Less than 1 hour</label>
		<br>
		<input type = 'radio' name = 'ques9' value = 'two' id = '62'><label for = '62'>Between 1 and 3 hours</label>
		<br>
		<input type = 'radio' name = 'ques9' value = 'four' id = '63'><label for = '63'>Between 3 and 5 hours</label>
		<br>
		<input type = 'radio' name = 'ques9' value = 'five' id = '64'> <label for = '64'>More than 5 hours</label>
		<br>
		</section>	
		</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'checkbox' name = 'ques9' value = 'one' id = '65'><label for ='65'> Less than 1 hour</label>
		<br>
		<input type = 'checkbox' name = 'ques9' value = 'two' id = '66'><label for = '66'> Between 1 and 3 hours</label>
		<br>
		<input type = 'checkbox' name = 'ques9' value = 'four' id = '67'><label for = '67'>Between 3 and 5 hours</label>
		<br>
		<input type = 'checkbox' name = 'ques9' value = 'five' id = '68'> <label for = '68'>More than 5 hours</label>
		<br>
		</section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>		

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 10 </h2>
		<h2 style="color:#3333cc;"> What is most important in a game for you?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques10' value = 'thrill' id = '69'><label for ='69'> The thrill</label>
		<br>
		<input type = 'radio' name = 'ques10' value = 'win' id = '70'><label for = '70'>The win</label>
		<br>
		<input type = 'radio' name = 'ques10' value = 'team' id = '71'><label for = '71'>The team</label>
		<br>
		<input type = 'radio' name = 'ques10' value = 'adv' id = '72'> <label for = '72'>The story</label>
		<br>
		</section>	
		</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'checkbox' name = 'ques10' value = 'thrill' id = '73'><label for ='73'> The thrill</label>
		<br>
		<input type = 'checkbox' name = 'ques10' value ='win' id = '74'><label for = '74'>The win</label>
		<br>
		<input type = 'checkbox' name = 'ques10' value = 'team' id = '75'><label for = '75'>The team</label>
		<br>
		<input type = 'checkbox' name = 'ques10' value = 'adv' id = '76'> <label for = '76'>The story</label>
		<br>
		</section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>		

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 11 </h2>
		<h2 style="color:#3333cc;"> What do you like better when playing a multiplayer game?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques11' value = 'lnd' id = '77'><label for ='77'> Leading and delegating</label>
		<br>
		<input type = 'radio' name = 'ques11' value = 'lead' id = '78'><label for = '78'>Leading but trying to do all the moves on my own</label>
		<br>
		<input type = 'radio' name = 'ques11' value = 'me' id = '79'><label for = '79'>Doing my own moves regardless of the team goal</label>
		<br>
		</section>	
		</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'radio' name = 'ques11' value = 'lnd' id = '80'><label for ='80'> Leading and delegating</label>
		<br>
		<input type = 'radio' name = 'ques11' value = 'lead' id = '81'><label for = '81'>Leading but trying to do all the moves on my own</label>
		<br>
		<input type = 'radio' name = 'ques11' value = 'me' id = '82'><label for = '82'>Doing my own moves regardless of the team goal</label>
		<br>
		</section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>		

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 12 </h2>
		<h2 style="color:#3333cc;">Would you play a game where you will have to lose game life to let the team win?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques12' value = 'yes' id = '83'><label for ='83'>Yes, team wins! I win.</label>
		<br>
		<input type = 'radio' name = 'ques12' value = 'no' id = '84'><label for = '84'>No. I can’t miss the first hand excitement.</label>
		<br>
		</section>	
		</div>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#3333cc;">What response will you accept from others?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques12' value = 'yes' id = '85'><label for ='85'>Yes, team wins! I win.</label>
		<br>
		<input type = 'radio' name = 'ques12' value = 'no' id = '86'><label for = '86'>No. I can’t miss the first hand excitement.</label>
		<br>
		</section>	
</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 13 </h2>
		<h2 style="color:#3333cc;">What are your preferred systems?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'checkbox' name = 'ques13' value = 'XB' id = '87'><label for ='87'>XBox</label>
		<br>
		<input type = 'checkbox' name = 'ques13' value = 'PS' id = '88'><label for = '88'>PlayStation</label>
		<br>
		<input type = 'checkbox' name = 'ques13' value = 'pc' id = '89'><label for = '89'>PC</label>
		<br>
		<input type = 'checkbox' name = 'ques13' value = 'nin' id = '90'> <label for = '90'>Nintendo/Wii</label>
		<br>
		<input type = 'checkbox' name = 'ques13' value = 'Other' id = '91'> <label for = '91'>Other</label>
		<br>
		</section>	
	   </div>	
	      
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'checkbox' name = 'ques13' value = 'XB' id = '92'><label for ='92'>XBox</label>
		<br>
		<input type = 'checkbox' name = 'ques13' value = 'PS' id = '93'><label for = '93'>PlayStation</label>
		<br>
		<input type = 'checkbox' name = 'ques13' value = 'pc' id = '94'><label for = '94'>PC</label>
		<br>
		<input type = 'checkbox' name = 'ques13' value = 'nin' id = '95'> <label for = '95'>Nintendo/Wii</label>
		<br>
		<input type = 'checkbox' name = 'ques13' value = 'Other' id = '96'> <label for = '96'>Other</label>
		<br>
		 </section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>	

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 14 </h2>
		<h2 style="color:#3333cc;">What location is ideal for playing online games?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques14' value = 'quiet' id = '97'><label for ='97'>Quiet rooms</label>
		<br>
		<input type = 'radio' name = 'ques14' value = 'loud' id = '98'><label for = '98'>Loud places</label>
		<br>
		<input type = 'radio' name = 'ques14' value = 'any' id = '99'><label for = '99'>Anywhere!</label>
		<br>
		</section>	
	   </div>	
	      
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'radio' name = 'ques14' value = 'quiet' id = '100'><label for ='100'>Quiet rooms</label>
		<br>
		<input type = 'checkbox' name = 'ques14' value = 'loud' id = '101'><label for = '101'>Loud places</label>
		<br>
		<input type = 'checkbox' name = 'ques14' value = 'any' id = '102'><label for = '102'>Anywhere!</label>
		<br>
		 </section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>	

</section>	

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 15</h2>
		<h2 style="color:#3333cc;"> How many new games (apart from the ones you play often) have you tried in the past year?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques15' value = 'none' id = '103'><label for ='103'>No new games</label>
		<br>
		<input type = 'radio' name = 'ques15' value = 'some' id = '104'><label for = '104'>1 to 5</label>
		<br>
		<input type = 'radio' name = 'ques15' value = 'more' id = '105'><label for = '105'>6 to 10</label>
		<br>
		<input type = 'radio' name = 'ques15' value = 'aLot' id = '106'><label for = '106'>More than 10</label>
		<br>
		</section>	
	   </div>	
	      
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'radio' name = 'ques15' value = 'none' id = '107'><label for ='107'>No new games</label>
		<br>
		<input type = 'radio' name = 'ques15' value = 'some' id = '108'><label for = '108'>1 to 5</label>
		<br>
		<input type = 'radio' name = 'ques15' value = 'more' id = '109'><label for = '109'>6 to 10</label>
		<br>
		<input type = 'radio' name = 'ques15' value = 'aLot' id = '110'><label for = '110'>More than 10</label>
		<br>
		 </section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>	

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 16</h2>
		<h2 style="color:#3333cc;"> What is your preferred language?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques16' value = 'en' id = '111'><label for ='111'>English</label>
		<br>
		<input type = 'radio' name = 'ques16' value = 'chi' id = '112'><label for = '112'>Mandarin</label>
		<br>
		<input type = 'radio' name = 'ques16' value = 'span' id = '113'><label for = '113'>Spanish</label>
		<br>
		<input type = 'radio' name = 'ques16' value = 'tag' id = '114'><label for = '114'> Tagalog</label>
		<br>
		<input type = 'radio' name = 'ques16' value = 'tag' id = '115'><label for = '115'> Other<input type='text' name='comment' placeholder='Enter language here!'></label>
		<br>
		</section>	
	   </div>	
	      
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'checkbox' name = 'ques16' value = 'en' id = '116'><label for ='116'>English</label>
		<br>
		<input type = 'checkbox' name = 'ques16' value = 'chi' id = '117'><label for = '117'>Mandarin</label>
		<br>
		<input type = 'checkbox' name = 'ques16' value = 'span' id = '118'><label for = '118'>Spanish</label>
		<br>
		<input type = 'checkbox' name = 'ques16' value = 'tag' id = '119'><label for = '119'> Tagalog</label>
		<br>
		<input type = 'checkbox' name = 'ques16' value = 'other' id = '120'><label for = '120'> Other <input type='text' name='comment' placeholder='Enter language here!'></label>
		<br>
		 </section>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>				

<section class = 'wrapper'>
<form>
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
	<h2 style="color:#cc0052;"> Question 17</h2>
		<h2 style="color:#3333cc;"> What region are you from?</h2>
	</section>
	<section>
	 <!-- Need to load answer choices -->
		<input type = 'radio' name = 'ques17' value = 'na' id = '121'><label for ='121'>North America</label>
		<br>
		<input type = 'radio' name = 'ques17' value = 'sa' id = '122'><label for = '122'>South America</label>
		<br>
		<input type = 'radio' name = 'ques17' value = 'asia' id = '123'><label for = '123'>Asia</label>
		<br>
		<input type = 'radio' name = 'ques17' value = 'eur' id = '124'><label for = '124'> Europe</label>
		<br>
		<input type = 'radio' name = 'ques17' value = 'other' id = '125'><label for = '125'> Other <input type='text' name='comment' placeholder='Enter region here!'></label>
		<br>
		</section>	
	   </div>	
	      
<div class = 'inner split'>
	<section>
	<!-- Need to load questions -->
		<h2 style="color:#3333cc;">What response would you accept from others?</h2>
	</section>
	<section>
	<input type = 'checkbox' name = 'ques17' value = 'na' id = '126'><label for ='126'>North America</label>
		<br>
		<input type = 'checkbox' name = 'ques17' value = 'sa' id = '127'><label for = '127'>South America</label>
		<br>
		<input type = 'checkbox' name = 'ques17' value = 'asia' id = '128'><label for = '128'>Asia</label>
		<br>
		<input type = 'checkbox' name = 'ques17' value = 'eur' id = '129'><label for = '129'> Europe</label>
		<br>
		<input type = 'checkbox' name = 'ques17' value = 'other' id = '130'><label for = '130'> Other <input type='text' name='comment' placeholder='Enter region here!'></label>
		<br>
	</div>
		<div class = 'inner split'>
		<section>
		<h2 style="color:#3333cc;"> How important would you rate this in a potential match with the following scale? </h2>
		<p padding-left = "10px;"> 1: Very Important </p>
		<p padding-left = "10px;"> 2: Somewhat Important</p>
		<p padding = "0px;"> 3: Neutral</p>
		<p padding = "0px;"> 4: Not important</p>
				</section>
		<section>
		<select>
			<option value = '1' name = 'importance'> 1 </option>
			<option value = '2' name = 'importance'> 2 </option>
			<option value = '3' name = 'importance'> 3 </option>
			<option value = '4' name = 'importance'> 4 </option>
					</select>
		</section>
		</form>
		</div>
</section>		

<!-- Back end to create new profile and algorithm -->
		<input type = 'submit' style="font-face: 'Comic Sans MS'; margin-left: 45%; font-size: larger; color: teal; background-color: #FFFFC0; border: 3pt ridge lightgrey" value = 'Finish!'>  
		</form>
		</div>
</section>				

<script type='text/javascript'>
function toggle(id){
	var e = document.getElementById(id);
	if( e.style.display == 'block' )
		e.style.display = 'none';
	else
		e.style.display = 'block';
}
</script>

</body>
</html>
