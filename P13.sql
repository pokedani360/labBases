USE AnimatedTvSeries

SELECT STRING_AGG(genre, ', ') AS Generos
FROM (
    SELECT DISTINCT genre
    FROM (
        SELECT TRIM(value) AS genre
        FROM tabla2
        CROSS APPLY STRING_SPLIT(genre, '|')
        WHERE genre LIKE '%|%'
        UNION ALL
        SELECT genre
        FROM tabla2
        WHERE genre NOT LIKE '%|%'
    ) AS UniqueGenres
) AS DistinctGenres;
