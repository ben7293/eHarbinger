CREATE OR REPLACE FUNCTION getRecentForums
(IN in_numforums integer)
RETURNS TABLE(
	forumid integer,
	username varchar(255),
	forumSubj varchar(255),
	forumBody text,
	forumtimestamp timestamp
	) AS
$$
DECLARE
BEGIN
	RETURN QUERY
	SELECT f.forumid, f.username, f.forumSubj, f.forumBody, f.forumtimestamp
	FROM forums f
	ORDER BY f.forumtimestamp DESC
	LIMIT in_numforums;
END
$$
LANGUAGE plpgsql;
