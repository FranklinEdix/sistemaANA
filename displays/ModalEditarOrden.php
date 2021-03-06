<?php
session_start();
ob_start();
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
ob_start();
$nombre = $c->nombreEmpleado($_SESSION['user']);
$b = false;
$contar = $c->contarOrdenPedido($_GET['id']);
if ($contar > 0) {
    $b = true;
}
$vector = $c->consultaAsignacion($_GET['id']);
$_SESSION['idEditarOrden'] = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<script>
function creaObjetoAjax() {
    var obj;
    if (window.XMLHttpRequest) {
        obj = new XMLHttpRequest();
    } else { //para IE 5 y IE 6
        obj = new ActiveXObject(Microsoft.XMLHTTP);
    }
    return obj;
}

function Mostrar(event) {
    //const producto = event.target.value;
    let Orden = document.getElementById('Orden').value;
    let FechaRecojo = document.getElementById('FechaRecojo').value;
    let Chofer = document.getElementById('Chofer').value;
    let fecha = document.getElementById('Fecha').value;
    let Cantidad = document.getElementById('Cantidad').value;
    let objajx = creaObjetoAjax();
    const parametros = "&Orden=" + Orden + "&FechaRecojo=" + FechaRecojo + "&Chofer=" +
        Chofer +
        "&fecha=" + fecha + "&Cantidad=" + Cantidad;
    objajx.open("POST", "editarOrden.php", true);
    objajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    objajx.send(parametros);
    objajx.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(objajx.responseText);
            const result = JSON.parse(objajx.responseText);
            console.log(result);
        }
        document.location.reload("ModalNuevaOrden.php");
    }
}
</script>

<body>
    <center>
        <h1>Nuevo Orden</h1>
        <form action="">
            <table class="  ">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><label for="">Orden: </label></th>
                        <td><input type="text" class="" value="<?php echo $vector[0]; ?>" name="Orden" id="Orden"
                                <?php if ($b) {
                                                                                                                        echo "disabled";
                                                                                                                    } ?>></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">Chofer: </label></th>
                        <td><input type="text" class="" value="<?php echo $vector[1]; ?>" name="Chofer" id="Chofer"
                                <?php if ($b) {
                                                                                                                        echo "disabled";
                                                                                                                    } ?>></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">FechaRecojo: </label></th>
                        <td><input type="date" class="" value="<?php echo $vector[3]; ?>" name="FechaRecojo"
                                id="FechaRecojo" style="padding-left: 12px;"
                                <?php if ($b) {
                                                                                                                                                                echo "disabled";
                                                                                                                                                            } ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">Cantidad: </label></th>
                        <td><input type="numeric" class="" value="<?php echo $vector[2]; ?>" name="Fecha" id="Cantidad"
                                <?php if ($b) {
                                                                                                                            echo "disabled";
                                                                                                                        } ?>></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">Responsable: </label></th>
                        <td><input type="text" class="" value="<?php echo $nombre ?>" name="Responsable"
                                id="Responsable" disabled></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">Fecha: </label></th>
                        <td><input type="date" class="" value="<?php date_default_timezone_set('America/Lima');
                                                                $fecha = date('Y-m-d');
                                                                echo $fecha; ?>" name="Fecha" id="Fecha" disabled
                                style="padding-left: 12px;"></td>
                    </tr>
                </tbody>
            </table>
            <!--<br>
            <label for=""><b>Nro de pedido - Cemento Andino</b></label>
            <br>
            <input type="numeric" class="" value="" name="NroPedido">
            <br>-->
            <br>
            <a type="submit" href="" name=""><button type="button" class="btn btn-success"
                    onclick="Mostrar(event);">Guardar</button></a>

            <!--<a type="submit" href="" name=""><button type="button" class="btn btn-secondary">Depósito</button></a>
    -->
        </form>
    </center>
</body>

</html>
<script src="https://code.jquery.com/jquery.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>