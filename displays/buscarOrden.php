<?php
session_start();
ob_start();
$chofer = $_POST['chofer'];
$NroDeOrden = $_POST['NroDeOrden'];
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
if (!is_null($chofer) && $chofer !== "") {
    $vector = $c->buscarOrden("%$chofer%", $NroDeOrden);
    $_SESSION['vector_orden'] = $vector;
    echo json_encode($vector);
} else {
    $vector = $c->buscarOrden(null, $NroDeOrden);
    $_SESSION['vector_orden'] = $vector;
    echo json_encode($vector);
}
  //echo json_encode($fechaInferior);