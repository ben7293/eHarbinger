CREATE OR REPLACE FUNCTION rmUser
(IN in_username varchar(255))
RETURNS boolean AS
$$
BEGIN
	        DELETE FROM users_public WHERE username=in_username;
                DELETE FROM users_answer_questions WHERE username=in_username;
                DELETE FROM users_rate_users WHERE username1=in_username or username2=in_username;
                DELETE FROM users_match_users WHERE username1=in_username or username2=in_username;
                DELETE FROM forums WHERE username=in_username;
                DELETE FROM forums_comment WHERE username=in_username;
                DELETE FROM users_like_games WHERE username=in_username;
                DELETE FROM users_message_users WHERE username1=in_username or username2=in_username;
                DELETE FROM users WHERE username=in_username;
		IF EXISTS (SELECT * FROM users WHERE username=in_username)
			THEN
			RETURN false;
		END IF;
		RETURN true;
END
$$
LANGUAGE plpgsql;
