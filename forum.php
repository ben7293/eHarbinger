<?php
	include_once('classes.php');
	$conn = new Database();
	$me = "brian";
	$forumid=0;
	if( isset($_GET['id']) && trim($_GET['id']) ){
		$forumid = pg_escape_string($_GET['id']);
		if( $conn->queryTrueFalse("select forumExists($forumid);" )){
			if( isset($_POST['comment']) && trim($_POST['comment']) ){
				$comment = pg_escape_string($_POST['comment']);
				if( $conn->queryTrueFalse("select insertComment($forumid,'$me','$comment');") ){
					header("refresh: 0");
				}
				else{
					echo "Comment failed to post!";
				}
			}
		}
		else{
			header('location: forum.php');
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
<!--        <link rel="stylesheet" type="text/css" href="style.css">-->
        <script type="text/javascript" src = "design.js"></script>
		<style>
		table td{
			border:1px solid #121212;
		}
</style>
	</head>
	<body>
		<div onload = "getPosts()" style='background-color: #CCCCCC;'>
			<?php
				$forum = $conn->queryArray("select * from getForum($forumid);");
				$fDate = date_create_from_format('Y-m-d H:i:s.u', $forum['forumtimestamp']);
				$fDateFmt = date_format($fDate,'M d, Y \a\t h:i:sa');
				echo "<h2>".$forum['forumsubj']."</h2>";
				echo "<a href='profile.php?user=".$forum['username']."'>".$forum['username']."</a> - ".$fDateFmt;
				echo "<p>".$forum['forumbody']."</p>";
				$comments = $conn->queryTable("select * from getComments($forumid);");
				echo "<table bgcolor=#EEEEEE style='border-style: solid;'>";
				foreach( $comments as $comment ){
					$cDate = date_create_from_format('Y-m-d H:i:s.u',$comment['commenttimestamp']);
					$cDateFmt = date_format($cDate, 'M d, Y \a\t h:i:sa');
					echo "<tr><td>".$cDateFmt." - ".$comment['username']."</td><td>".$comment['commentbody']."</td></tr>";
				}
				echo "</table>";
				echo "<br />";

				echo "<form method='post' action='forum.php?id=$forumid'>";

				echo "<input type='text' name='comment' autofocus='autofocus' placeholder='Enter a comment here!'>";
				echo "<input type='submit' value='Comment!'>";
			?>
			
		</div>
	</body>
</html>
