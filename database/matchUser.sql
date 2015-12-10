CREATE OR REPLACE FUNCTION matchUser
(IN in_username1 varchar(255),
IN in_username2 varchar(255),
IN in_matchPercent int)
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS (SELECT * FROM users_match_users WHERE username1 = in_username1 and username2 = in_username2) THEN
		UPDATE users_match_users SET mathPercent = in_matchPercent WHERE username1 = in_username1 and username2 = in_username2;
		IF EXISTS (SELECT * FROM users_match_users WHERE username1 = in_username1 and username2 = in_username2 and matchPercent = in_matchPercent) THEN
			RETURN true;
		ELSE
			RETURN false;
		END IF;
	ELSE
		INSERT INTO users_match_users VALUES (in_username1, in_username2, in_matchPercent);
		IF EXISTS (SELECT * FROM users_match_users WHERE username1 = in_username1 and username2 = in_username2 and matchPercent = in_matchPercent) THEN
			RETURN true;
		ELSE
			RETURN false;
		END IF;
	END IF;
END;
$$
LANGUAGE plpgsql;
