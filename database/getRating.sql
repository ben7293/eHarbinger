CREATE OR REPLACE FUNCTION getRating
(IN in_username varchar(255))
RETURNS TABLE( feedback bigint ) AS
$$
BEGIN
	RETURN QUERY
	SELECT sum(u.rating) AS feedback
	FROM users_rate_users AS u
	WHERE username2=in_username
	GROUP BY username2;
END
$$
LANGUAGE plpgsql;
