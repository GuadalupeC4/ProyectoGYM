<?php
//modelo

class Model {
    private $conexion;

    function __construct() {
        // Establecer conexión a la base de datos
        try {
            $this->conexion = new PDO("sqlsrv:server=LAPTOP-DONIVKJP\SQLEXPRESS;database=GYM", "sa", "042027");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Error en la conexión a la base de datos: '.$e->getMessage();
        }
    }

    function inicioSesion($contraseña) {
        try {
            $consulta = $this->conexion->prepare("SELECT * FROM admi WHERE  contraseña = dbo.fun_encriptar(?)");
            $consulta->bindParam(1, $contraseña);

            $consulta->execute();
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
            
            return $usuario; // Devuelve el usuario encontrado
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return null; // Error al buscar el usuario
        }
    }
}

?>