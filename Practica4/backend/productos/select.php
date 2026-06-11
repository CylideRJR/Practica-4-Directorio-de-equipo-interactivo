<?php
require_once 'includes/database/conexion.php';

function obtenerProductos($conexion) {
    $query = "SELECT claveProducto, nombreProducto, precioProducto, descripcion 
            FROM productos";
            
    $resultado = mysqli_query($conexion, $query);
    $productos = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila;
    }

    return $productos;
}

?>