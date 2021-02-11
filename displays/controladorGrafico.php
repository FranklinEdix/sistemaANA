<?php
$idGeneral = $_POST['Id'];
$idDeposito = substr(0, 3);
$idPedido = substr(4, 7);
echo json_encode($idDeposito)
/*
function dividir($id)
{
}
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require '../conexiondb/consultas.php';
$c = new consultas($conexion);
$consulta = $c->TraerDatosGraficoBar();
echo json_encode($consulta);*/