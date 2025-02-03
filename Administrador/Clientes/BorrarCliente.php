<?php
// Verificar si se recibió el parámetro 'idCliente' en la URL
if (isset($_POST['idCliente'])) {
    // Obtener el idCliente del cliente que se va a eliminar
    $id_Cliente = $_POST['idCliente']; 
    
    require_once 'ModelCliente.php';

    // Crear una instancia de la clase ModelCliente
    $modelCliente = new Model();

    // Intentar eliminar el cliente
    $eliminacionExitosa = $modelCliente->eliminarCliente($id_Cliente);

    if ($eliminacionExitosa) {
        echo "<script>alert('¡Cliente eliminado correctamente!'); window.location.replace('Clientes.php');</script>";
    } else {
        echo "<script>alert('Error al eliminar el cliente. Inténtalo de nuevo más tarde.'); window.location.replace('Clientes.php');</script>";
    }
} else {
    echo "<script>alert('ID de cliente no proporcionado'); window.location.replace('Clientes.php');</script>";
}
?>