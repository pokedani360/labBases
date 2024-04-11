WITH CTE AS (
    SELECT DISTINCT genre
    FROM tabla2
)
SELECT 
    STUFF((
        SELECT DISTINCT ', ' + CASE WHEN CHARINDEX('|', genre) > 0 THEN LEFT(genre, CHARINDEX('|', genre) - 1) ELSE genre END
        FROM CTE
        FOR XML PATH('')), 1, 2, '') AS concatenated_genres
