#include <iostream>
#include <pqxx/pqxx> 

using namespace std;
using namespace pqxx;

int main(int argc, char* argv[])
{
   try{
      connection C("dbname=bt773 user=bt773 password=bt773");
      if (C.is_open()) {
         cout << "Opened database successfully: " << C.dbname() << endl;
      } else {
         cout << "Can't open database" << endl;
         return 1;
      }
work txn(C);	
result r = txn.exec("select username from users where username='ben7293';");
string a =  r[0]["username"].as<string>();
cout << r.size() << " ";

cout << a;
C.disconnect ();
   }catch (const std::exception &e){
      cerr << e.what() << std::endl;
      return 1;
   }

}
