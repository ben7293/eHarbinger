CREATE OR REPLACE FUNCTION insertGame
(IN in_gameName varchar(255),
IN in_gameConsole varchar(255),
IN in_gameDesc text DEFAULT NULL)
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO games VALUES (in_GameName, in_GameConsole, in_GameDesc);
	IF EXISTS (SELECT * FROM games WHERE gameName = in_gameName AND gameConsole = in_gameConsole) THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;