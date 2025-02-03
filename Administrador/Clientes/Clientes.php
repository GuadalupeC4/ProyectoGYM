<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="website icon" type="png" href="/Logo.jpg" style="border-radius: 50%;">
    <link rel="stylesheet" href="../Menu.css">
    <link rel="stylesheet" href="Clientes.css">
    <title>Clientes</title>
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

    <section  class="home-section">
        <div class="Bloque1">
            <div class="agregar-curso">
                <button id="BtnAgregar" type="submit" class="B1">Agregar</button>
                <script>
                    var boton1 = document.getElementById('BtnAgregar');
                    boton1.addEventListener('click', function() {
                        window.location.href = 'AgregarClientes.php';
                    });
                </script>
            </div>
            
            <?php
            require_once 'ModelCliente.php';

            // Obtener los datos de los clientes
            $datosClientes = obtenerDatosCliente();

            ?>
            <table class="TbUsuario">
                <thead class="ECUsuario">
                    <tr>
                        <th>No.</th>
                        <th>NOMBRE</th>
                        <th>FECHA DE INSCRIPCIÓN</th>
                        <th>FECHA DE RENOVACIÓN</th>
                        <th>PAQUETE</th>
                        <th>DIAS</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="CRUsuario">
                <?php
                    // Verificar si hay datos de clientes para mostrar
                    if ($datosClientes) {
                        // Iterar sobre los datos de los clientes y generar las filas de la tabla
                        foreach ($datosClientes as $cliente) {
                            echo "<tr>";
                            echo "<td>" . $cliente['idCliente'] . "</td>";
                            echo "<td>" . $cliente['nombreCliente'] . "</td>";
                            echo "<td>" . $cliente['inscripcion'] . "</td>";
                            echo "<td>" . $cliente['renovacion'] . "</td>";
                            echo "<td>" . $cliente['idPaquete'] . "</td>";
                            echo "<td>" . $cliente['dias'] . "</td>";
                            echo "<td>" . $cliente['estado'] . "</td>";
                            echo "<td>
                                    <form action='EditarCliente.php' method='GET' style='display: inline;'>
                                        <input type='hidden' name='idCliente' value='" . $cliente['idCliente'] . "'>
                                        <button type='submit' class='BtnEditar'>Editar</button>
                                    </form>
                                    <form action='BorrarCliente.php' method='POST' style='display: inline;'>
                                        <input type='hidden' name='idCliente' value='" . $cliente['idCliente'] . "'>
                                        <button type='submit' class='BtnBorrar'>Borrar</button>
                                    </form>
                                </td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No se encontraron clientes.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    
</body>
</html>