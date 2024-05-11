<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> >.< </title>
</head>
    <h1>Reserva tu tour</h1>
    <h2>Ingresa los datos para tu reservacion</h2>
    <form action="reserva_tour.php" method="post">
        <label for="numero_habitacion">Numero de habitacion</label><br>
        <input type="number" id="numero_habitacion" name="numero_habitacion"><br>       
        <br>
        <label for="fecha">Fecha</label><br>
        <input type="date" id="fecha" name="fecha"><br>
        <br>
        <input type="submit" value="Enviar">
    </form>
<?php
    require 'db_config.php';
    $lugar = $_GET['destino'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $habitacion = $_POST["numero_habitacion"];
        $fecha = $_POST["fecha"];
        $reserva_query = $conn->query("SELECT id_reserva FROM reservas WHERE numero_habitacion = '$habitacion' AND (fecha_checkin <= '$fecha' AND fecha_checkout >= '$fecha')");
        $row = $reserva_query->fetch_assoc();
        $h_reserva = $row['id_reserva'];
        $precio_query = $conn->query("SELECT precio_tour FROM tours WHERE destino = '$lugar'");
        $row_precio = $precio_query->fetch_assoc();
        $precio = $row_precio['precio_tour'];
        $consulta = "INSERT INTO actividades (precio, fecha, reserva_habitacion) 
        VALUES ('$precio', '$fecha', '$h_reserva')";
    
        if ($conn->query($consulta) === TRUE && $conn->affected_rows > 0) {
            echo "Tour reservado correctamente.";
        } else {
            echo "No se pudo realizar la reserva.";
        }
    }
?>
  