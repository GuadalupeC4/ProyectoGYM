<?php

class Model{
    private $conexion;

    function __construct() {
        try {
            $this->conexion = new PDO("sqlsrv:server=LAPTOP-DONIVKJP\SQLEXPRESS;database=GYM", "sa", "042027");
            //$this->conexion = new PDO("sqlsrv:server=LEHETH;database=DEMEX", "sa", "1224");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error en la conexión a la base de datos: ' . $e->getMessage();
        }
    }
    
    function obtenerDatosPaquete() {
        try {
            $consulta = $this->conexion->prepare("SELECT idPaquete, nombrePaquete, imagen FROM paquetes");    
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            echo 'Error en la base de datos: ' . $e->getMessage();
            return null;
        } finally {
            $conexion = null; 
        }
    }

    function AgregarPaquete($nombrePaquete, $descripcion, $precio, $imagen_nombre) {
        try {
            $this->conexion->beginTransaction();
            $consulta = $this->conexion->prepare("INSERT INTO paquetes (nombrePaquete, descripcion, precio, imagen) VALUES (:nombrePaquete, :descripcion, :precio, :imagen)");
            $consulta->bindValue(':nombrePaquete', $nombrePaquete, PDO::PARAM_STR);
            $consulta->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $precio, PDO::PARAM_STR);
            $consulta->bindValue(':imagen', $imagen_nombre, PDO::PARAM_STR);
            $registroExitoso = $consulta->execute();
            $idPaquete = $this->conexion->lastInsertId();
            $this->conexion->commit();
            return $registroExitoso;
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo 'Error en la base de datos: ' . $e->getMessage();
            return false;
        } finally {
            $conexion = null; 
        }
    }

    function obtenerPaquetePorID($id_Paquete) {

        try {
            $consulta = $this->conexion->prepare("SELECT * FROM paquetes WHERE idPaquete = :id_Paquete");
            $consulta->bindValue(":id_Paquete", $id_Paquete);
            $consulta->execute();

            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

            return $usuario; 
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return null;
        }
    }

    function EditarPaquete() {
        
        try {
            $consulta = $this->conexion->prepare("UPDATE paquetes SET nombrePaquete = :nombrePaquete, descripcion = :descripcion, precio = :precio WHERE idPaquete = :idPaquete");
            $consulta->bindParam(':nombrePaquete', $this->nombrePaquete);
            $consulta->bindParam(':descripcion', $this->descripcion);
            $consulta->bindParam(':precio', $this->precio);
            $consulta->bindParam(':idPaquete', $this->idPaquete);

            return $consulta->execute();
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return false;
        }
    }

    public function eliminarPaquete($id_Paquete) {
        try {
            $consulta = $this->conexion->prepare("DELETE FROM Paquetes WHERE idPaquete = :id_Paquete");
            $consulta->bindValue(":id_Paquete", $id_Paquete);
            
            $eliminacionExitosa = $consulta->execute();

            return $eliminacionExitosa;
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return false;
        }
    }     
}

?>