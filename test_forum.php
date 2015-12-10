<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
        <li class="home"><a href = profile.html>Profile</a></li>
       <!-- <li><a href= achievements.html>Top Achievements</a></li>
        <li><a href= messages.php>My Messages</a></li>-->
		
      </ul>
    </div>
    <!-- / Top Navigation -->
    <div class="cl">&nbsp;</div>
    <!-- Logo -->
    <div id="logo">
      <h1><a href="http://all-free-download.com/free-website-templates/">e<span>Harbinger</span></a></h1>
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
			<li><a href="achievements.html"> See Achievements </a><span class="sep">&nbsp;</span></li>
            <li><a href="achievements.html"> Find Matches </a><span class="sep">&nbsp;</span></li>
            <li><a href="messages.html"> My Messages</a><span class="sep">&nbsp;</span></li>
            <li><a href= contactUs.html>Contact Us</a><span class="sep">&nbsp;</span></li>
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
        </div>
      </div>
      <div class="block">
        <div class="block-bot">
          <div class="head">
            <div class="head-cnt"> <a href="http://all-free-download.com/free-website-templates/" class="view-all">view all</a>
              <h3>Top Reviews</h3>
              <div class="cl">&nbsp;</div>
            </div>
          </div>
          <div class="col-articles articles">
            <div class="cl">&nbsp;</div>
            <div class="article">
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img4.jpg" alt="" /></a> </div>
              <h4><a href="http://all-free-download.com/free-website-templates/">F.E.A.R.2</a></h4>
              <p class="console"><strong>PSP3</strong></p>
            </div>
            <div class="article">
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img5.jpg" alt="" /></a> </div>
              <h4><a href="http://all-free-download.com/free-website-templates/">FALLOUT 3</a></h4>
              <p class="console"><strong>PC</strong></p>
            </div>
            <div class="article">
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img6.jpg" alt="" /></a> </div>
              <h4><a href="http://all-free-download.com/free-website-templates/">STARCRAF II</a></h4>
              <p class="console"><strong>PC</strong></p>
            </div>
            <div class="cl">&nbsp;</div>
          </div>
        </div>
      </div>
      <div class="block">
        <div class="block-bot">
          <div class="head">
            <div class="head-cnt"> <a href="http://all-free-download.com/free-website-templates/" class="view-all">view all</a>
              <h3>Editor`s Pick</h3>
              <div class="cl">&nbsp;</div>
            </div>
          </div>
          <div class="row-articles articles">
            <div class="cl">&nbsp;</div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img7.jpg" alt="" /></a> </div>
              <div class="cnt">
                <h4><a href="http://all-free-download.com/free-website-templates/">F.E.A.R.2</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum molestie urna, id scelerisque leo sodales sit amet. Curabitur volutpat lorem euismod nunc tincidunt condimentum. Suspendisse gravida elementum mauris, in vulputate justo ultrices sit amet. Maecenas ultricies elit </p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img8.jpg" alt="" /></a> </div>
              <div class="cnt">
                <h4><a href="http://all-free-download.com/free-website-templates/">FALLOUT 3</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum molestie urna, id scelerisque leo sodales sit amet. Curabitur volutpat lorem euismod nunc tincidunt condimentum. Suspendisse gravida elementum mauris, in vulputate justo ultrices sit amet. Maecenas ultricies elit in mi sagittis fringilla.</p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article last-article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img9.jpg" alt="" /></a> </div>
              <div class="cnt">
                <h4><a href="http://all-free-download.com/free-website-templates/">STARCRAF II</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum molestie urna, id scelerisque leo sodales sit amet. Curabitur volutpat lorem euismod nunc tincidunt condimentum. Suspendisse gravida elementum mauris, in vulputate justo ultrices sit amet. Maecenas ultricies elit in mi sagittis fringilla.</p>
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
            <a href="http://all-free-download.com/free-website-templates/" class="button button-left">sign in</a> <a href="http://all-free-download.com/free-website-templates/" class="button button-right">create account</a>
            <div class="cl">&nbsp;</div>
            
          </div>
        </div>
      </div>
      <!-- / Sign In -->
      <div class="block">
        <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Top Games</h3>
            </div>
          </div>
          <div class="image-articles articles">
            <div class="cl">&nbsp;</div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img1.gif" alt="" /></a> </div>
              <div class="cnt">
                <h4><a href="http://all-free-download.com/free-website-templates/">TMNT</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum molestie </p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img2.gif" alt="" /></a> </div>
              <div class="cnt">
                <h4><a href="http://all-free-download.com/free-website-templates/">F.E.A.R.2</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum molestie </p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img3.gif" alt="" /></a> </div>
              <div class="cnt">
                <h4><a href="http://all-free-download.com/free-website-templates/">Steel Fury</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum molestie </p>
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
              <h3>Top Videos</h3>
            </div>
          </div>
          <div class="image-articles articles">
            <div class="cl">&nbsp;</div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img1.gif" alt="" /></a> </div>
              <div class="cnt">
                <h4><a href="http://all-free-download.com/free-website-templates/">FALLOUT3</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum molestie </p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img2.gif" alt="" /></a> </div>
              <div class="cnt">
                <h4><a href="http://all-free-download.com/free-website-templates/">Crysis</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum molestie </p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="http://all-free-download.com/free-website-templates/"><img src="css/images/img3.gif" alt="" /></a> </div>
              <div class="cnt">
                <h4><a href="http://all-free-download.com/free-website-templates/">F.E.A.R.2</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum molestie </p>
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
            <li><a href="http://all-free-download.com/free-website-templates/">pc</a></li>
            <li><a href="http://all-free-download.com/free-website-templates/">xbox</a></li>
            <li><a href="http://all-free-download.com/free-website-templates/">360</a></li>
            <li><a href="http://all-free-download.com/free-website-templates/">wii</a></li>
            <li><a href="http://all-free-download.com/free-website-templates/">ps3</a></li>
            <li><a href="http://all-free-download.com/free-website-templates/">ps2</a></li>
            <li><a href="http://all-free-download.com/free-website-templates/">psp</a></li>
            <li><a href="http://all-free-download.com/free-website-templates/">ds</a></li>
          </ul>
          <div class="cl">&nbsp;</div>
        </div>
      </div>
      <p class="copy">&copy; Sitename.com. Design by <a href="http://chocotemplates.com">ChocoTemplates.com</a></p>
    </div>
    <!-- / Footer -->
  </div>
</div>
<!-- / Main -->
</div>
<!-- / Page -->
<div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>
