CREATE OR REPLACE FUNCTION getGameQuestions
(IN in_username varchar(255))
RETURNS TABLE(
	gameName varchar(255),
	gameConsole varchar(255)
	) AS
$$
BEGIN
	RETURN QUERY
	SELECT DISTINCT q.gameName, q.gameConsole
	FROM questions q
	WHERE (q.gameName, q.gameConsole) IN (
		SELECT u.gameName, u.gameConsole
		FROM users_like_games u
		WHERE username=in_username);
END
$$
LANGUAGE plpgsql;
