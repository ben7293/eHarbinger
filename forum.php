<?php
	include_once("session.php");
	include_once("classes.php");
	session_start();

	$me = $_SESSION["user"]->getName();
	$forumid=0;
	if( isset($_GET['id']) && trim($_GET['id']) ){
		$forumid = pg_escape_string($_GET['id']);
		if( $_SESSION["user"]->query("select forumExists($forumid);", "boolean" )){
			if( isset($_POST['comment']) && trim($_POST['comment']) ){
				$comment = pg_escape_string($_POST['comment']);
				if( $_SESSION["user"]->query("select insertComment($forumid,'$me','$comment');", "boolean") ){
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
	else{
			$result = $_SESSION["user"]->query("select * from getrecentforums(10);", "table");

	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
        <link rel="stylesheet" type="text/css" href="style.css">
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
				if( !isset($_GET['id']) ){
					foreach($result as $row){
						$forumid = $row['forumid'];
						$forumSubj = $row["forumsubj"];
						$user = $row['username'];
						$date = date_create_from_format('Y-m-d H:i:s.u',$row['forumtimestamp']);
						$dateFmt = date_format($date,'M d, Y \a\t h:i:sa');
						echo "<a href='forum.php?id=$forumid'>$forumSubj</a> posted by <a href='profile.php?user=$user'>$user</a> at $dateFmt";
					}
				}
				else{
					include_once("header.php");
					$forum = $_SESSION["user"]->query("select * from getForum($forumid);", "array");
					$fDate = date_create_from_format('Y-m-d H:i:s.u', $forum['forumtimestamp']);
					$fDateFmt = date_format($fDate,'M d, Y \a\t h:i:sa');
					echo "<h2>".$forum['forumsubj']."</h2>";
					echo "<a href='profile.php?user=".$forum['username']."'>".$forum['username']."</a> - ".$fDateFmt;
					echo "<p>".$forum['forumbody']."</p>";
					$comments = $_SESSION["user"]->query("select * from getComments($forumid);", "table");
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
				}
			?>
			
		</div>
	</body>
</html>
