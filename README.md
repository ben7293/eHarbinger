# eHarbinger
Senior design project - Fall 2015

For running our software:
Please go to http://pdc-amd01.poly.edu/~bt773/eHarbinger/

If you wish to run it separately from our server, please copy the contents of the CD to a web server with a PSQL database connection.
In classes.php, modify the connstring variable to include the information for your database.
Modify database connection attributes in line 92 to your database. Then, compile updateMatches.cpp with the following command:
$ g++ -lpqxx updateMatches.cpp -o matchusers.exe

We hope you enjoy our project!
