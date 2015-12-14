<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include_once("session.php");
	include_once("classes.php");
	session_start();

	$me = $_SESSION["user"]->getName();
	$forumid=0;
	if( isset($_GET['id']) && trim($_GET['id']) && $_GET['id'] != 'new' ){
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
	
	if( isset($_POST['forumsubj']) && trim($_POST['forumsubj']) && isset($_POST['forumbody']) && trim($_POST['forumbody']) ){
		$forumsubj = pg_escape_string($_POST['forumsubj']);
		$forumbody = pg_escape_string($_POST['forumbody']);
		if( !$_SESSION['user']->query("select insertForum('$me','$forumsubj','$forumbody');","table") ){
			echo "Forum failed to post!";
		} else{
			header('Location: forum.php');
		}
	}
	$result = $_SESSION["user"]->query("select * from getrecentforums(10);", "table");

	
?>
<head>
<title>eHarbinger</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie6-style.css" type="text/css" media="all" /><![endif]-->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/fns.js" type="text/javascript"></script>
</head>
<body>
<!-- Page -->
<div id="page" class="shell">
  <!-- Header -->
  <div id="header">
    <!-- Top Navigation -->
    <div id="top-nav">
      <ul>
        <li class="home"><a href = "popular.html">Now Trending</a></li>
       <!-- <li><a href= achievements.html>Top Achievements</a></li>
        <li><a href= messages.php>My Messages</a></li>-->
		
      </ul>
    </div>
    <!-- / Top Navigation -->
    <div class="cl">&nbsp;</div>
    <!-- Logo -->
    <div id="logo">
      <h1><span>eHarbinger</span></h1>
      <p class="description">Connect with other gamers</p>
    </div>
    <!-- / Logo -->
    <!-- Main Navigation -->
    <div id="main-nav">
      <div class="bg-right">
        
      </div>
    </div>
    <!-- / Main Navigation -->
    <div class="cl">&nbsp;</div>
    <!-- Sort Navigation -->
    <div id="sort-nav">
      <div class="bg-right">
        <div class="bg-left">
          <div class="cl">&nbsp;</div>
          <ul>
           <!-- <li class="first active first-active"><a href= achievements.html>See Achievements</a><span class="sep">&nbsp;</span></li>-->
			<li><a href="achievement.html"> See Achievements </a><span class="sep">&nbsp;</span></li>
            <li><a href="players.php"> Find Matches </a><span class="sep">&nbsp;</span></li>
            <li><a href="messages.php"> My Messages</a><span class="sep">&nbsp;</span></li>
            <li><a href= "contactUs.php">Contact Us</a><span class="sep">&nbsp;</span></li>
             </ul>
          <div class="cl">&nbsp;</div>
        </div>
      </div>
    </div>
    <!-- / Sort Navigation -->
  </div>
  <!-- / Header -->
  <!-- Main -->
  <div id="main">
    <div id="main-bot">
      <div class="cl">&nbsp;</div>
      <!-- Content -->
      <div id="content">
        <div class="block">
          <div class="block-bot">
            <div class="block-cnt">
				<?php
					if( !isset($_GET['id']) ){
						echo "<h1>See these recent forum posts</h1>";
						foreach($result as $row){
							$forumid = $row['forumid'];
							$forumSubj = $row["forumsubj"];
							$user = $row['username'];
							$date = date_create_from_format('Y-m-d H:i:s.u',$row['forumtimestamp']);
							$dateFmt = date_format($date,'M d, Y \a\t h:i:sa');
							echo "<h3><a href='forum.php?id=$forumid'>$forumSubj</a> posted by <a href='profile.php?user=$user'>$user</a> at $dateFmt <br/><br/></h3>";
						}
						echo "<h3>Or <a href='forum.php?id=new'>Post something new!</a></h3>";
					}
					elseif( $_GET['id'] != 'new' ){
						$forum = $_SESSION["user"]->query("select * from getForum($forumid);", "array");
						$fDate = date_create_from_format('Y-m-d H:i:s.u', $forum['forumtimestamp']);
						$fDateFmt = date_format($fDate,'M d, Y \a\t h:i:sa');
						echo "<div style='color: black; font-size: 150%; background-color: #888888;'>";
						echo "<h1>".$forum['forumsubj']."</h1>";
						echo "<a style='color: black;' href='profile.php?user=".$forum['username']."'>".$forum['username']."</a> - ".$fDateFmt;
						echo "<p style='font-size: 125%;'>".$forum['forumbody']."</p>";
						$comments = $_SESSION["user"]->query("select * from getComments($forumid);", "table");
						echo "<table bgcolor=#EEEEEE style='border-style: solid;'>";
						foreach( $comments as $comment ){
							$cDate = date_create_from_format('Y-m-d H:i:s.u',$comment['commenttimestamp']);
							$cDateFmt = date_format($cDate, 'M d, Y \a\t h:i:sa');
							echo "<tr><td>".$comment['username']."@".$cDateFmt."</td><td>  -  ".$comment['commentbody']."</td></tr>";
						}
						echo "</table>";
						echo "<br />";

						echo "<form method='post'>";

						echo "<input type='text' name='comment' autofocus='autofocus' placeholder='Enter a comment here!'><br/>";
						echo "<input type='submit' value='Comment!'>";
						echo "</div>";

                                                echo "<br/><br/><br/>";
						echo "<h1>See these other recent forum posts</h1>";
                                                foreach($result as $row){
                                                        $forumid = $row['forumid'];
                                                        $forumSubj = $row["forumsubj"];
                                                        $user = $row['username'];
                                                        $date = date_create_from_format('Y-m-d H:i:s.u',$row['forumtimestamp']);
                                                        $dateFmt = date_format($date,'M d, Y \a\t h:i:sa');
							if( $forumid != $_GET['id']) {
	                                                        echo "<h3><a href='forum.php?id=$forumid'>$forumSubj</a> posted by <a href='profile.php?user=$user'>$user</a> at $dateFmt <br/><br/></h3>";
							}       
                                         	}
						echo "<h3>Or <a href='forum.php?id=new'>Post something new!</a></h3>";

					}
					else{
						echo "<h1>Post a new forum entry here!</h1><br/>";
						echo "<form method='post'>";
						echo "<h3>Subject</h3>";
						echo "<input type='text' name='forumsubj' autofocus='autofocus' placeholder='Type the subject of your entry' style='width: 100%; height: 40px;'><br/><br/>";
						echo "<h3>Body</h3>";
						echo "<textarea name='forumbody' placeholder='Type the body of your entry' style='width: 100%; height: 100px;'></textarea><br/>";
						echo "<input type='submit' value='Submit'>";
						echo "</form>";
					}
				?>
			</div>
        </div>
      </div>
      <div class="block">
        <div class="block-bot">
          <div class="head">
            <div class="head-cnt"> <a href="suggested.html" class="view-all">Our picks</a>
              <h3>Top Reviews</h3>
              <div class="cl">&nbsp;</div>
            </div>
          </div>
          <div class="col-articles articles">
            <div class="cl">&nbsp;</div>
            <div class="article">
              <div class="image"><img src="images/img4.jpg" alt="" /></div>
              <h4>League of Legends</h4>
              <p class="console"><strong></strong></p>
            </div>
			
            <div class="article">
              <div class="image"><img src="images/img5.jpg" alt="" /></div>
              <h4>Super Mario</h4>
              <p class="console"><strong>Nintendo</strong></p>
            </div>
            <div class="article">
              <div class="image"><img src="images/img6.jpg" alt="" /></div>
              <h4>STARCRAFT II</h4>
              <p class="console"><strong>PC</strong></p>
            </div>
            <div class="cl">&nbsp;</div>
          </div>
        </div>
      </div>
      <div class="block">
        <div class="block-bot">
          <div class="head">
            <div class="head-cnt"> <a href="suggested.html" class="view-all">Trending</a>
              <h3>Top Rated Gamer's Pick</h3>
              <div class="cl">&nbsp;</div>
            </div>
          </div>
          <div class="row-articles articles">
            <div class="cl">&nbsp;</div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"><img src="images/img7.jpg" alt="" /></div>
              <div class="cnt">
                <h4>Dota 2</h4>
                <p> The top rated gamer, Syed suggested Dota 2 for the top game this week and says "You can spend 1000 hours in it but you'll be nowhere close to saying you've mastered it. You as a player progressively improve. There's always something new to learn.</p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"><img src="images/img8.jpg" alt="" /></div>
              <div class="cnt">
                <h4>Battlefield 3</h4>
                <p>Gamer Vincent says "From the awesome jet fly by’s to walls falling and getting quads to knifing a sniper right before he snags one of your team mates. Battlefield 3, regardless of which side of its fence you sit on, is fun. Battlefield has the scale of a real war. The largest CoD map is maybe the same size as the smallest BF map.
Battlefield has vehicles. CoD killstreaks are vehicles too, but don't give complete control, can't be upgraded, only have one seat, and are not supplied at the beginning of the game."</p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article last-article">
              <div class="cl">&nbsp;</div>
              <div class="image"><img src="images/img4.jpg" alt="" /></div>
              <div class="cnt">
                <h4>League of Legends</h4>
                <p> Top matched gamer Brian says that he enjoys League as no other game. The champions are designed well and there is so much variety to look forward to. And the skins in the game!</p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="cl">&nbsp;</div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <!--  -->
    <div id="sidebar">
      <!-- Search -->
      
      <!-- / Search -->
      <!-- Sign In -->
      <div id="sign" class="block">
        <div class="block-bot">
          <div class="block-cnt">
            <div class="cl">&nbsp;</div>
            
            <center>
			<form action="userauth.php" method="post">
				<button type="submit"> Log Out </button>
				<input type="hidden" name="type" value="logout">
			</form>
			</center>
            <div class="cl">&nbsp;</div>
            
          </div>
        </div>
      </div>
      <!-- / Sign In -->
      <div class="block">
        <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3> What's New</h3>
            </div>
          </div>
          <div class="image-articles articles">
            <div class="cl">&nbsp;</div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"><img src="images/im1.jpg" alt="" /></div>
              <div class="cnt">
                <h4>Bloodborne</h4>
                <p>Bloodborne follows the player character, the Hunter, through the fictional decrepit Gothic city of Yharnam.</p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"><img src="images/im2.jpg" alt="" /></div>
              <div class="cnt">
                <h4>Mortal Kombat X </a></h4>
                <p>Like previous Mortal Kombat games, Mortal Kombat X‍ '​s gameplay consists of two players, or one player and the CPU using character specific attacks</p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"><img src= "images/im3.jpg" alt="" /></div>
              <div class="cnt">
                <h4>H1Z1</h4>
                <p>A zombie survival MMO set in a post-apocalyptic sandbox world where thousands of players must align with friends in order to survive the worldwide infection.</p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="cl">&nbsp;</div>
            
            <div class="cl">&nbsp;</div>
          </div>
        </div>
      </div>
      <div class="block">
        <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Shared Links</h3>
            </div>
          </div>
          <div class="image-articles articles">
            <div class="cl">&nbsp;</div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="https://www.youtube.com/watch?v=CriFmT_OFLE"><img src="images/im4.jpg" alt="" /></a> </div>
              <div class="cnt">
                <h4>Graphics</h4>
                <p>Check out how graphics factors in the wholesome gaming experience.</p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="https://www.youtube.com/watch?v=gM8-HNnxJtk"><img src="images/im5.jpg" alt="" /></a> </div>
              <div class="cnt">
                <h4>PC Multiplayer Games</h4>
                <p>Some of the most popular video games for your PC are featured. Farcry 2 to Rise of Nations...</p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="https://www.youtube.com/watch?v=jXU5k4U8x20"><img src="images/im6.jpg" alt="" /></a> </div>
              <div class="cnt">
                <h4>Star Wars Battlefront</h4>
                <p>Such a thrill where you can battle in epic 40 multiplayer battles reminiscent of The Battle of Hoth. </p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="cl">&nbsp;</div>
            
            <div class="cl">&nbsp;</div>
          </div>
        </div>
      </div>
      
    </div>
    <!-- / Sidebar -->
    <div class="cl">&nbsp;</div>
    <!-- Footer -->
    <div id="footer">
      <div class="navs">
        <div class="navs-bot">
          <div class="cl">&nbsp;</div>
          <ul>
            
          </ul>
          <ul>

          </ul>
          <div class="cl">&nbsp;</div>
        </div>
      </div>
      
    </div>
    <!-- / Footer -->
  </div>
</div>
<!-- / Main -->
</div>
<!-- / Page -->
<div align=center>Feel free to post</div></body>
</html>
