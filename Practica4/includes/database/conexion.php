<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $base_de_datos = "tienda";

    $conexion = new mysqli($servidor, $usuario, $clave, $base_de_datos);

    if ($conexion->connect_error) {
        die("ERROR: No se puede conectar al servidor remoto " . $conexion->connect_error);
    }
?>