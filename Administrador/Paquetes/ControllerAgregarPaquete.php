<?php
require_once 'ModelPaquete.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombrePaquete']) && isset($_FILES['imagen'])) {
    $model = new Model();

    $nombrePaquete = htmlspecialchars($_POST["nombrePaquete"]);
    $descripcion = htmlspecialchars($_POST["descripcion"]);
    $precio = htmlspecialchars($_POST["precio"]);

    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK && !empty($_FILES['imagen']['tmp_name'])) {
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = basename($_FILES['imagen']['name']);
        $imagen_ruta = "D:/xampp/htdocs/ProyectoGYM/Administrador/ImagenesPaquetes/" . $imagen_nombre;

        if (move_uploaded_file($imagen_temp, $imagen_ruta)) {
            $registroExitoso = $model->AgregarPaquete($nombrePaquete, $descripcion, $precio, $imagen_nombre);

            if ($registroExitoso) {
                echo "<script>alert('¡Registro exitoso!'); window.location.replace('../Paquetes/Paquetes.php');</script>";
            } else {
                echo "<script>alert('Error al agregar el paquete. Por favor, inténtalo de nuevo más tarde.'); window.location.replace('../Paquetes/Paquetes.php');</script>";
            }
        } else {
            echo "<script>alert('Error al mover el archivo de imagen.'); window.location.replace('../Paquetes/Paquetes.php');</script>";
        }
    } else {
        echo "<script>alert('Error: Por favor seleccione un archivo de imagen válido.'); window.location.replace('../Paquetes/Paquetes.php');</script>";
    }
} else {
    echo "<script>alert('Faltan datos del formulario.'); window.location.replace('../Paquetes/Paquetes.php');</script>"; 
}
?>