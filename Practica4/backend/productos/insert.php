<?php
require_once '../../includes/database/conexion.php';

$claveProducto = $_POST['claveProducto'];
$nombreProducto = $_POST['nombreProducto'];
$precioProducto = $_POST['precioProducto'];
$descripcion = $_POST['descripcion'];

$sql = "INSERT INTO productos(claveProducto, nombreProducto, precioProducto, descripcion)
                     VALUES ('$claveProducto' , '$nombreProducto', $precioProducto, '$descripcion')";

if (mysqli_query($conexion, $sql)) {
    // Si sale bien, respondemos con JSON
    echo json_encode(["status" => "success"]);
} else {
    // Si hay error, respondemos con JSON
    echo json_encode(["status" => "error"]);
}
?>
