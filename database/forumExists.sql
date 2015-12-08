CREATE OR REPLACE FUNCTION forumExists
(IN in_forumid integer)
RETURNS boolean AS
$$
DECLARE
BEGIN
	IF EXISTS (SELECT * FROM forums WHERE forumid=in_forumid)
		THEN
		RETURN true;
	ELSE
		RETURN false;
	END IF;
END;
$$
LANGUAGE plpgsql;
