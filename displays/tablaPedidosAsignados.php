<?php
session_start();
ob_start();
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
$idAsignacion = $_POST['Id'];
$_SESSION['idPedidosAsignados'] = $_POST['Id'];
$cadena = str_replace(' ', null, $idAsignacion); //para quitar espacios
$_SESSION['vectorPedidosAsignados'] = $c->mostrarAsignacionOrden($cadena);
$tamaño = count($_SESSION['vectorPedidosAsignados']);
echo json_encode($tamaño);