<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"> 
        <title>eHarbinger</title>
        <link rel="stylesheet" type="text/css" href="css/meg.css">
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<header id = 'banner'> 
			<div class = 'inner split'>
			<section>
				<h2> Meet the Team! </h2>
			</section>
			<section>
				<!-- Needs button to be able to log out -->
				<form action="userauth.php" method="post">
					<button type="submit"> Log Out </button>
					<input type="hidden" name="type" value="logout">
				</form>
			</section>
			</div>
		</header>
		<section class = 'wrapper'>
		<div class = 'inner split'>
			<section>
				<h1> Meghan Clark </h1>
				<p> Meghan Clark is the lead front end designer for eHarbinger. She is currently working towards her B.S in Computer Science at NYU School of Engineering and looks forward to attending graduate school in the Fall. She loves playing on Xbox and PC, and enjoys RPG, Strategy, and Simulation games. If you wish to contact her, you can email her at mclark414[at]gmail.com :)</p>
			</section>
			<section>
				<img src = "images/ProfilePicture.jpg" height = "300px" width = "250px">
			</section>
		</div>
		<br>
		<br>
		<div class = 'inner split'>
			<section>
				<img src = "images/brian.jpg" height = "300px" width = "250px">
			</section>
			<section>
				<h1> Brian Marks </h1>
				<p> Brian Marks is the database designer for eHarbinger. He is currently getting his B.S in Computer Science at NYU School of Engineering to work full time after graduation. Brian mostly plays MMOs in the little free time he has. If you wish to contact him, you can email him at brian.marks[at]nyu.edu </p>
			</section>
		</div>
		<br>
		<br>
		<div class = 'inner split'>
			<section>
				<h1> Priyam Nidhi </h1>
				<p> Priyam Nidhi is the UX developer for eHarbinger. She is currently working for her B.S in Computer Science at NYU School of Engineering and will work in consulting. Priyam doesn't play many video games, mostly just Candy Crush once in a while. If you wish to contact her, you can email him at pn613[at]nyu.edu </p>
			</section>
			<section>
				<img src = 'images/priyam.jpg' height = '300px' width = '250px'>
			</section>
		</div>
		<br>
		<br>
		<div class = 'inner split'>
			<section>
				<img src = 'images/benson.jpg' height = '300px' width = '250px'>
			</section>
			<section>
				<h1> Benson Tsai </h1>
				<p> Benson Tsai is the main back end developer for eHarbinger. He is expected to graduate with B.S./M.S. degrees in Computer Science at NYU School of Engineering in 2017. Benson is a devoted enthusiast of flight simulation, and most of his gaming interest falls in simulation and strategy games such as Locomotion, SimCity, Cities:Skyline and Cities in Motion. Contact Benson at benson.tsai[at]nyu.edu. </p>
			</section>
		</div>
		<footer>
			<?php include('footer.html');?>
		</footer>
	</body>
</html>
