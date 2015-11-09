<?php

class User{
	public function __construct($userID){
		$this->$userID = userID;
	}
	
	public function getFullName(){
		return pg_exec($db, "select getFullName($userID)");
	}
	public function getUserName(){
		return pg_exec($db, "select getUserName($userID)");
	}
	public function getUserGames(){
		return pg_exec($db, "select getUserGames($userID)");
	}
	public function getUserSkill(){
		return pg_exec($db, "select getUserSkill($userID)");
	}

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
		pg_exec($db, "select updatePreferences($userID, $email)");
	}
	public function updatePreferences($preferences){
		pg_exec($db, "select updatePreferences($userID, $preferences)");
	}
	public function updateSkills($skills){
		pg_exec($db, "select updateSkills($userID, $skills)");
	}
	public function updateFeedback($otherUser, $rating){
		pg_exec($db, "select Feedback($userID, $otherUser, $rating)");
	}

	public function createProfile(){
	}
	public function viewProfile(){
	}
	public function giveFeedback(){
	}
	public function chatUser(){
	}
	public function updateProfile(){
	}
	public function deleteProfile(){
	}

	public function chatWithUser(){
	}
	public function updateUser(){
	}
	public function deleteUser(){
		pg_exec($db, "select deleteUser($userID)");
	}
	public function createUser($username, $password){
		pg_exec($db, "select insertUser($username, $password)");
	}
	private $userID;
	
}





?>