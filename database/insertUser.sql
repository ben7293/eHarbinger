CREATE OR REPLACE PROCEDURE insertUser
(IN username varchar(255),
IN password varchar(255))
IS
BEGIN
	INSERT INTO users VALUES (username, password);
EXCEPTION
	raise_application_error( -20001, 'An error was encountered - '||SQLCODE||' -ERROR-'||SQLERRM);
END;
/