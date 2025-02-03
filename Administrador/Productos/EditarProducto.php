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

    <div class="agregarProducto">
        <?php
            // Verificar si se recibió el parámetro 'idProducto' en la URL
            if (isset($_GET['idProducto'])) {
            // Obtener el idProducto del usuario que se está editando
            $id_Producto = $_GET['idProducto']; // Suponiendo que el ID se pasa como un parámetro de la URL

            // Incluir el archivo que contiene la clase ModelUsuarioId
            require_once 'ModelProducto.php'; // Cambia esto a 'ModelUsuarioId.php' si ese es el nombre correcto del archivo

            // Crear una instancia de la clase ModelUsuarioId
            $modelProducto = new Model();

            // Obtener los datos del usuario por su ID
            $producto = $modelProducto->obtenerProductoPorID($id_Producto);

            // Verificar si se obtuvieron los datos del producto
            if ($producto) {
        ?>
        <form action="ControllerEditarProducto.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idProducto" value="<?php echo $producto['idProducto']; ?>">
            <div class="input-group">
                <input class="input" required type="text" id="nombreProducto" name="nombreProducto" value="<?php echo $producto['nombreProducto']; ?>">
                <label class="label" for="nombreProducto">Nombre del producto</label>
            </div>
            <div class="input-group">
                <textarea class="input" id="descripcion" name="descripcion" rows="4" cols="6"  required><?php echo $producto['descripcion']; ?></textarea>
                <label class="label" for="descripcion">Descripcion del producto</label>
            </div>
            <div class="input-group">
                <input class="input" required type="number" id="precio" name="precio" value="<?php echo $producto['precio']; ?>">
                <label class="label" for="precio">Precio del producto</label>
            </div>
        

            <button id="BtnAgregar" type="submit" class="BtnAgregar">Agregar Producto</button>
        </form>
        <?php
            } else {
                echo "Paquete no encontrado";
                }
            } else {
                echo "ID del paquete no proporcionado"; // Mostrar un mensaje si no se proporciona el ID del usuario
            }
        ?>
        
    </div>

</body>
</html>