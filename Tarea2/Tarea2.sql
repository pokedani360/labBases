CREATE TABLE habitaciones (
    id_habitacion INT AUTO_INCREMENT PRIMARY KEY,
    numero_habitacion INT UNIQUE,
    tipo_habitacion VARCHAR(50),
    precio_noche INT
);

CREATE TABLE reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    rut_huesped VARCHAR(8) NOT NULL,
    numero_habitacion INT,
    fecha_checkin DATE NOT NULL,
    fecha_checkout DATE NOT NULL,
    FOREIGN KEY (numero_habitacion) REFERENCES habitaciones(numero_habitacion)
);

CREATE TABLE valoraciones (
    id_valoracion INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva INT,
    numero_habitacion INT,
    nombre_persona VARCHAR(100),
    valoracion DECIMAL(3,1),
    comentario VARCHAR(300),
    FOREIGN KEY (id_reserva) REFERENCES reservas(id_reserva),
    FOREIGN KEY (numero_habitacion) REFERENCES habitaciones(numero_habitacion)
);

CREATE TABLE tour(
    id_tour INT PRIMARY KEY,
    fecha_inicio DATE,
    fecha_final DATE,
    destino VARCHAR(50),
    medio_transporte VARCHAR(50),
    imagen LONGBLOB,
    precio_tour INT
);


CREATE TABLE actividades (
    id_actividad INT AUTO_INCREMENT PRIMARY KEY,
    reserva_habitacion INT,
    precio INT,
    FOREIGN KEY (reserva_habitacion) REFERENCES reservas(id_reserva),
    FOREIGN KEY (precio) REFERENCES tour(precio_tour)
);

