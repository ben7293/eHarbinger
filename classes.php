<?php

class Database
{
	function __construct()
	{
		$connstring = "dbname=bt773 user=bt773 password=bt773";
		$connection = pg_connect( "$connstring" );
	}
	
	// Please sanitize this...
	function queryArray( $query )
	{
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$fetch = pg_fetch_all($result);
		return $fetch;
	}
	
	function queryTrueFalse( $query )
	{
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$fetch = pg_fetch_all($result);
		return $fetch[0][0];
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
		$result = $conn->queryTrueFalse( "select authUser($username,$password)" );
		
		echo $result;
		
	}

	private $user;
}


$me = new User( 'bm1549', 'babe' );
$me = new User( 'bt773', 'babe' );


?>