CREATE OR REPLACE FUNCTION insertQuestion
(IN in_gameName varchar(255),
IN in_gameConsole varchar(255),
IN in_questionText varchar(255),
IN in_answer1 varchar(255),
IN in_answer2 varchar(255),
IN in_answer3 varchar(255),
IN in_answer4 varchar(255),
IN in_answer5 varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO questions VALUES (DEFAULT, in_gameName, in_gameConsole, in_questionText, in_answer1, in_answer2, in_answer3, in_answer4, in_answer5);
	IF EXISTS (SELECT * FROM questions WHERE gameName=in_gameName AND gameConsole=in_gameConsole AND questionText=in_questionText)
		THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
