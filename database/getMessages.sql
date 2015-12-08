CREATE OR REPLACE FUNCTION getMessages
(IN in_username1 varchar(255),
IN in_username2 varchar(255))
RETURNS TABLE(
	username1 varchar(255),
	username2 varchar(255),
	message text,
	messagetimestamp timestamp
	) AS
$$
BEGIN
	RETURN QUERY
	SELECT m.username1, m.username2, m.message, m.messagetimestamp
	FROM users_message_users AS m
	WHERE (m.username1 = in_username1 AND m.username2 = in_username2) OR (m.username1 = in_username2 AND m.username2 = in_username1)
	ORDER BY m.messagetimestamp ASC
	LIMIT 100;
END
$$
LANGUAGE plpgsql;
