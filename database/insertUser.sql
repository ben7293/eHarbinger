CREATE OR REPLACE FUNCTION insertUser
(IN in_username varchar(255),
IN in_password varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO users VALUES (in_username, in_password);
	INSERT INTO users_public VALUES (in_username);
	IF EXISTS (SELECT * FROM users WHERE username = in_username AND password = in_password) AND EXISTS (SELECT * FROM users_public WHERE username = in_username) THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
