CREATE OR REPLACE FUNCTION hideMatch
(IN in_username1 varchar(255),
IN in_username2 varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS (SELECT * FROM users_match_users WHERE username1 = in_username1 and username2 = in_username2) THEN
		UPDATE users_match_users SET hidden = true WHERE username1 = in_username1 and username2 = in_username2;
		IF EXISTS (SELECT * FROM users_match_users WHERE username1 = in_username1 and username2 = in_username2 and hidden = true) THEN
			RETURN true;
		ELSE
			RETURN false;
		END IF;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
