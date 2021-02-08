<?php 
$conexion = mysqli_connect("localhost","root","","teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
session_start();
ob_start();
$producto = $_POST['producto'];
$compra = $_POST['compra'];
$cantidad = $_POST['cantidad'];
$formato = $_POST['formato'];
$fecha = $_POST['fecha'];
$empleado = 'EM01';
$distribuidora = $_POST['distribuidora'];
$costoProduto = $c -> costoProducto($producto);
if($costoProduto > 0){
$costoTotal = $cantidad* $costoProduto;
//$IdPedido,$IdProducto,$IdDistribuidora,$IdEmpleado,$Cantidad,$CostoPedido,$FechaPedido,$Formato
$c -> modificarPedido($compra,$producto,$distribuidora,$empleado,$cantidad,$costoTotal,$fecha,$formato,$_SESSION['idProducto']);
echo json_encode($_SESSION['idProducto']);
}else{
    echo json_encode("Error");
}
?>