CREATE OR REPLACE FUNCTION userExists
(IN in_username varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS (SELECT * FROM users WHERE username=in_username)
		THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
