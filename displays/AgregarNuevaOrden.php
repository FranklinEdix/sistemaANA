<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
$Orden = $_POST['Orden'];
$fechaRecojo = $_POST['FechaRecojo'];
$chofer = $_POST['Chofer'];
$cantidad = $_POST['Cantidad'];
$fecha = $_POST['fecha'];
ob_start();
$empleado = $_SESSION['user'];
$c->agregarNuevaOrden($Orden, $chofer, $fechaRecojo, $cantidad, $empleado, $fecha);