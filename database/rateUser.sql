CREATE OR REPLACE FUNCTION rateUser
(IN in_username1 varchar(255),
IN in_username2 varchar(255),
IN in_rating integer)
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS (SELECT * FROM users_rate_users WHERE username1 = in_username1 and username2 = in_username2) THEN
		UPDATE users_rate_users
		SET rating=in_rating
		WHERE username1=in_username1 AND username2=in_username2;
	ELSE
		INSERT INTO users_rate_users VALUES (in_username1, in_username2, in_rating);
	END IF;

	IF EXISTS (SELECT * FROM users_rate_users WHERE username1 = in_username1 and username2 = in_username2 and rating = in_rating) THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
