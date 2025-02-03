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
    
    function obtenerDatosProducto() {
        try {
            $consulta = $this->conexion->prepare("SELECT idProducto, nombreProducto, imagen FROM productos");    
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

    function AgregarProducto($nombreProducto, $descripcion, $precio, $imagen_nombre) {
        try {
            $this->conexion->beginTransaction();
            $consulta = $this->conexion->prepare("INSERT INTO productos (nombreProducto, descripcion, precio, imagen) VALUES (:nombreProducto, :descripcion, :precio, :imagen)");
            $consulta->bindValue(':nombreProducto', $nombreProducto, PDO::PARAM_STR);
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

    function obtenerProductoPorID($id_Producto) {

        try {
            $consulta = $this->conexion->prepare("SELECT * FROM productos WHERE idProducto = :id_Producto");
            $consulta->bindValue(":id_Producto", $id_Producto);
            $consulta->execute();

            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

            return $usuario; 
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return null;
        }
    }

    function EditarProducto() {
        
        try {
            $consulta = $this->conexion->prepare("UPDATE productos SET nombreProducto = :nombreProducto, descripcion = :descripcion, precio = :precio WHERE idProducto = :idProducto");
            $consulta->bindParam(':nombreProducto', $this->nombreProducto);
            $consulta->bindParam(':descripcion', $this->descripcion);
            $consulta->bindParam(':precio', $this->precio);
            $consulta->bindParam(':idProducto', $this->idProducto);

            return $consulta->execute();
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return false;
        }
    }

    public function eliminarProducto($id_Producto) {
        try {
            $consulta = $this->conexion->prepare("DELETE FROM Productos WHERE idProducto = :id_Producto");
            $consulta->bindValue(":id_Producto", $id_Producto);
            
            $eliminacionExitosa = $consulta->execute();

            return $eliminacionExitosa;
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return false;
        }
    }  
}


?>