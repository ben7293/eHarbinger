CREATE OR REPLACE FUNCTION updateProfile
(IN in_username varchar(255),
IN in_name text,
IN in_location text,
IN in_languages text,
IN in_description text)
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS( SELECT * FROM users_public WHERE username = in_username )
		THEN
		UPDATE users_public
		SET name=in_name, location=in_location, languages=in_languages, description=in_description
		WHERE username = in_username;
		IF EXISTS( SELECT * FROM users_public WHERE username=in_username AND name=in_name AND location=in_location AND languages=in_languages AND description=in_description)
			THEN
			RETURN true;
		ELSE
			RETURN false;
		END IF;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
