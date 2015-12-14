<?php
                        include_once("session.php");
                        include_once("classes.php");
                        session_start();

                        // Get this from $_SESSION
                        $me = $_SESSION["user"]->getName();
                        if( !$_SESSION['user']->isLoggedIn() ){
                                header('location: index.php');
                        }

                        $conn = new Database();
                        $result = $conn->queryTable("select * from getGames('$me');");

                        if( isset ($_POST['games'] ) ){
                                foreach( $_POST['games'] as $game )
                                {
                                        $split = split('#', $game);
                                        $game = pg_escape_string($split[0]);
                                        $console = pg_escape_string($split[1]);
                                        if( !$conn->queryTrueFalse("select likeGame('$me','$game','$console');") ){
                                                die('Please contact benson');
                                        } else{
                                                header('Location: question.php');
                                        }
                                }
                        }


?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
        <link rel="stylesheet" type="text/css" href="css/meg.css">
	<script type='text/javascript' src='//code.jquery.com/jquery-1.7.1.js'></script>
	<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
var $rows = $('#table tr');
$('#search').keyup(function() {
    
    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
        reg = RegExp(val, 'i'),
        text;
    
    $rows.show().filter(function() {
        text = $(this).text().replace(/\s+/g, ' ');
        return !reg.test(text);
    }).hide();
});
});//]]> 

</script>
	</head>
	<body>
	<section id = 'banner'>
			<div class = 'inner split'>
			<form action="userauth.php" method="post">
        		<button> Log Out </button>
        		<input type="hidden" name="type" value="logout">
        		</form>

			<section>
				<h2> Pick Any Games </h2>
			</section>
			<section>
				<p> In order to match you with other players, click on each game you love to play.</p>
			</section>
		</div>
	</section>
	<section class = 'wrapper'>
		<form method='post'>
		<?php
/*		        include_once("session.php");
		        include_once("classes.php");
		        session_start();

		        // Get this from $_SESSION
		        $me = $_SESSION["user"]->getName();
		        if( !$_SESSION['user']->isLoggedIn() ){
	        	        header('location: index.php');
        		}

			$conn = new Database();
			$result = $conn->queryTable("select * from getGames('$me');");

			if( isset ($_POST['games'] ) ){
				foreach( $_POST['games'] as $game )
				{
					$split = split('#', $game);
					$game = pg_escape_string($split[0]);
					$console = pg_escape_string($split[1]);
					if( !$conn->queryTrueFalse("select likeGame('$me','$game','$console');") ){
						die('Please contact benson');
					} else{
						header('refresh: 0');
					}
				}
			}
*/
			$i=1;
			echo "<input type='text' id='search' placeholder='Type to search' autofocus='autofocus' autocomplete='off'>";
			echo "<table id='table'>";
			foreach( $result as $row ){
				$gameName=$row['gamename'];
				$gameConsole=$row['gameconsole'];
				echo "<tr><td><input type='checkbox' name='games[]' value='$gameName#$gameConsole' id='$i'><label for='$i'><font color='black'>$gameName</font> ON <font color='black'>$gameConsole</font></label><br/></td></tr>\n";
				$i++;
			}
			echo "</table>";
		?>
			<input type='submit' value='Submit'>	
		</form>
	</section>
	</body>
<footer><?php include('footer.html');?></footer>
</html>
