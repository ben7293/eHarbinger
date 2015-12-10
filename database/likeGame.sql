CREATE OR REPLACE FUNCTION likeGame
(IN in_username varchar(255),
IN in_gameName varchar(255),
IN in_gameConsole varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO users_like_games VALUES (in_username, in_gameName, in_gameConsole);
	IF EXISTS (SELECT * FROM users_like_games WHERE username = in_username and gameName = in_gameName and gameConsole = in_gameConsole) THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
