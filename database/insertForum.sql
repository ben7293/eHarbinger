CREATE OR REPLACE FUNCTION insertForum
(IN in_username varchar(255),
IN in_forumSubj varchar(255),
IN in_forumBody text)
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO forums VALUES (DEFAULT, in_username, in_forumSubj, in_forumBody, DEFAULT);
	
	IF EXISTS SELECT * FROM forums WHERE username = in_username and forumSubj = in_forumSubj and forumBody = in_forumBody;
		RETURN true;
	ELSE
		RETURN false;
	END IF
END;
$$
LANGUAGE plpgsql;