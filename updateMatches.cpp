#include<iostream>
#include <pqxx/pqxx>

using namespace std;
using namespace pqxx;


bool isInList(const string& target, result list){
	for (int i=0; i < list.size(); ++i){
		if (list[i]["questionid"].as<string>() == target){
			return true;
		}
	}
	return false;
}

bool matchOneQuestion(work& conn, const string& questionID, const string& myUserName, const string& yourUserName){
	// Pull answers for each user
	string myExpQuery = "select answerother, importance from users_answer_questions where questionID=" + questionID + "and username='" + string(myUserName) + "';";
	string yourAnsQuery = "select answerself from users_answer_questions where questionID=" + questionID + "and username='" + string(yourUserName) + "';";
	
	result myExpectation = conn.exec(myExpQuery);
	result yourAnswer = conn.exec(yourAnsQuery);
	
	string answerOther = myExpectation[0]["answerother"].as<string>();
	int index = yourAnswer[0]["answerself"].as<int>();
	char theAns = answerOther[ index-1 ];
	
	cout << "QID = " << questionID << ", myAnswer = " << answerOther << " yourAnswer = " << theAns;	
	
	if ( theAns == '1' ){
		cout << ", it's a match!" << endl;;
		return true;
	}
	cout << ", it's not a match." << endl;;
	return false;
	
}

void matchOneUserWithOthers(work& conn, const string& myUserName){
	// First, grab a list of all users...
	result userList = conn.exec("select username from users;");
	for (int i=0; i < userList.size(); ++i){
		// For each user
		cout << "myUserName = " << myUserName << ", yourUserName = " << userList[i]["username"].as<string>() << endl;
		if (myUserName != userList[i]["username"].as<string>()){
			// We don't want to self-match
			// Grab a list of questions I have answered
			string myQIDQuery = "select questionid from users_answer_questions where username='" + myUserName + "';";
			string yourQIDQuery = "select questionid from users_answer_questions where username='" + userList[i]["username"].as<string>() + "';";
			result myQuestionNums = conn.exec(myQIDQuery);
			result yourQuestionNums = conn.exec(yourQIDQuery);
			
			for (int j=0; j < myQuestionNums.size(); ++j){
				if ( isInList(myQuestionNums[j]["questionid"].as<string>(), yourQuestionNums) ){
					// If this question is answered by you
					bool result = matchOneQuestion(conn, myQuestionNums[j]["questionid"].as<string>(), myUserName, userList[i]["username"].as<string>());
				}
			}
			
		}
		
	}
	int totalscore = 0;

}

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
	// cout << matchOneQuestion(conn, "2", myUserName, yourUserName);
	matchOneUserWithOthers(conn, myUserName);
	
	
	db.disconnect();
	
}