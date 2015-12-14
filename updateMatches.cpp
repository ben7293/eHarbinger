#include<iostream>
#include <pqxx/pqxx>

using namespace std;
using namespace pqxx;


// void matchOneQuestion(work& conn, const int questionID, const string& myUsername, const string& yourUserName){
	// // Pull answers for each user
	// result myExpectation = conn.exec("select answerother, importance from users_answer_questions;");
	// result yourAnswer = conn.exec("select answerself from users_answer_questions;");
	// if ( myExpectation[0]["answerother"][ yourAnswer[0]["answerself"] ] == 1){
		// // If your answer is in my expectations
		// score += myExpectation[0]["importance"];
	// }
// }

// void matchOneUserWithOthers(work& conn, const string& myUserName){
	// // First, grab a list of all users...
	// result userList = conn.exec("select username from users;");
	// for (int i=0; i < userList.size(); ++i){
		// // For each user
		// if (myUserName != userList[i]["username"]){
			// // We don't want to self-match
			// matchEachQuestions();
		// }
	// }
	// int totalscore = 0;

// }

// void matchAllUsers(){
	
// }

int main(){
	// Connect to database
	connection db("dbname=bt773 user=bt773 password=bt773");
	work conn(db);
	string questionID = "2";
	string myUserName = "brian";
	string yourUserName = "ben7293";
	string myExpQuery = "select answerother, importance from users_answer_questions where questionID=" + string(questionID) + "and username='" + string(myUserName) + "';";
	string yourAnsQuery = "select answerself from users_answer_questions where questionID=" + string(questionID) + "and username='" + string(yourUserName) + "';";
	
	result myExpectation = conn.exec(myExpQuery);
	result yourAnswer = conn.exec(yourAnsQuery);
	string answerOther = myExpectation[0]["answerother"].as<string>();
	int index = yourAnswer[0]["answerself"].as<int>();
	int theAns = answerOther[ index-1 ];
	if ( theAns == '1' ){
		// If your answer is in my expectations
		cout << "It's a match!\n";
		// score += myExpectation[0]["importance"];
	}
	else{
		cout << "It's not a match :(\n";
	}
	
	
	db.disconnect();
	
}