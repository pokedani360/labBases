<?php
    require 'db_config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <title> Busqueda </title>
</head>
<body>
    <h1>Revisa la disponibilidad de la habitacion </h1>
    <form action = "" method = "GET">
        <input type = "number" name = "numero"><br><br>
        <input type = "submit" name = "Buscar" value = "Buscar">
    </form>
    <br><br><br>
</body>
<?php
    if (isset($_GET['Buscar'])) {
        $num= $_GET["numero"];
        $consulta = $conn->query("SELECT * FROM habitaciones WHERE numero_habitacion LIKE '$num'");
        while ($row = $consulta->fetch_array()) {
            echo 'habitacion: '. $row['numero_habitacion'].'<br>'.
            ' tipo: '. $row['tipo_habitacion']. '<br>'.
            'precio: '. $row['precio_noche']. '<br>';
        }
        echo '<br>';
        $consulta2 = $conn->query("SELECT * FROM reservas WHERE numero_habitacion LIKE '$num'");
        while ($row2 = $consulta2->fetch_array()) {
            echo "reservada desde: <br>". $row2["fecha_checkin"]."<br>".
            'hasta: <br>'. $row2["fecha_checkout"]."<br><br>";
        }
        echo '<button onclick="window.location.href=\'reserva.html\'">Reservar</button>';
    }
    $conn->close();
?>