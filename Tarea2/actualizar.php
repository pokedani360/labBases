<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizacion</title>
</head>
<body>
    <h2>:3</h2>
    <?php
        require 'db_config.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero= $_POST["numero_habitacion"];
            $check_in= $_POST["fecha_checkin"];
            $check_out= $_POST["fecha_checkout"];
            $numero2= $_POST["numero_habitacion2"];
            $check_in2= $_POST["fecha_checkin2"];
            $check_out2= $_POST["fecha_checkout2"];
            $sql = "UPDATE reservas SET numero_habitacion ='$numero2', fecha_checkin = '$check_in2', fecha_checkout = '$check_out2'
            WHERE numero_habitacion ='$numero' AND fecha_checkin = '$check_in' AND fecha_checkout = '$check_out'";

            if ($conn->query($sql) === TRUE) {
                echo "La reserva se actualizó correctamente.";
            } else {
                echo "Error al actualizar la reserva: " . $conn->error;
            }
            
        }
        $conn->close();
    ?> 
</body>
