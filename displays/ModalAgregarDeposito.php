<?php

ob_start();
$nombre = $c->nombreEmpleado($_SESSION['user']);
if (isset($_GET['id'])) {
    $codigoPedido = $_GET['id'];
}

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
    let NroDeposito = document.getElementById('NroDeposito').value;
    let Monto = document.getElementById('Monto').value;
    let Banco = document.getElementById('Banco').value;
    let NroVentanilla = document.getElementById('NroVentanilla').value;
    let fecha = document.getElementById('Fecha').value;
    let NumeroPedido = document.getElementById('NumeroPedido').value;
    let objajx = creaObjetoAjax();
    const parametros = "&NroDeposito=" + NroDeposito + "&Monto=" + Monto + "&Banco=" + Banco + "&NroVentanilla=" +
        NroVentanilla + "&fecha=" + fecha + "&NumeroPedido=" + NumeroPedido;
    objajx.open("POST", "AgregarNuevoDeposito.php", true);

    objajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    objajx.send(parametros);
    objajx.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(objajx.responseText);
            const result = JSON.parse(objajx.responseText);
        }
    }
}
</script>

<body>
    <center>
        <h1>Nuevo Deposito</h1>
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
                        <th scope="row"><label for="">Nro Depósito: </label></th>
                        <td><input type="text" class="" value="" name="Compra" id="NroDeposito">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">Monto: </label></th>
                        <td><input type="numeric" class="" value="" name="Formato" id="Monto"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">Banco: </label></th>
                        <td><input type="text" class="" value="" name="Producto" id="Banco"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">Nro Ventanilla: </label></th>
                        <td><input type="text" class="" value="" name="Fecha" id="NroVentanilla"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">Encargado: </label></th>
                        <td><input type="text" class="" value="<?php echo $nombre ?>" name="Fecha" id="empleado"
                                disabled>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="">Fecha: </label></th>
                        <td><input type="date" class="" value="<?php date_default_timezone_set('America/Lima');
                                                                $fecha = date('Y-m-d');
                                                                echo $fecha; ?>" name="Fecha" id="Fecha"
                                style="padding-left: 12px;"></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <label for=""><b>Nro de pedido - Cemento Andino</b></label>
            <br>
            <input type="numeric" class="" value="<?php echo $codigoPedido; ?>" name="" id="NumeroPedido" disabled>
            <br>
            <br>
            <a type="submit" href="" name=""><button type="button" class="btn btn-success"
                    onclick="Mostrar(event)">Guardar</button></a>

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