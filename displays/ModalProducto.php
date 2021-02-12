<?php
session_start();
ob_start();
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <br>
    <center>
        <h4>Codigo de Orden: <?php echo $_GET['id'] ?></h4>
        <div class="container">
            <div class="row displayFirst__formato-table">
                <div class="col-10">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">IdProducto</th>
                                <th scope="col">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $vector = $c->mostrarProducto($_GET['id']);

                            //echo '<h4>'.$vector.'</h4>';
                            for ($i = 0; $i < count($vector); $i++) {
                            ?>
                            <tr>
                                <td><?php echo $vector[$i][0]; ?></td>
                                <td><?php echo $vector[$i][1]; ?></td>
                            </tr>
                            <?php }
                            $_SESSION['vector'] = null; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </center>
</body>

</html>