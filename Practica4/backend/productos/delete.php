<?php
require_once '../../includes/database/conexion.php';

$claveProducto = $_POST['claveProducto'];

$sql = "DELETE FROM productos WHERE claveProducto='$claveProducto'";

if (mysqli_query($conexion, $sql)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>