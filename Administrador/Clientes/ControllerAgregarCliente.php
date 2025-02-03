<?php

require_once 'ModelCliente.php';

// Verificar si se enviaron los datos del formulario de registro


if(!empty($_POST['nombreCliente']) && !empty($_POST['inscripcion']) && !empty($_POST['idPaquete'])) {
    // Crear una instancia del modelo
    $model = new Model();

    // Validar y convertir la fecha de inscripción a 'YYYY-MM-DD'
    $inscripcion = date('Y-m-d', strtotime($_POST['inscripcion']));

    // Establecer las propiedades del modelo con los datos del formulario
    $model->nombreCliente = $_POST["nombreCliente"];
    $model->inscripcion =  $inscripcion;
    $model->idPaquete = $_POST["idPaquete"];
    $model->estado = 'Vigente';

    // Verificar los datos de entrada
        /*echo "<pre>";
        echo "nombreCliente: $nombreCliente\n";
        echo "inscripcion: $inscripcion\n";
        echo "idPaquete: $idPaquete\n";
        echo "estado: $estado\n";*/

    // Intentar registrar al usuario
    $registroExitoso = $model->AgregarCliente();

    if($registroExitoso === true) {
        echo "<script>alert('¡Registro exitoso del usuario!'); window.location.replace('../Clientes/Clientes.php');</script>";
    } else {
        echo "<script>alert('Error al registrar el usuario.'); window.location.replace('../Clientes/Clientes.php');</script>";
    }
}

?> 