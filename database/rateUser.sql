CREATE OR REPLACE FUNCTION rateUser
(IN in_username1 varchar(255),
IN in_username2 varchar(255),
IN in_rating integer)
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO users_rate_users VALUES (in_username1, in_username2, in_rating);
	IF EXISTS SELECT * FROM users_rate_users WHERE username1 = in_username1 and username2 = in_username2 and rating = in_rating;
		RETURN true;
	ELSE
		RETURN false;
	END IF
END;
$$
LANGUAGE plpgsql;