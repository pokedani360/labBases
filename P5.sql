SELECT ROUND(AVG(tabla1.imdb), 2) AS PROM_IMDb
FROM tabla1
WHERE tabla1.channel = 'Netflix';