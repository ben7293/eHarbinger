CREATE OR REPLACE FUNCTION friendUser
(IN in_username1 varchar(255),
IN in_username2 varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS SELECT * FROM users_friend_users WHERE username1 = in_username2 and username2 = in_username1;
		UPDATE TABLE users_friend_users SET accepted = true WHERE username1 = in_username2 and username2 = in_username1;
		IF EXISTS SELECT * FROM users_friend_users WHERE username1 = in_username2 and username2 = in_username1 and accepted = true;
			RETURN true;
		ELSE
			RETURN false;
		END IF
	ELSE
		INSERT INTO users_friend_users VALUES (in_username1, in_username2, false);
		IF EXISTS SELECT * FROM users_friend_users WHERE username1 = in_username1 and username2 = in_username2 and accepted = false;
			RETURN true;
		ELSE
			RETURN false;
		END IF
	END IF
END;
$$
LANGUAGE plpgsql;