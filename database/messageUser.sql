CREATE OR REPLACE FUNCTION messageUser
(IN in_username1 varchar(255),
IN in_username2 varchar(255),
IN in_message text)
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO users_message_users VALUES (in_username1, in_username2, in_message);
	IF EXISTS (SELECT * FROM users_message_users WHERE username1 = in_username1 and username2 = in_username2 and message = in_message) THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;