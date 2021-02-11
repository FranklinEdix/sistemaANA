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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
</head>

<body>
    <center>
        <div class="container" style="display: flex;">
            <div class="col-12">
                </table>
                <div class="row displayFirst__formato-table">
                    <div class="col-12">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nro</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Banco</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Responsable</th>
                                    <th scope="col">Ventanilla</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $vector = $c->consultaDeposito($_GET['id']);
                                if ($vector !== "Error" && $vector !== null) {
                                    //echo '<h4>'.$vector.'</h4>';
                                    for ($i = 0; $i < count($vector); $i++) {
                                ?>
                                <tr>
                                    <td><?php echo $vector[$i][0]; ?></td>
                                    <td><?php echo $vector[$i][5]; ?></td>
                                    <td><?php echo $vector[$i][3]; ?></td>
                                    <td><?php echo $vector[$i][2]; ?></td>
                                    <td><?php echo $vector[$i][6]; ?></td>
                                    <td><?php echo $vector[$i][4]; ?></td>
                                    <td><a href="#myModal1" type="button" class="btn btn-primary" data-toggle="modal"><i
                                                class="bi bi-pencil-square"></i></a></td>
                                </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <script>
                    $('.modal-child').on('show.bs.modal', function() {
                        var modalParent = $(this).attr('data-modal-parent');
                        $(modalParent).css('opacity', 0);
                    });

                    $('.modal-child').on('hidden.bs.modal', function() {
                        var modalParent = $(this).attr('data-modal-parent');
                        $(modalParent).css('opacity', 1);
                    });
                    </script>

                </div>
            </div>
    </center>
</body>

</html>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>