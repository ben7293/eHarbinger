#include<iostream>
#include <pqxx/pqxx>

using namespace std;
using namespace pqxx;


bool isInList(const int target, result list){
	for (int i=0; i < list.size(); ++i){
		if (list[i]["questionid"].as<int>() == target){
			return true;
		}
	}
	return false;
}

bool matchOneQuestion(work& conn, int questionID, const string& myUserName, const string& yourUserName){
	// Pull answers for each user
	string myExpQuery = "select answerother, importance from users_answer_questions where questionID=" + string(questionID) + "and username='" + string(myUserName) + "';";
	string yourAnsQuery = "select answerself from users_answer_questions where questionID=" + string(questionID) + "and username='" + string(yourUserName) + "';";
	
	result myExpectation = conn.exec(myExpQuery);
	result yourAnswer = conn.exec(yourAnsQuery);
	
	string answerOther = myExpectation[0]["answerother"].as<string>();
	int index = yourAnswer[0]["answerself"].as<int>();
	int theAns = answerOther[ index-1 ];
	
	cout << "QID = " questionID << ", myAnswer = " << answerOther << " yourAnswer = " << theAns << endl;	
	
	if ( theAns == '1' ){
		return true;
	}
	return false;
	
}

// void matchOneUserWithOthers(work& conn, const string& myUserName){
	// // First, grab a list of all users...
	// result userList = conn.exec("select username from users;");
	// for (int i=0; i < userList.size(); ++i){
		// // For each user
		// if (myUserName != userList[i]["username"]){
			// // We don't want to self-match
			// // Grab a list of questions I have answered
			// string myQIDQuery = "select questionid from users_answer_questions where username='" + myUserName + "';";
			// string yourQIDQuery = "select questionid from users_answer_questions where username='" + userList[i]["username"] + "';";
			// result myQuestionNum = conn.exec(myQIDQuery);
			// result yourQuestionNum = conn.exec(yourQIDQuery);
			
			// for (int j=0; j < myQuestionNum.size(); ++j){
				// if ( isInList(questionNum[j]["questionid"], yourQuestionNum) ){
					// // If this question is answered by you
					// bool result = matchOneQuestion(conn, questionNum[j]["questionid"], myUserName, userList[i]["username"]);
				// }
			// }
			
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

	// string myExpQuery = "select answerother, importance from users_answer_questions where questionID=" + string(questionID) + "and username='" + string(myUserName) + "';";
	// string yourAnsQuery = "select answerself from users_answer_questions where questionID=" + string(questionID) + "and username='" + string(yourUserName) + "';";
	
	// result myExpectation = conn.exec(myExpQuery);
	// result yourAnswer = conn.exec(yourAnsQuery);
	matchOneQuestion(conn, 2, myUserName, yourUserName);
	
	
	db.disconnect();
	
}