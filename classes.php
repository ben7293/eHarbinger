<?php

class Database
{
	function __construct()
	{
		$connstring = "dbname=bt773 user=bt773 password=bt773";
		$connection = pg_connect( "$connstring" );
	}
	
	// Please sanitize this...
	function queryTable( $query )
	{
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$fetch = pg_fetch_all($result);
		return $fetch;
	}

	function queryArray( $query )
	{
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$fetch = pg_fetch_row($result);
		return $fetch;
	}
	
	function queryTrueFalse( $query )
	{
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$fetch = pg_fetch_row($result);
		return $fetch[0];
	}
	
	private $connstring;
	private $connection;	
}

class User
{
	public function __construct( $username, $password )
	{
		$user = $username;
		$conn = new Database();
		$result = $conn->queryTrueFalse( "select authUser('$username','$password');" );	
		if( $result == 'f' )
		{
			die("Your password is wrong, $username");
		}
	}
	
	public function getInfo()
	{
		$result = $conn->queryArray( "select * from users_public where username='$username';" );
		foreach( $result as $data )
		{
			echo "field: $data<br/>";
		}
	}
	
	public function sendMessage( $otherUser, $text )
	{
		$user2 = $otherUser->$user;
		$result = $conn->queryTrueFalse( "select messageUser( '$user', '$user2', '$text' ");
		if( $result == 'f' )
		{
			die("Message send failed from: $user to: $user2" );
		}
	}
	
	public function getMessages( $otherUser )
	{
		$user2 = $otherUser->$user;
		$result = $conn->queryTable( "select * from users_message_users where (username1='$user' and username2='$user2') or (username2='$user' and username1='$user2');" );
		echo "<table>";
		foreach( $result as $row )
		{
			echo "<tr>";
			foreach( $row as $col )
			{
				echo "<td>$col</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	

	private $user;
	private $conn;
}


$me = new User( 'bm1549', 'babe' );
$you = new User( 'bt773', 'baby' );
$me->getInfo();
$me->sendMessage( $you,'hello' );
$me->sendMessage( $you,'how are you?' );
$you->sendMessage($me, 'im good');
?>
