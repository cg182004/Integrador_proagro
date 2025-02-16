<?php
session_start();
include 'conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // realizar registro de usuario

    // datos
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // mantener sesion
    $_SESSION['usuario'] = $usuario;
    $_SESSION['contrasena'] = $contrasena;

    // validar campos
    if (empty($usuario) && empty($contrasena)){
        $_SESSION['errorLogin'] = 'Usuario y Contraseña Requeridos';
        header('Location: inicio.php');
        exit();
    } else if (empty($usuario)) {
        $_SESSION['errorLogin'] = 'El usuario es Requerido';
        header('Location: inicio.php');
        exit();
    } else if (empty($contrasena)) {
        $_SESSION['errorLogin'] = 'La contraseña es Requerida';
        header('Location: inicio.php');
        exit();
    }  

    // Verificar si la conexión a la base de datos está definida
    if (!isset($conn)) {
        $_SESSION['errorLogin'] = 'Error de conexión a la base de datos';
        header('Location: inicio.php');
        exit();
    }

    $sql = "SELECT usuario, contrasena FROM usuario WHERE usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // si estan los datos.... dar acceso a otras partes + activar el loggedin
        unset($_SESSION['usuario']);
        unset($_SESSION['contrasena']);

        $_SESSION['loggedin'] = true;
        header('Location: ../sesion/Menu.php');
        exit();
    } else {
        // si no estan los datos... enviar mensajes de error
        $stmt->close(); // Cerrar el primer statement antes de reutilizarlo

        $sql = "SELECT usuario FROM usuario WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['errorLogin'] = 'Contraseña incorrecta';
        } else {
            $_SESSION['errorLogin'] = 'Usuario no registrado';
        }
        header('Location: inicio.php');
        exit();
    }  

    $stmt->close();
    $conn->close();
}
?>