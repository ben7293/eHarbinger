CREATE OR REPLACE FUNCTION insertUser
(IN in_username varchar(255),
IN in_password varchar(255))
RETURNS varchar(255) AS
$$
DECLARE
	out_username varchar(255) DEFAULT 'Failure';
BEGIN
	INSERT INTO users VALUES (in_username, in_password);
	SELECT username INTO out_username FROM users WHERE username = in_username;
	RETURN out_username;
END;
$$
LANGUAGE plpgsql;