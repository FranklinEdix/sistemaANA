<?php 
$conexion = mysqli_connect("localhost","root","","teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
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
$c -> insertarNuevoPedido($compra,$producto,$distribuidora,$empleado,$cantidad,$costoTotal,$fecha,$formato);
echo json_encode($producto);
}else{
    echo json_encode("Error");
}
?>