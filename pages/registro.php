<?php
$status_message2 = '';
include_once '../db/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $sql = "INSERT INTO Usuarios (tipo_identificacion, numero_identificacion, correo_electronico, nombres, apellidos, sexo, fecha_nacimiento, departamento_residencia, municipio_residencia, direccion_residencia, telefono_celular, contrasena, grupo_etnico, grupo_sisben, discapacidad, tipo_discapacidad, estado_civil, victima_conflicto_armado) VALUES ('$tipo_identificacion', '$numero_identificacion', '$correo_electronico', '$nombres', '$apellidos', '$sexo', '$fecha_nacimiento', '$departamento_residencia', '$municipio_residencia', '$direccion_residencia', '$telefono_celular', '$contrasena', '$grupo_etnico', '$grupo_sisben', '$discapacidad', '$tipo_discapacidad', '$estado_civil', '$victima_conflicto_armado')";

    if ($conn->query($sql) === TRUE) {
        $status_message2 = '<div class="alert alert-success" role="alert">Usuario registrado correctamente</div>';
    } else {
        $status_message2 = '<div class="alert alert-danger" role="alert">Error al registrar el usuario: ' . $conn->error . '</div>';
    }


    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mostrar un mensaje de error si los campos están vacíos
    $status_message2 = '<div class="alert alert-danger" role="alert">Por favor, complete todos los campos</div>';
}
?>
<!DOCTYPE html>

<head>
    <title>Registro - AppConsulta</title>
    <link rel="stylesheet" href="../css/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 class="card-header">Formulario de Registro</h1>
            <!-- Comienzo del formulario -->
            <form method="post" action="registro.php">
                <?php echo $status_message2; ?>
                <!-- Tipo de identificacion del usuario-->
                <div class="form-group">
                    <select class="form-control" name="tipo_identificacion" title="Tipo de identificacion">
                        <option value="">Tipo de identificacion</option>
                        <option value="cc">Cedula de Ciudadania</option>
                        <option value="ti">Tarjeta de identidad</option>
                        <option value="rc">Registro civil</option>
                        <option calue="ps">Pasaporte</option>
                        
                    </select>
                </div>
                 <!-- Numero de identificacion del usuario-->
                <div class="form-group">
                    <input type="text" class="form-control" name="numero_identificacion" placeholder="Número de identificación">
                </div>
                 <!-- Correro del usuario -->
                <div class="form-group">
                    <input type="email" class="form-control" name="correo_electronico" placeholder="Correo Electrónico">
                </div>
                <!-- Nombres del usuario -->
                <div class="form-group">
                    <input type="text" class="form-control" name="nombres" placeholder="Nombres">
                </div>
                <!-- Apellidos del usuario -->
                <div class="form-group">
                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                </div>
                <!-- sexo del usuario -->
                <div class="form-group">
                    <select class="form-control" name="sexo" title="Sexo">
                        <option value="">Sexo</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>
                <!-- Fecha de nacimiento-->
                <div class="form-group">
                    <input type="date" class="form-control" name="fecha_nacimiento" placeholder="Fecha de nacimiento">
                </div>
                <!-- Departamento de residencia-->
                <div class="form-group">
                <select class="form-control" name="departamento_residencia" title="Departamento de residencia">
                <option value="">Departamento de residencia</option>
                <option value="amazonas">Amazonas</option>
                <option value="antioquia">Antioquia</option>
                <option value="arauca">Arauca</option>
                <option value="atlantico">Atlántico</option>
                <option value="bolivar">Bolívar</option>
                <option value="boyaca">Boyacá</option>
                <option value="caldas">Caldas</option>
                <option value="caqueta">Caquetá</option>
                <option value="casanare">Casanare</option>
                <option value="cauca">Cauca</option>
                <option value="cesar">Cesar</option>
                <option value="choco">Chocó</option>
                <option value="cordoba">Córdoba</option>
                <option value="cundinamarca">Cundinamarca</option>
                <option value="guainia">Guainía</option>
                <option value="guaviare">Guaviare</option>
                <option value="huila">Huila</option>
                <option value="laguajira">La Guajira</option>
                <option value="magdalena">Magdalena</option>
                <option value="meta">Meta</option>
                <option value="narino">Nariño</option>
                <option value="nortedesantander">Norte de Santander</option>
                <option value="putumayo">Putumayo</option>
                <option value="quindio">Quindío</option>
                <option value="risaralda">Risaralda</option>
                <option value="sanandresyprovidencia">San Andrés y Providencia</option>
                <option value="santander">Santander</option>
                <option value="sucre">Sucre</option>
                <option value="tolima">Tolima</option>
                <option value="valledelcauca">Valle del Cauca</option>
                <option value="vaupes">Vaupés</option>
                <option value="vichada">Vichada</option>
            </select>
                <!-- Municipio de Residencia -->
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="municipio_residencia" placeholder="Municipio de residencia">
                </div>
                <!-- Dirrecion_Residencia -->
                <div class="form-group">
                    <input type="text" class="form-control" name="direccion_residencia" placeholder="Dirección de residencia">
                </div>
                <!-- Telefono celular -->
                <div class="form-group">
                    <input type="tel" class="form-control" name="telefono_celular" placeholder="Teléfono celular">
                </div>
                <!-- Contraseña -->
                <div class="form-group">
                    <input type="password" class="form-control" name="contrasena" placeholder="Contraseña">
                </div>
                <!-- Grupo Etnico -->
                <div class="form-group ">
                    <select class="form-control" name="grupo_etnico" title="Grupo Etnico">
                        <option value="">Grupo Etnico</option>
                        <option value="narp">Comunidades Negras, Afrocolombianas, Raizales y Palenqueras (NARP)</option>
                        <option value="pueblo_indigena">Pueblo Indigena</option>
                        <option value="pueblo_rrom_gitano">Pueblo Rrom o Gitano</option>
                        <option value="ninguno">Ninguno</option>
                    </select>
                </div>
                <!-- Ponemos el hasta el grupo de sisben , ya que es hasta donde llega el programa de colombia mayor, 
                el resto de programas esta por debajo de ese umbral-->
                <div class="form-group">
                    <select class="form-control" name="grupo_sisben" title="Grupo Sisben IV">
                        <option value="">Grupo Sisben IV</option>
                        <option value="A1">GRUPO A1</option>
                        <option value="A2">GRUPO A2</option>
                        <option value="A3">GRUPO A3</option>
                        <option value="A4">GRUPO A4</option>
                        <option value="A5">GRUPO A5</option>
                        <option value="B1">GRUPO B1</option>
                        <option value="B2">GRUPO B2</option>
                        <option value="B3">GRUPO B3</option>
                        <option value="B4">GRUPO B4</option>
                        <option value="B5">GRUPO B5</option>
                        <option value="B6">GRUPO B6</option>
                        <option value="B7">GRUPO B7</option>
                        <option value="C1">GRUPO C1</option>
                        <option value="C2">GRUPO C2</option>
                        <option value="C3">GRUPO C3</option>
                        <option value="C4">GRUPO C4</option>
                        <option value="C5">GRUPO C5</option>
                        <option value="C6">GRUPO C6</option>
                        <option value="C7">GRUPO C7</option>
                        <option value="C8">GRUPO C8</option>
                        <option value="C9">GRUPO C9</option>
                        <option value="C10">GRUPO C10</option>
                        <option value="C11">GRUPO C11</option>
                        <option value="C12">GRUPO C12</option>
                        <option value="C13">GRUPO C13</option>
                        <option value="C14">GRUPO C14</option>
                        <option value="C15">GRUPO C15</option>
                        <option value="C16">GRUPO C16</option>
                        <option value="C17">GRUPO C17</option>
                        <option value="C18">GRUPO C18</option>
                        <option value="otro">Otro</option>
                    </select>
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


    <script src="../js/validacion_registro.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>