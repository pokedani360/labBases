<?php
    require 'db_config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <title> Tours </title>
</head>
    
<?php
    $consulta = $conn->query("SELECT * FROM tours");
    while ($row = $consulta->fetch_array()) {
        echo 'destino: '. $row['destino'].'<br>'.
        'transporte: '. $row['medio_transporte']. '<br>'.
        'disponible desde: '. $row ['fecha_inicio']. ' '.
        'hasta: '. $row['fecha_final'].'<br>';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagen']) . '"><br>';
        echo '<a href="reserva_tour.php?destino=' . $row['destino'] . '&medio_transporte=' . $row['medio_transporte'] . '&fecha_inicio=' . $row['fecha_inicio'] . '&fecha_final=' . $row['fecha_final'] . '">Reservar tour</a><br>';
    }
    $conn->close();
?>

