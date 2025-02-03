<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="website icon" type="png" href="/Logo.jpg" style="border-radius: 50%;">
    <link rel="stylesheet" href="../Menu.css">
    <link rel="stylesheet" href="Producto.css">
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

    <div class="Bloque1">
        <?php
        require_once 'ModelProducto.php';
        $model = new Model(); // Crear una instancia del modelo
        // Obtener los datos de los cursos
        $datosProductos = $model->obtenerDatosProducto();
        ?>
        <div class="ContenedorCursos">
            <div class="row">
               <?php 
               $existenProductos = false;
               if ($datosProductos) {
                foreach ($datosProductos as $Producto) {
                    echo "<div class='NuevoCurso'>";
                    echo "   <img src='http://localhost/ProyectoGYM/Administrador/ImagenesProductos/" . htmlspecialchars($Producto['imagen']) . "' onerror=this.src='../imgs/noimage.png'>";
                    echo "   <p class='NomCurso'>" . $Producto['nombreProducto'] . "</p> ";
                    echo "   <div class='btns'>"; 
                    echo "      <form action='EditarProducto.php' method='GET' style='display: inline;'>";
                    echo "          <input type='hidden' name='idProducto' value='" . $Producto['idProducto'] . "'>"; // Corregir la variable de ID
                    echo "          <button type='submit' class='BtnEditar'>Editar</button>";
                    echo "      </form>";
                    echo "      <form action='BorrarProducto.php' method='POST' style='display: inline;'>";
                    echo "          <input type='hidden' name='idProducto' value='" . $Producto['idProducto'] . "'>"; // Corregir la variable de ID
                    echo "          <button type='submit' class='BtnBorrar'>Borrar</button>";
                    echo "      </form>";
                    echo "   </div>";
                    echo "</div>";
                    $existenProductos = true;
                }
                } else {
                    echo "<div class='AgregarCurso' style='max-width: 80%;'>";
                    echo "    <a href='AgregarProducto.php'>";
                    echo "       <i class='bx bx-plus'></i>";
                    echo "       <span class='NomCurso'>Agregar Producto</span> ";
                    echo "    </a>";
                    echo "</div>";
                }
               

                // Verifica si existen cursos y ajusta el ancho de AgregarCurso
                if ($existenProductos) {
                    echo "<div class='AgregarCurso' style='max-width: 20%;'>";
                    echo "    <a href='AgregarProducto.php'>";
                    echo "       <i class='bx bx-plus'></i>";
                    echo "       <span class='NomCurso'>Agregar Producto</span> ";
                    echo "    </a>";
                    echo "</div>";
                }
                ?>
            </div>    
        </div>
    </div> 

</body>
</html>