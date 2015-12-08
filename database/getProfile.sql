CREATE OR REPLACE FUNCTION getProfile
(IN in_username varchar(255))
RETURNS TABLE(
	username varchar(255),
	email varchar(255),
	name text,
	location text,
	languages text,
	description text,
	logintimestamp timestamp
	 ) AS
$$
BEGIN
	RETURN QUERY
	SELECT p.username, p.email, p.name, p.location, p.languages, p.description, u.logintimestamp
	FROM users_public AS p, users as u
	WHERE p.username = u.username AND u.username=in_username;
END
$$
LANGUAGE plpgsql;
