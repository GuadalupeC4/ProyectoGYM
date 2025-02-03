<?php
session_start(); // Iniciar la sesión

require_once 'ModelSesion.php';

//instancia
$model = new Model();

// Obtener datos del formulario
if(isset($_POST['Contraseña'])) {
    $contraseña = $_POST['Contraseña'];

    // Obtener información del usuario
    $usuario = $model->inicioSesion($contraseña);

    // Verificar si el usuario existe
    if($usuario) {
        // Redirigir dependiendo del rol del usuario
        header("Location: ../Administrador/Clientes/Clientes.php");
    } else {
        //echo "<h1>Usuario o contraseña incorrectos!</h1>";
        echo "<script>alert('¡Usuario o contraseña incorrectos!'); window.location.replace('../Login.php');</script>"; 
        //exit();
        
    }
} elseif(isset($_GET['cerrar_sesion'])) {
    // Si se recibe una solicitud para cerrar sesión
    unset($_SESSION['usuario']); // Eliminar los datos de sesión del usuario
    session_destroy(); // Destruir la sesión
    header("Location: ../Inicio de sesion/InicioSesión.php");
    exit();
}

?>