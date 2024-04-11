create table tabla1 (
    id int primary key,
    title varchar(100),
    episodes int,
    years varchar (30),
    channel varchar(80),
    company varchar(100),
    note varchar(100),
    technique varchar(200),
    imdb float,
    users varchar(10)
);

Bulk insert tabla1
from 'C:\Users\Dani\OneDrive - Universidad Técnica Federico Santa María\2024-1\INF239 - Bases de Datos\tareas\Tarea1\Animated_Tv_Series.csv'
with
(
    keepnulls,
    format = 'CSV',
    firstrow = 2,
    fieldterminator = ',',
    rowterminator = '\n',
    tablock
);

create table tabla2(
    title varchar(100),
    released_year float,
    rated_class varchar(20),
    runtime varchar(20),
    stars float,
    total_ratings varchar(20),
    genre varchar(200),
    summary varchar(400)
);

Bulk insert tabla2
from 'C:\Users\Dani\OneDrive - Universidad Técnica Federico Santa María\2024-1\INF239 - Bases de Datos\tareas\Tarea1\final_movies.csv'
with
(
    keepnulls,
    format = 'CSV',
    firstrow = 2,
    fieldterminator = ',',
    rowterminator = '\n',
    tablock
);