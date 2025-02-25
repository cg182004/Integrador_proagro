<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proagro Site</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="icon" href="../css/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>    
</head>
<body>
    <!-- navegacion -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="../css/logo.png" alt="mi logo" width="110" height="80">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.html">Sobre Nosotros</a>
                    <a class="nav-link" href="catalogo.html">Paquetes</a>
                    <a class="nav-link active" aria-current="page" href="reserva.php">Reserva Ahora</a> 
                </div>
            </div>
            <ul class="nav justify-content-end">
                <button class="btn cancelaciones"  id="cancelar" title="cancelar reserva" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class='bx bx-camera-off'></i></button>
            </ul>
        </div>
    </nav>
    
    <!-- nostrar mensaje de exito al reservar -->
    <?php
    if (isset($_SESSION['successMessage'])) {
        echo '
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var successModal = new bootstrap.Modal(document.getElementById("successModal"));
                successModal.show();

                document.getElementById("form-stars").addEventListener("submit", function() {
                    successModal.hide();
                }); 
            });
            
        </script>
        ';
        unset($_SESSION['successMessage']);
    }
    ?>
    
    <!-- manejo de cancelaciones - offcanvas boostrap -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Cancelación</h5>
            <!-- boton para limpiar session -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" title="cancelar"><a href="backend/limpiar_sesion.php" class="limpiar-sesion">AA</a></button>
        </div>
        <div class="offcanvas-body" style="justify-content: center;">
            <form action="backend/cancelacion.php" method="post"  onsubmit=" return validarCancelacion()" id="form-cancelacion">
                
                <!-- llamar los mensajes de error y éxito -->
                <?php
                if (isset($_SESSION['errorCancelacion'])) {
                    echo '<p id = "errorCancelacion" class="alert alert-danger"> <i class="fa-solid fa-circle-exclamation"></i> ' . htmlspecialchars($_SESSION['errorCancelacion']) . '</p>';
                    unset($_SESSION['errorCancelacion']); 
                }
                ?>
                <?php
                if (isset($_SESSION['successCancelacion'])) {
                    echo '<p id = "successCancelacion" class="alert alert-success"> <i class="fa-solid fa-circle-check"></i> ' . htmlspecialchars($_SESSION['successCancelacion']) . '</p>';
                    unset($_SESSION['successCancelacion']); 
                }
                ?>
                
                <!-- campos de formulario -->
                <p>**Recuerde leer los terminos de cancelaciones</p>
                <div class="form-floating mb-3">
                    <input type="text" id="fechahorapicker" name="fechahora" class="form-control" placeholder="Fecha y Hora de Reservación" value="<?php echo isset($_SESSION['fechahora']) ? htmlspecialchars($_SESSION['fechahora']) : ''; ?>">
                    <label for="fechahorapicker">Fecha y Hora Reservada</label>
                    <span id="fechaHoraError" class="text-danger"></span>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="anombre" name="anombre" placeholder="Nombre" minlength="3"
                        maxlength="50" pattern="[A-Za-zÁÉÍÓÚÜÑáéíóúüñ][a-zA-ZÁÉÍÓÚÜÑáéíóúüñ\s]*" value="<?php echo isset($_SESSION['anombre']) ? htmlspecialchars($_SESSION['anombre']) : ''; ?>">
                    <label for="anombre">A nombre de</label>
                    <span id="anombreError" class="text-danger"></span>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="ccorreo" name="ccorreo" placeholder="Correo Electrónico" value="<?php echo isset($_SESSION['ccorreo']) ? htmlspecialchars($_SESSION['ccorreo']) : ''; ?>">
                    <label for="ccorreo">Correo Electrónico</label>
                    <span id="ccorreoError" class="text-danger"></span>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="justificacion" name="justificacion" style="height: 100px"
                        maxlength="900" placeholder="Petición Extra"><?php echo isset($_SESSION['justificacion']) ? htmlspecialchars($_SESSION['justificacion']) : ''; ?></textarea>
                    <label for="justificacion">Justificación</label>
                </div>
                <button type="button" id="btnCancelacion" class="btn btn-outline boton-canc" onclick="mostrarConfirmacion()">Cancelar</button>
                
                <!-- Mensaje de Confirmación -->
                <div id="confirmacionCancelacion" class="confirmacion-overlay" style="display: none;">
                    <div class="confirmacion-content">
                        <h5 style="color: #2980b9;">Confirmar Cancelación</h5><hr style="color: #99a3a4; width: 98%; margin: 5px auto;">
                        <i class="fa-regular fa-circle-question"></i>
                        <p style="font-size: 15px;">¿Está seguro de que desea cancelar esta reserva?</p>
                        <button type="button" class="btn volver" onclick="ocultarConfirmacion()">Volver</button> 
                        <button type="submit" class="btn cancelar"  id="cancelarReserva" onclick="confirmarCancelacion()">Cancelar</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

    <script>
        // dejar abierto el offcanva si mientras sea necesario
        document.addEventListener("DOMContentLoaded", function() {
            <?php
                if (isset($_SESSION['offcanvasOpen']) && $_SESSION['offcanvasOpen']) {
                echo '
                    var offcanvasElement = document.getElementById("offcanvasWithBothOptions");
                    offcanvasElement.classList.add("show");';
                unset($_SESSION['offcanvasOpen']);
                }
            ?>
        });
    </script>

    <!-- formulario principal de reservación -->
    <div class="contenedor-form">
        <h2>Sesión Fotográfica</h2>
        <h3>Revisa la disponibilidad y reserva Ya!</h3>
        <form class="formulario" method="post" action="backend/reservacion.php" onsubmit="return validarFormulario()" id="form">
        <section class="info-reserva">
                <!-- campos de form sobre reserva + utilizar php para dejar datos de sesion -->
                <div class="form-floating mb-3">
                    <input type="text" id="datetimepicker" name="datetime" class="form-control" placeholder="Fecha y Hora de Reservación" value="<?php echo isset($_SESSION['form_data']['datetime']) ? htmlspecialchars($_SESSION['form_data']['datetime']) : ''; ?>">
                    <label for="datetimepicker">Fecha y Hora de Reservación</label>
                    <span id="datetimeError" class="text-danger"></span>
                    
                    <!-- mostrar mensaje de error si esta ocupada la fecha -->
                    <?php
                        if (isset($_SESSION['errorFecha'])) {
                            echo '<span id="errorFecha" class="text-danger"> <i class="fa-solid fa-circle-exclamation"></i> ' . htmlspecialchars($_SESSION['errorFecha']) . '</span>';
                            unset($_SESSION['errorFecha']); 
                        }
                    ?>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select form-control" name="clasificacion" id="clasificacion" aria-label="Floating label select example">
                        <option value="Abre el menu de selección" disabled <?php echo !isset($_SESSION['form_data']['clasificacion']) ? 'selected' : ''; ?>>Abre el menú de selección</option>
                        <option value="Experiencia Agroeducativa" <?php echo isset($_SESSION['form_data']['clasificacion']) && $_SESSION['form_data']['clasificacion'] === 'Graduacion' ? 'selected' : ''; ?>>Experiencia Agroeducativa</option>
                        <option value="Paseo Expres" <?php echo isset($_SESSION['form_data']['clasificacion']) && $_SESSION['form_data']['clasificacion'] === 'Cumpleaños' ? 'selected' : ''; ?>>Paseo Expres</option>
                        <option value="Degustaciones de Productos" <?php echo isset($_SESSION['form_data']['clasificacion']) && $_SESSION['form_data']['clasificacion'] === 'Album Digital' ? 'selected' : ''; ?>>Degustaciones de Productos</option>
                        <option value="Aventura Grupal" <?php echo isset($_SESSION['form_data']['clasificacion']) && $_SESSION['form_data']['clasificacion'] === 'Boda' ? 'selected' : ''; ?>>Aventura Grupal</option>
                    </select>
                    <label for="clasificacion">Paquete</label>
                    <span id="clasificacionError" class="text-danger"></span>
                </div>
            </section>
            <hr>

            <section class="info-cliente">
                <!-- campos de form sobre cliente -->
                <h3>Información del cliente</h3>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" minlength="3"
                        maxlength="50" pattern="[A-Za-zÁÉÍÓÚÜÑáéíóúüñ][a-zA-ZÁÉÍÓÚÜÑáéíóúüñ\s]*" value="<?php echo isset($_SESSION['form_data']['nombre']) ? htmlspecialchars($_SESSION['form_data']['nombre']) : ''; ?>">
                    <label for="nombre">Nombre</label>
                    <span id="nombreError" class="text-danger"></span>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos"
                        minlength="2" maxlength="50" pattern="[A-Za-zÁÉÍÓÚÜÑáéíóúüñ][a-zA-ZÁÉÍÓÚÜÑáéíóúüñ\s]*" value="<?php echo isset($_SESSION['form_data']['apellidos']) ? htmlspecialchars($_SESSION['form_data']['apellidos']) : ''; ?>">
                    <label for="apellidos">Apellidos</label>
                    <span id="apellidosError" class="text-danger"></span>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="numero" name="numero" pattern="\d{3}-?\d{3}-?\d{4}$"
                        placeholder="Número de Teléfono" value="<?php echo isset($_SESSION['form_data']['numero']) ? htmlspecialchars($_SESSION['form_data']['numero']) : ''; ?>">
                    <label for="numero">Número de Teléfono</label>
                    <span id="numeroError" class="text-danger"></span>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico" value="<?php echo isset($_SESSION['form_data']['correo']) ? htmlspecialchars($_SESSION['form_data']['correo']) : ''; ?>">
                    <label for="correo">Correo Electrónico</label>
                    <span id="correoError" class="text-danger"></span>
                </div>
                <!-- aqui hay problemas :( (upd: YA NOOO :) ) -->
                <div class="check">
                    <input class="form-check-input" type="checkbox" name="CheckTerminos" id="CheckTerminos" value="1" <?php echo isset($_SESSION['form_data']['CheckTerminos']) && $_SESSION['form_data']['CheckTerminos'] == '1' ? 'checked' : ''; ?>>

                    <p class="d-inline-flex gap-1">
                        <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <label class="form-check-label" for="flexCheckDefault">Acepto Términos y condiciones <i class="fa-solid fa-angle-down"></i></label>
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <p class="title">Términos y Condiciones de Reservación y Cancelación</p>
                            <p>Como empresa trabajamos y nos comprometemos en proveer un servicio de calidad y la mejor atención posible. Somos comprometidos y respetuosos con nuestros clientes y deseamos ser correspondidos de la misma manera. Es por ello que acordamos los siguientes puntos:</p><br>

                            <ul><p class="subtitle">Reservas</p>
                                <li> Solicitamos puntualidad de nuestros clientes a la hora de presentarse en su sesión. De igual forma, tenemos como norma cumplir con nuestros horarios para no hacer esperar a ninguno de nuestros clientes.</li>
                                <li>Las reservas para una sesión deben de realizarse con al menos 2 días de anticipación y en caso de requerir un lugar distinto al estudio, debe especificarse en la misma.</li>
                                <li>Cada reserva tiene una duración estándar de 2 horas, a excepción de las fotos 2x2/pasaporte, las cuáles duran 45 minutos. Si el cliente requiere más de este tiempo debe especificarlo en la reservación.</li>
                                <li>Para las reservas de actividades fuera del horario laboral también debe ser especificado en la reservación o contactarse con la empresa para coordinar dicho evento.</li>
                            </ul><br>

                            <ul><p class="subtitle">Cancelaciones</p>
                            <li>Las cancelaciones deben ser realizadas al menos con un día de anticipación de la sesión ya reservada.</li>
                            <li>No es necesario comunicar los motivos de la cancelación, más esto nos serviría como mejora en el ámbito de realizar las reservas y las sesiones.</li>
                            <li> Una vez realizada la cancelación no hay vuelta atrás, pero sí es posible realizar una nueva reservación para fines de cambio de fechas y horas. Siempre y cuando esté disponible el tiempo elegido por el usuario.</li>
                            </ul>
                        </div>
                    </div>
                    <span id="CheckError" class="text-danger" style="display: block"></span>
                </div>
            </section>
            <button type="button" id="btnReservar" class="btn btn-outline-primary boton-rl" onclick="mostrarResumen()" onsubmit="validarCheck()">
                Reservar
            </button>

            <!-- Modal de confirmacion reserva -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Reserva de Sesión de Fotos</h1>
                            <!-- btn para cerrar session -->
                            <button type="button" class="btn-close" title="cancelar"><a href="backend/limpiar_sesion.php" class="limpiar-sesion">AA</a></button>
                        </div>
                        <div class="modal-body" id="resumen">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn cancelar" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                            <button type="submit" class="btn confirmar" id="guardarReserva" onclick="deshabilitarboton()">Confirmar Reserva</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
    </div>

    <!-- loader de pagina -->
    <div class="loader"></div>

    <!-- pie de pagina -->
    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <h5>Dirección</h5>
                    <ul class="list-unstyled">

                        <li><i class="fa-solid fa-location-dot"></i>Matanzas Adentro, Los Filpos #200</li>
                        <li class="li-rest">Santiago, Puñal</li>
                        <li><i class="fa-solid fa-map-location-dot"></i>República Dominicana</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa-brands fa-google"></i>estudiofotografico@gmail.com</li>
                        <li><i class="fa-brands fa-whatsapp"></i>+809 486 7790</li>
                        <li><i class="fa-brands fa-instagram"></i>@estudiofotografico</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Horario</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-clock"></i>Lunes - Viernes</li>
                        <li class="li-rest">8:00 a.m. - 5:00 p.m.</li>
                        <li><i class="fa-solid fa-calendar-days"></i>Sabado - Domingo</li>
                        <li class="li-rest">Hora cambiante</li>
                    </ul>
                </div>
            </div>
            <div class="text-left mt-3">
                <p>&copy; 2024 DesarrolloYanl. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <style>
        /* estilos que no funcionaban en styles.css */

        /*modal de confirmacion */
        .contenedor-form .modal-footer .btn.cancelar{
        color: var(--color-1);
        text-decoration: none;
        }

        .contenedor-form .modal-footer .btn.cancelar:hover{
        color: var(--color-7);
        text-decoration: none;
        }

        .contenedor-form .modal-footer .btn.confirmar{
            color: var(--color-1);
        }
        .contenedor-form .modal-footer .btn.confirmar:hover{
            color: var(--color-3);
        }
    
        /*MODAL DE EXITO*/
        .form-stars label{
            color:var(--color-6);
            font-size: 25px;
            margin-top: 5px;
        }
        .form-stars label:hover{
            color:var(--color-7);
        }
        .form-stars label:hover ~ label{
            color:var(--color-7);
        }

        .form-stars input[type = "radio"]{ 
            display:none;
        }

        .form-stars input[type = "radio"]:checked ~ label{
            color:var(--color-7);
        }

        .clasificacion{
            direction: rtl;/* right to left */
            unicode-bidi: bidi-override;/* bidi de bidireccional */
        }

        .modal-body .fa-circle-check{
            color: rgb(70, 163, 26);
            font-size: 80px;
            display: block;
            text-align: center;
            margin: 15px 0;
        }

        .container-stars{
            padding-top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30px;
        }

        .modal-body h3{
            text-align: center;
            font-weight: normal;
            text-wrap: wrap;
            margin-bottom: 3px;
            font-size: 23px;
        }

        .form-stars{
            justify-content: center;
        }

        #successModal .modal-footer{
            align-items: center;
        }

        /* offcanva de cancelacion */
        .offcanvas{
        padding: 10px;
        color: #5d6d7e;
        }

        .limpiar-sesion{
            font-size: 20px;
            color: transparent;
            text-decoration: none;
        }

        /*mensaje de confirmacion cancelacion*/
        .confirmacion-overlay {
            position: fixed;
            top: 40%;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 399px;
            z-index: 2;
        }

        .confirmacion-content {
            margin-left: 3%;
            width: 370px;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .fa-circle-question{
            font-size: 31px;
            color: #ff9800;
            margin: 5px;
        }
        .confirmacion-content button{
            color: #5d6d7e;
            margin-top: 7px;
        }
        .confirmacion-content p{
            font-size: 30px;
            margin-bottom:5px;
        }
        .confirmacion-content .volver:hover{
            color: var(--color-7);
            text-decoration: none;
        }
        .confirmacion-content .cancelar:hover{
            color: var(--color-3);
        }

    /*spinner de carga*/
    .loader{
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f2f4f4;
        transition: opacity 0.75s, visibility 0.75s;
        z-index:9999;
    }

    .loader-hidden{
        opacity: 0;
        visibility: hidden;
    }

    .loader::after{
        content: "";
        width: 75px;
        height: 75px;
        border: 10px solid #dddddd;
        border-top-color: #ff9800;
        border-radius: 50%;
        animation: loading 0.75s ease infinite;
    }

    @keyframes loading{
        Form{
            transform: rotate(0turn);
        }
        to{
            transform: rotate(1turn);
        }
    }
    </style>

    <!-- Modal Success -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 aline-items" id="successModalLabel">Reserva Realizada</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="stars">
                    <i class="fa-regular fa-circle-check"></i>
                    <h3>¡Su reserva se realizó exitosamente! Ahora puedes calificar tu experiencia</h3>

                    <form method="post" action="backend/calificaciones.php" class="form-stars" id="form-stars">
                        <div class="container-stars">
                            <p class="clasificacion">
                                <input id="radio1" type="radio" name="estrellas" value="5">
                                <label for="radio1">★</label>
                                <input id="radio2" type="radio" name="estrellas" value="4">
                                <label for="radio2">★</label>
                                <input id="radio3" type="radio" name="estrellas" value="3">
                                <label for="radio3">★</label>
                                <input id="radio4" type="radio" name="estrellas" value="2">
                                <label for="radio4">★</label>
                                <input id="radio5" type="radio" name="estrellas" value="1">
                                <label for="radio5">★</label>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn" id="submitForm">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    

    <!-- agregar bootrap, jquery, el js y flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="script.js"></script>
</body>
</html>