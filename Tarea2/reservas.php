<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reserva</title>
</head>
<body>
    <h2>reserva</h2>
    <?php
    require 'db_config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rut= $_POST["rut_huesped"];
        $num= $_POST["numero_habitacion"];
        $checkIn= $_POST["fecha_checkin"];
        $checkOut= $_POST["fecha_checkout"];
    
        $sql = "INSERT INTO reservas(rut_huesped, numero_habitacion, fecha_checkin, fecha_checkout)
        SELECT '$rut', '$num', '$checkIn', '$checkOut'
        FROM dual
        WHERE NOT EXISTS (
            SELECT 1 FROM reservas
            WHERE numero_habitacion = '$num' 
            AND (
                (fecha_checkin <= '$checkOut' AND fecha_checkout >= '$checkIn') OR
                (fecha_checkin BETWEEN '$checkIn' AND '$checkOut') OR
                (fecha_checkout BETWEEN '$checkIn' AND '$checkOut')
            )
        ) LIMIT 1";

        if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
            echo "Reserva realizada correctamente.";
        } else {
            echo "No se pudo realizar la reserva.";
        }
    }
    $conn->close();    
    ?>

</body>

