<?php
// Verificar si se recibió el parámetro 'idProducto' en la URL
if (isset($_POST['idProducto'])) {
    // Obtener el idProducto del producto que se va a eliminar
    $id_Producto = $_POST['idProducto']; 
    
    require_once 'ModelProducto.php';

    // Crear una instancia de la clase ModelProducto
    $modelProducto = new Model();

    // Intentar eliminar el producto
    $eliminacionExitosa = $modelProducto->eliminarProducto($id_Producto);

    if ($eliminacionExitosa) {
        echo "<script>alert('¡Producto eliminado correctamente!'); window.location.replace('Productos.php');</script>";
    } else {
        echo "<script>alert('Error al eliminar el producto. Inténtalo de nuevo más tarde.'); window.location.replace('Productos.php');</script>";
    }
} else {
    echo "<script>alert('ID de producto no proporcionado'); window.location.replace('Productos.php');</script>";
}
?>