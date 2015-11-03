CREATE OR REPLACE FUNCTION insertUser
(IN in_username varchar(255),
IN in_password varchar(255))
RETURNS boolean AS
$$
DECLARE
BEGIN
	INSERT INTO users VALUES (in_username, in_password);
	RETURN true;
END;
$$
LANGUAGE plpgsql;