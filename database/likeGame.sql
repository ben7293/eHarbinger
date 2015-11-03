CREATE OR REPLACE FUNCTION likeGame
(IN in_username varchar(255),
IN in_gameId integer)
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO users_like_games VALUES (in_username, in_gameId);
	IF EXISTS (SELECT * FROM users_like_games WHERE username = in_username and gameId = in_gameId) THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;