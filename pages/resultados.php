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

    // Obtener los datos necesarios para la validación
    $fecha_nacimiento = $row['fecha_nacimiento'];
    $grupo_sisben = $row['grupo_sisben'];
    $sexo = $row['sexo'];
    $victima_conflicto_armado = $row['victima_conflicto_armado'];
    $discapacidad = $row['discapacidad'];


    // Calcular la edad del usuario
    $fecha_actual = new DateTime();
    $fecha_nacimiento = new DateTime($fecha_nacimiento);
    $edad = $fecha_actual->diff($fecha_nacimiento)->y;


    // Validación para Colombia Mayor
    $edad_minima_pension = 54; // Para mujeres
    if ($sexo == 'masculino') {
        $edad_minima_pension = 59; // Para hombres
    }

    $cumple_edad_colombia_mayor = ($edad >= ($edad_minima_pension - 3) && $grupo_sisben <= 'C1');

    // Validación para Renta Joven
    $cumple_edad_renta_joven = ($edad >= 14 && $edad <= 28 && $grupo_sisben != '');

    // Validación para Renta Ciudadana
    $cumple_renta_ciudadana = ($grupo_sisben >= 'A1' && $grupo_sisben <= 'B7');




    // Mostrar resultado para Colombia Mayor
    if ($cumple_edad_colombia_mayor) {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>

                    ¡Felicidades! Cumple con la edad y con el Sisben ICV para el programa 'Colombia Mayor'.<br><br>
            
                    Descripcion del programa:<br>
                    El Programa de Protección Social al Adulto Mayor “Colombia Mayor” busca aumentar la protección a los 
                    adultos mayores por medio de la entrega de un subsidio económico para aquellos que se encuentran 
                    desamparados, que no cuentan con una pensión, o viven en la extrema pobreza.<br><br>

                    Para inscribirse el adulto debe cumplir con los siguientes requisitos:<br>
                    -Ser colombiano.<br>
                    -Haber residido durante los últimos diez (10) años en el territorio nacional.<br>
                    -Tener mínimo tres años menos de la edad que se requiere para pensionarse por vejez (Cumple)<br>
                    -Carecer de rentas o ingresos suficientes para subsistir. De acuerdo con SISBÉN IV, se toman todos los 
                    niveles de los grupos A y B y C hasta el subgrupo C1.<br><br>
                    ¿Cómo me puedo inscribir en el programa Colombia Mayor?<br>
                    1. Ubicar el punto de atención:<br>
                    -Acércate a la alcaldía de tu municipio con tu cédula de ciudadanía original.<br>
                    -En la mayoría de los municipios, el trámite se realiza en la Oficina de Atención al Adulto Mayor.<br>
                    -En Bogotá, la inscripción se adelanta en las Subdirecciones Locales de la Secretaría de Integración
                    Social, antiguos COL.<br><br>
            
                    2. Presentar la documentación requerida:<br>
                    -Cédula de ciudadanía original del adulto mayor.<br>
                    -Un poder notarial en caso de que el trámite lo realice un tercero.<br>
                    -Certificado de defunción del cónyuge, si es el caso.<br><br>

                    Información adicional:<br><br>

                        -Línea de atención gratuita: 192<br>
                        -Página web del programa Colombia Mayor:
                         <a href= https://prosperidadsocial.gov.co/Noticias/category/colombia-mayor/>Página web </a><br><br>
                        Recuerda:<br><br>
                        
                        -El programa Colombia Mayor es gratuito.<br>
                        -No es necesario contar con intermediarios para realizar la inscripción.<br>
                        -Puedes verificar el estado de tu solicitud en la página web del programa.<br>

                </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
                    Lo sentimos, no cumple con la edad para el programa 'Colombia Mayor'.
                </div>";
    }

    /* Mostrar resultado para Renta Joven
    if ($cumple_edad_renta_joven) {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>
                    ¡Felicidades! Cumple con los requisitos para el programa 'Renta Joven'.<br><br>

                    
                </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
                    Lo sentimos, no cumple con los requisitos para el programa 'Renta Joven'.
                </div>";
    }
    */

    // Mostrar resultado para Renta Ciudadana
    if ($cumple_renta_ciudadana) {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>
                    ¡Felicidades! usted puede ser posible beneficiario para el programa 'Renta Ciudadana'.<br><br>

                    Descripción del programa:<br>
                    La Renta Ciudadana es un programa comandado por el Departamento de Prosperidad Social que busca 
                    ayudar a los hogares en situación de pobreza extrema y moderada, quienes recibirán ingresos de 
                    hasta $500.000 que les permitan superar al hambre, la línea de pobreza y romper las brechas de desigualdad.

                    Su implementación se llevará a cabo de manera gradual y progresiva a través de diversas líneas de intervención.<br><br>

                    Requisitos:<br>
                    -Encuestados por el Sisbén que estén en grupos (A1-A5) y beneficiarios cada año (B1-B7).<br>
                    -Madre cabezas de hogar que tengan niños y niñas menores de 6 años.<br>
                    -Personas con discapacidad que requieran atención permanente.<br>
                    -La prioridad del municipio donde se registró la familia.<br>
                    -Características poblacionales (que sea hogar víctima de desplazamiento o perteneciente a una comunidad indígena).<br>
                    -Cumplimiento de corresponsabilidades en salud y educación.<br><BR>

                    Consulte para saber si eres benefiario:
                    <a href= https://rentaciudadana.prosperidadsocial.gov.co/>Consulta aqui. </a><br><br>

                    Información adicional:<br><br>

                    -Atención al Ciudadano: 01-8000-95-1100 (Línea Gratuita Nacional)<br>
                    -Página web del programa Renta Ciudadana:
                     <a href= https://prosperidadsocial.gov.co/sgpp/transferencias/renta-ciudadana/>Página web </a><br><br>

                    Recuerda:<br><br>
                    
                    -El programa Colombia Mayor es gratuito.<br>
                    -. El programa Renta Ciudadana no tiene un proceso de inscripción abierto al público. En lugar de eso, es la 
                    entidad Prosperidad Social la que se encarga de la identificación, selección y vinculación de los hogares 
                    potenciales beneficiarios a través de registros administrativos de las fuentes oficiales que sean definidas1. 
                    Por lo tanto, no es necesario que los hogares se inscriban por sí mismos.<br>
                    


                </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
                    Lo sentimos, no cumple con ninguno requisitos para el programa 'Renta Ciudadana'.<br><br>

                    Aunque hay una pequeña posibilidad de que pueda ser beneficiario.
                    <a href= https://rentaciudadana.prosperidadsocial.gov.co/>Consulta aqui. </a><br>
                </div>";
    }
    // Mostrar resultado para el programa Asistencia Integral a las Víctimas del Conflicto Armado 
    if ($victima_conflicto_armado == 'si') {
        $resultadosProgramas .= "<div class='alert alert-success' role='alert'>
        ¡Felicidades! Cumple con los requisitos para el programa 'Asistencia Integral a las Víctimas del Conflicto Armado '.<br><br>
        
        Descripción del programa:<br>   

        El Programa Nacional de Asistencia Integral a las Víctimas del Conflicto Armado (PNAIV) desempeña un papel 
        crucial en la promoción del bienestar y la recuperación de las víctimas del conflicto armado en Colombia. 
        A través de sus acciones y actividades, el programa contribuye a mitigar el impacto del conflicto en la vida de 
        las víctimas, promover su reintegración en la sociedad y construir una cultura de paz y reconciliación en el país. 
        Sin embargo, aún existen desafíos pendientes, como la necesidad de ampliar el alcance y la cobertura del programa, 
        mejorar la coordinación entre las instituciones involucradas y garantizar la sostenibilidad a largo plazo de las 
        iniciativas implementadas.<br><br>
        
        A través de este programa, se proporciona apoyo financiero a las víctimas del conflicto para que puedan cursar programas 
        académicos en niveles técnico, tecnológico y profesional en instituciones de educación superior reconocidas por el 
        Ministerio de Educación Nacional. Este apoyo incluye créditos educativos condonables que cubren hasta el 100% del valor 
        de la matrícula por semestre, así como recursos de sostenimiento y permanencia para garantizar la continuidad de los
        estudios.<br><br>
        Finalmente, los créditos educativos otorgados a través de este fondo se condonan una vez que los beneficiarios culminan 
        satisfactoriamente sus estudios y cumplen con los compromisos establecidos en la estrategia de acompañamiento 
        'Construyendo mi Futuro', diseñada para apoyar su permanencia y graduación en la educación superior.<br><br>

        Requisitos:<br>
        -Ser ciudadano/a colombiano/a<br>
        -Estar incluido en el Registro Único de Víctimas (RUV) o ser reconocido en procesos de Restitución de Tierras, Justicia y Paz, 
        Jurisdicción Especial para la Paz o de la Corte Interamericana de Derechos Humanos.<br>
        -No tener apoyo económico adicional de entidades nacionales u otros organismos para adelantar estudios de educación superior en 
        el nivel universitario.<br>
        -No tener título de nivel universitario
        -Estar admitido o en proceso de admisión en una Institución de Educación Superior reconocida por el Ministerio de Educación Nacional<br>
        -Haber presentado la prueba Saber 11 o la prueba de estado equivalente<br><br>





        
    </div>";
    } else {
        $resultadosProgramas .= "<div class='alert alert-danger' role='alert'>
        Lo sentimos, no cumple con los requisitos para el programa 'Asistencia Integral a las Víctimas del Conflicto Armado '.
    </div>";
    }
}
$conn->close();
?>
<!DOCTYPE html>

<head>
    <title>Resultados - AppConsulta</title>
    <link rel="stylesheet" href="../css/styles_resultado.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Programas de Beneficios</h1>
        <!-- Preguntar a Duvan -->
        <div class="programs-info">
            <?php echo $resultadosProgramas; ?>
        </div>
        <!-- Redirigir al usuario a la página login.php -->
        <button id="logout" class="btn btn-danger">Cerrar Sesión</button>



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