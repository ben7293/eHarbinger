CREATE OR REPLACE FUNCTION authUser
(IN in_username varchar(255),
IN in_password varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS (SELECT * FROM users WHERE username = in_username and password = in_password) THEN
		UPDATE users_public SET loginTimestamp = current_timestamp WHERE username = in_username;
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
