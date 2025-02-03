<?php
require_once 'ModelPaquete.php';

// Verificar si se enviaron los datos del formulario de edición
if (isset($_POST['idPaquete'], $_POST['nombrePaquete'], $_POST['descripcion'], $_POST['precio'])) {
    // Crear una instancia del modelo
    $model = new Model();

    // Establecer las propiedades del modelo con los datos del formulario
    $model->idPaquete = $_POST["idPaquete"];
    $model->nombrePaquete = $_POST["nombrePaquete"];
    $model->descripcion = $_POST["descripcion"];
    $model->precio = $_POST["precio"];
    
    
    // Intentar actualizar los datos del usuario
    $actualizacionExitosa = $model->EditarPaquete();

    if ($actualizacionExitosa) {
        echo "<script>alert('¡Datos del usuario actualizados correctamente!'); window.location.replace('../Paquetes/Paquetes.php');</script>";
    } else {
        echo "<script>alert('Error al actualizar los datos del usuario. Inténtalo de nuevo más tarde.'); window.location.replace('../Paquetes/Paquetes.php');</script>";
    }
} else {
    // Si no se enviaron los datos del formulario, mostrar un mensaje de error o redirigir al usuario a otra página
    echo "<script>alert('Faltan datos del formulario.'); window.location.replace('../Paquetes/Paquetes.php');</script>";
}
?>