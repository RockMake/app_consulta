<?php include '../includes/header.php'; ?>
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

    $fecha_nacimiento = $row['fecha_nacimiento'];
    $grupo_sisben = $row['grupo_sisben'];
    $sexo = $row['sexo'];
    $victima_conflicto_armado = $row['victima_conflicto_armado'];
    $discapacidad = $row['discapacidad'];

    $fecha_actual = new DateTime();
    $fecha_nacimiento = new DateTime($fecha_nacimiento);
    $edad = $fecha_actual->diff($fecha_nacimiento)->y;

    $edad_minima_pension = 54; // Para mujeres
    if ($sexo == 'masculino') {
        $edad_minima_pension = 59; // Para hombres
    }

    $cumple_edad_colombia_mayor = ($edad >= ($edad_minima_pension - 3) && $grupo_sisben <= 'C1');
    $cumple_edad_renta_joven = ($edad >= 14 && $edad <= 28 && $grupo_sisben != '');
    $cumple_renta_ciudadana = ($grupo_sisben >= 'A1' && $grupo_sisben <= 'B7');

    if ($cumple_edad_colombia_mayor) {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>
            ¡Felicidades! Cumple con la edad y con el Sisben ICV para el programa 'Colombia Mayor'.<br><br>
            Descripción del programa: El programa 'Colombia Mayor' busca proteger a los adultos mayores de 54 años (mujeres) o 59 años (hombres) que se encuentran en situación de pobreza extrema, pobreza o vulnerabilidad, y que no cuentan con una pensión ni posibilidad de obtenerla.
        </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
            Lo sentimos, no cumple con la edad para el programa 'Colombia Mayor'.
        </div>";
    }

    if ($cumple_renta_ciudadana) {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>
            ¡Felicidades! usted puede ser posible beneficiario para el programa 'Renta Ciudadana'.<br><br>
            Descripción del programa: 'Renta Ciudadana' busca garantizar un ingreso básico para las familias en situación de pobreza extrema y vulnerabilidad, clasificadas en los grupos A y B del Sisbén.
        </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
            Lo sentimos, no cumple con los requisitos para el programa 'Renta Ciudadana'.
        </div>";
    }

    if ($victima_conflicto_armado == 'si') {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>
            ¡Felicidades! Cumple con los requisitos para el programa 'Asistencia Integral a las Víctimas del Conflicto Armado'.<br><br>
            Descripción del programa: Este programa brinda apoyo económico, social y psicológico a las personas que han sido víctimas del conflicto armado en Colombia, ayudándoles en su proceso de recuperación y reintegración.
        </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
            Lo sentimos, no cumple con los requisitos para el programa 'Asistencia Integral a las Víctimas del Conflicto Armado'.
        </div>";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Resultados - AppConsulta</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="text-center">Programas de Beneficios</h1>
        <?php echo $resultadosProgramas; ?>
        <div class="text-center mt-4">
            <button id="logout" class="btn btn-danger">Cerrar Sesión</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.getElementById('logout').addEventListener('click', function() {
            window.location.href = 'login.php';
        });
    </script>
</body>

</html>