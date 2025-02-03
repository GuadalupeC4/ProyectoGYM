<?php
require_once 'ModelProducto.php';

// Verificar si se enviaron los datos del formulario de edición
if (isset($_POST['idProducto'], $_POST['nombreProducto'], $_POST['descripcion'], $_POST['precio'])) {
    // Crear una instancia del modelo
    $model = new Model();

    // Establecer las propiedades del modelo con los datos del formulario
    $model->idProducto = $_POST["idProducto"];
    $model->nombreProducto = $_POST["nombreProducto"];
    $model->descripcion = $_POST["descripcion"];
    $model->precio = $_POST["precio"];
    
    
    // Intentar actualizar los datos del producto
    $actualizacionExitosa = $model->EditarProducto();

    if ($actualizacionExitosa) {
        echo "<script>alert('¡Datos del producto actualizados correctamente!'); window.location.replace('../Productos/Productos.php');</script>";
    } else {
        echo "<script>alert('Error al actualizar los datos del producto. Inténtalo de nuevo más tarde.'); window.location.replace('../Productos/Productos.php');</script>";
    }
} else {
    // Si no se enviaron los datos del formulario, mostrar un mensaje de error o redirigir al producto a otra página
    echo "<script>alert('Faltan datos del formulario.'); window.location.replace('../Productos/Productos.php');</script>";
}
?>