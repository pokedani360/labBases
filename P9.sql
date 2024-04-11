SELECT TOP 5 tabla1.title, tabla1.imdb
FROM tabla1
WHERE tabla1.channel = 'TBS'
ORDER BY tabla1.imdb DESC;