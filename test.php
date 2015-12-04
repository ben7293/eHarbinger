<html>
<head>
</head>
<body>
<form id='login' action='userauth.php' method='post'>
	<label for='username' >UserName*:</label>
	<input type='text'	name='username' id='username'  maxlength="50" />
	 
	<label for='password' >Password*:</label>
	<input type='password' name='password' id='password' maxlength="50" />
	 
	<input type='submit' name='Submit' value='Submit' />
</form>

<?php


// $me = new User( 'bm1549', 'babe' );
// $you = new User( 'ben7293', 'baby' );
// //echo "getinfo";
// //$me->getInfo();
// echo "sendmessage";
// $me->sendMessage( $you,'hello' );
// $me->sendMessage( $you,'how are you?' );
// $you->sendMessage($me, 'im good');
// echo 'getmessages';
// $me->getMessages( $you );

?>

</body>
</html>
