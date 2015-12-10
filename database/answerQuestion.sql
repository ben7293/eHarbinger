CREATE OR REPLACE FUNCTION answerQuestion
(IN in_username varchar(255),
IN in_questionId integer,
IN in_answerSelf integer,
IN in_answerOther varchar(255),
IN in_importance integer)
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS (SELECT * FROM users_answer_questions WHERE username=in_username AND questionId=in_questionId)
		THEN
		UPDATE users_answer_questions
		SET answerSelf=in_answerSelf, answerOther=in_answerOther, importance=in_importance
		WHERE username=in_username AND questionId=in_questionId;
	ELSE
		INSERT INTO users_answer_questions VALUES (in_username, in_questionId, in_answerSelf, in_answerOther, in_importance);
	END IF;
	RETURN true;
END;
$$
LANGUAGE plpgsql;
