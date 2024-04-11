SELECT TOP 1 *
FROM tabla1
WHERE episodes = (SELECT MAX(episodes) FROM tabla1);

