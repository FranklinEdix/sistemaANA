<?php 
    include("conexiondb/conexion.php");
    $usuario = $_POST['USUARIO'];
    $contraseña = $_POST['CLAVE'];
    $sql = "SELECT*FROM empleado WHERE IdEmpleado = '$usuario' AND Pass = '$contraseña'";
    $result = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_row($result);
    if($row){
        header("Location: displays/formato.php");
    }else{?>
    <h4> Datos incorrectos
    </h4>
      <?php
        include("login.html");
    }
    echo $usuario.$contraseña;

?>