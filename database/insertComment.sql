CREATE OR REPLACE FUNCTION insertComment
(IN in_forumId integer,
IN in_username varchar(255),
IN in_commentBody text)
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO forums_comment VALUES (DEFAULT, in_forumId, in_username, in_commentBody, DEFAULT);
	
	IF EXISTS SELECT * FROM forums_comment WHERE forumId = in_forumId and username = in_username and commentBody = in_commentBody;
		RETURN true;
	ELSE
		RETURN false;
	END IF
END;
$$
LANGUAGE plpgsql;