CREATE OR REPLACE FUNCTION rmAdmin
(IN in_username varchar(255))
RETURNS boolean AS
$$
BEGIN
	UPDATE users
	SET isadmin=false
	WHERE username=in_username;
	
	IF EXISTS (SELECT * FROM users WHERE username=in_username AND isadmin=true)
		THEN
		RETURN false;
	ELSE
		RETURN true;
	END IF;
END;
$$
LANGUAGE plpgsql;
