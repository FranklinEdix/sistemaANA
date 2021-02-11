<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
$NroDeposito = $_POST['NroDeposito'];
$Monto = $_POST['Monto'];
$Banco = $_POST['Banco'];
$NroVentanilla = $_POST['NroVentanilla'];
$fecha = $_POST['fecha'];
$NroPedido = $_POST['NumeroPedido'];
ob_start();
$empleado = $_SESSION['user'];
$c->nuevoDeposito($NroDeposito, $NroPedido, $Monto, $Banco, $NroVentanilla, $fecha, $empleado);
echo json_encode($NroDeposito);