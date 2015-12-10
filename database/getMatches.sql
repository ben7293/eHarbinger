CREATE OR REPLACE FUNCTION getMatches
(IN in_username varchar(255),
IN in_numResults integer)
RETURNS TABLE(
	username varchar(255),
	matchPercent integer
	) AS
$$
BEGIN
	RETURN QUERY
	SELECT m.username2, m.matchpercent
	FROM users_match_users AS m
	WHERE m.username1=in_username AND m.hidden=false
	ORDER BY m.matchpercent DESC
	LIMIT in_numResults;
END
$$
LANGUAGE plpgsql;
