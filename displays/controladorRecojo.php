<?php
  session_start();
  ob_start();
  $producto = $_POST['producto'];
  $fechaInferior = $_POST['FechaInferior'];
  $fechaSuperior = $_POST['FechaSuperior'];
  $nroFormato = $_POST['NroFormato'];
  $nroPedido = $_POST['NroPedido'];
  $conexion = mysqli_connect("localhost","root","","teamfor");
  require "../conexiondb/consultas.php";
  $c = new consultas($conexion);
  if(!is_null($producto) && $producto !== ""){
    $vector = $c -> formatoApertura("%$producto%",$fechaInferior,$fechaSuperior,$nroFormato,$nroPedido);
    $_SESSION['vector']=$vector;
    echo json_encode($vector); 
  }else{
    $vector = $c -> formatoApertura(null,$fechaInferior,$fechaSuperior,$nroFormato,$nroPedido);
    $_SESSION['vector']=$vector;
    echo json_encode($vector);
  }
  //echo json_encode($fechaInferior);