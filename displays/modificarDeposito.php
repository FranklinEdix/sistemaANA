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
$c->editarDeposito($NroDeposito, $Banco, $NroVentanilla, $fecha, $NroPedido);