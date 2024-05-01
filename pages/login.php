<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="style_login.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">¡Bienvenido a AppConsulta!</h1>
        <div class="card">
            <h2 class="card-header">Iniciar Sesión</h2>
            <form>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Correo Electrónico">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña">
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
            <p class="mt-3">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>