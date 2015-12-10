CREATE OR REPLACE FUNCTION addAdmin
(IN in_username varchar(255))
RETURNS boolean AS
$$
BEGIN
	UPDATE users
	SET isadmin=true
	WHERE username=in_username;
	
	IF EXISTS (SELECT * FROM users WHERE username=in_username AND isadmin=true)
		THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
