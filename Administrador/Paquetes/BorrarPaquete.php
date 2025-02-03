<?php
// Verificar si se recibió el parámetro 'idPaquete' en la URL
if (isset($_POST['idPaquete'])) {
    // Obtener el idPaquete del cliente que se va a eliminar
    $id_Paquete = $_POST['idPaquete']; 
    
    require_once 'ModelPaquete.php';

    // Crear una instancia de la clase ModelCliente
    $modelPaquete = new Model();

    // Intentar eliminar el cliente
    $eliminacionExitosa = $modelPaquete->eliminarPaquete($id_Paquete);

    if ($eliminacionExitosa) {
        echo "<script>alert('¡Paquete eliminado correctamente!'); window.location.replace('Paquetes.php');</script>";
    } else {
        echo "<script>alert('Error al eliminar el paquete. Inténtalo de nuevo más tarde.'); window.location.replace('Paquetes.php');</script>";
    }
} else {
    echo "<script>alert('ID de paquete no proporcionado'); window.location.replace('Paquetes.php');</script>";
}
?>