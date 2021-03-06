<?php
class consultas
{
    public $conexion;
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    function formatoApertura($producto, $fechaInferior, $fechaSuperior, $nroFormato, $pedido)
    {
        $sql = "SELECT * FROM pedido WHERE IdProducto IN(SELECT IdProducto FROM producto WHERE NombreProduto LIKE '$producto') OR (FechaPedido >= '$fechaInferior' AND FechaPedido <= '$fechaSuperior') OR Formato = '$nroFormato' OR IdPedido = '$pedido'"; //Concatenar con porcentaje cuando el campo de filtrar producto esta en uso             
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = array();
            while ($array = mysqli_fetch_array($result)) {
                $vector[] = $array;
            }
            return $vector;
        } else {
            return "Error";
        }
    }
    function formatoAperturaTotal()
    {
        $sql = "SELECT * FROM pedido";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = array();
            while ($array = mysqli_fetch_array($result)) {
                $vector[] = $array;
            }
            return $vector;
        } else {
            return "Error";
        }
    }
    function insertarNuevoPedido($IdPedido, $IdProducto, $IdDistribuidora, $IdEmpleado, $Cantidad, $CostoPedido, $FechaPedido, $Formato)
    {
        $sql = "INSERT INTO pedido (IdPedido,IdProducto,IdDistribuidora,IdEmpleado,Cantidad,CostoPedido,FechaPedido,CantidadRestante,MontoRestante,Formato) VALUES ('$IdPedido','$IdProducto','$IdDistribuidora','$IdEmpleado','$Cantidad','$CostoPedido','$FechaPedido','$Cantidad','$CostoPedido','$Formato')";
        $result = mysqli_query($this->conexion, $sql);
    }
    function costoProducto($IdProducto)
    {
        $sql = "SELECT * FROM producto WHERE IdProducto = '$IdProducto'";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $row = mysqli_fetch_row($result);
            return $row[2];
        } else {
            return -1;
        }
    }
    function consultaPedido($IdPedido)
    {
        $sql = "SELECT * FROM pedido WHERE IdPedido = '$IdPedido'";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = mysqli_fetch_row($result);
            return $vector;
        } else {
            return -1;
        }
    }
    function contarPedido($nombreTabla, $IdPedido)
    {
        $sql = "SELECT COUNT(*) FROM $nombreTabla WHERE IdPedido = '$IdPedido'";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = mysqli_fetch_row($result);
            return $vector[0];
        } else {
            return -1;
        }
    }
    function modificarPedido($IdPedido, $IdProducto, $IdDistribuidora, $IdEmpleado, $Cantidad, $CostoPedido, $FechaPedido, $Formato, $id)
    {
        $sql = "UPDATE pedido SET IdPedido='$IdPedido',IdProducto='$IdProducto',IdDistribuidora='$IdDistribuidora',IdEmpleado='$IdEmpleado',Cantidad='$Cantidad',CostoPedido='$CostoPedido',FechaPedido='$FechaPedido',CantidadRestante='$Cantidad',MontoRestante='$CostoPedido',Formato='$Formato' WHERE IdPedido = '$id'";
        $result = mysqli_query($this->conexion, $sql);
    }
    function nombreEmpleado($IdEmpleado)
    {
        $sql = "SELECT * FROM empleado WHERE IdEmpleado = '$IdEmpleado'";
        $result = mysqli_query($this->conexion, $sql);
        $row = mysqli_fetch_row($result);
        return $row[2];
    }
    function consultaDeposito($IdPedido)
    {
        $sql = "SELECT * FROM deposito WHERE IdPedido = '$IdPedido'"; //Concatenar con porcentaje cuando el campo de filtrar producto esta en uso             
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = array();
            while ($array = mysqli_fetch_array($result)) {
                $vector[] = $array;
            }
            return $vector;
        } else {
            return "Error";
        }
    }
    function nuevoDeposito($NroDeposito, $NroPedido, $Monto, $Banco, $NroVentanilla, $fecha, $empleado)
    {
        $sql = "INSERT INTO deposito (IdDeposito,IdPedido,MontoDeposito,NombreBanco,NumeroVentanilla,FechaDeposito,IdEmpleado) VALUES ('$NroDeposito', '$NroPedido', '$Monto', '$Banco', '$NroVentanilla', '$fecha', '$empleado')";
        $result = mysqli_query($this->conexion, $sql);
    }
    function editarDeposito($IdDeposito, $nombreBanco, $NumeroVentanilla, $fecha, $IdPedido)
    {
        $sql = "UPDATE deposito SET NombreBanco='$nombreBanco',NumeroVentanilla='$NumeroVentanilla',FechaDeposito='$fecha' WHERE IdDeposito = '$IdDeposito' AND IdPedido = '$IdPedido'";
        $result = mysqli_query($this->conexion, $sql);
    }
    function mostrarDesposito($IdDeposito, $IdPedido)
    {
        $sql = "SELECT*FROM deposito WHERE IdDeposito = '$IdDeposito' AND IdPedido = '$IdPedido'";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $row = mysqli_fetch_row($result);
            return $row;
        } else {
            return "error";
        }
    }
    function mostrarOrdenesDeRecojo()
    {
        $sql = "SELECT*FROM pedidochofer";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = array();
            while ($array = mysqli_fetch_array($result)) {
                $vector[] = $array;
            }
            return $vector;
        } else {
            return "Error";
        }
    }
    function buscarOrden($chofer, $NroDeOrden)
    {
        $sql = "SELECT * FROM pedidochofer WHERE IdChofer IN(SELECT IdChofer FROM chofer WHERE NombreChofer LIKE '$chofer') OR IdPedidoChofer = '$NroDeOrden'"; //Concatenar con porcentaje cuando el campo de filtrar producto esta en uso             
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = array();
            while ($array = mysqli_fetch_array($result)) {
                $vector[] = $array;
            }
            return $vector;
        } else {
            return "Error";
        }
    }
    function mostrarProducto($pedidoChofer)
    {
        $sql = "SELECT*FROM producto WHERE IdProducto IN(SELECT IdProducto FROM pedido WHERE IdPedido In(SELECT IdPedido FROM pedidoentregado WHERE IdPedidoChofer = '$pedidoChofer'))";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = array();
            while ($array = mysqli_fetch_array($result)) {
                $vector[] = $array;
            }
            return $vector;
        } else {
            return "Error";
        }
    }
    function cantidadRecogido($pedidoChofer)
    {
        $sql = "SELECT SUM(CantidadEntregado) FROM pedidoentregado WHERE IdPedidoChofer = '$pedidoChofer'";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $array = mysqli_fetch_array($result);
            return $array[0];
        } else {
            return "Error";
        }
    }
    function agregarNuevaOrden($Orden, $chofer, $fechaRecojo, $cantidad, $empleado, $fecha)
    {
        $sql = "INSERT INTO pedidochofer (IdPedidoChofer,IdChofer,CantidadPedido,FechaRecojo,IdEmpleado,FechaEmision) VALUES ('$Orden', '$chofer', '$cantidad', '$fechaRecojo', '$empleado', '$fecha')";
        $result = mysqli_query($this->conexion, $sql);
    }
    function asignarPedido($IdAsignar, $IdPedido, $IdOrden, $cantidadSolicitada)
    {
        $sql = "INSERT INTO asignarpedido (IdAsignarPedido,IdPedido,IdPedidoChofer,CantidadSolicitada) VALUES ('$IdAsignar', '$IdPedido', '$IdOrden', '$cantidadSolicitada')";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            return "Ok";
        } else {
            return "error";
        }
    }
    function consultaAsignacion($IdPedidoChofer)
    {
        $sql = "SELECT*FROM pedidochofer WHERE IdPedidoChofer = '$IdPedidoChofer'";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $row = mysqli_fetch_row($result);
            return $row;
        } else {
            return "error";
        }
    }
    function contarOrdenPedido($IdPedidoChofer)
    {
        $sql = "SELECT COUNT(*) FROM asignarpedido WHERE IdPedidoChofer = '$IdPedidoChofer'";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = mysqli_fetch_row($result);
            return $vector[0];
        } else {
            return -1;
        }
    }
    function editarOrden($id, $Orden, $chofer, $fechaRecojo, $cantidad, $empleado, $fecha)
    {
        $sql = "UPDATE pedidochofer SET IdPedidoChofer = '$Orden', IdChofer = '$chofer', CantidadPedido = '$cantidad', FechaRecojo = '$fechaRecojo', IdEmpleado = '$empleado', FechaEmision = '$fecha' WHERE IdPedidoChofer = '$id'";
        $result = mysqli_query($this->conexion, $sql);
    }
    function mostrarRecojo()
    {
        $sql = "SELECT IdPedidoChofer FROM pedidochofer";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = array();
            while ($array = mysqli_fetch_array($result)) {
                $vector[] = $array;
            }
            return $vector;
        } else {
            return "Error";
        }
    }
    function mostrarAsignacionOrden($IdPedidoChofer)
    {
        $sql = "SELECT*FROM asignarpedido WHERE IdPedidoChofer = '$IdPedidoChofer'";
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $vector = array();
            while ($array = mysqli_fetch_array($result)) {
                $vector[] = $array;
            }
            return $vector;
        } else {
            return "Error";
        }
    }
}