<?php
    include("preguntas.php");
    $respuesta1 = fechaVentas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard Empresa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <p class="text-3xl">Relacionado con ventas</p>
    <p class="text-xl">1. ¿Que ventas se realizaron del 2020 en adelante?</p>
    <button onclick="toggleAnswer()">Mostrar/Ocultar Respuesta</button>
    <div id="respuesta" style="display: none;">
        <?php while($fila = mysqli_fetch_array($respuesta1))
        {
            ?>
            <tr>
                <td"><?php echo $fila['ID_ventas']?></td>
                <td><?php echo $fila['Fecha']?></td>
                <td><?php echo $fila['ID_Cliente']?></td>
                <td><?php echo $fila['ID_Producto']?></td>
                <td><?php echo $fila['Cantidad']?></td>
                <td><?php echo $fila['Precio_Unitario']?></td>
            </tr>
            <br>
            <?php
        }
        ?>
    </div>
    <script>
        function toggleAnswer() {
            var respuesta = document.getElementById("respuesta");
            if (respuesta.style.display === "none") {
                respuesta.style.display = "block";
            } else {
                respuesta.style.display = "none";
            }
        }
    </script>
</body>
</html>
