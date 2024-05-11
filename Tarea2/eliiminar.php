<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <title> Eliminar </title>
</head>    
<body>
    <h1>Ingresa los datos para tu reserva</h1>
    <form action="eliiminar.php" method="post">
        <label for="numero_habitacion">Número de habitación</label><br>
        <input type="digit" id="numero_habitacion" name="numero_habitacion"><br>
        <br>
        <label for="fecha_checkin">Check-in</label><br>
        <input type="date" id="fecha_checkin" name="fecha_checkin"><br>
        <br>
        <label for="fecha_checkout">Check-out</label><br>
        <input type="date" id="fecha_checkout" name="fecha_checkout"><br>
        <br>
        <input type="submit" value="Enviar">
        </form>
        <?php
        require 'db_config.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num= $_POST["numero_habitacion"];
            $checkIn= $_POST["fecha_checkin"];
            $checkOut= $_POST["fecha_checkout"];
            $sql = "DELETE FROM reservas WHERE `reservas`.`numero_habitacion` = '$num' AND `reservas`.`fecha_checkin` = '$checkIn'
            AND`reservas`.`fecha_checkout` = '$checkOut'";
            if ($conn->query($sql)){
                echo "Reserva eliminada correctamente.";
            } else {
                echo "Error al realizar la reserva: " . $conn->error;
            }
        
        }
        $conn->close();

        ?>
</body>
</html>