<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
$Orden = $_POST['OrdenAsignar'];
$NroAsignacion = $_POST['NroAsignacion'];
$Pedido = $_POST['Pedido'];
$cantidad = $_POST['cantidadPedidoAsignado'];
$c->asignarPedido($NroAsignacion, $Pedido, $Orden, $cantidad);
echo json_decode($cantidadSolicitada);