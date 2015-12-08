CREATE OR REPLACE FUNCTION getForum
(IN in_forumid integer)
RETURNS TABLE(
	username varchar(255),
	forumSubj varchar(255),
	forumBody text,
	forumtimestamp timestamp
	) AS
$$
DECLARE
BEGIN
	RETURN QUERY
	SELECT f.username, f.forumSubj, f.forumBody, f.forumtimestamp
	FROM forums f
	WHERE f.forumid=in_forumid;
END
$$
LANGUAGE plpgsql;
