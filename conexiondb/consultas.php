<?php 
    class consultas{
        public $conexion;
        public function __construct($conexion)
        {
            $this -> conexion = $conexion;
        }
        function formatoApertura($producto, $fechaInferior, $fechaSuperior, $nroFormato, $pedido){
            $sql = "SELECT * FROM pedido WHERE IdProducto IN(SELECT IdProducto FROM producto WHERE NombreProduto LIKE '$producto') OR (FechaPedido >= '$fechaInferior' AND FechaPedido <= '$fechaSuperior') OR Formato = '$nroFormato' OR IdPedido = '$pedido'"; //Concatenar con porcentaje cuando el campo de filtrar producto esta en uso             
            $result = mysqli_query($this -> conexion, $sql);
            if($result){
            $vector = array();
            while($array = mysqli_fetch_array($result)){
                $vector[] = $array;
            }
            return $vector;
            }else{
                return "Error";
            }
        }
        function formatoAperturaTotal(){
            $sql = "SELECT * FROM pedido";
            $result = mysqli_query($this -> conexion, $sql);
            if($result){
                $vector = array();
                while($array = mysqli_fetch_array($result)){
                    $vector[] = $array;
                }
                return $vector;
                }else{
                    return "Error";
                }        
        }
        function insertarNuevoPedido($IdPedido,$IdProducto,$IdDistribuidora,$IdEmpleado,$Cantidad,$CostoPedido,$FechaPedido,$Formato){
            $sql = "INSERT INTO pedido (IdPedido,IdProducto,IdDistribuidora,IdEmpleado,Cantidad,CostoPedido,FechaPedido,CantidadRestante,MontoRestante,Formato) VALUES ('$IdPedido','$IdProducto','$IdDistribuidora','$IdEmpleado','$Cantidad','$CostoPedido','$FechaPedido','$Cantidad','$CostoPedido','$Formato')";
            $result = mysqli_query($this -> conexion, $sql);
        }
        function costoProducto($IdProducto){
            $sql = "SELECT * FROM producto WHERE IdProducto = '$IdProducto'";
            $result = mysqli_query($this -> conexion, $sql);
            if($result){
            $row = mysqli_fetch_row($result);
            return $row[2];
            }else{
                return -1;
            }
        }
        function consultaPedido($IdPedido){
            $sql = "SELECT * FROM pedido WHERE IdPedido = '$IdPedido'";
            $result = mysqli_query($this -> conexion, $sql);
            if($result){
                $vector = mysqli_fetch_row($result);
                return $vector;
            }else{
                return -1;
            }        
        }
        function contarPedido($nombreTabla, $IdPedido){
            $sql = "SELECT COUNT(*) FROM $nombreTabla WHERE IdPedido = '$IdPedido'";
            $result = mysqli_query($this -> conexion, $sql);
            if($result){
                $vector = mysqli_fetch_row($result);
                return $vector[0];
            }else{
                return -1;
            } 
        }
        function modificarPedido($IdPedido,$IdProducto,$IdDistribuidora,$IdEmpleado,$Cantidad,$CostoPedido,$FechaPedido,$Formato,$id){
            $sql = "UPDATE pedido SET IdPedido='$IdPedido',IdProducto='$IdProducto',IdDistribuidora='$IdDistribuidora',IdEmpleado='$IdEmpleado',Cantidad='$Cantidad',CostoPedido='$CostoPedido',FechaPedido='$FechaPedido',CantidadRestante='$Cantidad',MontoRestante='$CostoPedido',Formato='$Formato' WHERE IdPedido = '$id'";
            $result = mysqli_query($this -> conexion, $sql);
        }
    }
?>
