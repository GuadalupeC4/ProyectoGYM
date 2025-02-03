<?php
require_once 'ModelProducto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombreProducto']) && isset($_FILES['imagen'])) {
    $model = new Model();

    $nombreProducto = htmlspecialchars($_POST["nombreProducto"]);
    $descripcion = htmlspecialchars($_POST["descripcion"]);
    $precio = htmlspecialchars($_POST["precio"]);

    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK && !empty($_FILES['imagen']['tmp_name'])) {
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = basename($_FILES['imagen']['name']);
        $imagen_ruta = "D:/xampp/htdocs/ProyectoGYM/Administrador/ImagenesProductos/" . $imagen_nombre;

        if (move_uploaded_file($imagen_temp, $imagen_ruta)) {
            $registroExitoso = $model->AgregarProducto($nombreProducto, $descripcion, $precio, $imagen_nombre);

            if ($registroExitoso) {
                echo "<script>alert('¡Registro exitoso!'); window.location.replace('../Productos/Productos.php');</script>";
            } else {
                echo "<script>alert('Error al agregar el producto. Por favor, inténtalo de nuevo más tarde.'); window.location.replace('../Productos/Productos.php');</script>";
            }
        } else {
            echo "<script>alert('Error al mover el archivo de imagen.'); window.location.replace('../Productos/Productos.php');</script>";
        }
    } else {
        echo "<script>alert('Error: Por favor seleccione un archivo de imagen válido.'); window.location.replace('../Productos/Productos.php');</script>";
    }
} else {
    echo "<script>alert('Faltan datos del formulario.'); window.location.replace('../Productos/Productos.php');</script>"; 
}
?>