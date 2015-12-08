CREATE OR REPLACE FUNCTION insertUser
(IN in_username varchar(255),
IN in_password varchar(255),
IN in_email varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS( SELECT * FROM users WHERE username=in_username ) OR EXISTS( SELECT * FROM users_public WHERE email=in_email )
		THEN
		RETURN false;
	ELSE
		INSERT INTO users VALUES (in_username, in_password);
		INSERT INTO users_public VALUES (in_username, in_email );
		IF EXISTS (SELECT * FROM users WHERE username = in_username AND password = in_password) AND EXISTS (SELECT * FROM users_public WHERE username = in_username and email = in_email) THEN
			RETURN true;
		ELSE
			RETURN false;
		END IF;
	END IF;
END;
$$
LANGUAGE plpgsql;
