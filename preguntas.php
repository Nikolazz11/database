<?php
    include("conexion.php");

    //PREGUNTA 1
    //Obtener las ventas por su año en la FECHA
    function fechaVentas(){
        $conexion=conexion_db();
        $consulta= "SELECT * FROM ventas WHERE Fecha > '2019-12-31'";
        $result=mysqli_query($conexion, $consulta);
        return $result;
    }
?>