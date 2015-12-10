CREATE OR REPLACE FUNCTION isAdmin
(IN in_username varchar(255))
RETURNS boolean AS
$$
BEGIN	
	IF EXISTS (SELECT * FROM users WHERE username=in_username AND isadmin=true)
		THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
