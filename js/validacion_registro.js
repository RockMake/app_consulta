function validarRegistro() {
    // Obtiene los valores de los campos
    var tipoIdentificacion = document.getElementById("tipo_identificacion").value;
    var numeroIdentificacion = document.getElementById("numero_identificacion").value;
    // Agrega aquí el resto de los campos del formulario que necesites validar

    // Verifica que todos los campos obligatorios estén completos
    if (tipoIdentificacion === "" || numeroIdentificacion === "") {
        alert("Por favor, complete todos los campos obligatorios.");
        return false;
    }
    // Agrega aquí más validaciones si es necesario

    // Si todo está bien, permite el envío del formulario
    return true;
}

function mostrarTipoDiscapacidad() {
    var seleccion = document.getElementById("discapacidad").value;
    var tipoDiscapacidad = document.getElementById("tipoDiscapacidad");

    if (seleccion === "si") {
        tipoDiscapacidad.style.display = "block";
    } else {
        tipoDiscapacidad.style.display = "none";
    }
}