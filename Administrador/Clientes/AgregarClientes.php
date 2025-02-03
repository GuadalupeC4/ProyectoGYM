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
        <form action="ControllerAgregarCliente.php" method="POST" >
            <div class="input-group">
                <input class="input" required type="text" id="nombreCliente" name="nombreCliente">
                <label class="label" for="nombreCliente">Nombre</label>
            </div>
            <div class="input-group">
                <input class="input" required type="date" id="inscripcion" name="inscripcion">
            </div>
            <div class="input-group">
                <input class="input" required type="date" id="renovacion" name="re" readonly>
            </div>
            <div class="input-group">
                <input class="input" required type="number" id="dias_restantes" name="di" readonly>
                <!--<label class="label" for="dias_restantes">Días restantes para renovación</label>-->
            </div>


            <script>
                const inscripcionInput = document.getElementById('inscripcion');
                const renovacionInput = document.getElementById('renovacion');
                const diasRestantesInput = document.getElementById('dias_restantes');
                
                inscripcionInput.addEventListener('input', () => {
                    const inscripcionDate = new Date(inscripcionInput.value);

                    if (!isNaN(inscripcionDate)) {
                        // Sumar un mes a la fecha de inscripción
                        const renovacionDate = new Date(inscripcionDate);
                        renovacionDate.setMonth(renovacionDate.getMonth() + 1);

                        // Ajustar el día si se pasa al mes siguiente
                        if (renovacionDate.getDate() !== inscripcionDate.getDate()) {
                            renovacionDate.setDate(0); // Va al último día del mes anterior
                        }

                        // Formatear la fecha a YYYY-MM-DD
                        const formattedDate = renovacionDate.toISOString().split('T')[0];
                        renovacionInput.value = formattedDate;

                        // Calcular días restantes para la renovación
                        const today = new Date();
                        const diffRenovacion = Math.ceil((renovacionDate - today) / (1000 * 60 * 60 * 24));
                        diasRestantesInput.value = diffRenovacion >= 0 ? diffRenovacion : 0;

                    } else {
                        renovacionInput.value = '';
                        diasRestantesInput.value = '';
                        diasDesdeInscripcionInput.value = '';
                    }
                });
            </script>

            <div class="input-group">
                <select name="idPaquete" id="idPaquete" class="input" onchange="actualizarCosto()">
                    <option value="">Selecciona un paquete</option>
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
                <input type="number" class="input" id="precio" value="" readonly>
                <!--<label class="label" for="username">Precio</label>-->
            </div>
            

            <script>
                function actualizarCosto() {
                    var select = document.getElementById("idPaquete");
                    var selectedOption = select.options[select.selectedIndex];
                    var precio = selectedOption.getAttribute("data-costo");
                                
                    document.getElementById("precio").value = precio ? precio : '';
                }
                            
             </script>


            <button id="BtnAgregar" type="submit" class="B1">Agregar</button>
        </form>
        
    </div>


</body>
</html>