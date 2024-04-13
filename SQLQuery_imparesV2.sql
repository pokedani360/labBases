--IMPARES

--P1
SELECT title AS 'Peliculas y series animadas', years AS 'Año de Lanzamiento (Ascendente)' FROM table1 ORDER BY years ASC;


--P3
SELECT table1.title AS 'Peliculas y series animadas'
FROM table1

--P5
SELECT ROUND(AVG(table1.imdb), 2) AS 'Promedio IMDb'
FROM table1
WHERE table1.original_channel = 'Netflix'; --Seleccionar canal

--P7
SELECT TOP 10 title AS 'TOP 10 Peliculas o series animadas mejor evaluadas IMDb', imdb as 'IMDb'
FROM table1
ORDER BY table1.imdb DESC;

--P11
SELECT TOP 1 title AS 'Pelicula o Serie con mas Capitulos', episodes AS 'Episodios'
FROM table1
WHERE episodes = (SELECT MAX(episodes) FROM table1);

--P13
SELECT STRING_AGG(genre, ', ') AS 'Generos'
FROM (
    SELECT DISTINCT genre
    FROM (
        SELECT TRIM(value) AS genre
        FROM table2
        CROSS APPLY STRING_SPLIT(genre, '|')
        WHERE genre LIKE '%|%'
        UNION ALL
        SELECT genre
        FROM table2
        WHERE genre NOT LIKE '%|%'
    ) AS UniqueGenres
) AS DistinctGenres;

--P15
SELECT title AS 'Peliculas con C' --Falta peliculas animadas?
FROM table2
WHERE Title LIKE 'C%';

--P17
SELECT t2.Title AS 'Peliculas que tambien son series animadas'
FROM table2 t2
INNER JOIN table1 t1 ON t2.Title = t1.Title;
