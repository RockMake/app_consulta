<?php include '../includes/header.php'; ?>
<?php

include_once '../db/config.php';


$status_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM Usuarios WHERE correo_electronico = '$correo_electronico' AND contrasena = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Almacenar el número de identificación del usuario en una variable de sesión
        session_start();
        $_SESSION['numero_identificacion'] = $row['numero_identificacion'];
        // Redirigir al usuario a la página resultado.php
        header('Location: resultados.php');
        exit();
    } else {
        $status_message = '<div class="alert alert-danger" role="alert">Credenciales incorrectas</div>';
    }
    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status_message = '<div class="alert alert-danger" role="alert">Por favor, complete todos los campos</div>';
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Estilos personalizados -->
    <!-- <link rel="stylesheet" href="../css/style_login.css"> -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 class="card-header">Iniciar Sesión</h1>
            <form method="post" action="login.php">
                <?php echo $status_message; ?>
                <div class="form-group">
                    <input type="email" class="form-control" name="correo_electronico" placeholder="Correo Electrónico">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="contrasena" placeholder="Contraseña">
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                <p class="sm-3">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>