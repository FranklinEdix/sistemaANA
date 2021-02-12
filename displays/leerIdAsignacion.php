<?php
session_start();
ob_start();
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
$id = $_SESSION['idPedidosAsignados'];
$tamaño = $c->mostrarAsignacionOrden($id);
if ($tamaño !== null and $tamaño !== "Error") {
    echo json_encode(count($tamaño));
} else {
    echo json_encode("Error");
}