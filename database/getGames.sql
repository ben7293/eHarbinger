CREATE OR REPLACE FUNCTION getGames
(IN in_username varchar(255))
RETURNS TABLE(
	gameConsole varchar(255),
	gameName varchar(255)
	) AS
$$
BEGIN
	RETURN QUERY
	SELECT g.gameConsole, g.gameName
	FROM games g
	WHERE NOT EXISTS(
		SELECT *
		FROM users_like_games u
		WHERE g.gameConsole=u.gameConsole AND g.gameName=u.gameName AND u.username=in_username
	)
	ORDER BY gameConsole;
END
$$
LANGUAGE plpgsql;
