<?php
require_once '../../includes/database/conexion.php';

$claveProducto = $_POST['claveProducto'];
$nombreProducto = $_POST['nombreProducto'];
$precioProducto = $_POST['precioProducto'];
$descripcion = $_POST['descripcion'];

$sql = "UPDATE productos 
        SET nombreProducto='$nombreProducto', 
            precioProducto=$precioProducto, 
            descripcion='$descripcion' 
        WHERE claveProducto='$claveProducto'";

$stmt = $conexion->prepare("UPDATE productos SET nombreProducto=?, precioProducto=?, descripcion=? WHERE claveProducto=?");
$stmt->bind_param("sdss", $nombreProducto, $precioProducto, $descripcion, $claveProducto);

if (mysqli_query($conexion, $sql)) {
    // Si sale bien, respondemos con JSON
    echo json_encode(["status" => "success"]);
} else {
    // Si hay error, respondemos con JSON
    echo json_encode(["status" => "error"]);
}
?>