<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
$Orden = $_POST['OrdenAsignar'];
$NroAsignacion = $_POST['NroAsignacion'];
$Pedido = $_POST['Pedido'];
$CantidadSolicitada = $_POST['CantidadSolicitada'];
//$c->asignarPedido($NroAsignacion, $Pedido, $Orden, $cantidadSolicitada);
echo json_encode($NroAsignacion);