<?php
session_start();

if (!isset($_SESSION['numero_identificacion'])) {
    header("Location: login.php");
    exit();
}
include_once '../db/config.php';

$numero_identificacion = $_SESSION['numero_identificacion'];

$sql = "SELECT * FROM Usuarios WHERE numero_identificacion = '$numero_identificacion'";
$result = $conn->query($sql);

$resultadosProgramas = '';

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Obtener los datos necesarios para la validación
    $fecha_nacimiento = $row['fecha_nacimiento'];
    $grupo_sisben = $row['grupo_sisben'];
    $sexo = $row['sexo'];


    // Calcular la edad del usuario
    $fecha_actual = new DateTime();
    $fecha_nacimiento = new DateTime($fecha_nacimiento);
    $edad = $fecha_actual->diff($fecha_nacimiento)->y;

    // Validación para Colombia Mayor
    $edad_minima_pension = 54; // Para mujeres
    if ($sexo == 'masculino') {
        $edad_minima_pension = 59; // Para hombres
    }

    $cumple_edad_colombia_mayor = ($edad >= ($edad_minima_pension - 3));

    // Validación para Renta Joven
    $cumple_edad_renta_joven = ($edad >= 14 && $edad <= 28 && $grupo_sisben != '');

    // Validación para Renta Ciudadana
    $cumple_renta_ciudadana = ($grupo_sisben >= 'A1' && $grupo_sisben <= 'B7');


    // Mostrar resultado para Colombia Mayor
    if ($cumple_edad_colombia_mayor) {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>
                    ¡Felicidades! Cumple con los requisitos para el programa 'Colombia Mayor'.
                </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
                    Lo sentimos, no cumple con los requisitos para el programa 'Colombia Mayor'.
                </div>";
    }

    // Mostrar resultado para Renta Joven
    if ($cumple_edad_renta_joven) {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>
                    ¡Felicidades! Cumple con los requisitos para el programa 'Renta Joven'.
                </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
                    Lo sentimos, no cumple con los requisitos para el programa 'Renta Joven'.
                </div>";
    }

    // Mostrar resultado para Renta Ciudadana
    if ($cumple_renta_ciudadana) {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>
                    ¡Felicidades! Cumple con los requisitos para el programa 'Renta Ciudadana'.
                </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
                    Lo sentimos, no cumple con los requisitos para el programa 'Renta Ciudadana'.
                </div>";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - AppConsulta</title>
    <link rel="stylesheet" href="../css/styles_resultado.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Programas de Beneficios</h1>
        <?php echo $resultadosProgramas; ?>
        <div class="programs-info">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>