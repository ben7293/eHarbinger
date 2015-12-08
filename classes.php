<?php

class Database
{
	function __construct(){
		$this->connstring = "dbname=bt773 user=bt773 password=bt773";
		$this->connection = pg_connect( "$this->connstring" ) or die("Connection failed: " . pg_last_error());
	}


	function queryTable($query){
		$this->connection = pg_connect( "$this->connstring" ) or die("Connection failed: " . pg_last_error());
		$result = pg_query($query) or die("Query failed: " . pg_last_error());
		$fetch = pg_fetch_all($result);
		return $fetch;
	}

	function queryArray($query){
		$this->connection = pg_connect( "$this->connstring" ) or die("Connection failed: " . pg_last_error());
		$result = pg_query($query) or die("Query failed: " . pg_last_error());
		$fetch = pg_fetch_assoc($result);	
		return $fetch;
	}
	
	public function queryTrueFalse($query){
		$this->connection = pg_connect( "$this->connstring" ) or die("Connection failed: " . pg_last_error());
		$result = pg_query($query) or die("Query failed: " . pg_last_error());
		$fetch = pg_fetch_row($result);
		if ($fetch[0] == 't') {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	private $connstring;
	private $connection;	
}

class User
{
	public function __construct($username, $password, $db){
		$this->conn = $db;
		$this->user = pg_escape_string($username);
		die("a");
		if ($this->userAuth($this->user, $password)){
			$this->isLoggedIn = TRUE;
		}
	}
	
	private function userAuth($username, $password){
		return $this->query( "select authUser('$username','$password');", "boolean" );
	}
		
	public function getInfo(){
		$result = $conn->queryArray( "select * from users_public where username='$username';" ); echo "test";
		foreach( $result as $data )
		{
			echo "field: $data<br/>";
		}
	}
	public function getName(){
		return $this->user;
	}
	public function isLoggedIn(){
		return $this->isLoggedIn;
	}
	public function upProf($username, $name, $location, $lang, $prefCsv){
		$this->updateProfile($username, $name, $location, $lang, $prefCsv);
	}
	private function updateProfile($username, $name, $location, $lang, $prefCsv){
		echo "in updateProfile()";
		echo "$username | $name | $location | $lang | $prefCsv ";
		var_dump($this->conn);
		$status = $this->conn->queryTrueFalse(
			"select updateprofile('$username','$name','$location','$lang','$prefCsv');"
		);
		return $status;
	}
	
	public function sendMessage($otherUser, $text){
		echo "here1";
		echo $otherUser->getName();
		$user2 = $otherUser->$user;
		echo "here2";
		$result = $conn->queryTrueFalse( "select messageUser( '$user', '$user2', '$text' ");
		if( $result == "f" )
		{
			die("Message send failed from: $user to: $user2" );
		}
	}
	
	public function getMessages($otherUser){
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
	
	public function query($query, $type){
		if ($type == "table"){
			return $this->conn->queryTable($query);
		}
		elseif($type == "array"){
			return $this->conn->queryArray($query);			
		}
		elseif($type == "boolean"){
			return $this->conn->queryTrueFalse($query);
		}
		else return NULL;
	}
	
	private $user;
	private $conn;
	private $isLoggedIn = FALSE;
	
}




?>
