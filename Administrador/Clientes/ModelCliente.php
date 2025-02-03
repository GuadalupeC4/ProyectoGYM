<?php



function obtenerDatosCliente() {
    $conexion = new PDO("sqlsrv:server=LAPTOP-DONIVKJP\SQLEXPRESS;database=GYM", "sa", "042027");
    try{
        $consulta = $conexion->prepare("SELECT idCliente, nombreCliente, inscripcion, renovacion, idPaquete, dias, estado from clientes");    
        $consulta->execute();
        //fila de resultados
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        // Devolver los datos del usuario
        return $resultado;
    }catch(PDOException $e){
        echo 'Error en la base de datos: '.$e->getMessage();
        return null;
    }
}

// Obtener los datos del usuario
$datosClientes = obtenerDatosCliente();
// Convertir los datos del usuario a JSON para enviarlos al cliente
$datosClientesJSON = json_encode($datosClientes);

class Model{
    function __construct() {
        try {
            $this->conexion = new PDO("sqlsrv:server=LAPTOP-DONIVKJP\SQLEXPRESS;database=GYM", "sa", "042027");
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
        }
    }

    //AgregarClientes para obtener los nombres de los paquetes
    function obtenerDatosPaquetes() {
        try{
            $consulta = $this->conexion->prepare("SELECT idPaquete, nombrePaquete, precio from paquetes");    
            $consulta->execute();
            //fila de resultados
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // Devolver los datos del usuario
            return $resultado;
        }catch(PDOException $e){
            echo 'Error en la base de datos: '.$e->getMessage();
            return null;
        }
    }

    var $id;
    var $nombreCliente;
    var $inscripcion;
    var $renovacion;
    var $idPaquete;
    var $dias;
    var $estado;

    function AgregarCliente(){
        try {
            // Calcula valores en PHP
            $fechaRenovacion = date('Y-m-d', strtotime("+1 month", strtotime($this->inscripcion)));
            $diasRestantes = (strtotime($fechaRenovacion) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
    
            // Prepara la consulta
            $consulta = $this->conexion->prepare("INSERT INTO clientes (nombreCliente, inscripcion, renovacion, idPaquete, dias, estado) 
                VALUES (:nombreCliente, :inscripcion, :renovacion, :idPaquete, :dias, :estado)");
    
            // Vincula los valores
            $consulta->bindValue(":nombreCliente", $this->nombreCliente);
            $consulta->bindValue(":inscripcion", $this->inscripcion);
            $consulta->bindValue(":renovacion", $fechaRenovacion);
            $consulta->bindValue(":idPaquete", $this->idPaquete);
            $consulta->bindValue(":dias", $diasRestantes);
            $consulta->bindValue(":estado", $this->estado ? $this->estado : 'Vigente');
    
            // Ejecuta la consulta
            $registroExitoso = $consulta->execute();
    
            return $registroExitoso;
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return null;
        }
    }

    function obtenerClientePorID($id_Cliente) {

        try {
            $consulta = $this->conexion->prepare("SELECT 
                c.idCliente, 
                c.nombreCliente, 
                c.inscripcion, 
                c.renovacion, 
                p.nombrePaquete, 
                c.dias, 
                c.estado
            FROM 
                clientes c
            INNER JOIN 
                paquetes p 
            ON 
                c.idPaquete = p.idPaquete
            WHERE 
                c.idCliente = :id_Cliente");
            $consulta->bindValue(":id_Cliente", $id_Cliente);
            $consulta->execute();

            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

            return $usuario; 
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return null;
        }
    }

    function EditarCliente() {
        
        try {
            $consulta = $this->conexion->prepare("UPDATE clientes SET nombreCliente = :nombreCliente, inscripcion = :inscripcion, renovacion = :renovacion, idPaquete = :idPaquete, dias = :dias, estado = :estado WHERE idCliente = :idCliente");
            $consulta->bindParam(':nombreCliente', $this->nombreCliente);
            $consulta->bindParam(':inscripcion', $this->inscripcion);
            $consulta->bindParam(':renovacion', $this->renovacion);
            $consulta->bindParam(':idPaquete', $this->idPaquete);
            $consulta->bindParam(':dias', $this->dias);
            $consulta->bindParam(':estado', $this->estado);
            $consulta->bindParam(':idCliente', $this->idCliente);

            return $consulta->execute();
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return false;
        }
    }

    public function eliminarCliente($id_Cliente) {
        try {
            $consulta = $this->conexion->prepare("DELETE FROM clientes WHERE idCliente = :id_Cliente");
            $consulta->bindValue(":id_Cliente", $id_Cliente);
            
            $eliminacionExitosa = $consulta->execute();

            return $eliminacionExitosa;
        } catch(PDOException $e) {
            echo 'Error en la base de datos: '.$e->getMessage();
            return false;
        }
    }   

}

?>