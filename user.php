<?php

class User{
	public function __construct($username){
		$this->$username = username;
	}
		
	
	//Getters
	public function getFirstName(){
		return pg_query($db, "select getFirstName($username)");
	}
	public function getLastName(){
		return pg_query($db, "select getLastName($username)");
	}
	public function getUserName(){
		return pg_query($db, "select getUserName($username)");
	}
	public function getUserGames(){
		return pg_query($db, "select getUserGames($username)");
	}
	public function getUserSkill($gameID){
		return pg_query($db, "select getUserSkill($username)");
	}

	//Modifiers
	public function updateFullName($fullName){
		pg_query($db, "select updateFullName($username, $fullName)");
	}
	public function updateUserName($userName){
		pg_query($db, "select updateUserName($username, $userName)");
	}
	public function updatePassword($password){
		pg_query($db, "select updatePassword($username, $password)");
		//Probably want to encrypt before sending
	}
	public function updateEmail($email){
		pg_query($db, "select updateEmail($username, $email)");
		//Exception for already existing email
	}
	public function updatePreferences($preferences){
		//Dictionary comparison, update changed fields
		pg_query($db, "select updatePreferences($username, $preferences)");
	}
	public function updateSkills($skills){
		pg_query($db, "select updateSkills($username, $skills)");
	}
	public function updateFeedback($otherUser, $rating){
		pg_query($db, "select Feedback($username, $otherUser, $rating)");
	}
	public function chatWithUser(){
	}
	
	//Low level profile maintenance
	public function viewUser(){
	}
	public function deleteUser(){
		pg_query($db, "select deleteUser($username)");
	}
	public function createUser($username, $password){
		//Password should be encrypted
		pg_query($db, "select insertUser($username, $password)");
	}
	
	//Member variables
	private $username;
	
}





?>