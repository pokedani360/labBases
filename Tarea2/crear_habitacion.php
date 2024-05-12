<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Habitación</title>
    <script>
        function actualizarPrecio() {
            var tipoHabitacion = document.getElementById("tipo_habitacion").value;
            var precioNoche = document.getElementById("precio_noche");

            switch (tipoHabitacion) {
                case "single":
                    precioNoche.value = 20000;
                    break;
                case "double":
                    precioNoche.value = 30000;
                    break;
                case "king":
                    precioNoche.value = 40000;
                    break;
                default:
                    precioNoche.value = "";
                    break;
            }
        }
    </script>
</head>
<body>
    <h1>Crear una Nueva Habitación</h1>
    <?php
    require 'db_config.php';

    $mensaje = "";
    $numero_habitacion = "";
    $tipo_habitacion = "";
    $habitacionDisponible = true;

    // Este código se ejecutará cuando se envíe el formulario de comprobación
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['comprobar'])) {
            // Recuperar el número de habitación del formulario
            if (isset($_POST['numero_habitacion'])) {
                // Procesar la entrada del formulario
                $numero_habitacion = $_POST['numero_habitacion'];

                // Verificar si el número de habitación ya existe en la base de datos
                $consulta_existencia = $conn->prepare("SELECT id_habitacion FROM habitaciones WHERE numero_habitacion = ?");
                $consulta_existencia->bind_param("i", $numero_habitacion);
                $consulta_existencia->execute();
                $resultado_existencia = $consulta_existencia->get_result();

                if ($resultado_existencia->num_rows > 0) {
                    $mensaje = "El número de habitación ya existe. Por favor, elige otro número.";
                    $habitacionDisponible = true;
                } else {
                    $mensaje = "El número de habitación está disponible.";
                    $habitacionDisponible = false;
                }

                // Cerrar la consulta de existencia
                $consulta_existencia->close();
            } else {
                // Mostrar un mensaje de error o tomar alguna otra acción
                $mensaje = "El número de habitación no se ha proporcionado.";
            }
        }

        if (isset($_POST['crear_habitacion'])) {
            $numero_habitacion = $_POST['numero_habitacion'];
            $tipo_habitacion = $_POST['tipo_habitacion'];
            $precio_noche = $_POST['precio_noche'];

            // Verificar que el número de habitación no esté vacío
            if (!empty($numero_habitacion)) {
                // Preparar la consulta SQL para crear la habitación
                $consulta = $conn->prepare("INSERT INTO habitaciones (numero_habitacion, tipo_habitacion, precio_noche) VALUES (?, ?, ?)");
                $consulta->bind_param("iss", $numero_habitacion, $tipo_habitacion, $precio_noche);

                // Ejecutar la consulta
                if ($consulta->execute()) {
                    $mensaje = "Nueva habitación creada con éxito.";
                    $numero_habitacion = ""; // Limpiar el número de habitación después de la creación exitosa
                    $habitacionDisponible = true;
                } else {
                    $mensaje = "Error al crear la habitación: " . $consulta->error;
                }

                // Cerrar la consulta
                $consulta->close();
            } else {
                $mensaje = "El número de habitación no puede estar vacío.";
            }
        }
    }
    ?>

    <form action="crear_habitacion.php" method="post">
        <label for="numero_habitacion">Número de Habitación:</label>
        <input type="number" id="numero_habitacion" name="numero_habitacion" value="<?php echo $numero_habitacion; ?>" <?php if (!$habitacionDisponible) echo "readonly"; ?> required>
        <button type="submit" name="comprobar">Comprobar Disponibilidad</button>

        <?php if (!$habitacionDisponible) : ?>
            <div>
                <label for="tipo_habitacion">Tipo de Habitación:</label>
                <select id="tipo_habitacion" name="tipo_habitacion" onchange="actualizarPrecio()" required>
                    <option value="" selected disabled>Selecciona un tipo</option>
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="king">King</option>
                </select>
            </div>
            <div>
                <label for="precio_noche">Precio por Noche:</label>
                <input type="number" id="precio_noche" name="precio_noche" readonly>
            </div>
            <div>
                <button type="submit" name="crear_habitacion">Crear Habitación</button>
            </div>
        <?php endif; ?>
    </form>

    <?php echo $mensaje; ?> <!-- Mostrar el mensaje de aviso -->
</body>
</html>
