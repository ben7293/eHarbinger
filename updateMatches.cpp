#include<iostream>
#include <pqxx/pqxx>

using namespace std;
using namespace pqxx;


void matchOneQuestion(work& conn, const int questionID, const string& myUsername, const string& yourUserName){
	// Pull answers for each user
	result myExpectation = conn.exec("select answerother, importance from users_answer_questions;");
	result yourAnswer = conn.exec("select answerself from users_answer_questions;");
	if ( myExpectation[0]["answerother"][ yourAnswer[0]["answerself"] ] == 1){
		// If your answer is in my expectations
		score += myExpectation[0]["importance"];
	}
}

void matchOneUserWithOthers(work& conn, const string& myUserName){
	// First, grab a list of all users...
	result userList = conn.exec("select username from users;");
	for (int i=0; i < userList.size(); ++i){
		// For each user
		if (myUserName != userList[i]["username"]){
			// We don't want to self-match
			matchEachQuestions();
		}
	}
	int totalscore = 0;

}

void matchAllUsers(){
	
}

int main(){
	// Connect to database
	connection db("dbname=bt773 user=bt773 password=bt773");
	work conn(db);
	int questionID = 2;
	string myUserName = "ben7293";
	string yourUserName = "brian";
	string myExpQuery = "select answerother, importance from users_answer_questions where questionID=" + questionID + "and username=" + myUserName + ";";
	string yourAnsQuery = "select answerself from users_answer_questions where questionID=" + questionID + "and username=" + yourUserName + ";";
	
	result myExpectation = conn.exec(myExpQuery);
	result yourAnswer = conn.exec(yourAnsQuery);
	if ( myExpectation[0]["answerother"][ yourAnswer[0]["answerself"] ] == 1){
		// If your answer is in my expectations
		cout << "It's a match!\n";
		// score += myExpectation[0]["importance"];
	}	
	
	
	
	db.disconnect();
	
}