<?php
if (isset($_GET['id'])) {
} else {
    echo '<h4>Error</h4>';
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

function asignar(event) {
    //const producto = event.target.value;
    let OrdenAsignar = document.getElementById('OrdenAsignar').value;
    let NroAsignacion = document.getElementById('NroAsignar').value;
    let Pedido = document.getElementById('PedidoAsignar').value;
    let cantidadPedidoAsignado = document.getElementById('CantidadSolicitada').value;
    let objajx = creaObjetoAjax();
    const parametros = "&OrdenAsignar=" + OrdenAsignar + "&NroAsignacion=" + NroAsignacion + "&Pedido=" +
        Pedido + "&cantidadPedidoAsignado=" + cantidadPedidoAsignado;
    objajx.open("POST", "asignarPedido.php", true);
    objajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    objajx.send(parametros);
    objajx.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

        }
        document.location.reload("OrdeneDeRecojo.php");
    }
}
</script>

<body>
    <center>
        <h1>Asignar Pedido</h1>
        <table>
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><label for="">Nro Asignación: </label></th>
                    <td><input type="text" id="NroAsignar"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="">Pedido: </label></th>
                    <td><input type="text" class="" value="" name="" id="PedidoAsignar"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="">Orden: </label></th>
                    <td><input type="text" class="" value="<?php echo $_GET['id']; ?>" name="" id="OrdenAsignar"
                            disabled></td>
                </tr>
                <tr>
                    <th scope="row"><label for="">Cantidad Solicitada: </label></th>
                    <td><input type="numeric" class="" value="" name="" id="CantidadSolicitada"></td>
                </tr>
            </tbody>
        </table>

        <br>
        <button type="button" class="btn btn-success" onclick="asignar(event);">Guardar</button>
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