CREATE OR REPLACE FUNCTION getQuestion
(IN in_gameName varchar(255),
IN in_gameConsole varchar(255))
RETURNS TABLE(
	questionId integer,
	gameName varchar(255),
	gameConsole varchar(255),
	questionText text,
	answer1 varchar(255),
        answer2 varchar(255),
        answer3 varchar(255),
        answer4 varchar(255),
        answer5 varchar(255)
	) AS
$$
BEGIN
	RETURN QUERY
	SELECT q.questionid, q.gamename, q.gameconsole, q.questiontext, q.answer1, q.answer2, q.answer3, q.answer4, q.answer5
	FROM questions q
	WHERE q.gameName=in_gameName AND q.gameConsole=in_gameConsole;
END
$$
LANGUAGE plpgsql;
