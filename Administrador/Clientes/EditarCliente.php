<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Menu.css">
    <link rel="stylesheet" href="Clientes.css">
    <title>Agregar Cliente</title>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a><img src="../../Img-Logo/Logo.jpg"></a>
            <label class="labe_hamburguesa" for="menu_hamburguesa">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="35"
                height="35"
                fill="currentColor"
                class="list_icon"
                viewBox="0 0 16 16">
                    <path
                    fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5
                    0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0
                    1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0
                    0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                    />
                </svg>
            </label>

            <input class="menu_hamburguesa" type="checkbox" name="" id="menu_hamburguesa">

            <ul class="ul_links">
                <li class="li_links"><a href="../Clientes/Clientes.php" class="link">Clientes</a></li>
                <li class="li_links"><a href="../Paquetes/Paquetes.php" class="link">Paquetes</a></li>
                <li class="li_links"><a href="../Productos/Productos.php" class="link">Productos</a></li>
                <li class="li_links"><a href="../CerrarSesión.php" class="link">Salir</a></li>
            </ul>
        </nav>
    </header>

    <div class="agreCliente">
        <?php
            // Verificar si se recibió el parámetro 'idCliente' en la URL
            if (isset($_GET['idCliente'])) {
            // Obtener el idCliente del usuario que se está editando
            $id_Cliente = $_GET['idCliente']; // Suponiendo que el ID se pasa como un parámetro de la URL

            // Incluir el archivo que contiene la clase ModelUsuarioId
            require_once 'ModelCliente.php'; // Cambia esto a 'ModelUsuarioId.php' si ese es el nombre correcto del archivo

            // Crear una instancia de la clase ModelUsuarioId
            $modelCliente = new Model();

            // Obtener los datos del usuario por su ID
            $cliente = $modelCliente->obtenerClientePorID($id_Cliente);

            // Verificar si se obtuvieron los datos del cliente
            if ($cliente) {
        ?>

        <form action="ControllerEditarCliente.php" method="POST" >
            <input type="hidden" name="idCliente" value="<?php echo $cliente['idCliente']; ?>">
            <div class="input-group">
                <input class="input" required type="text" id="nombreCliente" name="nombreCliente" value="<?php echo $cliente['nombreCliente']; ?>">
                <label class="label" for="nombreCliente">Nombre</label>
            </div>
            <div class="input-group">
                <input class="input" required type="date" id="inscripcion" name="inscripcion" value="<?php echo $cliente['inscripcion']; ?>">
                <label class="label" for="inscripcion">Inscripción</label>
            </div>
            <div class="input-group">
                <input class="input" required type="date" id="renovacion" name="renovacion" value="<?php echo $cliente['renovacion']; ?>" readonly>
                <label class="label" for="renovacion">Renovación</label>
            </div>
            <div class="input-group">
                <select name="idPaquete" id="idPaquete" class="input" onchange="actualizarCosto()">
                    <option id="idPaquete" name="nombrePaquete" value=""><?php echo $cliente['nombrePaquete']; ?></option>
                    <?php
                    require_once 'ModelCliente.php';
                    $model = new Model(); // Crear una instancia del modelo            
                    $paquetes = $model->obtenerDatosPaquetes();
                    foreach ($paquetes as $paquete) {
                        echo "<option value='" . $paquete['idPaquete'] . "' data-costo='" . $paquete['precio'] . "'>" . $paquete['nombrePaquete'] . "</option>";                            
                    }
                ?>
                </select>
            </div>
            <div class="input-group">
                <input class="input" required type="number" id="dias" name="dias" value="<?php echo $cliente['dias']; ?>" readonly>
                <label class="label" for="dias">Días restantes para renovación</label>
            </div>
            <div class="input-group">
                <input class="input" required type="text" id="estado" name="estado" value="<?php echo $cliente['estado']; ?>" readonly>
                <label class="label" for="estado">Estado</label>
            </div>
            
            <script>
                function actualizarCosto() {
                    var select = document.getElementById("idPaquete");
                    var selectedOption = select.options[select.selectedIndex];
                    var precio = selectedOption.getAttribute("data-costo");
                                
                    document.getElementById("precio").value = precio ? precio : '';
                }
                            
             </script>


            <button id="BtnAgregar" type="submit" class="B1">Guardar</button>
        </form>
                        
        <?php
            } else {
                echo "Cliente no encontrado";
                }
            } else {
                echo "ID del cliente no proporcionado"; // Mostrar un mensaje si no se proporciona el ID del usuario
            }
        ?>

    </div>
</body>
</html>