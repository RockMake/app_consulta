<?php
// Incluir el archivo de configuración de la base de datos
include_once '../db/config.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $numero_identificacion = $_POST['numero_identificacion'];
    $correo_electronico = $_POST['correo_electronico'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $sexo = $_POST['sexo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $departamento_residencia = $_POST['departamento_residencia'];
    $municipio_residencia = $_POST['municipio_residencia'];
    $direccion_residencia = $_POST['direccion_residencia'];
    $telefono_celular = $_POST['telefono_celular'];
    $contrasena = $_POST['contrasena'];
    $grupo_etnico = $_POST['grupo_etnico'];
    $grupo_sisben = $_POST['grupo_sisben'];
    $discapacidad = isset($_POST['discapacidad']) ? $_POST['discapacidad'] : '';
    $tipo_discapacidad = isset($_POST['tipo_discapacidad']) ? $_POST['tipo_discapacidad'] : '';
    $estado_civil = $_POST['estado_civil'];
    $victima_conflicto_armado = $_POST['victima_conflicto_armado'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO Usuarios (tipo_identificacion, numero_identificacion, correo_electronico, nombres, apellidos, sexo, fecha_nacimiento, departamento_residencia, municipio_residencia, direccion_residencia, telefono_celular, contrasena, grupo_etnico, grupo_sisben, discapacidad, tipo_discapacidad, estado_civil, victima_conflicto_armado) VALUES ('$tipo_identificacion', '$numero_identificacion', '$correo_electronico', '$nombres', '$apellidos', '$sexo', '$fecha_nacimiento', '$departamento_residencia', '$municipio_residencia', '$direccion_residencia', '$telefono_celular', '$contrasena', '$grupo_etnico', '$grupo_sisben', '$discapacidad', '$tipo_discapacidad', '$estado_civil', '$victima_conflicto_armado')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - AppConsulta</title>
    <link rel="stylesheet" href="/css/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 class="card-header">Formulario de Registro</h1>
            <form method="post" action="registro.php">
                <div class="form-group">
                    <select class="form-control" name="tipo_identificacion" title="Tipo de identificacion">
                        <option value="">Tipo de identificacion</option>
                        <option value="cc">Cedula de Ciudadania</option>
                        <option value="ti">Tarjeta de identidad</option>
                        <option value="rc">Registro civil</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="numero_identificacion" placeholder="Número de identificación">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="correo_electronico" placeholder="Correo Electrónico">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="nombres" placeholder="Nombres">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                </div>
                <div class="form-group">
                    <select class="form-control" name="sexo" title="Sexo">
                        <option value="">Sexo</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" name="fecha_nacimiento" placeholder="Fecha de nacimiento">
                </div>
                <div class="form-group">
                    <select class="form-control" name="departamento_residencia" title="Departamento de residencia">
                        <option value="">Departamento de residencia</option>
                        <option value="amazonas">Amazonas</option>
                        <option value="antioquia">Antioquia</option>
                        <option value="arauca">Arauca</option>
                        <option value="atlantico">Atlántico</option>
                        <option value="bolivar">Bolívar</option>
                        <option value="boyaca">Boyacá</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="municipio_residencia" placeholder="Municipio de residencia">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="direccion_residencia" placeholder="Dirección de residencia">
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" name="telefono_celular" placeholder="Teléfono celular">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="contrasena" placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="grupo_etnico" placeholder="Grupo étnico">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="grupo_sisben" placeholder="Grupo Sisben">
                </div>
                <div class="form-group">
                    <select class="form-control" name="discapacidad" id="discapacidad" onchange="mostrarTipoDiscapacidad()" title="¿Tiene alguna discapacidad?">
                        <option value="">¿Tiene alguna discapacidad?</option>
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-group" id="tipoDiscapacidad">
                    <input type="text" class="form-control" name="tipo_discapacidad" placeholder="Tipo de discapacidad">
                </div>
                <div class="form-group">
                    <select class="form-control" name="estado_civil" title="Estado Civil">
                        <option value="">Estado Civil</option>
                        <option value="soltero">Soltero</option>
                        <option value="casado">Casado</option>
                        <option value="divorciado">Divorciado</option>
                        <option value="viudo">Viudo</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="victima_conflicto_armado" title="Select an option">
                        <option value="">¿Es usted víctima del conflicto armado?</option>
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
                <p class="mt-3">¿ya tienes una cuenta ? <a href="login.php">Inicia sesion</a>.</p>
            </form>
        </div>
    </div>

    <script>
        function mostrarTipoDiscapacidad() {
            var seleccion = document.getElementById("discapacidad").value;
            var tipoDiscapacidad = document.getElementById("tipoDiscapacidad");

            if (seleccion === "si") {
                tipoDiscapacidad.style.display = "block";
            } else {
                tipoDiscapacidad.style.display = "none";
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>