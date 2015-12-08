CREATE OR REPLACE FUNCTION isProfileComplete
(IN in_username varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS (
	  SELECT *
	  FROM users_public AS u
	  WHERE u.username=in_username
	  AND (u.name != '' AND u.location != '' AND u.languages != '' AND u.description != '')
	)
		THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
