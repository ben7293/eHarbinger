<?php

include_once("userauth.php");

class Database
{
	function __construct()
	{
		$connstring = "dbname=bt773 user=bt773 password=bt773";
		$connection = pg_connect( "$connstring" ) or die('Connection failed: ' . pg_last_error());;
		echo var_dump($connection);
		echo "db conx success\n";
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
		echo 'test';
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		echo 'test';
		$fetch = pg_fetch_row($result);
		
		return $fetch;
	}
	
	public function queryTrueFalse( $query )
	{
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$fetch = pg_fetch_row($result);
		return $fetch[0];
	}
	
	public $connstring;
	public $connection;	
}

class User
{
	public function __construct( $username, $password, $db )
	{
		if ($db){echo "db exists\n";}
		$conn = $db;
		if ($conn){echo "conn exists\n";}
		echo var_dump($db);
		echo var_dump($conn);
		echo "Executing userAuth\n";
		$result = $this->userAuth($username, $password);
		echo "userAuth finished\n";
		if( $result == 'f' )
		{
			die("Your password is wrong, $username");
		}
		else{
			$loggedIn = 't';
			echo "userauth successful\n";
		}
	}
	
	private function userAuth($username, $password){
		echo "Entering userAuth\n";
		$result = $conn->queryTrueFalse( "select authUser('$username','$password');" );
		$loggedIn = $result;
		echo $loggedIn;
		return $result;
	}
		


	public function getInfo()
	{
		$result = $conn->queryArray( "select * from users_public where username='$username';" ); echo 'test';
		foreach( $result as $data )
		{
			echo "field: $data<br/>";
		}
	}
	public function getName()
	{
		return $user;
	}	
	public function sendMessage( $otherUser, $text )
	{
		echo 'here1';
		echo $otherUser->getName();
		$user2 = $otherUser->$user;
		echo 'here2';
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
	private $loggedIn;
	
}




?>
