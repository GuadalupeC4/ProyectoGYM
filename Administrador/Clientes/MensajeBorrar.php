<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Mensaje.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="modal">
        <div class="modal-content">
            <span class="closeIcon"><i class='bx bx-x'></i></i></span>
            <div class="modal-body">
                <span class="icon"><i class='bx bxs-info-circle'></i></span>
                <div class="right-items">
                    <h1 id="modalTitle"></h1>
                    <p id="modalText"></p>
                    <button id="okBtn">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Obtener el parámetro 'status' de la URL
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get("status");

        if (status) {
            const modal = document.getElementById("modalMessage");
            const modalTitle = document.getElementById("modalTitle");
            const modalText = document.getElementById("modalText");

            if (status === "success") {
                modalTitle.innerText = "¡Éxito!";
                modalText.innerText = "El producto ha sido eliminado correctamente.";
            } else {
                modalTitle.innerText = "Ooops!";
                modalText.innerText = "Hubo un error al eliminar el producto.";
            }

            modal.style.display = "block";

            document.getElementById("okBtn").addEventListener("click", function () {
                modal.style.display = "none";
                window.location.href = "Productos.php"; // Redirigir a la página principal
            });

            document.querySelector(".closeIcon").addEventListener("click", function () {
                modal.style.display = "none";
                window.location.href = "Productos.php";
            });
        }
    });
</script>


</body>
</html>