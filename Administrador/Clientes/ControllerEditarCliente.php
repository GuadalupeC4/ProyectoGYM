<?php
require_once 'ModelCliente.php';

// Verificar si se enviaron los datos del formulario de edición
if (isset($_POST['idCliente'], $_POST['nombreCliente'], $_POST['inscripcion'], $_POST['renovacion'], $_POST['idPaquete'], $_POST['dias'], $_POST['estado'])) {
    // Crear una instancia del modelo
    $model = new Model();

    // Establecer las propiedades del modelo con los datos del formulario
    $model->idCliente = $_POST["idCliente"];
    $model->nombreCliente = $_POST["nombreCliente"];
    $model->inscripcion = $_POST["inscripcion"];
    $model->renovacion = $_POST["renovacion"];
    $model->idPaquete = $_POST["idPaquete"];
    $model->dias = $_POST["dias"];
    $model->estado = $_POST["estado"];

    // Intentar actualizar los datos del usuario
    $actualizacionExitosa = $model->EditarCliente();

    if ($actualizacionExitosa) {
        echo "<script>alert('¡Datos del usuario actualizados correctamente!'); window.location.replace('../Clientes/Clientes.php');</script>";
    } else {
        echo "<script>alert('Error al actualizar los datos del usuario. Inténtalo de nuevo más tarde.'); window.location.replace('../Clientes/Clientes.php');</script>";
    }
} else {
    // Si no se enviaron los datos del formulario, mostrar un mensaje de error o redirigir al usuario a otra página
    echo "<script>alert('Faltan datos del formulario.'); window.location.replace('../Clientes/Clientes.php');</script>";
}
?>