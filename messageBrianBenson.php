<?php
	require_once('classes.php');
	$conn = new Database();

	// Get this from $_SESSION
	$me = pg_escape_string($_GET['me']);

	// get this from $_GET
	$you = '';
	if( isset($_GET['user']) && trim($_GET['user']) ){
		$you = pg_escape_string($_GET['user']);
		if( !$conn->queryTrueFalse("select userExists('$you');") ){
			header("Location: messages.php");
		}
	}
	else{
		header("Location: messages.php");
	}

	if( isset($_POST['message']) && trim($_POST['message']) ){
		$msg = pg_escape_string($_POST['message']);
		$result = $conn->queryTrueFalse("select messageUser('$me','$you','$msg');");
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
</head>
<body>
<?php
	echo "<div style='height: 75%; float: right; display: inline-block;'>";
	echo "<div id='chat' style='height: 100%; overflow-y: scroll;'>";
	echo "<table>";
	$result = $conn->queryTable("select * from getMessages('$me','$you');");
	foreach( $result as $row ){
		echo "<tr>";
		$date = date_create_from_format('Y-m-d H:i:s.u',$row['messagetimestamp']);
		$dateFmt = date_format($date,'M d, Y \a\t h:i:sa');
		echo "<td>".$dateFmt."<td>";
		echo "<td>".$row['username1']."</td>";
		echo "<td>".$row['message']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<script>var objDiv = document.getElementById('chat'); objDiv.scrollTop = objDiv.scrollHeight;</script>";
	echo "</div>";
	echo "<form method='post' action=''>";
	echo "<input right;' type='text' name='message' autofocus='autofocus' placeholder='Type a message...'>";
	echo "<input type='submit'>";
	echo "</div>";
?>
</body>
</html>
