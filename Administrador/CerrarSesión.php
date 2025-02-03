<?php

// Iniciar sesión si no está iniciada
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al formulario de inicio de sesión
header("Location: ../Sesión/Login.php");
exit();

?>