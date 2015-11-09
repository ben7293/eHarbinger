<?php

class User{
	public function __construct($userID){
		$this->$userID = userID;
	}
	//Getters
	public function getFirstName(){
		return pg_exec($db, "select getFirstName($userID)");
	}
	public function getLastName(){
		return pg_exec($db, "select getLastName($userID)");
	}
	public function getUserName(){
		return pg_exec($db, "select getUserName($userID)");
	}
	public function getUserGames(){
		return pg_exec($db, "select getUserGames($userID)");
	}
	public function getUserSkill($gameID){
		return pg_exec($db, "select getUserSkill($userID)");
	}

	//Modifiers
	public function updateFullName($fullName){
		pg_exec($db, "select updateFullName($userID, $fullName)");
	}
	public function updateUserName($userName){
		pg_exec($db, "select updateUserName($userID, $userName)");
	}
	public function updatePassword($password){
		pg_exec($db, "select updatePassword($userID, $password)");
		//Probably want to encrypt before sending
	}
	public function updateEmail($email){
		pg_exec($db, "select updateEmail($userID, $email)");
		//Exception for already existing email
	}
	public function updatePreferences($preferences){
		//Dictionary comparison, update changed fields
		pg_exec($db, "select updatePreferences($userID, $preferences)");
	}
	public function updateSkills($skills){
		pg_exec($db, "select updateSkills($userID, $skills)");
	}
	public function updateFeedback($otherUser, $rating){
		pg_exec($db, "select Feedback($userID, $otherUser, $rating)");
	}
	public function chatWithUser(){
	}
	
	//Low level profile maintenance
	public function viewUser(){
	}
	public function deleteUser(){
		pg_exec($db, "select deleteUser($userID)");
	}
	public function createUser($username, $password){
		pg_exec($db, "select insertUser($username, $password)");
	}
	
	//Member variables
	private $userID;
	
}





?>