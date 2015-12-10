CREATE OR REPLACE FUNCTION insertGame
(IN in_gameName varchar(255),
IN in_gameConsole varchar(255),
IN in_gameDesc text DEFAULT NULL)
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS (SELECT * FROM games WHERE gameName = in_gameName AND gameConsole = in_gameConsole) THEN
		UPDATE games
		SET gamedesc=in_gameDesc
		WHERE gamename=in_gameName AND gameconsole = in_gameConsole;
	ELSE
		INSERT INTO games VALUES (in_GameName, in_GameConsole, in_GameDesc);
	END IF;
	RETURN true;
END;
$$
LANGUAGE plpgsql;
