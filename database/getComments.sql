CREATE OR REPLACE FUNCTION getComments
(IN in_forumid integer)
RETURNS TABLE(
	username varchar(255),
	commentBody text,
	commenttimestamp timestamp
	) AS
$$
DECLARE
BEGIN
	RETURN QUERY
	SELECT f.username, f.commentBody, f.commenttimestamp
	FROM forums_comment f
	WHERE f.forumid=in_forumid;
END
$$
LANGUAGE plpgsql;
