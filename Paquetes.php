<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="website icon" type="png" href="Img-Logo/Logo.jpg" style="border-radius: 50%;">
    <link rel="stylesheet" href="Menu.css">
    <link rel="stylesheet" href="Paquetes.css">
    <title>Paquetes</title>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="Sesión/Login.php"><img src="Img-Logo/Logo.jpg"></a>
            <h1 class="logo">GYM</h1>
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
                <li class="li_links"><a href="Inicio.html" class="link">Inicio</a></li>
                <li class="li_links"><a href="Paquetes.php" class="link">Paquetes</a></li>
                <li class="li_links"><a href="Productos.php" class="link">Prodcutos</a></li>
            </ul>

        </nav>
    </header>
    <div class="paquetes">
        <div class="row">
            <?php
            require_once 'Model.php';
            $model = new Model();            
            $datosPaquetes = $model->obtenerDatosPaquete();
            if ($datosPaquetes) {
                foreach($datosPaquetes as $paquete){
            ?>           
            <div class="column">
                <img src="http://localhost/ProyectoGYM/Administrador/ImagenesPaquetes/<?php echo htmlspecialchars($paquete['imagen']); ?>">
                <div class="contenido">
                    <h3 class="title"><?php echo $paquete['nombrePaquete']; ?></h3>
                    <div class="lista">
                        <?php
                        $descripcion = explode(".", $paquete["descripcion"]); 
                        echo  "<ul class='contenido'>";
                        foreach ($descripcion as $lista){
                            echo "  <li>" . $lista . "</li>";
                        }
                        echo   "</ul>";             
                        ?>
                    </div>
                    <h4>$<?php echo $paquete['precio']; ?></h4>
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>   
</body>
</html>