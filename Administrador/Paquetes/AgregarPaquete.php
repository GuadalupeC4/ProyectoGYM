<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="website icon" type="png" href="Logo.jpg" style="border-radius: 50%;">
    <link rel="stylesheet" href="../Menu.css">
    <link rel="stylesheet" href="Paquete.css">
    <title>Agregar Paquetes</title>
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

    <div class="agregarPaquete">
        <form action="ControllerAgregarPaquete.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <input class="input" required type="text" id="nombrePaquete" name="nombrePaquete">
                <label class="label" for="nombrePaquete">Nombre del paquete</label>
            </div>
            <div class="input-group">
                <textarea class="input" id="descripcion" name="descripcion" rows="4" cols="6"  required></textarea>
                <label class="label" for="descripcion">Descripcion del paquete</label>
            </div>
            <div class="input-group">
                <input class="input" required type="number" id="precio" name="precio">
                <label class="label" for="precio">Precio</label>
            </div>
            <div class="input-group">
                <input type="file" id="imagen" name="imagen" accept="image/*" required>
            </div>
            <button id="BtnAgregar" type="submit" class="B1">Agregar paquete</button>
        </form>
        
    </div>



</body>
</html>