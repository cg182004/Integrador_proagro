window.addEventListener("load", () => {
    // mostrar loader en pagina
    const loader = document.querySelector(".loader");
    loader.classList.add("loader-hidden");

    loader.addEventListener("transitionend", ()=>{
        loader.remove();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // crear instancia de calendarios flatpickr
    flatpickr("#datetimepicker", {
        enableTime: true,
        dateFormat: "d-m-Y h:i K",
        minDate: "today",
        minTime: "08:00",
        maxTime: "17:00",
    });
    
    flatpickr("#fechahorapicker", {
        enableTime: true,
        dateFormat: "d-m-Y h:i K",
        minDate: "today",
        minTime: "08:00",
        maxTime: "17:00",
    });

    // para las validaciones en tiempo real
    document.getElementById('datetimepicker').addEventListener('input',validarfecha);
    document.getElementById('clasificacion').addEventListener('input',validarClasf);
    document.getElementById('nombre').addEventListener('input', validarNombre);
    document.getElementById('apellidos').addEventListener('input', validarApellidos);
    document.getElementById('numero').addEventListener('input', validarNumero);
    document.getElementById('correo').addEventListener('input', validarCorreo);
    //document.getElementById('checkterm').addEventListener('input',validarCheck);

    document.getElementById('fechahorapicker').addEventListener('input', validarFechahora);
    document.getElementById('anombre').addEventListener('input', validarAnombre);
    document.getElementById('ccorreo').addEventListener('input', validarCcorreo);
});

// funciones de validaciones unitarias por campos

function validarNombre(){
    var nombre = document.getElementById('nombre').value;

    if (nombre.length < 3) {
        document.getElementById('nombreError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> El nombre debe tener al menos 3 caracteres`;
        document.getElementById('nombre').style.borderColor = "rgb(207, 19, 19)";
        document.getElementById('nombre').scrollIntoView();
    } else if (!/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ][a-zA-ZÁÉÍÓÚÜÑáéíóúüñ\s]+$/.test(nombre)) {
        document.getElementById('nombreError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> El nombre solo puede contener letras y espacios`;
        document.getElementById('nombre').scrollIntoView();
        document.getElementById('nombre').style.borderColor = "rgb(207, 19, 19)";
    } else {
        document.getElementById('nombreError').innerHTML = "";
        document.getElementById('nombre').style.borderColor = "#2980b9";
    }
}

function validarApellidos() {
    var apellidos = document.getElementById('apellidos').value;

    if (apellidos.length < 2) {
        document.getElementById('apellidosError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Los apellidos deben tener al menos 2 caracteres`;
        document.getElementById('apellidos').scrollIntoView();
        document.getElementById('apellidos').style.borderColor = "rgb(207, 19, 19)";
    } else if (!/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ][a-zA-ZÁÉÍÓÚÜÑáéíóúüñ\s]+$/.test(apellidos)) {
        document.getElementById('apellidosError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Los apellidos solo pueden contener letras y espacios`;
        document.getElementById('apellidos').scrollIntoView();
        document.getElementById('apellidos').style.borderColor = "rgb(207, 19, 19)";
    } else {
        document.getElementById('apellidosError').innerHTML = "";
        document.getElementById('apellidos').style.borderColor = "#2980b9";
    }
}

function validarNumero() {
    var numero = document.getElementById('numero').value;
    if (!/\d{3}-?\d{3}-?\d{4}$/.test(numero)) {
        document.getElementById('numeroError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> El número debe tener el formato estandard: 000-000-0000`;
        document.getElementById('numero').scrollIntoView();
        document.getElementById('numero').style.borderColor = "rgb(207, 19, 19)";
    } else {
        document.getElementById('numeroError').innerHTML = "";
        document.getElementById('numero').style.borderColor = "#2980b9";
    }
}

function validarCorreo() {
    var correo = document.getElementById('correo').value;
    var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexCorreo.test(correo)) {
        document.getElementById('correoError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Por favor, ingrese un correo electrónico válido`;
        document.getElementById('correo').scrollIntoView();
        document.getElementById('correo').style.borderColor = "rgb(207, 19, 19)";
    } else {
        document.getElementById('correoError').innerHTML = "";
        document.getElementById('correo').style.borderColor = "#2980b9";
    }
}

function validarClasf(){
    var clasificacion = document.getElementById('clasificacion').value;
    if (clasificacion === "Abre el menu de selección") {
        document.getElementById('clasificacionError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Por favor, selecciona una clasificación`;
        document.getElementById('clasificacion').focus();
        document.getElementById('clasificacion').scrollIntoView();
        document.getElementById('clasificacion').style.borderColor = "rgb(207, 19, 19)";
        $('#exampleModal').modal('hide');
    } else {
        document.getElementById('clasificacionError').innerHTML = "";
        document.getElementById('clasificacion').style.borderColor = "#2980b9";
    }
}

function validarfecha(){
    // descomponer la fecha recivida por el flatpickr en formato d-m-Y y convertirla al formato estandar para compararcion con el dia de hoy
    var datetimeInput = document.getElementById('datetimepicker').value;
    var day1 = parseInt(datetimeInput.substring(0, 2), 10);
    var month1 = parseInt(datetimeInput.substring(3, 5), 10) - 1;
    var year1 = parseInt(datetimeInput.substring(6, 10), 10);
    var datetime = new Date(year1, month1, day1);
    datetime.setHours(0,0,0,0);
    
    const fechaActual = new Date();
    fechaActual.setHours(0,0,0,0);

    if(datetimeInput === ""){
        document.getElementById('datetimeError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Por favor, seleccione una fecha y hora`;
        document.getElementById('datetimepicker').scrollIntoView();
        document.getElementById('datetimepicker').style.borderColor = "rgb(207, 19, 19)";
        $('#exampleModal').modal('hide');
    } 
    else if (datetime.getTime() <= fechaActual.getTime()){
        document.getElementById('datetimeError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Seleccione una fecha y hora válidas a partir de hoy`;
        document.getElementById('datetimepicker').scrollIntoView();
        document.getElementById('datetimepicker').style.borderColor = "rgb(207, 19, 19)";
        $('#exampleModal').modal('hide');
    } else {
        document.getElementById('datetimeError').innerHTML = "";
        document.getElementById('datetimepicker').style.borderColor = "#2980b9";

    }
}

function validarCheck(){
    var validado = true;
    var checkterm = document.getElementById('CheckTerminos').checked;
    if(!checkterm){
        document.getElementById('CheckError').innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Es necesario aceptar los términos y condiciones`;
        document.getElementById('CheckError').style.color = "rgb(207, 19, 19)";
        $('#exampleModal').modal('hide');
        validado = false;
    } else{
        document.getElementById('CheckError').innerHTML = "";
        $('#exampleModal').modal('show');
        validado = true;
    }

    return validado;
}

// desabilita boton de confirmar reserva y pone spiner de carga con font awesome
function deshabilitarboton(){
    var submitButton = document.getElementById('guardarReserva');

    submitButton.innerHTML = `<i class="fa-solid fa-circle-notch fa-spin"></i> Cargando....`;
    submitButton.disabled = true;
    submitButton.style.opacity = 0.9;
    submitButton.style.border = 'none';

    var validado = validarFormulario();

    if (validado) {
        document.getElementById('form').submit();
    } else {
        setTimeout(() =>{
            submitButton.innerHTML = "Confirmar Reserva";
            submitButton.disabled = false;
            submitButton.style.opacity = 1;
        }, 5000);
    }
}

// validacion de formulario de reserva de sesiones
function validarFormulario() {
    var validado = true;
    
    validarNombre();
    if (document.getElementById('nombreError').innerText !== "") validado = false;

    validarApellidos();
    if (document.getElementById('apellidosError').innerText !== "") validado = false;

    validarNumero();
    if (document.getElementById('numeroError').innerText !== "") validado = false;

    validarCorreo();
    if (document.getElementById('correoError').innerText !== "") validado = false;
    
    validarClasf();
    if(document.getElementById("clasificacionError").innerText !== "") validado = false;

    validarfecha();
    if(document.getElementById("datetimeError").innerText !== "") validado = false;

    validarCheck();
    if(document.getElementById("CheckError").innerHTML !=="") validado = false;

    if(!validado){
        $('#exampleModal').modal('hide');
    }
    return validado;
}

// mostrar resumen de reserva para la confirmacion
function mostrarResumen() {
    if (!validarFormulario()) {
        return false;
    }

    var datetime = document.getElementById('datetimepicker').value;
    var clasificacionSelect = document.getElementById('clasificacion');
    var clasificacion = clasificacionSelect.options[clasificacionSelect.selectedIndex].text;
    var nombre = document.getElementById('nombre').value;
    var apellidos = document.getElementById('apellidos').value;
    var numero = document.getElementById('numero').value;
    var correo = document.getElementById('correo').value;
    var valorAproxPagar = calcularValorAprox(clasificacionSelect.value);
    var extra = document.getElementById('extraPeticion').value;

    var resumenHTML = `
    <table class="table">
        <thead>
            <tr>
                <th>Información</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Cliente</strong></td>
                <td>${nombre} ${apellidos}</td>
            </tr>
            <tr>
                <td><strong>Número de Teléfono</strong></td>
                <td>${numero}</td>
            </tr>
            <tr>
                <td><strong>Correo Electrónico</strong></td>
                <td>${correo}</td>
            </tr>
            <tr>
                <td><strong>Fecha y Hora de Sesión</strong></td>
                <td>${datetime}</td>
            </tr>
            <tr>
                <td><strong>Clasificación de la Sesión</strong></td>
                <td>${clasificacion}</td>
            </tr>
            <tr>
                <td><strong>Aproximado a Pagar</strong></td>
                <td>${valorAproxPagar}</td>
            </tr>
    `;

    if (extra) {
        resumenHTML += `
            <tr>
                <td><strong>Petición Extra</strong></td>
                <td>${extra}</td>
            </tr>
        `;
    }
    
    resumenHTML += `
            </tbody>
        </table>
    `;
    
    document.getElementById('resumen').innerHTML = resumenHTML;
    
    $('#exampleModal').modal('show');
}

// atribuhir presios a las seciones seleccionadas
function calcularValorAprox(opcionSeleccionada) {
    switch (opcionSeleccionada) {
        case "Graduacion":
            return "RD$5000";
        case "Cumpleaños":
            return "RD$3000";
        case "Album Digital":
            return "RD$7000";
        case "Boda":
            return "RD$10000";
        case "15 años":
            return "RD$4000";
        case "Foto familiar":
            return "RD$1000";
        case "Foto 2x2":
            return "RD$2000";
        default:
            return "No especificado";
    }
}

//CANCELACIÓN

// mostrar mensaje de confirmacion de cancelacion 
function mostrarConfirmacion() {
    if(validarCancelacion()){
        document.getElementById('confirmacionCancelacion').style.display = 'block';
    }
    return false; // Evitar el envío del formulario
}

// Ocultar la confirmación
function ocultarConfirmacion() {
    document.getElementById('confirmacionCancelacion').style.display = 'none';
}

// validar formulario de cancelacion 
function validarCancelacion() {
    var validado = true;

    if (validarAnombre() === false) {
        validado = false;
    }

    if (validarCcorreo() === false) {
        validado = false;
    }

    if (validarFechahora() === false) {
        validado = false;
    }

    return validado;
}

// desabilitar boton de confirmar cancelacion y mostrar estado de carga en el mismo 
function mostrarEstadoCarga(btn) {
    btn.innerHTML = `<i class="fa-solid fa-circle-notch fa-spin"></i> Cargando....`;
    btn.disabled = true;
    btn.style.opacity = 0.9;
    btn.style.border = 'none';
}

// enviar formulario y ejecutar funcion anterior
function confirmarCancelacion(){
    var btn = document.getElementById('cancelarReserva');
    mostrarEstadoCarga(btn);

    document.getElementById('form-cancelacion').submit();
};

// validaciones unitarias de los campos de la cancelacion 
function validarAnombre(){
        var validado = true;
        var anombre = document.getElementById('anombre').value;
        if (anombre === ""){
            document.getElementById('anombreError').innerText = "Es obligatorio llenar este campo";
            document.getElementById('anombre').style.borderColor = "rgb(207, 19, 19)";
            validado = false;
        } else if (!/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ][a-zA-ZÁÉÍÓÚÜÑáéíóúüñ\s]+$/.test(anombre)) {
            document.getElementById('anombreError').innerText = "El nombre solo puede contener letras y espacios";
            document.getElementById('anombre').style.borderColor = "rgb(207, 19, 19)";
            validado = false;
        } else {
            document.getElementById('anombreError').innerText = "";
            document.getElementById('anombre').style.borderColor = "#2980b9";
        }
        return validado;
};

    function validarCcorreo(){
        var validado = true;
        var ccorreo = document.getElementById('ccorreo').value;
        var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(ccorreo === ""){
            document.getElementById('ccorreoError').innerText = "Es obligatorio llenar este campo";
            document.getElementById('ccorreo').style.borderColor = "rgb(207, 19, 19)";
            validado = false;
        }
        else if (!regexCorreo.test(ccorreo)) {
            document.getElementById('ccorreoError').innerText = "Por favor, ingrese un correo electrónico válido";
            document.getElementById('ccorreo').style.borderColor = "rgb(207, 19, 19)";
            validado = false;
        } else {
            document.getElementById('ccorreoError').innerText = "";
            document.getElementById('ccorreo').style.borderColor = "#2980b9";
        }
        return validado;
    };

    function validarFechahora(){
        var validado = true;
        var datetimeInput = document.getElementById('fechahorapicker').value;
        var day1 = parseInt(datetimeInput.substring(0, 2), 10);
        var month1 = parseInt(datetimeInput.substring(3, 5), 10) - 1;
        var year1 = parseInt(datetimeInput.substring(6, 10), 10);
        var datetime = new Date(year1, month1, day1);
        datetime.setHours(0,0,0,0);
        
        const fechaActual = new Date();
        fechaActual.setHours(0,0,0,0);

        //10/agosto/2024 || 3/agosto/2024
        if(datetimeInput === ""){
            document.getElementById('fechaHoraError').innerText = "Por favor, seleccione una fecha y hora";
            document.getElementById('fechahorapicker').style.borderColor = "rgb(207, 19, 19)";
            validado = false;
        } 
        else if (datetime.getTime() <= fechaActual.getTime()){
            document.getElementById('fechaHoraError').innerText = "No es posible cancelar el mismo dia de su reservación";
            document.getElementById('fechahorapicker').style.borderColor = "rgb(207, 19, 19)";
            validado = false;
        } else {
            document.getElementById('fechaHoraError').innerText = "";
            document.getElementById('fechahorapicker').style.borderColor = "#2980b9";
        }    
        return validado;
    };

// evitar mostrar el menu al clickear derecho (no se copien las imagenes)
document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});