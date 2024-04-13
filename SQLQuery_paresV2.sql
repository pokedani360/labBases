--P2
SELECT title AS 'Series con mas de 100 episodios' FROM table1 WHERE episodes >= 100 ORDER BY episodes DESC;

--P4
SELECT years as 'Años', COUNT(*) AS 'Cantidad'
FROM table1
GROUP BY years
HAVING COUNT(*) > 5 
ORDER BY cantidad ASC;

--P6
SELECT title as 'Series y peliculas de Cartoon Network' from table1 where original_channel LIKE 'cartoon network%';

--P8
SELECT title as 'Peliculas y series animadas peor evaluadas IMDb', google_users AS 'Calificacion' FROM table1 where google_users < '30%' AND google_users != '100%' order by google_users ASC;

--P10 Defensa
DELETE FROM table1 WHERE imdb < 3.5;
SELECT * FROM table1;

--P12 -- no me tira null TT
SELECT ROUND(AVG(CONVERT(float, reemplazo3)), 2) as Promedio FROM (
		SELECT REPLACE(reemplazo2, ' ', '') as reemplazo3 FROM (
		SELECT REPLACE(reemplazo, 'h', '.') as reemplazo2 FROM (
		SELECT REPLACE(run_time, 'm', '') as reemplazo FROM table2
		WHERE run_time IS NOT NULL
		) AS t1
	) AS t2
) AS t3;

--P14
SELECT IDt3 AS 'ID3', title AS 'Titulo', episodes AS 'Episodios', years AS 'Años', original_channel AS 'Canal', american_company AS 'Productora',
note as 'Nota', technique AS 'Tecnica', imdb AS 'Rating IMDb', google_users AS '% Aprobacion', released_year as 'Año de lanzamiento', rated_class as 'Clasificiacion',
run_time as 'Duracion', stars as 'Estrellas', genre as 'Genero', summary as 'Sinopsis'
FROM table3 
WHERE episodes IS NOT NULL AND run_time IS NOT NULL;

--P16 - arreglada :3
SELECT table1.* FROM (
	SELECT years from table1 WHERE years IS NOT NULL
	GROUP BY years)
AS t1
INNER JOIN table1 ON t1.years = table1.years
ORDER BY table1.years ASC;
