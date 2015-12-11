<?php
	include_once("session.php");
	include_once("classes.php");
	session_start();

	// Get this from $_SESSION
	$me = $_SESSION["user"]->getName();


	// get this from $_GET
	$you = '';

	if( isset($_GET["user"]) && trim($_GET["user"]) ){
		$you = pg_escape_string($_GET["user"]);
		if( !$_SESSION["user"]->query("select userExists('$you');", "boolean") ){
			header("Location: messages.php");
		}
	}
	else{
		header("Location: messages.php");
	}


	if( isset($_POST['message']) && trim($_POST['message']) ){
		$msg = pg_escape_string($_POST['message']);
		$result = $_SESSION["user"]->query("select messageUser('$me','$you','$msg');", "boolean");
		if( !$result ){
			echo "An error occured!";
		}
		else{
			header("Refresh:0");
		}
	}

?>

<html>
<head>
	<meta charset="utf-8"> 
    <title>eHarbinger</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<section id = 'banner'>
<div class = 'inner split'>
	<section>
		<h2> Messages for You! </h2>
	</section>
	<section>
		<p> Talk to other players here :) </p>
	</section>
</div>
</section>
<div class = 'wrapper>
<?php
	echo "<div style='height: 75%; float: right; display: inline-block;'>";
	echo "<div id='chat' style='height: 100%; overflow-y: scroll;'>";
	echo "<table>";
	$result = $_SESSION["user"]->query("select * from getMessages('$me','$you');", "table");
	foreach( $result as $row ){
		if( $row['username1'] == $me ){
			echo "<tr bgcolor='#CCCCFF'>";
		}
		else{
			echo "<tr bgcolor='#EEEEEE'>";
		}
		$date = date_create_from_format('Y-m-d H:i:s.u',$row['messagetimestamp']);
		$dateFmt = date_format($date,'M d, Y \a\t h:i:sa');
		echo "<td>".$dateFmt."<td>";
		echo "<td>".$row['username1']."</td>";
		echo "<td>".$row['message']."</td>";
		echo "</tr>\n";
	}
	echo "</table>";
	echo "<script>var objDiv = document.getElementById('chat'); objDiv.scrollTop = objDiv.scrollHeight;</script>";
	echo "</div>";
	echo "<form method='post' action=''>";
	echo "<input right;' type='text' name='message' autofocus='autofocus' placeholder='Type a message...' autocomplete='off'>";
	echo "<input type='submit'>";
	echo "</div>";
?>
</div>
</body>
</html>
