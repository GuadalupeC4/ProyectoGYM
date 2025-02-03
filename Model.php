<?php

class Model{
    private $conexion;

    function __construct() {
        try {
            $this->conexion = new PDO("sqlsrv:server=LAPTOP-DONIVKJP\SQLEXPRESS;database=GYM", "sa", "042027");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error en la conexión a la base de datos: ' . $e->getMessage();
        }
    }
    
    function obtenerDatosPaquete() {
        try{
            $consulta =$this->conexion->prepare("SELECT idPaquete, nombrePaquete, descripcion, precio, imagen from paquetes");    
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            echo 'Error en la base de datos: '.$e->getMessage();
            return null;
        }
    }

    function obtenerDatosProducto() {
        try{
            $consulta =$this->conexion->prepare("SELECT idProducto, nombreProducto, descripcion, precio, imagen from productos");    
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            echo 'Error en la base de datos: '.$e->getMessage();
            return null;
        }
    }
}
?>