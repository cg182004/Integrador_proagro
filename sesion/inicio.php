<?php
session_start();
?>

<style>
     :root {
    --color-1: #5d6d7e;
    --color-2: #7fb3d5;
    --color-3: #2980b9;
    --color-4: #f2f4f4;
    --color-5: #e5e8e8;
    --color-6: #99a3a4;
    --color-7: #ff9800;
    --fc-today-bg-color: rgba(155, 210, 247, 0.322);
    --fc-now-indicator-color: red;
    --fc-event-border-color: transparent;
}

/* importar fuentes - en uso: Poppins */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* {
    font-family: Poppins;
}

body {
    background-color: var(--color-4);
}

/* inicio de sesion */
.container-login{
    max-height: 1200px;
    min-width: 375px;
    height: 645px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.formulario {
    border: 1px var(--color-2);
    border-radius: 7px;
    box-shadow: 1px 1px 2px 2px rgba(93, 109, 126, 0.2);
    padding: 30px;
    max-width: 500px;
    max-height: 450px;
    min-height: 460px;
    width: 100%;
    height: 100%;
}

.formulario span{
    background-color: #f7f6f6b7;
    width: 50px;
    align-items: center;
    justify-content: center;
}

.fa-solid{
    font-size: 18px;
    cursor: pointer;
    color: var(--color-1);
}

.formulario .input-group{
    height: 50px;
    margin-bottom: 30px;
    font-size: 20px;
    color: var(--color-6);
}

.formulario .form-control:focus {
    outline: none;
    box-shadow: none; 
    border-color: var(--color-2);
}
.formulario .input-group label{
    color: var(--color-6);
}

.formulario h1{
    margin: 10px 10px;
    text-align: center;
    font-size: 50px;
    color: var(--color-1);
}

.formulario h1::selection{
    background-color: var(--color-5);
    color: var(--color-2);
}

.formulario hr{
    color: var(--color-6);
    width: 99%;
    padding-bottom: 25px;
}
.formulario .boton-rl {
    width: 100%;
    height: 50px;
    display: block;
    margin: 30px auto;
    font-size: 20px;
    color: rgb(96, 189, 30); 
    border-color: rgb(96, 189, 30);
}

.formulario .boton-rl:hover {
    background-color:rgb(96, 189, 30);
    color: var(--color-4);
}

.formulario .text-danger{
    background-color:rgb(96, 189, 30);
}

.formulario .fa-circle-exclamation{
    font-size: 16px;
    color: rgba(180, 6, 6, 0.575);
}

/* calendario calendar*/
.nav{
    height: 60px;
    align-items: center;
}

.nav .btn-group{
    margin-right: 20px;
    width: 100px;
    margin-top: 15px;
}

.nav .fa-circle-user{
    color: var(--color-3);
    padding-right: 10px;
    font-size: 26px;
}
.nav .dropdown-toggle{
    color: var(--color-3);
    font-size: 26px;
}
.nav .dropdown-toggle:hover{
    color: var(--color-2);
}

.nav i{
    color: var(--color-1);
}
.nav i:hover{
    color: var(--color-2);
}

.nav a{ 
    color: var(--color-1);
}
.nav a:hover{ 
    color: var(--color-2);
}

/*calendario fullcalendar*/
.container-calend h1{
    text-align: center;
    margin-bottom: 25px;
    color: var(--color-1);
    text-wrap: balance;
}
.container-calend img{
    height: 200px;
}
.container-calend h1::selection, .fc a::selection, .fc-toolbar-title::selection{
    background-color: transparent;
    color: var(--color-2);
}

#calendar{
    width: 80%;
    height: 80%;
    border: 4px #2980b9;
    margin: 15px auto;
}

.fc a {
    color: var(--color-1);
    text-decoration: none;
}

.fc .row{
    font-weight: bold;
}

.fc-toolbar-title{
    color: var(--color-3);
}
.fc-toolbar-title::first-letter{
    text-transform: uppercase;
}

.fc-header-toolbar {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}
.fc-toolbar-chunk {
    margin: 5px 0;
}

/*page nav*/
footer{
    margin: 45px auto;
    display: flex;
    justify-content: center;
}

footer .page-item .page-link{
    color: var(--color-1);
}

/*mostrar calificaciones*/
.container-calf .table{
    margin: 30px auto;
    width: 1100px;
    max-height: 320px;
    text-align: center;
}
.container-calf .table thead{
    font-weight: bold;
}
.container-calf .table td{
    color: var(--color-1);
}

.container-calf h1::selection, img::selection{
    background-color: transparent;
    color: var(--color-2);
}
.container-calf .table td::selection{
    background-color: var(--color-5);
    color: var(--color-2);
}

.container-calf h1{
    text-align: center;
    margin-bottom: 25px;
    color: var(--color-1);
    text-wrap: balance;
}
.container-calf img{
    height: 200px;
}
.calificaciones{
    display: flex;
    justify-content: center;
}
.calificaciones .scroll{
    max-height: 320px;
    overflow-y: auto;
}
.table .fa-star{
    font-size: 16px;
    color: var(--color-7);
}

/*responsive*/
@media (max-width: 1200px) {
    .container-login{
        height: 700px;
    }

    .formulario {
        width: 100%;
        height: 100%;
    } 
}

@media (max-width: 992px) {
    .container-login{
        height: 700px;
    }
    .formulario {
        width: 100%;
        height: 100%;
    }
    .fc-header-toolbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .fc-toolbar-chunk {
        width: 100%;
        text-align: center;
        margin-bottom: 10px;
    }

    .fc-toolbar-title {
        font-size: 1.5rem;
    }

    .fc-button-group, .fc-toolbar-chunk > button {
        margin: 5px;
        width: 100%;
    }
}

@media (max-width: 768px) {
    .container-login{
        height: 700px;
    }

    .formulario {
        width: 90%;
        height: 100%;
    }

    .formulario h1{
        font-size: 40px;
    }
    .fc-toolbar-title {
        font-size: 1.2rem;
    }

    .fc-button-group, .fc-toolbar-chunk > button {
        margin: 3px;
    }
}

@media (max-width: 576px) {
    .container-login{
        height: 700px;
    }

    .formulario {
        width: 70%;
        height: 100%;
    }

    .formulario h1{
        font-size: 28px;
    }
    .fc-toolbar-title {
        font-size: 1rem;
    }

    .fc-button-group, .fc-toolbar-chunk > button {
        width: 100%;
        margin: 2px;
    }

    .fc-toolbar-chunk {
        text-align: center;
        width: 100%;
    }
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proagro</title>
        <link rel="stylesheet" href="../css/styles2.css">
    <link rel="icon" type="icon" href="../css/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- registro de usuarios de la empresa -->
    <div class="container-login">
        <section class="formulario">
            <h1>Iniciar Sesión</h1><hr>
            <form action="../backend/login.php" method="post" id="formularioLogin">
                <!-- mostar mensajes de error -->
                <?php
                session_start();
                if (isset($_SESSION['errorLogin'])) {
                    echo '<p id = "errorLogin" class="alert alert-danger"> <i class="fa-solid fa-circle-exclamation"></i> ' . htmlspecialchars($_SESSION['errorLogin']) . '</p>';
                    unset($_SESSION['errorLogin']); 
                }
                ?>

                <!-- inputs del form -->
                <div class="input-group">
                    <input type="text" id="usuario" class="form-control" name="usuario" placeholder="Usuario"
                        value="<?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : ''; ?>">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                </div>
                <div class="input-group">
                    <input type="password" id="contrasena" class="form-control" name="contrasena" placeholder="Contraseña">
                    <span class="input-group-text"><i class="fa-solid fa-eye-slash" id="ix"></i></span>
                </div>
                <button type="submit" class="btn btn-outline-primary boton-rl">Iniciar Sesión</button>
            </form>
        </section>
    </div>

    <!-- agregar js, bootrap y jquery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</body>
</html>
